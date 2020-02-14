        <!-- jQuery  -->
        <script src="{{ URL::asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/metisMenu.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{ URL::asset('assets/js/waves.min.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{ URL::asset('assets/js/typeahead.bundle.js')}}"></script>
        <script src="{{ URL::asset('assets/js/jquery.redirect.js')}}"></script>

        <script src="{{ URL::asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>

        @yield('script')

        <script type="text/javascript">
          var APP_URL = {!! json_encode(url('/')) !!};
          var csrf_token = "{{ csrf_token() }}";
        </script>
        <!-- App js -->
        <script src="{{ URL::asset('assets/js/app.js')}}"></script>
        
        @yield('script-bottom')
