@php
  $eyebrowHeading = get_field('home_logo_eyebrow_heading');
  $heading = get_field('home_logo_heading');
  $description = get_field('home_logo_description');
  $logos = get_field('home_logo_logos');

  if (count($logos) > 6) {
    $sliderClass = 'logo-slider';
  } else {
    $sliderClass = 'logo-grid';
  }
@endphp

<section class="home-logo-section logo-section" id="home-logo-section">
  <div class="container">
    <div class="section-inner-wrp">
      <div class="intro-content text-center">
        @if($eyebrowHeading)
          <span class="eyebrow-heading">@php echo $eyebrowHeading @endphp</span>
        @endif
        @if($heading)
          <h2>@php echo $heading @endphp</h2>
        @endif
        @if($description)
          <p>@php echo $description @endphp</p>
        @endif
      </div>
      <div class="logo-wrp {{$sliderClass}}">
        @if ($logos)
          @foreach( $logos as $logo )
            <div class="logo-item">
              <img src="{{$logo['url']}}" alt="{{$logo['title']}}"/>
            </div>
          @endforeach
        @endif
      </div>
    </div>
  </div>
</section>
