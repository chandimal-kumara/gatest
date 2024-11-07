@php
  $eyebrowHeading = get_sub_field('fcp_testimonials_eyebrow_heading');
  $heading = get_sub_field('fcp_testimonials_heading');
  $description = get_sub_field('fcp_testimonials_description');
  $testimonials = get_sub_field('fcp_testimonials');

  if (count($testimonials) > 3) {
    $sliderClass = 'item-slider d-block';
    $sliderClass2 = 'slider';
  } else {
    $sliderClass = 'item-grid d-block d-xxl-flex';
    $sliderClass2 = 'grid';
  }
@endphp

@if ($testimonials)
  <section class="fcp-section testimonials-section {{$sliderClass2}}">
    <div class="container">
      <div class="section-inner-wrp">
        @if ($eyebrowHeading || $heading || $description)
          <div class="intro-content text-center">
            @if ($eyebrowHeading)
              <span class="eyebrow-heading">@php echo $eyebrowHeading; @endphp</span>
            @endif
            @if ($heading)
              <h2>@php echo $heading; @endphp</h2>
            @endif
            @if ($description)
              @php
                echo $description;
              @endphp
            @endif
          </div>
        @endif
        <div class="testimonials-wrp">
          <div class="testimonials-row row {{$sliderClass}}">
            @foreach ($testimonials as $testimonial)
              @php
                $testimonialId = $testimonial->ID;
                $image = get_field('feedback_image', $testimonialId);
                $name = get_field('feedback_name', $testimonialId);
                $title = get_field('feedback_title', $testimonialId);
                $testimonialDescription = get_field('feedback_description', $testimonialId);
                $rating = (int)get_field('feedback_rating', $testimonialId);
              @endphp
              <div class="testimonials-item-wrp col-12 col-lg-6 col-xxl-4">
                <div class="testimonial-item">
                  <div class="image-wrp">
                    @if ($image)
                      <img src="@php echo esc_url($image['url']); @endphp" alt="@php echo esc_attr($image['caption']); @endphp">
                    @endif
                  </div>
                  <div class="content-wrp">
                    @if ($name)
                      <h4>@php echo $name @endphp</h4>
                    @endif
                    @if ($title)
                      <div class="title-wrp">
                        <p>@php echo $title @endphp</p>
                      </div>
                    @endif
                    @if ($testimonialDescription)
                      <div class="description-wrp">
                        @php echo $testimonialDescription @endphp
                      </div>
                    @endif
                    @if ($rating)
                      <div class="stars-wrp">
                        @for ($i = 0; $i <5; $i++)
                          @if ($i < $rating)
                            <span class="single-star active"></span>
                          @else
                            <span class="single-star"></span>
                          @endif
                        @endfor
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          <div class="flickity-button-wrp"></div>
        </div>
      </div>
    </div>
  </section>
@endif
