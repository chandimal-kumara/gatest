@php
  $footerLogo = get_field('site_logo_footer','options');
  $terms = get_field('site_terms_link','options');
  $privacyPolicy = get_field('site_privacy_link','options');
  $email = get_field('site_email','options');
  $contactNumber = get_field('site_contact_number','options');
  $locations = get_field('site_locations','options');
  $socials = get_field('site_social_links','options');
  $copyRightYear = date("Y");
@endphp

<footer class="footer">
  <div class="footer-top-container">
    <div class="container">
      <div class="footer-top-content">
        <div class="row">
          <div class="col-12 col-md-4 col-xl-2 footer-content footer-logo">
            <div class="footer-logo-wrp">
              <a href="/">
                <img src="@php echo esc_url($footerLogo['url']); @endphp" alt="@php echo esc_attr($footerLogo['alt']); @endphp">
              </a>
            </div>
          </div>
          <div class="col-6 col-md-4 col-xl-2 footer-content footer-menu">
            <div class="footer-menu-wrp">
              @if (has_nav_menu('footer-menu-primary'))
                {!! wp_nav_menu(['theme_location' => 'footer-menu-primary', 'menu_class' => 'nav']) !!}
              @endif
            </div>
          </div>
          <div class="col-6 col-md-4 col-xl-2 footer-content footer-menu">
            <div class="footer-menu-wrp">
              @if (has_nav_menu('footer-menu-secondary'))
                {!! wp_nav_menu(['theme_location' => 'footer-menu-secondary', 'menu_class' => 'nav']) !!}
              @endif
            </div>
          </div>
          <div class="col-12 col-md-4 col-xl-2 footer-content footer-contact">
            @if ($email || $contactNumber)
              <h5>Contact Us</h5>
              <div class="contact-details">
                <div class="contact-detail-item email"><a href="mailto:@php echo $email @endphp">@php echo $email @endphp</a></div>
                <div class="contact-detail-item tel"><a href="tel:@php echo $contactNumber @endphp">@php echo $contactNumber @endphp</a></div>
              </div>
            @endif
          </div>
          <div class="col-12 col-md-4 col-xl-2 footer-content footer-location">
            <h5>Location</h5>
            @if ($locations)
              <div class="location-item-wrp">
                @foreach( $locations as $location )
                @php
                  $address = $location['locations_address'];
                @endphp
                <div class="location-item">
                  <p>@php echo $address; @endphp</p>
                </div>
              @endforeach
              </div>
            @endif
          </div>
          <div class="col-12 col-md-4 col-xl-2 footer-content social-media">
            <h5>Follow Us</h5>
            <div class="social-media-wrp">
              @if ($socials)
                @foreach( $socials as $social )
                  @php
                    $smType = $social['socials_link_type'];
                    $smLink = $social['socials_link_url'];

                    if ($smType == 'facebook') {
                      $smTypeClass = 'fa-brands fa-facebook-f';
                    } else if ($smType == 'instagram') {
                      $smTypeClass = 'fa-brands fa-instagram';
                    } else if ($smType == 'twitter') {
                      $smTypeClass = 'fa-brands fa-x-twitter';
                    } else if ($smType == 'linkedin') {
                      $smTypeClass = 'fa-brands fa-linkedin-in';
                    } else {
                      $smTypeClass = '';
                    }
                  @endphp
                  <div class="social-media-item">
                    @if ($smLink)
                      <a href="@php echo esc_url($smLink['url']); @endphp" target="_blank" class="@php echo $smTypeClass; @endphp">
                      </a>
                    @endif
                  </div>
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom-container">
    <div class="container">
      <div class="d-flex justify-content-between flex-column flex-lg-row">
        <div class="footer-copyright s-para">
          <span class="footer-text">&copy; Copyright @php echo $copyRightYear; @endphp.</span>
          <div class="terms-privacy-wrp">
            @if ($privacyPolicy)
              <a href="@php echo esc_url($privacyPolicy['url']); @endphp">@php echo $privacyPolicy['title'] @endphp</a>
            @endif
            @if ($terms)
              <a href="@php echo esc_url($terms['url']); @endphp">@php echo $terms['title'] @endphp</a>
            @endif
          </div>
        </div>
        <div class="footer-site-details s-para">
          <span class="footer-text">Website by </span>
          <a href="https://smashy.design/" target="_blank">Smashy Design</a>
        </div>
      </div>
    </div>
  </div>
</footer>