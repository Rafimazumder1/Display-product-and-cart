@extends('layout')

@section('content')
<table id="cart" class="table table-hover table-condensed">
    <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
    </thead>
    <tbody>
        @php
            $total = 0;
            $productCount = session('cart') ? count(session('cart')) : 0;
        @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php
                    $subtotal = $details['price'] * $details['quantity'];
                    $total += $subtotal;
                @endphp
                <tr data-id="{{ $id }}">
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hidden-xs"><img src="{{ $details['image'] }}" width="100" height="150" class="img-responsive"/></div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{ $details['name'] }}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{ number_format($details['price'], 2) }}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                    </td>
                    <td data-th="Subtotal" class="text-center subtotal">${{ number_format($subtotal, 2) }}</td>
                    <td class="actions" data-th="">
                        <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa fa-trash-o"></i></button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>

    @php
        $discount = 0;
        if ($productCount >= 3) {
            $discount = $total * 0.10;
        }
        $finalTotal = $total - $discount;
    @endphp

    <tfoot>
        <tr>
            <td colspan="5" class="text-right"><h4><strong>Subtotal: $<span class="cart-total">{{ number_format($total, 2) }}</span></strong></h4></td>
        </tr>
        @if ($discount > 0)
        <tr class="discount-row">
            <td colspan="5" class="text-right text-success">
                <h4><strong>Discount (10% Applied): -$<span class="discount-amount">{{ number_format($discount, 2) }}</span></strong></h4>
            </td>
        </tr>
        @endif
        <tr>
            <td colspan="5" class="text-right"><h3><strong>Final Total: $<span class="final-total">{{ number_format($finalTotal, 2) }}</span></strong></h3></td>
        </tr>
        <tr>
            <td colspan="5" class="text-right">
                <a href="{{ url('/') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a>
                <button class="btn btn-success">Checkout</button>
            </td>
        </tr>
    </tfoot>
</table>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $(".update-cart").change(function (e) {
            e.preventDefault();
            var ele = $(this);

            $.ajax({
                url: '{{ route('update.cart') }}',
                method: "PATCH",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id"),
                    quantity: ele.parents("tr").find(".quantity").val()
                },
                success: function (response) {
                    if (response.success) {

                        ele.parents("tr").find(".subtotal").text('$' + response.total_price);


                        $(".cart-total").text('$' + response.cart_total);

                        
                        if (response.discount > 0) {
                            $(".discount-amount").text('$' + response.discount);
                            $(".discount-row").show();
                        } else {
                            $(".discount-row").hide();
                        }

                        $(".final-total").text('' + response.final_total);
                    }
                }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);

            if (confirm("Are you sure want to remove?")) {
                $.ajax({
                    url: '{{ route('remove.from.cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    });
</script>
@endsection
