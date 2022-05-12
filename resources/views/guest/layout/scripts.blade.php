<!-- JS -->
<script src="{{ asset('bower_components/magz-master-theme/js/jquery.js') }}"></script>
<script src="{{ asset('bower_components/magz-master-theme/js/jquery.migrate.js') }}"></script>
<script src="{{ asset('bower_components/magz-master-theme/scripts/bootstrap/bootstrap.min.js') }}"></script>
<script>
    var $target_end = $(".best-of-the-week");
</script>
<script src="{{ asset('bower_components/magz-master-theme/scripts/jquery-number/jquery.number.min.js') }}"></script>
<script src="{{ asset('bower_components/magz-master-theme/scripts/owlcarousel/dist/owl.carousel.min.js') }}"></script>
<script
src="{{ asset('bower_components/magz-master-theme/scripts/magnific-popup/dist/jquery.magnific-popup.min.js') }}">
</script>
<script src="{{ asset('bower_components/magz-master-theme/scripts/easescroll/jquery.easeScroll.js') }}"></script>
<script src="{{ asset('bower_components/magz-master-theme/scripts/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('bower_components/magz-master-theme/scripts/toast/jquery.toast.min.js') }}"></script>
<script src="{{ asset('bower_components/magz-master-theme/js/e-magz.js') }}"></script>

<script>
    if ({{ Auth::check() }}) {
        window.user = {{ Auth::id() }};
    }
</script>

<script src="{{ asset('js/notification.js') }}"></script>
