@php
  $statistics = get_field('home_cstat_statistics');
@endphp

<section class="home-company-stats-section" id="home-company-statistics">
  <div class="container">
    <div class="section-inner-wrp">
      <div class="row">
        @if($statistics)
        @php
          $counter = 0;
        @endphp
        @foreach ($statistics as $stat)
          @php
            $counter++;
            $statValue = floatval($stat['statistics_figure']);
            $statLabel = $stat['statistics_label'];
            if ($statValue >= 1000000) {
              $statFigure = floor($statValue/1000000);
              $statCharacter = 'M +';
            } elseif ($statValue <= 4999) {
              $statFigure = $statValue;
              $statCharacter = '';
            } else {
              $statFigure = floor($statValue/5000)*5;
              $statCharacter = 'K +';
            }
          @endphp
          <div class="col-12 col-md-4 stat-item-wrp">
            {{-- "count" class activates the counter --}}
            <div class="stat-item">
              <div class="value-wrp d-flex">
                <span id="@php echo "initial-".$counter; @endphp" class="initial-figure xxl-para">0</span>
                <span id="@php echo "final-".$counter; @endphp" class="stat-figure d-none count xxl-para">{{ $statFigure }}</span>
                <span class="stat-figure-letter xxl-para">{{$statCharacter}}</span>
              </div>
              <span class="stat-label l-para">{{ $statLabel }}</span>
            </div>
          </div>
        @endforeach
      @endif
      </div>
    </div>
  </div>
</section>
