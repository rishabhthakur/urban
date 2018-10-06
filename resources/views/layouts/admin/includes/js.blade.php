<!-- Core Javascript and Vue Compilation -->
<script src="{{ asset('js/admin/app.js') }}"></script>

<!-- Third party Javascript -->
<script src="{{ asset('js/fontawesome.js') }}"></script>
<script src="{{ asset('vendor/dropzone/dropzone.js') }}"></script>
<script type="text/javascript" src="{!! asset('vendor/customScrollbar/jquery.mCustomScrollbar.concat.min.js') !!}"></script>
<script src="{{ asset('vendor/tinymce/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/image-picker/image-picker.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });
        $("#notifications").mCustomScrollbar({
            theme: "minimal"
        });
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar, #content').toggleClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });
</script>

<script type="text/javascript">
    $('#noty').on('click', function () {
        axios.get('/api/mark/')
             .then((response) => {
                 console.log(response);
             })
    });
</script>

@yield('settings-js')
@yield('new-post-js')
@yield('new-product-js')
