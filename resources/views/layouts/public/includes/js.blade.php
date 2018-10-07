<!-- Main JS -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- jQuery (Necessary for All JavaScript Plugins) -->
<script src="{!! asset('vendor/public/jquery/jquery-2.2.4.min.js') !!}"></script>
<!-- Plugins js -->
<script src="{!! asset('vendor/public/plugins.js') !!}"></script>
<!-- Classy Nav js -->
<script src="{!! asset('vendor/public/classy-nav.min.js') !!}"></script>
<!-- Active js -->
<script src="{!! asset('vendor/public/active.js') !!}"></script>
<!-- Custom Scrollbar js -->
<script type="text/javascript" src="{!! asset('vendor/customScrollbar/jquery.mCustomScrollbar.concat.min.js') !!}"></script>
<script type="text/javascript">
    // $(document).ready(function () {
    //     $("#mobileMenu").mCustomScrollbar({
    //         theme: "minimal"
    //     });
    // });
</script>
<script type="text/javascript">
    window.setTimeout(function() {
        $(".alert").fadeTo(0, 0).hide(500, function(){
            $(this).remove();
        });
    }, 4000);
</script>
@yield('address-js')
@yield('map-js')
@yield('stripe-js')
