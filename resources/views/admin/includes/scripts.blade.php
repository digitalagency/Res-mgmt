    <!-- jQuery 3.3.1 -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!--Popper-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" defer></script>
    <!-- jQuery UI 1.12.1 -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" defer></script>
<<<<<<< HEAD
    
=======

>>>>>>> 151a5fef7a6889386d189031eb40b7de3903ab86
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{asset('admin/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>    
    
    <!--Magnific-Popup JS-->
    <script src="{{asset('admin/plugins/magnific-popup/magnific-popup.min.js')}}" type="text/javascript"></script>
    <!--Bootstrap wysihtml5 text editor-->
    <script src="{{asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}" type="text/javascript"></script>
    <!-- DATA TABES SCRIPT -->
    
    <script src="{{asset('admin/plugins/datatables/datatables.min.js')}}" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js" defer></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js" defer></script>
   
    <!-- AdminLTE App -->
    <script src="{{asset('admin/js/app.min.js')}}" type="text/javascript"></script>    

<<<<<<< HEAD
    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.1.0/js/vendor/jquery.ui.widget.min.js"></script>
    <!-- The Templates plugin is included to render the upload/download listings -->
    <script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
    
    <!-- blueimp Gallery script -->
    <script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.1.0/js/jquery.iframe-transport.min.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.1.0/js/jquery.fileupload.min.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.1.0/js/jquery.fileupload-process.min.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.1.0/js/jquery.fileupload-image.min.js"></script>
    <!-- The File Upload validation plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.1.0/js/jquery.fileupload-validate.min.js"></script>
    <!-- The File Upload user interface plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-file-upload/10.1.0/js/jquery.fileupload-ui.min.js"></script>

    <!--jQuery Form Validation-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <!--Datepicker-->
    <script src="{{asset('admin/plugins/datepicker/js/datepicker.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/js/toastr.min.js')}}"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-bottom-left",
            "preventDuplicates": true,
            "showDuration": "300",
            "hideDuration": "5000",
            "timeOut": "0",
            "extendedTimeOut": "0",
        };
        @if(Session::has('success'))
            toastr.success("{{Session::get('success')}}");
        @endif
        @if(Session::has('info'))
            toastr.info("{{Session::get('info')}}");
        @endif
    </script>
=======
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.4/js/fileinput.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.4/themes/fa/theme.js" defer></script>
>>>>>>> 151a5fef7a6889386d189031eb40b7de3903ab86

    <!-- for time picker -->
    <script src="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>

    <script type="text/javascript" src="datepair.js"></script>

    <!--Custom Script-->
    <script src="{{asset('admin/js/main.js')}}" defer></script>
<<<<<<< HEAD
    <!-- multiple image upload  -->
    <script src="{{asset('admin/js/multiImage.js')}}" defer></script>
=======

    
>>>>>>> 151a5fef7a6889386d189031eb40b7de3903ab86

