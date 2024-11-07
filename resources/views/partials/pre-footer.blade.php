@php
  if (is_front_page()) {
    if (get_field('home_pfcta_heading')) {
      $heading = get_field('home_pfcta_heading');
    } else {
      $heading = get_field('site_prefooter_heading','options');
    }

    if (get_field('home_pfcta_button')) {
      $button = get_field('home_pfcta_button');
    } else {
      $button = get_field('site_prefooter_link','options');
    }
  } else {
    $isPrefooter = get_field('global_pfcta_show_prefooter');

    if (get_field('global_pfcta_heading')) {
      $heading = get_field('global_pfcta_heading');
    } else {
      $heading = get_field('site_prefooter_heading','options');
    }

    if (get_field('global_pfcta_button')) {
      $button = get_field('global_pfcta_button');
    } else {
      $button = get_field('site_prefooter_link','options');
    }
  }
@endphp

@if ((!is_front_page() && $isPrefooter) || is_front_page())
  <section class="pre-footer">
    <div class="section-inner-wrp">
      <div class="row align-items-end justify-content-between">
        <div class="col-12 col-md-8">
          <div class="text-wrapper">
            @if ($heading)
              <h2>@php echo $heading; @endphp</h2>
            @endif
          </div>
        </div>
        <div class="col-12 col-md-4 text-md-right">
          <div class="button-wrapper">
            @if ($button)
              @include('partials.components.buttons',['buttonName'=>'primary-button','buttonUrl'=>$button['url'], 'buttonTitle'=>$button['title'], 'buttonTarget'=>$button['target']])
            @endif
          </div>
        </div>
      </div>
    </div>
  </section>
@endif
