@php
  if (get_field('global_banner_heading')) {
      $bannerHeading = get_field('global_banner_heading');
  } else {
    $bannerHeading = get_the_title();
  }

  if (is_single()) {
    if (get_field('global_banner_image')) {
      $bannerImage = get_field('global_banner_image');
    } else {
      $bannerImage = get_field('site_fallback_banner_pages','options');
    }
  } else {
    if (get_field('global_banner_image')) {
      $bannerImage = get_field('global_banner_image');
    } else {
      $bannerImage = get_field('site_fallback_banner_posts','options');
    }
  }
@endphp

<section class="page-banner-section p-0">
  <div class="banner-heading-wrp" style="background-image: url(@php echo esc_url($bannerImage['url']); @endphp);">
    <div class="container">
      <div class="banner-wrp">
        @if ($bannerHeading)
          <h1>@php echo $bannerHeading @endphp</h1>
        @endif
      </div>
    </div>
  </div>
  @include('partials.components.breadcrumbs')
</section>
