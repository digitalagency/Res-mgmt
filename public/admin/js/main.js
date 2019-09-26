$(document).ready(function () {
    //load datatable plugin - table viewer
    $('#dataList, table.order-list').DataTable({
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'Bfrtip',
        language: {
            searchPlaceholder: "Search records",
            search: "",
        },
        buttons: [
            { extend: 'pdf',className: 'btn btn-primary glyphicon glyphicon-file' },
            { 
                extend: 'print', 
                exportOptions: {
                    columns: ':visible'
                },
                className: 'btn btn-primary glyphicon glyphicon-print' },
            { extend: 'colvis', className: 'btn btn-primary glyphicon glyphicon-print' },
            
        ],
        // columnDefs: [{
        //     targets: -1,
        //     visible: false
        // }]
    });
    $("input[type='search']").addClass('form-control');
    $("input[type='search']").css({"font-weight": "500", 'width':'250px', 'padding-left': '10px'});

    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();

    /**
     * Click event in the toogle switch of product list page 
     * Chnage the value of the value attribute and
     * Send ajax request to the server
     */
    $(".product-view input").click(function(e){
        inputValue = $(this).attr('value');
        productId = $(this).parent().parent().find('>input').attr('value');
        if($(this).attr('value')==1){
            inputValue = 0;
        }
        else{
            inputValue = 1;
        }
        data = {productId: productId};
        data[$(this).attr('name')] = inputValue;
        
        $.ajax({
            url: '/admin/updatestatus',
            type: 'GET',
            data: data,
        });
    });

    $(".product-status").click(function(e){
        stat = "";
        p = $(this);
        productId = $(this).parent().find('.product-id').val();
        statusInput = $(this).parent().find('.p-status');
        status = statusInput.val();
        if(status == 1){
            status = 0;
            statusInput.attr('value', status);
            stat = 'Inactive';
        }else{
            status = 1;
            statusInput.attr('value', status);
            stat = 'Active';
        }
        $.ajax({
            url: '/admin/updatestatus',
            type: 'GET',
            data: {
                productId: productId,
                status: status
            },
            success: function(){
                p.html(stat);
            }
        })
    });

    /**
     * click event for the additional setting in create product page to change 
     * the value of value attribute
     */
    $(".additional-setting-body input").click(function(e){
        inputValue = $(this).attr('value');
        if(inputValue == 1){
            $(this).attr('value', 0);
        }else{
            $(this).attr('value', 1);
        }
    });


    //.template-upload element bubbles up to tbody.file parent element
    $("tbody.files").on("dblclick", ".template-upload", function (e) { //using event propagation method
        e.preventDefault();
        selectFeaturedImage($(this));
    });

    $("tbody.files tr").dblclick(function(e){
        e.preventDefault();
        selectFeaturedImage($(this));
    });
    
    //show the action buttons of product listing page when an item is hoverd
    $('.product-info').hover(function(){
        actionBtns = $(this).find('.contact-action');
        actionBtns.toggleClass('show-action-btns');
    });

    // $('.delete').click(function(e){
    //     e.preventDefault();
    //     console.log($(this).attr('data-url'));
    // });
    
    $("#readMore").click(function(){
        readMore();
    });



    /**
     * 
     * Popup gallery-section using Magnific-popup library
     */
    $('.popup-gallery').magnificPopup({
        delegate: 'a',      // child items selector, by clicking on it popup will open
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },

        //Prevent to open lightbox if window width is less than the number
        disableOn: function () {
            if ($(window).width() < 600) {
                return false;
            }
            return true;
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: 'title'
        }
    });


    $(".category-products tr").dblclick(function(e){
        window.location = $(this).data('href');
        return false;
    });

    /**
     * Submitting the metadata edit form
     */
    $("#metadataEditForm").submit(function (e){
        e.preventDefault();
        $('p.text-danger').addClass('hide');
        form = $("#metadataEditForm");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $("input[name='_token']").val()
            }
        });
        data = form.serialize();
        $.ajax({
            method: 'PUT',
            dataType: "json",
            cache: 'false',
            url: form.attr('action'),
            data: data,
            error: function (xhr, status, error) {
                    response = JSON.parse(xhr.responseText);
                    errors = response['errors'];
                    $.each(errors, function (key, value) {
                        errorElem = $('input[name=' + key + ']').parent().find('.text-danger');
                        errorElem.removeClass('hide');
                        errorElem.html(value);
                    });
                }
        })
        .done(function(response){
            $('#productMetadataEdit').modal('hide');
            $('#metadata').modal('show');
            $('#metaTitle').html(response.meta_title);
            $('#metaKeywords').html(response.meta_keywords);
            $('#metaDescription').html(response.meta_description);
        })
    });
    
    var dishList = [];
    var dishInfo = [];
    var formData = [];

    var dishId = 0;
    var totalPrice =0;
    var dishId = 0;
    var dishCategoryId = 0;
    var grossPrice = 0;
    var vatAmount = 0;
    var netPrice = 0;
    var tableId = 0;

    var vatPercentage = 0.13;
    var dishPrice;

    $('#orderForm').validate({
        rules: {
            table: {
                required: true,
            },
            dish: {
                required: true,
            },
            dishCategory: {
                required: true,
            },
        }
    });

    /**
     * Show dish type on dish change
     */
    $('#dishCategory').change(function(){
        dishCategoryId = $(this).val();
        dish = $('#dish');
        dish.find("option:gt(0)").remove();     //gt() is a selector method which specifies select index more than 0
        let dishId = $('#dishCategory').val();
        url = productGetUrl.replace('model', dishId);
        $.ajax({
            url: url,
            method: 'get',
            cache: 'false',
            success: function (response) {
                dishInfo = response;
                $.each(response, function (key, dish_type){
                    dish.append(
                        $("<option>", { text: dish_type.name, val: dish_type.id })
                    );
                });
            }
        });
    });

    //Get the price of the selected dish
    $("#dish").change(function () {
        dishId = $(this).val();
        for (var i = 0; i <= dishInfo.length; i++) {
            if (dishInfo[i].id == $(this).val()) {
                var dishDetails = dishInfo[i];
                console.log(dishInfo[i]);
                dishPrice = dishDetails.price.replace('Rs.', '');
                $("#price").val($("#quantity").val() * dishPrice);
                dishTotalPrice = $("#quantity").val() * dishPrice;
                break;
            }
        }
    });

    //Events for quantity and display price on event trigger
    $('#quantity').keyup(function(){
        $("#price").val($("#quantity").val() * dishPrice);
    });
    $('#quantity').change(function(){
        $("#price").val($("#quantity").val() * dishPrice);
    });
    // $('#quantity').mousewheel(function(){
    //     $("#price").val($("#quantity").val() * dishPrice);
    // });

    //refresh the table list on any change
    $.fn.refreshOrderList = function(){
        $('#orderDetails').empty();
        $('#orderSummary').empty();
        $(this).renderDishList(dishList);
    }

    //add an order to a list
    $('#orderForm').submit(function(e){
        e.preventDefault();
        tableId = parseInt($("#table").val());
        totalPrice = parseFloat($('#price').val()) + parseFloat(totalPrice);
        $('#totalPrice').val(totalPrice);
        console.log(totalPrice);
        dishInfo = {
            dishId: parseInt(dishId),
            dishCategoryName: $("#dishCategory option:selected").text(),
            dishCategoryId: parseInt(dishCategoryId),
            dishName: $("#dish option:selected").text(),
            quantity: parseInt($("#quantity").val()),
            price: parseFloat($("#price").val()),
        };
        dishList.push(dishInfo);
        if(dishInfo.price > 1){
            $(this).refreshOrderList();
            $(this).trigger('reset');
        }else{
            alert('Please select all required fields');
        }
        console.log(dishList);
    });

    //delete an item from the table list
    $.fn.deleteDishFromList = function(index){
        console.log(dishList[index]);
        var con = confirm("Are you sure you want to remove dish from order?");
        if (con){
            dishList.splice(index, 1);
            $(this).refreshOrderList();
        }
    }

    //display ordered item in a list and show total price
    $.fn.renderDishList = function(data){
        $.each(data, function(index, dish){
            netPrice += parseInt(dish.price);
            $('#orderDetails').append(
                $('<tr>').append(
                    $('<td>', {text: dish.dishName}),
                    $('<td>', {text: dish.dishCategoryName}),
                    $('<td>', {text: dish.quantity}),
                    $('<td>', {text: dish.price}),
                    $("<td>").append(
                        $("<button>", {
                            class: "btn btn-danger btn-xs",
                            onClick: "$(this).deleteDishFromList(" + index + ")"
                        }).append(
                            $("<span>", { class: "fa fa-trash" })
                        )
                    )
                )
            )
        });
        if(dishList.length != 0){
            grossPrice = $(this).vatCalculator(netPrice);
            $('#orderDetails').append(
                $('<tr>').append(
                    $('<td>', {colspan: 3, text: 'Total (exc. VAT):', class: 'text-right'}),
                    $('<th>', {text: netPrice})
                )
            );
            $('#orderDetails').append(
                $('<tr>').append(
                    $('<td>', {colspan: 3, text: 'Total (inc. VAT-13%):', class: 'text-right'}),
                    $('<th>', {text: grossPrice})
                )
            );
            // $('#orderSummary').append(
            //     $('<div>', { class: 'form-group' }).append(
            //         $('<label>', {class: 'col-sm-2 control-label', text: 'Price incl. VAT'}),
            //         $('<div>', {class: 'col-sm-5'}).append(
            //             $('<input>', { class: 'form-control', id: 'grossPrice', 
            //                             type: 'number', disabled: 'disabled', value: grossPrice
            //             })
            //         )
            //     )
            // )
            // $('#orderSummary').append(
            //     $('<div>', {class: 'form-group'}).append(
            //         $('<label>', {class: 'col-sm-2 control-label', text: 'Payment'}),
            //         $('<div>', {class: 'col-sm-5'}).append(
            //             $('<input>', {class: 'form-control', id: 'payment', type: 'number', min: 1, 
            //                             onChange: "$(this).showChange(" + netPrice + ")",
            //                             onkeyup: "$(this).showChange(" + netPrice + ")",
            //             })
            //         )
            //     )
            // )
            // $('#orderSummary').append(
            //     $('<div>', {class: 'form-group'}).append(
            //         $('<label>', {class: 'col-sm-2 control-label', text: 'Change'}),
            //         $('<div>', {class: 'col-sm-5'}).append(
            //             $('<input>', {class: 'form-control', id: 'paymentChange', 
            //                             type: 'number', disabled: 'disabled'
            //                         })
            //         )
            //     ),
            // )
            $('#orderSummary').append(
                $('<div>', {class: 'form-group'}).append(
                    $('<div>', {class: 'col-sm-5'}).append(
                        $('<button>', {class: 'btn btn-success', text: 'Submit Order', onClick: "$(this).saveOrder()"})
                    )
                )
            );
        }
    }
    //calculate VAT amount
    $.fn.vatCalculator = function(netPrice){
        vatAmount = parseFloat((vatPercentage * netPrice).toFixed(2));
        grossPrice = netPrice + vatAmount;
        return grossPrice;
    }
    //now not needed
    //calculate change amount to be retured to customer
    $.fn.showChange = function(total){
        payment = $(this).val();
        console.log(payment);
        if(payment != null){
            if(total - payment < 0){
                change = (payment - grossPrice).toFixed(2);
                $('#paymentChange').val(change);
            }
            else {
                change = '';
                $('#paymentChange').val(change);
            }
        }else{
            change = '';
            $('#paymentChange').val(change);
        }
    }

    $.fn.saveOrder = function(){
        console.log('Order Submit!');
        let saveOrder = {
            _token: $("input[name=_token]").val(),
            tableId: tableId,
            dishList: dishList,
            netPrice: netPrice,
            grossPrice: grossPrice,
            vat: vatAmount
        }
        console.log(saveOrder);
        $.post("/admin/order", saveOrder, function(data){
            console.log(data);
        }).done(function(){
            $("#table option[value='"+tableId+"']").fadeOut(100);
            toastr.success('Success! Order Has been done successfully');
            dishList = [];
            $(this).refreshOrderList();
        })
    }
    $('.order-delete').click(function(e){
        e.preventDefault();
        var tr = $(this).closest('tr');
        url = $(this).data('url');
        $.ajax({
            method: 'delete',
            url: url,
            success: function(data){
                if(data == true){
                    tr.fadeOut(function(){
                        $(this).remove();
                    });
                }else{
                    alert("Cannot delete the data!!!");
                }
            }
        })
    })
});

//convert form data into json
function convertIntoJson(form){
    var array = jQuery(form).serializeArray();
    var json = {};
    $.each(array, function(){
        json[this.name] = this.value || '';
    });
    return json;
}


/**
 * Displying certain content of the whole document and toggle show all and show less
 */
function readMore() {
    var dots = $('#dots');
    var moreText = $('#more')
    var btnText = $('#readMore')
    if (dots.css('display') == "none") {
        dots.css('display', 'inline');
        btnText.html("Read more");
        moreText.css('display', 'none');
    } else {
        dots.css('display','none');
        btnText.html("Read less");
        moreText.css('display', 'inline');
    }
}

/**
 * For selecting the featured image of the product
 * 
 * @param object elem 
 */
function selectFeaturedImage(elem){
    $("tbody.files tr").removeClass('featured-image');
    elem.toggleClass('featured-image');
    imageName = elem.find('.image-name').html();
    console.log(imageName);
    $("#featuredImage").attr('value', imageName);
}