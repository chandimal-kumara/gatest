@php
  $eyebrowHeading = get_sub_field('fcp_accordion_eyebrow_heading');
  $heading = get_sub_field('fcp_accordion_heading');
  $description = get_sub_field('fcp_accordion_description');
  $accordion = get_row_index();
  $accordionContents = get_sub_field('fcp_accordion_content');
  $count = 0;
@endphp

@if ($accordionContents)
  <section class="fcp-section accordion-section">
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
              <p>@php echo $description; @endphp</p>
            @endif
          </div>
        @endif
        <div class="accordion-wrp" id="accordionFaq{{$accordion}}">
          @foreach ($accordionContents as $accordionContent)
            @php
              $title = $accordionContent['accordion_title'];
              $content = $accordionContent['accordion_description'];
              $accordionItem = "{$accordion}_item_{$count}";
            @endphp

            <div class="accordion-item-wrp">
              @if ($title)
                <div class="faq-title @php if ($count!=0) { echo('collapsed'); }; @endphp" data-toggle="collapse" data-target="#collapse{{$accordionItem}}">
                  <p class="l-para">@php echo $title @endphp</p>
                  <span class="accord-icon"></span>
                </div>
              @endif
              @if ($content)
                <div id="collapse{{$accordionItem}}" class="faq-content collapse @php if ($count==0) { echo('show'); }; @endphp" data-parent="#accordionFaq{{$accordion}}">
                  <div class="faq-content-inner-wrp">
                    @php echo $content @endphp
                  </div>
                </div>
              @endif
            </div>
            @php
              $count++;
            @endphp
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endif
