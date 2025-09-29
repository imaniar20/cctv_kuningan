@include('partials.head')
<body data-spy="scroll" data-target="#templateux-navbar" data-offset="200">

    @include('partials.navbar')
    @include('partials.css')
    @yield('Content')

    @include('partials.footer')

    @stack('before-script')
    @include('partials.js')
    @stack('after-script')
    @include('partials.session')
</body>