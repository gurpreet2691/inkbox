<?php

namespace App\Http\Controllers;

use App\Models\PrintSheet;
use Illuminate\Support\Facades\DB;

class PrintSheetController extends Controller
{
    public function index()
    {
        return view('print_sheet', [
            'sheets' => PrintSheet::all()->map->format()
        ]);
    }

    public function show(int $id)
    {
        $print_sheets = DB::table('print_sheet AS ps')
                            ->select(DB::raw('p.title, p.size, psi.status, ps.sheet_url'))
                            ->join('print_sheet_items AS psi', 'psi.ps_id', '=' , 'ps.ps_id')
                            ->join('orders_items AS oi', 'oi.order_item_id', '=', 'psi.order_item_id')
                            ->join('products AS p', 'p.product_id', '=', 'oi.product_id')
                            ->where('ps.ps_id', '=', $id)
                            ->get();

        return view('print_sheet_items', [
            'sheet_items' => $print_sheets
        ]);
    }
}

