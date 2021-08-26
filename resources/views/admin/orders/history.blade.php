<div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Disc (%)</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            {{ $date }}
            {{-- @foreach ($order_history as $key=>$order)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $order->product_name }}</td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>
</div>