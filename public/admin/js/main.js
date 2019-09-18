$(document).ready(function () {
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

    $(function () {
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });


    $( function() {
        $( "#tabs" ).tabs();
    });

    // for uploading file

    $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

    $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });


    $('.readMore').click(function(){
          elem = $(this);
          readMore(elem);
        });

    $('#timeRange .time').timepicker({
        'showDuration': true,
        'timeFormat': 'g:ia'
    });
    
      var basicExampleEl = document.getElementById('timeRange');
      var datepair = new Datepair(basicExampleEl);
});
/**
 * 
 * Displying certain content of the whole document and toggle show all and show less
 * 
 */
function readMore(elem) {
    var dots = elem.parent().find('.dots');
    var moreText = elem.parent().find('.more');
    var btnText = elem.parent().find('.readMore');
    if (dots.css('display') == "none") {
        dots.css('display', 'inline');
        btnText.html("Read More");
        moreText.css('display', 'none');
    } else {
        dots.css('display','none');
        btnText.html("Read less");
        moreText.css('display', 'inline');
    }
}
