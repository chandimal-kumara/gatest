<div class="breadcrumb-wrp">
  <div class="container">
    <div id="breadcrumb-scroll" class="text-wrp">
      @php
        global $wp_query;
        $post = $wp_query->post;
        $ancestors = array_reverse(get_post_ancestors($post));
      @endphp
      <span class="link-wrp">
        <a href="@php echo get_home_url(); @endphp">
          Home
        </a>
        @foreach ($ancestors as $ancestor)
          <a href="@php echo get_permalink( $ancestor ); @endphp">
            @php echo get_the_title( $ancestor ); @endphp
          </a>
        @endforeach
      </span>
      <span class="current-page">@php echo get_the_title(); @endphp</span>
    </div>
  </div>
</div>
