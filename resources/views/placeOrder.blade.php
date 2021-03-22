@extends('layout.mainlayout')

@section('content')
    <div class="album text-muted">
        <div class="container">
            <div class="row">
                <div class="mb-3">
                    <form action=" {!! route('place_order') !!}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Select products</label>
                            <select class="form-select" id="product" name="product">
                                @foreach($products as $product)
                                    <option value="{{ $product['id'] }}">{{ $product['title'] }} size: {{ $product['size'] }} price: {{ $product['price'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Quantity</label>
                            <input type="number" name="quantity" min="0">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark">Place Order</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

<b></b>
