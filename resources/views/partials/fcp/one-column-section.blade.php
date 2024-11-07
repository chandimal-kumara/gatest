@php
  $backgroundColor = get_sub_field('fcp_one_col_background');
  $eyebrowHeading = get_sub_field('fcp_one_col_eyebrow_heading');
  $heading = get_sub_field('fcp_one_col_heading');
  $content = get_sub_field('fcp_one_col_content');
  $button = get_sub_field('fcp_one_col_button');
  $image = get_sub_field('fcp_one_col_image');

  if ($backgroundColor == "none") {
    $bgClass = "";
  } elseif ($backgroundColor == "color-1") {
    $bgClass = "bg-enabled color-1 stick-all";
  }
@endphp

@if ($image && $backgroundColor == "none")
  @if ($eyebrowHeading || $heading || $content)
    <section class="fcp-section one-column-section with-image stick-bottom">
      <div class="container">
        <div class="section-inner-wrp">
          <div class="content-section">
            <div class="heading-wrp">
              @if ($eyebrowHeading)
                <span class="eyebrow-heading">@php echo $eyebrowHeading @endphp</span>
              @endif
              @if ($heading)
                <h2>@php echo $heading @endphp</h2>
              @endif
            </div>
            <div class="content-wrp">
              @if ($content)
                @php echo $content @endphp
              @endif
            </div>
            <div class="button-wrp">
              @if ($button)
                @include('partials.components.buttons',['buttonName'=>'primary-button','buttonUrl'=>$button['url'], 'buttonTitle'=>$button['title'], 'buttonTarget'=>$button['target']])
              @endif
            </div>
          </div>
        </div>
      </div>
      @if ($image)
        <div class="image-wrp">
          <img src="@php echo esc_url($image['url']); @endphp">
          @if ($image['caption'])
            <div class="caption-wrp">
              <div class="container">
                <p>{{$image['caption']}}</p>
              </div>
            </div>
          @endif
        </div>
      @endif
    </section>
  @endif
@else
  @if ($eyebrowHeading || $heading || $content)
    <section class="fcp-section one-column-section {{ $bgClass }}">
      <div class="container">
        <div class="section-inner-wrp">
          <div class="content-section">
            <div class="heading-wrp">
              @if ($eyebrowHeading)
                <span class="eyebrow-heading">@php echo $eyebrowHeading @endphp</span>
              @endif
              @if ($heading)
                <h2>@php echo $heading @endphp</h2>
              @endif
            </div>
            <div class="content-wrp">
              @if ($content)
                @php echo $content @endphp
              @endif
            </div>
            <div class="button-wrp">
              @if ($button)
                @include('partials.components.buttons',['buttonName'=>'primary-button','buttonUrl'=>$button['url'], 'buttonTitle'=>$button['title'], 'buttonTarget'=>$button['target']])
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif
@endif

