<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\OrdersItems;
use App\Models\PrintSheet;
use App\Models\PrintSheetItems;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    protected $algo;
    protected CONST PRINT_SHEET_AREA = 100;

    public function __construct(\Algorithm $algo)
    {
       $this->algo = $algo;
    }

    public function index(Request $request)
    {
        return view('orders', [
            'orders' => Orders::all()->map->format()
        ]);
    }

    public function placeOrder(Request $request)
    {
       $product_id = $request->input('product');
       $quantity = $request->input('quantity');

       $product = Products::FindOrFail($product_id)->format();

        try {
            DB::beginTransaction();

            // insert Order
            $order = new Orders();
            $order->order_number = rand(1000, 10000);
            $order->customer_id = 1;
            $order->total_price = $product['price'] * $quantity;
            $order->fulfillment_status = 'pending';
            $order->customer_order_count = rand(1, 10);
            $order->save();

            //insert order_items
            $order_items = new OrdersItems();
            $order_items->order_id = $order->order_id;
            $order_items->product_id = $product_id;
            $order_items->quantity = $quantity;
            $order_items->refund = 0;
            $order_items->save();

            //fetch all the orders
            $orders = DB::table('orders AS o')
                    ->select(DB::raw('SUM(oi.quantity) as quantity, p.title, p.size, p.type, oi.order_item_id'))
                    ->join('orders_items AS oi', 'o.order_id', '=', 'oi.order_id')
                    ->join('products AS p', 'p.product_id', '=', 'oi.product_id')
                    ->groupBy(['oi.product_id', 'oi.order_item_id'])
                    ->get();

            // expand the product quantity.
            $products = $this->expandQuantities($orders->toArray());

            // sort the order based on the size desc
            $sort_by_size = array_column($products, 'size');
            array_multisort($sort_by_size, SORT_DESC, $products);
            $sheets = $this->algo->bestFitAlgo(['area' => self::PRINT_SHEET_AREA], $products);

            foreach ($sheets as $key => $sheet) {
                //insert data into print sheet
                $print_sheet = new PrintSheet();
                $print_sheet->type = 'test';
                $print_sheet->sheet_url = '\test\\' . $key;
                $print_sheet->save();

                foreach ($sheet['rect'] as $rect) {
                    //insert data into print_sheet_items
                    $print_sheet_items = new PrintSheetItems();
                    $print_sheet_items->ps_id = $print_sheet->ps_id;
                    $print_sheet_items->order_item_id = $rect->order_item_id;
                    $print_sheet_items->x_pos = 0;
                    $print_sheet_items->y_pos = 0;
                    $print_sheet_items->width = 0;
                    $print_sheet_items->height = 0;
                    $print_sheet_items->image_url = 'testurl';
                    $print_sheet_items->status = 'complete';
                    $print_sheet_items->size = $rect->size;
                    $print_sheet_items->save();
                }
        }
           DB::commit();
       } catch (\Exception $e) {
           DB::rollBack();

           throw new \Exception($e->getMessage());
       }
    }

    public function store(Request $request)
    {
        $products = Products::all()->map->format();
        return view('placeOrder', [
            'products' => $products
        ]);
    }

    public function show(int $id)
    {
        $order = Orders::findOrFail($id);

        return $order->orderItems;
    }

    private function expandQuantities(array $items): array
    {
        $expanded_items = [];
        foreach ($items as $item) {
            if (array_key_exists('quantity', $item) && $item->quantity > 0) {
                $count = $item->quantity;
                for ($i = 0; $i < $count; $i++) {
                    $new_item = $item;
                    $new_item->quantity = 1;
                    $expanded_items[] = $new_item;
                }
            } else {
                $expanded_items[] = $item;
            }
        }

        return $expanded_items;
    }
}
