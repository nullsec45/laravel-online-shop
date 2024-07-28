@stack('prepend-script')
<script src="{{url('/vendor/jquery/jquery.slim.min.js')}}"></script>
<script src="{{url('/vendor/bootstrap/js/bootstrap.bundle.min.j')}}s"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script>
  $("#menu-toggle").click(function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
</script>
@stack('addon-script')