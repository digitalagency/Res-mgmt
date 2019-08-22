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
        $("tbody.files tr").removeClass('featured-image');
        $(this).toggleClass('featured-image');
        imageName = $(this).find('p.image-name').html();
        // console.log(imageName);
        $("#featuredImage").attr('value', imageName);
    });
    
});

