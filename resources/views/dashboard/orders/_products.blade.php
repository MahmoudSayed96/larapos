@push('styles')
    <style>
        @media only print {
            #print-area table{
                width: 90%;
                margin: 10px auto;
                text-align:center;
                border:1px solid #ddd;
            }
        }
    </style>
@endpush
<div class="box">
    <div id="print-area">
        @if ($products->count()>0)
            <!-- Client-info -->
            <div class="client-info">
                <ul class="list-unstyled">
                    <li>@lang('site.date'): <strong dir="ltr">{{$order->created_at->toDateTimeString()}}</strong></li>
                    <li>@lang('site.client_name'): <strong>{{$order->client->name}}</strong></li>
                    <li>@lang('site.bill_no'): <strong>{{$order->id}}</strong></li>
                </ul>
            </div>
            <!-- ./Client-info -->
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

