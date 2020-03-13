@include('layouts.admin.header')
    <div class="container-fluid page-body-wrapper">
      @include('layouts.admin.sidebar')
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
        @include('layouts.admin.footer')
  