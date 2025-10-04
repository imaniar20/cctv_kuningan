@include('Front/Partials.head')
<body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        @include('Front/Partials.sidebar')
        
        <div class="layout-page">
            @include('Front/Partials.navbar')

            <div class="content-wrapper">
              <div class="container-xxl flex-grow-1 container-p-y">
                @yield('Content')
              </div>

                @include('Front/Partials.footer')
                <div class="content-backdrop fade"></div>
            </div>
        </div>
      </div>
    </div>
    @stack('before-script')
    @include('Front/Partials.js')
    @stack('after-script')
    @include('Front/Partials.session')
</body>