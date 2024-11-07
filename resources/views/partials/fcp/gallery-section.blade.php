
@php
  $eyebrowHeading = get_sub_field('fcp_gallery_eyebrow_heading');
  $heading = get_sub_field('fcp_gallery_heading');
  $layout = get_sub_field('fcp_gallery_layout');

  if ($layout == 'layout-variation-1') {
    $content = get_sub_field('gallery_layout_v1');
    $gallery = $content['images_v1'];
  } elseif ($layout == 'layout-variation-2') {
    $content = get_sub_field('gallery_layout_v2');
    $galleryTemp = $content['images_v2'];

    if ((count($galleryTemp))%4 == 0) {
      $gallery = $galleryTemp;
    } else {
      $gallery = array_slice($galleryTemp,0, (count($galleryTemp))%4*(-1));
    }
  }
@endphp

@if ($layout == 'layout-variation-1')
  @if ($gallery)
    <section class="fcp-section gallery-section v1">
      <div class="container">
        <div class="section-inner-wrp">
          @if ($eyebrowHeading || $heading)
            <div class="intro-content">
              @if ($eyebrowHeading)
                <span class="eyebrow-heading">@php echo $eyebrowHeading @endphp</span>
              @endif
              @if ($heading)
                <h2>@php echo $heading @endphp</h2>
              @endif
            </div>
          @endif
          <ul class="gallery-wrapper gallery-images-viewer-v1">
            @foreach( $gallery as $galleryItem )
              <li class="gallery-item">
                <img src="@php echo esc_url($galleryItem['url']); @endphp" alt="@php echo esc_attr($galleryItem['alt']); @endphp"/>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </section>
  @endif
@elseif ($layout == 'layout-variation-2')
  @if ($gallery)
    <section class="fcp-section gallery-section v2 stick-bottom">
      <div class="section-inner-wrp">
        @if ($eyebrowHeading || $heading)
          <div class="intro-content">
            <div class="container">
              @if ($eyebrowHeading)
                <span class="eyebrow-heading">@php echo $eyebrowHeading @endphp</span>
              @endif
              @if ($heading)
                <h2>@php echo $heading @endphp</h2>
              @endif
            </div>
          </div>
        @endif
        <ul class="gallery-wrapper row m-0 gallery-images-viewer-v2">
          @foreach( $gallery as $galleryItem )
            <li class="gallery-item col-6 col-md-3 p-0">
              <img src="@php echo esc_url($galleryItem['url']); @endphp" alt="@php echo esc_attr($galleryItem['alt']); @endphp"/>
            </li>
          @endforeach
        </ul>
      </div>
    </section>
  @endif
@endif