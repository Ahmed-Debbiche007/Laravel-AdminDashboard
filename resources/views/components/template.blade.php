<x-dashboardHeader>
    <body id="page-top">
        <div id="wrapper">
            {{$slot}}
        </div>

        <x-logoutModal />

        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
    </body>
</x-dashboardHeader>