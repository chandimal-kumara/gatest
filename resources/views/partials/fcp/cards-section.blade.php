@php
  $gridOrSlider = get_sub_field('fcp_cards_new_image_or_slider');
  $gridMobileLayout = get_sub_field('fcp_cards_new_grid_mobile_layout');
  $eyebrowHeading = get_sub_field('fcp_cards_new_eyebrow_heading');
  $heading = get_sub_field('fcp_cards_new_heading');
  $cards = get_sub_field('fcp_cards_new_card_content');

  if ($gridOrSlider) {
    $cardsType = "slider";
    $cardsDisplay = "d-block";
  } else {
    $cardsType = "grid";
    $cardsDisplay = "d-block d-md-flex justify-content-center";
  }

  if ($gridMobileLayout) {
    $gridLayout = "mobile-slider";
  }
@endphp

@if ($cards)
  <section class="fcp-section cards-section-new @php echo $cardsType; @endphp @php echo $gridLayout; @endphp">
    <div class="container">
      <div class="section-inner-wrp">
        @if ($eyebrowHeading || $heading)
          <div class="intro-content text-center">
            @if ($eyebrowHeading)
              <span class="eyebrow-heading">@php echo $eyebrowHeading; @endphp</span>
            @endif
            @if ($heading)
              <h2>@php echo $heading; @endphp</h2>
            @endif
          </div>
        @endif
        <div class="cards-wrp row @php echo $cardsDisplay; @endphp">
          @foreach ($cards as $card)
            @php
              $imageVariation = $card['cards_new_image_select'];
              $image = $card['cards_new_image'];
              $cardContent = $card['cards_new_content'];
              $link = $card['cards_new_link'];

              if ($imageVariation == 'image') {
                $imageType = 'image';
              } elseif ($imageVariation == 'b-image') {
                $imageType = 'background-image';
              } elseif ($imageVariation == 'icon') {
                $imageType = 'icon';
              } else {
                $imageType = 'none';
              }
            @endphp
            <div class="cards-item-wrp col-12 col-md-6 col-xl-4 col-xxl-3">
              @if ($link)
                @if ($imageVariation == 'b-image')
                  <a class="cards-item-inner-wrp @php echo $imageType; @endphp" href="@php echo esc_url($link['url']); @endphp" style="background-image: url('@php echo esc_url($image['url']); @endphp')">
                @else
                  <a class="cards-item-inner-wrp @php echo $imageType; @endphp" href="@php echo esc_url($link['url']); @endphp">
                @endif
              @else
                @if ($imageVariation == 'b-image')
                  <div class="cards-item-inner-wrp @php echo $imageType; @endphp" style="background-image: url('@php echo esc_url($image['url']); @endphp')">
                @else
                  <div class="cards-item-inner-wrp @php echo $imageType; @endphp">
                @endif
              @endif
                @if ($imageVariation == 'image')
                  <div class="image-wrapper">
                    <img src="@php echo esc_url($image['url']); @endphp" alt="@php echo esc_attr($image['alt']); @endphp">
                  </div>
                @endif
                @if ($imageVariation == 'icon')
                  <div class="image-wrapper">
                    <img src="@php echo esc_url($image['url']); @endphp" alt="@php echo esc_attr($image['alt']); @endphp">
                  </div>
                @endif
                @if ($cardContent)
                  <div class="content-wrp">
                    @php
                      echo $cardContent;
                    @endphp
                  </div>
                @endif
                @if ($link)
                  <div class="button-wrp">
                    <span class="btn btn-read-more">@php echo ($link['title']); @endphp</span>
                  </div>
                @endif
              @if ($link)
                </a>
              @else
              </div>
              @endif
            </div>
          @endforeach
        </div>
        <div class="flickity-button-wrp"></div>
      </div>
    </div>
  </section>
@endif
