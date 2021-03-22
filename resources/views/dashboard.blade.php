@extends('layout')
@include('nav')
@section('body')
<br><hr>
<div class="container">



        <div class="col-xs-12">
        </div>




        <div class="col-xs-12">
            <label> Menu Items </label> <br>
            <!-- <button class="btn btn-success" id="add_menu_item_btn">Add Menu Item</button> <br> <br> -->
            <table class="table text-center" id="items_table">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Price with 12% VAT (Actual Price)</th>
                        <th>Qty</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="category" id="category">
                                <option value="0">--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select name="item" id="item">
                                <option value="0">--</option>
                            </select>
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            <input type="number" name="qty" id="qty" placeholder="QUANTITY" required class="form-control">
                        </td>
                        <td><a href="#" class="addItem">Add</a></td>
                    </tr>
                </tbody>
            </table>
        </div>



        <div class="col-xs-12">
            <label> Orders</label>
            <table class="table" id="orders_table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <div class="col-xs-12">
            <label>Coupon (optional):</label> <br>
            <input type="text" name="coupon" id="coupon" placeholder="TYPE COUPON CODE">
        </div> <br>

</div>
<script>
$(document).ready(function(){
    var oOrder = {
        aOrderedItems: [],

        init: function() {
            this.cacheDOM();
            this.bindEvents();
        },

        cacheDOM: function() {
            this.oCategory = $('#category');
            this.oMenuItem = $('#item');
            this.oAddMenuItem = $('#add_menu_item_btn');
            this.oOrderTable = $('#orders_table');
        },

        bindEvents: function() {
            oOrder.oCategory.on('change', function() {
                var iCategory = oOrder.oCategory.val();
                oOrder.getMenuItems(iCategory);
            });

            oOrder.oAddMenuItem.on('click', oOrder.addMenuItem);


            oOrder.oMenuItem.on('change', function() {
                var iItem = oOrder.oMenuItem.val();
                oOrder.getItemData(iItem);
            });

            // $('#items_table').on('click','tr a.remove',function(e){
            //     e.preventDefault();
            //     var iItemRowsCount = $('#items_table tbody tr').length;
            //     if (iItemRowsCount <= 1) {
            //         return;
            //     }
            //     $(this).closest('tr').remove();
            // });

            $('#items_table').on('click','tr a.addItem',function(e){
                e.preventDefault();
                
                if ($('#qty').val() === '') {
                    return alert('Please input quantity')
                }
                oOrderedItem = {
                    id: oOrder.oMenuItem.val(),
                    name: $('#item option:selected').text(),
                    price: parseFloat($('#item option:selected').attr('actual_price')),
                    quantity: parseInt($('#qty').val())
                };
                oOrder.aOrderedItems.push(oOrderedItem);
                console.log(oOrder.aOrderedItems);
                oOrder.addOrderItem();
            });
        },

        getMenuItems: function (iCategory) {
            oOrder.oMenuItem.empty();
            $.ajax({
                url: '/items',
                method: 'POST',
                dataType: 'json',
                data: {
                    iCategory: iCategory
                },
                success: function(oResponse) {
                    var oFirstItem = oResponse[0];
                    var iActualPrice = oOrder.computeActualItemPrice(oFirstItem.price, oFirstItem.tax);
                    oOrder.oMenuItem.closest('td').next().text('P'+oFirstItem.price);
                    oOrder.oMenuItem.closest('td').next().next().text('P'+iActualPrice);
                    
                    $.each(oResponse, function(items, item) {
                        oOrder.oMenuItem.append($('<option />').val(item.id).text(item.name).attr('actual_price', iActualPrice) );
                    })
                }
            });
        },

        computeActualItemPrice: function(price, tax) {
            var price = parseFloat(price);
            var tax = parseFloat(tax);
            return (price + (price * (tax / 100)));
        },

        addMenuItem: function() {
            $('#items_table tbody tr:last').clone().insertAfter('#items_table tbody tr:last');
        },

        getItemData: function(iItem) {
            $.ajax({
                url: '/item/'+iItem,
                method: 'GET',
                dataType: 'json',
                success: function(oItem) {
                        var iActualPrice = oOrder.computeActualItemPrice(oItem.price, oItem.tax);
                        oOrder.oMenuItem.closest('td').next().text('P'+oItem.price);
                        oOrder.oMenuItem.closest('td').next().next().text('P'+iActualPrice);

                }
            })
        },

        addOrderItem: function() {
            $('#orders_table tbody').empty();
            var oItemRow = '';
            $.each(oOrder.aOrderedItems, function(items, item) {
                // console.log(item);
                oItemRow += '<tr><td>' + item.name + '</td><td>' + item.quantity + '</td><td>' + item.price + '</td></tr>';
            });
            $('#orders_table tbody').append(oItemRow);
        }
    }

    oOrder.init();

});
</script>
@endsection
