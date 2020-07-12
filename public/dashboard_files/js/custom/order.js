$(document).ready(function () {
    // add product btn listener
    $('.add-product-btn').on('click', function (evt) {
        evt.preventDefault();

        var id = $(this).data('id');
        var name = $(this).data('name');
        var price = $.number($(this).data('price'), 2);
        var stock = $(this).data('stock');

        // make disabled
        $(this).removeClass('btn-success').addClass('btn-default disabled');

        var html = `<tr id="row_${id}">
                    <td>${name}</td>
                    <td>
                        <input type="number" name="products[${id}][quantity]" data-price="${price}" class="form-control input-sm product-quantity"  min="1" max="${stock}" value="1">
                    </td>
                    <td class="product-price">${price}</td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>`;
        $('.order-list').append(html);
        // calc total
        calculateTotalPrice();
    }); //end of add product btn

    // prevent default behavior of disabled btn
    $('body').on('click', '.disabled', function (e) {
        e.preventDefault();
    }); //end of disabled

    // Remove product and reset add product btn style
    $('body').on('click', '.remove-product-btn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $(`#product_${id}`).removeClass('btn-default disabled').addClass('btn-success');
        $(`#row_${id}`).remove();
        // calc total
        calculateTotalPrice();
    }); //end of remove product btn

    // calculate total price on change product quantity
    $('body').on('change keyup', '.product-quantity', function (e) {
        var unitPrice = parseFloat($(this).data('price').replace(/,/g, ''));
        var quantity = parseFloat($(this).val().replace(/,/g, ''));

        $(this).closest('tr').find('.product-price').text($.number(unitPrice * quantity, 2));
        // calc total
        calculateTotalPrice();
    }); //end of change quantity

    // get order products btn
    $('.order-products').on('click', function (e) {
        e.preventDefault();
        $('.loading').css('display', 'flex');
        var _url = $(this).data('url');
        var _method = $(this).data('method');
        $.ajax({
            url: _url,
            method: _method,
            success: function (response) {
                $('.loading').css('display', 'none');
                $('.order-products-list').empty();
                $('.order-products-list').append(response);
            }
        }); //end of ajax
    }); //end of order products

    // print order products list
    $(document).on('click', '#print-btn', function (e) {
        e.preventDefault();
        var _url = $(this).data('url');
        $.ajax({
            url: _url,
            method: 'GET',
            success: function (response) {
                console.log(response);
                if (response) {
                    $('#print-area').printThis();
                }
            }
        }); //end of ajax
    }); // end of print this

    // Price selection.
    $('.select-price').on('change', function () {
        var price = $(this).children("option:selected").val();
        var id = $(this).children("option:selected").data('product');
        var saleType = $(this).children("option:selected").data('sale');
        var product = 'product_' + id;
        $(this).parent().find('.selected-price').text(price);
        //Change data-price of product you chose.
        $('#' + product).attr('data-price', price);
        // Change sale type.
        var saleUrl = $(this).children("option:selected").data('url');
        console.log(saleUrl);
        $.ajax({
            url: saleUrl,
            method: 'POST',
            data: {
                'sale_type': saleType,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response);
            }
        }); //end of ajax
    }); // end of price selection.

}); //end of ready

// METHODS
// calculate total price of products order
function calculateTotalPrice() {
    var price = 0;
    $('.order-list .product-price').each(function (index) {
        price += parseFloat($(this).text().replace(/,/g, ''));
    });
    $('.total-price').text($.number(price, 2));

    // add order btn Active or not active
    // check if price > 0
    if (price > 0) {
        $('#add_order_form_btn').removeClass('disabled');
    } else {
        $('#add_order_form_btn').addClass('disabled');
    }
} // end of calculate total price
