    <div class="box">
    <div id="print-area">
        @if ($products->count()>0)
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>@lang('site.name')</th>
                        <th>@lang('site.quantity')</th>
                        <th>@lang('site.price')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $index=>$product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->pivot->quantity }}</td>
                            <td>{{ number_format($product->sale_price * $product->pivot->quantity,2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table><!-- ./table -->
            <h3>
                @lang('site.total'): <span>{{ number_format($order->total_price,2) }}</span>
            </h3>
        @else
            <h2 class="text-center">@lang('site.no_data_found')</h2>
        @endif
    </div>
    {{-- Pagination --}}
    {{ $products->appends(request()->query())->links() }}
    <button id="print-btn" class="btn btn-primary btn-block">
        <i class="fa fa-print"></i> @lang('site.print')
    </button>
</div>

