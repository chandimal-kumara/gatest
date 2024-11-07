@php
  $layout = get_sub_field('fcp_image_layout');

  if ($layout == 'layout-variation-1') {
    $content = get_sub_field('fcp_image_layout_v1');

    $imageWidth = $content['image_width_v1'];
    $image = $content['image_v1'];

    if($imageWidth) {
      $imageWidthClass = 'full-width-image';
    } else {
      $imageWidthClass = 'constrained-image';
    }

  } else if ($layout == 'layout-variation-2') {
    $content = get_sub_field('fcp_image_layout_v2');

    $image1 = $content['image1_v2'];
    $image2 = $content['image2_v2'];
  }
@endphp

@if ($layout == 'layout-variation-1')
  @if ($image)
    @if ($image['caption'])
      <section class="fcp-section image-section v1 {{$imageWidthClass}}">
    @else
      <section class="fcp-section image-section v1 no-caption stick-all {{$imageWidthClass}}">
    @endif
      @if ($imageWidth)
        <div class="section-inner-wrp option-1">
          @if ($image['caption'])
            <div class="container">
              <div class="caption-outer">
                <div class="caption-wrp">
                  <p class="s-para">@php echo esc_attr($image['caption']); @endphp</p>
                </div>
              </div>
            </div>
          @endif
          <div class="image-wrp">
            <img src="@php echo esc_url($image['url']); @endphp" alt="@php echo esc_attr($image['title']); @endphp">
          </div>
        </div>
      @else
        <div class="container">
          <div class="section-inner-wrp option-2">
            <div class="image-wrp">
              <img src="@php echo esc_url($image['url']); @endphp" alt="@php echo esc_attr($image['title']); @endphp">
            </div>
            @if ($image['caption'])
              <div class="caption-outer">
                <div class="caption-wrp">
                  <p class="s-para">@php echo esc_attr($image['caption']); @endphp</p>
                </div>
              </div>
            @endif
          </div>
        </div>
      @endif
    </section>
  @endif
@elseif ($layout == 'layout-variation-2')
  @if ($image1 || $image2)
    <section class="fcp-section image-section v2">
      <div class="container">
        <div class="section-inner-wrp">
          <div class="content-images">
            <div class="image image-1">
              <div class="image-inner">
                <img src="@php echo esc_url($image1['url']); @endphp" alt="@php echo esc_attr($image1['title']); @endphp">
              </div>
              @if ($image1['caption'])
                <div class="caption-wrp">
                  <p class="s-para">@php echo esc_attr($image1['caption']); @endphp</p>
                </div>
              @endif
            </div>
            <div class="image image-2">
              <div class="image-inner">
                <img src="@php echo esc_url($image2['url']); @endphp" alt="@php echo esc_attr($image2['title']); @endphp">
              </div>
              @if ($image2['caption'])
                <div class="caption-wrp">
                  <p class="s-para">@php echo esc_attr($image2['caption']); @endphp</p>
                </div>
              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif
@endif
