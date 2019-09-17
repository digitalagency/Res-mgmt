$(document).ready(function () {
    numberofTr = $('.update-table .files tr').length;
});
$(function () {
    'use strict';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $("input[name='_token']").val()
        }
    });
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $('#fileupload').attr('action')
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(/\/[^/]*$/, '/cors/result.html?%s')
    );

    if (window.location.hostname === '127.0.0.1') {
        // Demo settings:
        $('#fileupload').fileupload('option', {
            url: $('#fileupload').attr('action'),
            // Enable image resizing, except for Android and Opera,
            // which actually support image resizing, but fail to
            // send Blob objects via XHR requests:
            disableImageResize: /Android(?!.*Chrome)|Opera/.test(
                window.navigator.userAgent
            ),
            maxFileSize: 999000,
            acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
        });
        // Upload server status check for browsers with CORS support:
        if ($.support.cors) {
            $.ajax({
                url: $('#fileupload').attr('action'),
                type: 'HEAD'
            }).fail(function () {
                $('<div class="alert alert-danger"/>')
                    .text('Upload server currently unavailable - ' + new Date())
                    .appendTo('#fileupload');
            });
        }
    } else {
        // Load existing files:
        a = $('#fileupload').addClass('fileupload-processing');
        console.log(a);
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0],
        })
            .always(function () {
                $(this).removeClass('fileupload-processing');
            })
            .done(function (result) {
                $(this)
                    .fileupload('option', 'done')
                    // eslint-disable-next-line new-cap
                    .call(this, $.Event('done'), { result: result });
            })
    }
});

//send ajax request
//delete the item and remove it from the list
$('.delete').click(function (e) {
    e.preventDefault();
    
    //table row in edit page
    var tr = $(this).closest('tr');
    //product information container in product listing page
    if($(this).parent() == $('div.contact-action')){        //Check if the request is coming from index page
        productInfo = $(this).parent().parent().parent().parent();
    }
    
    $.ajax({
        url: $(this).data('url'),
        type: $(this).data('type'),
        success: function(data){
            if(data == true){
                //After deleting the image remove the 
                tr.fadeOut(function(){
                    $(this).remove();
                });
                //After delete product remove product from the list
                if(!productInfo){
                    productInfo.fadeOut(function(){
                        $(this).remove();
                    });
                }
            }
            else{
                alert("Cannot delete the data!!!");
            }
        }
    });
});

//if no additional image was uploaded
$('.edit').on("click", function (e) {
    e.preventDefault();
    if (numberofTr == $('.update-table .files tr').length){
        $('p.text-danger').addClass('hide');
        $.ajax({
            url: $('#fileupload').attr('action'),
            type: 'post',
            data:{ 
                    data: $('#fileupload input').serialize(), 
                    description: $.trim($("textarea[name=description]").val()),
                    category_id: $("#category_id").val(),
                    meta_description: $.trim($("textarea[name=meta_description]").val()),
                },
            success: function (response) {
                toastr.success('Product updated successfully!!!');
            },
            error: function (xhr, status, error) {
                if (error == 'Conflict') {
                    response = JSON.parse(xhr.responseText);
                    $.each(response, function (key, value) {
                        errorElem = $('input[name=' + key + ']').parent().find('.error');
                        errorElem.removeClass('hide');
                        errorElem.html(value);
                    });
                }
            },
        });
    }
});