@php
  $eyebrowHeading = get_sub_field('fcp_logo_eyebrow_heading');
  $heading = get_sub_field('fcp_logo_heading');
  $description = get_sub_field('fcp_logo_description');
  $logos = get_sub_field('fcp_logo_gallery');

  if (count($logos) > 6) {
    $sliderClass = 'logo-slider';
  } else {
    $sliderClass = 'logo-grid';
  }
@endphp

@if ($logos)
  <section class="fcp-section logo-section">
    <div class="container">
      <div class="section-inner-wrp">
        @if ($eyebrowHeading || $heading || $description)
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
        @endif
        <div class="logo-wrp {{$sliderClass}}">
          @foreach( $logos as $logo )
            <div class="logo-item">
              <img src="{{$logo['url']}}" alt="{{$logo['title']}}"/>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endif
