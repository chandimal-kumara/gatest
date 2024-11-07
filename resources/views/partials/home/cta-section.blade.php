@php
  $heading = get_field('home_cta_heading');
  $image = get_field('home_cta_image');
  $button = get_field('home_cta_button');
@endphp

<section class="home-cta-section" id="home-cta-section" style="background-image: url({{$image['url']}})">
  <div class="container">
    <div class="section-inner-wrp">
      <div class="content-wrp text-center">
        @if ($heading)
          <p class="xxl-para">@php echo $heading @endphp</p>
        @endif
        @if ($button)
          @include('partials.components.buttons',['buttonName'=>'cta-button','buttonUrl'=>$button['url'], 'buttonTitle'=>$button['title'], 'buttonTarget'=>$button['target']])
        @endif
      </div>
    </div>
  </div>
</section>
