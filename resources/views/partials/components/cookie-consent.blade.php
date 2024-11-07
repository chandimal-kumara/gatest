@php
  $cookieConsent = get_field('site_is_cookie_popup', 'options');
  $heading = get_field('site_cookie_heading', 'options');
  $description = get_field('site_cookie_description', 'options');
  $buttons = get_field('site_cookie_buttons', 'options');
  $customizePopup = get_field('customize_popup_menu', 'options');

  if (!$cookieConsent) {
    setcookie("popupCookie", "submited", time() + 100 * 24 * 60 * 60);
    setcookie("popupCookieAllowed", "necessary,performance,functional,targetting", time() + 100 * 24 * 60 * 60);
  }
@endphp

@if ($cookieConsent)
  <div class="cookie-click-icon" id="fixed-cookie-logo" style="display: none">
    <div class="img-wrp">
    </div>
  </div>
  <div class="cookie-wrp" id="cookie-consent-section" style="display: none">
    <div class="section-wrp">
      <div class="heading-wrp">
        <h3>@php echo $heading @endphp</h3>
      </div>
      <div class="content-wrp row">
        <div class="col-4">
          <div class="img-wrp">
          </div>
        </div>
        <div class="col-8">
          <div class="text-content">
            @php
              echo $description;
            @endphp
          </div>
        </div>
      </div>
      <div class="btn-wrp">
        <span class="btn btn-primary" id="accept-all-button">@if ($buttons['accept_all']) @php echo $buttons['accept_all'] @endphp @else @php echo "Accept All" @endphp @endif</span>
        <span class="btn btn-primary" id="accept-necessary-button">@if ($buttons['accept_necessary']) @php echo $buttons['accept_necessary'] @endphp @else @php echo "Accept Necessary" @endphp @endif</span>
        <span class="btn btn-primary" id="accept-customize-button" data-toggle="modal" data-target="#cookiePopupModal"> @if ($buttons['customize']) @php echo $buttons['customize'] @endphp @else @php echo "Customize" @endphp @endif</span>
      </div>
    </div>
    @php
    $customizeTitle = $customizePopup['costomize_title'];
    $customizeContent = $customizePopup['customize_content'];
    $customizeNecessary = $customizePopup['customize_strictly_necessary'];
    $customizePerformance = $customizePopup['customize_performance'];
    $customizeFunctional = $customizePopup['customize_functional'];
    $customizeTargetting = $customizePopup['customize_targetting'];
    $customizeConfirmBtn = $customizePopup['customize_confirm_button_text'];

    if ($customizeConfirmBtn) {
      $confirmButton = $customizeConfirmBtn;
    } else {
      $confirmButton = "Confirm Preferences";
    }

    @endphp
    <div class="modal fade" id="cookiePopupModal" tabindex="-1" role="dialog" aria-labelledby="cookiePopupModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cookiePopupModalLabel">@php echo $customizeTitle; @endphp</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="accordion-wrp" id="accordion-cookie-popup">
              <div class="toggle-accordion-wrp">
                <label class="toggle-btn">
                  <input id="necessary-cookies-toggle" type="checkbox" checked disabled>
                  <span class="slider round"></span>
                </label>
                <div class="accordion-item-wrp">
                  <div class="faq-title collapsed" data-toggle="collapse" data-target="#collapse-1">
                    <p class="l-para">Strictly Necessary Cookies</p>
                    <span class="accord-icon"></span>
                  </div>
                  <div id="collapse-1" class="faq-content collapse" data-parent="#accordion-cookie-popup">
                    <div class="faq-content-inner-wrp">
                      @php echo $customizeNecessary @endphp
                    </div>
                  </div>
                </div>
              </div>
              <div class="toggle-accordion-wrp">
                <label class="toggle-btn">
                  <input id="performance-cookies-toggle" type="checkbox">
                  <span class="slider round"></span>
                </label>
                <div class="accordion-item-wrp">
                  <div class="faq-title collapsed" data-toggle="collapse" data-target="#collapse-2">
                    <p class="l-para">Performance Cookies</p>
                    <span class="accord-icon"></span>
                  </div>
                  <div id="collapse-2" class="faq-content collapse" data-parent="#accordion-cookie-popup">
                    <div class="faq-content-inner-wrp">
                      @php echo $customizePerformance @endphp
                    </div>
                  </div>
                </div>
              </div>
              <div class="toggle-accordion-wrp">
                <label class="toggle-btn">
                  <input id="functional-cookies-toggle" type="checkbox">
                  <span class="slider round"></span>
                </label>
                <div class="accordion-item-wrp">
                  <div class="faq-title collapsed" data-toggle="collapse" data-target="#collapse-3">
                    <p class="l-para">Functional Cookies</p>
                    <span class="accord-icon"></span>
                  </div>
                  <div id="collapse-3" class="faq-content collapse" data-parent="#accordion-cookie-popup">
                    <div class="faq-content-inner-wrp">
                      @php echo $customizeFunctional @endphp
                    </div>
                  </div>
                </div>
              </div>
              <div class="toggle-accordion-wrp">
                <label class="toggle-btn">
                  <input id="targetting-cookies-toggle" type="checkbox">
                  <span class="slider round"></span>
                </label>
                <div class="accordion-item-wrp">
                  <div class="faq-title collapsed" data-toggle="collapse" data-target="#collapse-4">
                    <p class="l-para">Targetting Cookies</p>
                    <span class="accord-icon"></span>
                  </div>
                  <div id="collapse-4" class="faq-content collapse" data-parent="#accordion-cookie-popup">
                    <div class="faq-content-inner-wrp">
                      @php echo $customizeTargetting @endphp
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <span class="btn btn-primary" id="confirm-preferences">@php echo $confirmButton; @endphp</span>
          </div>
        </div>
      </div>
    </div>
  </div>
@endif