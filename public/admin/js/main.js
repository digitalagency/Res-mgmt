$(document).ready(function () {
    //load datatable plugin - table viewer
    $('#dataList').DataTable({
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
        columnDefs: [{
            targets: -1,
            visible: false
        }]
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
                    console.log(xhr.responseText);
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
});

/**
 * 
 * Displying certain content of the whole document and toggle show all and show less
 * 
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