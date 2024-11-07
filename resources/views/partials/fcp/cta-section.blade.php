@php
  $eyebrowHeading = get_sub_field('fcp_cta_eyebrow_heading');
  $heading = get_sub_field('fcp_cta_heading');
  $button = get_sub_field('fcp_cta_button');
@endphp

@if ($eyebrowHeading || $heading || $button)
  <section class="fcp-section cta-section bg-enabled stick-all p-0">
    <div class="container">
      <div class="section-inner-wrp">
        <div class="content-wrp">
          @if ($eyebrowHeading)
            <span class="eyebrow-heading">@php echo $eyebrowHeading; @endphp</span>
          @endif
          @if ($heading)
            <h2>@php echo $heading; @endphp</h2>
          @endif
          @if ($button)
          <div class="button-wrp">
            @include('partials.components.buttons',['buttonName'=>'cta-button','buttonUrl'=>$button['url'], 'buttonTitle'=>$button['title'], 'buttonTarget'=>$button['target']])
          </div>
          @endif
        </div>
      </div>
    </div>
  </section>
@endif
