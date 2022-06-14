@include('layouts.header')

<body>
    <div id="app">
      <div class="main-wrapper">
        @include('layouts.navbar')
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content">

          <section class="section">
            @yield('content')
          </section>

        </div>

        @include('layouts.footer')

      </div>
    </div>

    @include('layouts.js')
    @yield('script')
    @include('sweetalert::alert')
</body>
</html>
