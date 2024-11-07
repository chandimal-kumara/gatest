@php
  $image = get_field('home_about_image');
  $eyebrowHeading = get_field('home_about_eyebrow_heading');
  $heading = get_field('home_about_heading');
  $description = get_field('home_about_description');
  $button = get_field('home_about_button');
@endphp

<section class="home-about-section" id="home-about-us">
  @if($image)
    <div class="image-wrp d-none d-lg-block" style="background-image: url(@php echo esc_url($image['url']); @endphp);"></div>
  @endif
  <div class="container">
    <div class="section-inner-wrp">
      <div class="row m-0">
        <div class="col-12 col-lg-6 offset-lg-6 p-0">
          <div class="content-wrp">
            @if($eyebrowHeading)
              <span class="eyebrow-heading">@php echo $eyebrowHeading @endphp</span>
            @endif
            @if($heading)
              <h2>@php echo $heading @endphp</h2>
            @endif
            @if($image)
              <div class="image-wrp d-block d-lg-none" style="background-image: url(@php echo esc_url($image['url']); @endphp);"></div>
            @endif
            @if($description)
              @php echo $description @endphp
            @endif
            @if($button)
              @include('partials.components.buttons',['buttonName'=>'primary-button','buttonUrl'=>$button['url'], 'buttonTitle'=>$button['title'], 'buttonTarget'=>$button['target']])
              @include('partials.components.buttons',['buttonName'=>'secondary-button','buttonUrl'=>$button['url'], 'buttonTitle'=>$button['title'], 'buttonTarget'=>$button['target']])
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
