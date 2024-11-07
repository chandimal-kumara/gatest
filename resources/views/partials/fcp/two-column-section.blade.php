@php
  $backgroundColor = get_sub_field('fcp_two_col_new_background');
  $eyebrowHeading = get_sub_field('fcp_two_col_new_eyebrow_heading');
  $heading = get_sub_field('fcp_two_col_new_heading');

  $content = get_sub_field('fcp_two_col_new_column_content');

  if ($backgroundColor == "none") {
    $bgClass = "";
  } elseif ($backgroundColor == "color-1") {
    $bgClass = "bg-enabled color-1 stick-all";
  }
@endphp

@if ($content)
  <section class="fcp-section two-column-section {{$bgClass}}">
    <div class="container">
      <div class="section-inner-wrp">
        @if ($eyebrowHeading || $heading)
          <div class="intro-content text-lg-center">
            @if ($eyebrowHeading)
              <span class="eyebrow-heading">@php echo $eyebrowHeading @endphp</span>
            @endif
            @if ($heading)
              <h2>@php echo $heading @endphp</h2>
            @endif
          </div>
        @endif
        @php
          $selectCol1 = $content['two_col_new_col1_select'];
          $imageCol1 = $content['two_col_new_col1_image'];
          $contentCol1 = $content['two_col_new_col1_content'];

          $selectCol2 = $content['two_col_new_col2_select'];
          $imageCol2 = $content['two_col_new_col2_image'];
          $contentCol2 = $content['two_col_new_col2_content'];
        @endphp
        @if ($selectCol1 == 'image' && $selectCol2 == 'content')
          <div class="two-column-wrp row m-0 align-items-center">
            <div class="col-12 col-lg-6 p-0 img-left">
              <div class="image-wrapper">
                <img src="@php echo esc_url($imageCol1['url']); @endphp" alt="@php echo esc_attr($imageCol1['alt']); @endphp">
              </div>
            </div>
            <div class="col-12 col-lg-6 p-0 content-right">
              <div class="content-wrp editor-content-wrp">
                @php
                  echo $contentCol2;
                @endphp
              </div>
            </div>
          </div>
        @endif
        @if ($selectCol1 == 'content' && $selectCol2 == 'image')
          <div class="two-column-wrp row m-0 align-items-center">
            <div class="col-12 col-lg-6 p-0 order-lg-1 order-2 content-left">
              <div class="content-wrp editor-content-wrp">
                @php
                  echo $contentCol1;
                @endphp
              </div>
            </div>
            <div class="col-12 col-lg-6 p-0 order-lg-2 order-1 img-right">
              <div class="image-wrapper">
                <img src="@php echo esc_url($imageCol2['url']); @endphp" alt="@php echo esc_attr($imageCol2['alt']); @endphp">
              </div>
            </div>
          </div>
        @endif
        @if ($selectCol1 == 'image' && $selectCol2 == 'image')
          <div class="two-column-wrp row m-0">
            <div class="col-12 col-lg-6 p-0 img-left">
              <div class="image-wrapper">
                <img src="@php echo esc_url($imageCol1['url']); @endphp" alt="@php echo esc_attr($imageCol1['alt']); @endphp">
              </div>
            </div>
            <div class="col-12 col-lg-6 p-0 img-right">
              <div class="image-wrapper">
                <img src="@php echo esc_url($imageCol2['url']); @endphp" alt="@php echo esc_attr($imageCol2['alt']); @endphp">
              </div>
            </div>
          </div>
        @endif
        @if ($selectCol1 == 'content' && $selectCol2 == 'content')
          <div class="two-column-wrp row m-0">
            <div class="col-12 col-lg-6 p-0 content-left">
              <div class="content-wrp editor-content-wrp">
                @php
                  echo $contentCol1;
                @endphp
              </div>
            </div>
            <div class="col-12 col-lg-6 p-0 content-right">
              <div class="content-wrp editor-content-wrp">
                @php
                  echo $contentCol2;
                @endphp
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>
@endif



