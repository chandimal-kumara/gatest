<!doctype html>
<html {!! get_language_attributes() !!}>
  @include('partials.head')
  <body @php body_class('header-variation') @endphp>
    @php do_action('get_header') @endphp
    @include('partials.header')
    <div class="wrap" role="document">
      <div class="content">
        <main class="main">
          @if (!is_front_page())
            @include('partials.banner')
          @endif
          @yield('content')
          @include('partials.components.cookie-consent')
        </main>
        @if (App\display_sidebar())
          <aside class="sidebar">
            @include('partials.sidebar')
          </aside>
        @endif
      </div>
    </div>
    @if (!is_single())
      @include('partials.pre-footer')
    @endif
    @php do_action('get_footer') @endphp
    @include('partials.footer')
    @php wp_footer() @endphp
  </body>
</html>
