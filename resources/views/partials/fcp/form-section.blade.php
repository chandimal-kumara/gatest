@php
  $image = get_sub_field('fcp_form_image');
  $eyebrowHeading = get_sub_field('fcp_form_eyebrow_heading');
  $heading = get_sub_field('fcp_form_heading');
  $contactShortcode = get_sub_field('fcp_form_short_code');
@endphp

@if ($contactShortcode)
  <section class="fcp-section form-section stick-all">
    <div class="section-inner-wrp">
      @if ($image)
        <div class="image-wrp" style="background-image: url(@php echo esc_url($image['url']); @endphp);"></div>
      @endif
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-6 offset-lg-6">
            <div class="form-wrp">
              @if ($eyebrowHeading)
                <span class="eyebrow-heading">@php echo $eyebrowHeading; @endphp</span>
              @endif
              @if ($heading)
                <h2>@php echo $heading; @endphp</h2>
              @endif
              @php echo do_shortcode($contactShortcode); @endphp
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endif








