// $(function () {
//     'use strict';
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $("input[name='_token']").val()
//         }
//     });
//     // Initialize the jQuery File Upload widget:
//     $('#fileupload').fileupload({
//         // Uncomment the following to send cross-domain cookies:
//         //xhrFields: {withCredentials: true},
//         url: $('#fileupload').attr('action')
//     });

//     // Enable iframe cross-domain access via redirect option:
//     $('#fileupload').fileupload(
//         'option',
//         'redirect',
//         window.location.href.replace(/\/[^/]*$/, '/cors/result.html?%s')
//     );

//     if (window.location.hostname === '127.0.0.1') {
//         // Demo settings:
//         $('#fileupload').fileupload('option', {
//             url: $('#fileupload').attr('action'),
//             // Enable image resizing, except for Android and Opera,
//             // which actually support image resizing, but fail to
//             // send Blob objects via XHR requests:
//             disableImageResize: /Android(?!.*Chrome)|Opera/.test(
//                 window.navigator.userAgent
//             ),
//             maxFileSize: 999000,
//             acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
//         });
//         // Upload server status check for browsers with CORS support:
//         // if ($.support.cors) {
//         //     $.ajax({
//         //         url: '//jquery-file-upload.appspot.com/',
//         //         type: 'HEAD'
//         //     }).fail(function () {
//         //         $('<div class="alert alert-danger"/>')
//         //             .text('Upload server currently unavailable - ' + new Date())
//         //             .appendTo('#fileupload');
//         //     });
//         // }
//     } else {
//         // Load existing files:
//         $('#fileupload').addClass('fileupload-processing');
//         $.ajax({
//             // Uncomment the following to send cross-domain cookies:
//             //xhrFields: {withCredentials: true},
//             url: $('#fileupload').fileupload('option', 'url'),
//             dataType: 'json',
//             // type: 'put',
//             context: $('#fileupload')[0]
//         })
//             .always(function () {
//                 $(this).removeClass('fileupload-processing');
//             })
//             .done(function (result) {
//                 $(this)
//                     .fileupload('option', 'done')
//                     // eslint-disable-next-line new-cap
//                     .call(this, $.Event('done'), { result: result });
//             });
//         $('#fileupload').reset();
//     }

//     $('#fileupload').bind('fileuploadsubmit', function (e, data) {
//         // The example input, doesn't have to be part of the upload form:
//         var input = $('#fileupload input');
//         data.formData = { data: input.serialize(), 
//                             description: $.trim($("#fileupload textarea").val()),
//                             category_id: $("#category_id").val()};
//         if (!data.formData.example) {
//             data.context.find('button').prop('disabled', false);
//             input.focus();
//             return false;
//         }
//     });
    
// });

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
        $('#fileupload').addClass('fileupload-processing');
        $.ajax({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: $('#fileupload').fileupload('option', 'url'),
            dataType: 'json',
            context: $('#fileupload')[0]
        })
            .always(function () {
                $(this).removeClass('fileupload-processing');
            })
            .done(function (result) {
                $(this)
                    .fileupload('option', 'done')
                    // eslint-disable-next-line new-cap
                    .call(this, $.Event('done'), { result: result });
            });
    
    //     $('#fileupload').bind('fileuploadsubmit', function (e, data) {
    //     // The example input, doesn't have to be part of the upload form:
    //     var input = $('#fileupload input');
    //     data.formData = { data: input.serialize(), 
    //                         description: $.trim($("#fileupload textarea").val()),
    //                         category_id: $("#category_id").val()};
    //     if (!data.formData.example) {
    //         data.context.find('button').prop('disabled', false);
    //         input.focus();
    //         return false;
    //     }
    // });    
}
});

//send ajax request for deleting the image
$('.delete').click(function (e) {
    
    e.preventDefault();
    var tr = $(this).closest('tr');
    $.ajax({
        url: $(this).attr('data-url'),
        type: $(this).attr('data-type'),
        success: function(data){
            if(data == true){
                tr.fadeOut(function(){
                    $(this).remove();
                });
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
    // if ($('#preview').html().length < 1) {
        console.log('submitting without image');

        $.ajax({
            url: $('#fileupload').attr('action'),
            type: 'post',
            data: { data: $('#fileupload input').serialize(), 
                    description: $.trim($("#fileupload textarea").val()),
                    category_id: $("#category_id").val(),
                    },
            // beforeSend: function (xhr) {
            //     xhr.setRequestHeader("Content-Type", "application/json");
            // },
            success: function (result) {
                // console.log(result);
                if (!result.error) {
                    $('#modal-account-activated-success').modal('show');
                    $("#submitbtn").removeAttr('disabled');
                    $('#mercname').html('');
                    // window.setTimeout(function () {
                    //     window.location.href = config.settings.user_url;
                    // }, 3000);

                } else {
                    //analytics.track('completeProfileError', {
                    //  error        : JSON.parse(result.responseText).error,
                    //  activationKey: sessionStorage.getItem("activationkey")
                    //});
                    // $('#modal-account-activated-error').modal('show');
                    // $('#submitloader').html('');
                    // $("#submitbtn").removeAttr('disabled');
                }
            },
            error: function (e) {
                $('<div class="alert alert-danger"/>')
                    .text(JSON.parse(e.responseText).error.messages[0])
                    .appendTo('#fileupload');
                //analytics.track('completeProfileError', {
                //  error        : e,
                //  activationKey: sessionStorage.getItem("activationkey")
                //});
                // $('#errormessage').html(JSON.parse(e.responseText).error.messages[0]);
                // $('#modal-account-activated-error').modal('show');
                // $('#submitloader').html('');
                // $("#submitbtn").removeAttr('disabled');
            }
        });
    // }
});