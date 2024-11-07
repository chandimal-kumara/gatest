@php
  $eyebrowHeading = get_field('home_cs_eyebrow_heading');
  $heading = get_field('home_cs_heading');
  $description = get_field('home_cs_description');
  $projects = get_field('home_cs_projects');
@endphp

<section class="home-case-studies-section" id="home-case-studies">
  <div class="container">
    <div class="section-inner-wrp">
      <div class="intro-content text-center">
        @if($eyebrowHeading)
          <span class="eyebrow-heading">@php echo $eyebrowHeading @endphp</span>
        @endif
        @if($heading)
          <h2>@php echo $heading @endphp</h2>
        @endif
        @if($description)
          <p>@php echo $description @endphp</p>
        @endif
      </div>
      <div class="case-studies-wrp">
        @if ($projects)
          @php
            $count = 0;
            $leftItems = [];
            $rightItems = [];
            $mobileItems = [];

            foreach( $projects as $project ):
              $featureImage = get_the_post_thumbnail_url($project->ID, 'full');
              $title = get_the_title($project->ID);
              // $content = get_post_field('post_content', $project->ID);
              $content = get_the_excerpt($project->ID);
              $permalink = get_permalink($project->ID);

              $data = [$featureImage, $title, $content, $permalink];
              // $mobileItems = $data;

              if ($count % 2 == 0) {
                array_push($leftItems, $data);
                array_push($mobileItems, $data);
              } else {
                array_push($rightItems, $data);
                array_push($mobileItems, $data);
              }

              if ($count > 0 && ($count % 2 == 0)) {}
              $count++;
            endforeach;
            // var_dump($mobileItems);
          @endphp
          <div class="row d-none d-md-flex">
            <div class="col-6 left-column">
              @foreach ($leftItems as $left)
                @php
                  $image = '/wp-content/themes/roots/resources/assets/images/default-photo.jpg';
                  if ($left[0] != null) {
                    $image = $left[0];
                  }
                @endphp
                <div class="case-studies-item">
                  <div class="image-wrp">
                    <img src="{{$image}}" alt="{{$left[1]}}">
                  </div>
                  <div class="content-wrp">
                    <h4>@php echo $left[1]; @endphp</h4>
                    <p>@php echo $left[2]; @endphp</p>
                    @include('partials.components.buttons',['buttonName'=>'read-more-button','buttonUrl'=>$left[3], 'buttonTitle'=>'Read More'])
                  </div>
                </div>
              @endforeach
            </div>
            <div class="col-6 right-column">
              @foreach ($rightItems as $right)
                @php
                  $image = '/wp-content/themes/roots/resources/assets/images/default-photo.jpg';
                  if ($right[0] != null) {
                    $image = $right[0];
                  }
                @endphp
                <div class="case-studies-item">
                  <div class="image-wrp">
                    <img src="{{$image}}" alt="{{$right[1]}}">
                  </div>
                  <div class="content-wrp">
                    <h4>@php echo $right[1]; @endphp</h4>
                    <p>@php echo $right[2]; @endphp</p>
                    @include('partials.components.buttons',['buttonName'=>'read-more-button','buttonUrl'=>$right[3], 'buttonTitle'=>'Read More'])
                  </div>
                </div>
              @endforeach
            </div>
          </div>
          <div class="mobile-content d-block d-md-none">
            @foreach ($mobileItems as $items)
                @php
                  $image = '/wp-content/themes/roots/resources/assets/images/default-photo.jpg';
                  if ($items[0] != null) {
                    $image = $items[0];
                  }
                @endphp
                <div class="case-studies-item">
                  <div class="image-wrp">
                    <img src="{{$image}}" alt="{{$items[1]}}">
                  </div>
                  <div class="content-wrp">
                    <h4>@php echo $items[1]; @endphp</h4>
                    <p>@php echo $items[2]; @endphp</p>
                    @include('partials.components.buttons',['buttonName'=>'read-more-button','buttonUrl'=>$items[3], 'buttonTitle'=>'Read More'])
                  </div>
                </div>
              @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
</section>
