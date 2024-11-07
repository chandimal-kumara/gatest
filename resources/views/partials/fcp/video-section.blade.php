@php
$layout = get_sub_field('fcp_video_layout');
$addAutoplay = get_sub_field('fcp_video_add_autoplay');
$addControls = get_sub_field('fcp_video_add_controls');

if ($layout == 'layout-variation-1') {
  $contents = get_sub_field('fcp_video_layout_v1');

  $eyebrowHeading = $contents['eyebrow_heading_v1'];
  $heading = $contents['heading_v1'];
  $description = $contents['description_v1'];
  $button = $contents['button_v1'];
  $videoOptions = $contents['video_options_v1'];
  $videoThumbnail = $contents['video_thumbnail_v1'];

  if ($videoOptions == 'link') {
    $videoUrl = $contents['video_url_v1'];
    if ($addControls) {
      $controlsClass = "controls=1";
    } else {
      $controlsClass = "controls=0";
    }
  } else if ($videoOptions == 'file') {
    $videoFile = $contents['video_file_v1'];

    if ($addControls) {
      $controlsClass = "controls";
    } else {
      $controlsClass = "";
    }
  }

} elseif ($layout == 'layout-variation-2') {
  $contents = get_sub_field('fcp_video_layout_v2');

  $videoPosition = $contents['video_position_v2'];
  $eyebrowHeading = $contents['eyebrow_heading_v2'];
  $heading = $contents['heading_v2'];
  $description = $contents['description_v2'];
  $button = $contents['button_v2'];
  $videoOptions = $contents['video_options_v2'];
  $videoThumbnail = $contents['video_thumbnail_v2'];

  if ($videoOptions == 'link') {
    $videoUrl = $contents['video_url_v2'];

    if ($addControls) {
      $controlsClass = "controls=1";
    } else {
      $controlsClass = "controls=0";
    }
  } else if ($videoOptions == 'file') {
    $videoFile = $contents['video_file_v2'];

    if ($addControls) {
      $controlsClass = "";
    } else {
      $controlsClass = "pointer-events:none";
    }
  }

  if ($videoPosition) {
    $col1Order = 'order-2';
    $col2Order = 'order-1';
    $videoPositionClass = 'video-left';
  } else {
    $col1Order = 'order-2 order-lg-1';
    $col2Order = 'order-1 order-lg-2';
    $videoPositionClass = 'video-right';
  }
}
  $isYouTube = strpos($videoUrl, 'youtu');
  $isVimeo = strpos($videoUrl, 'vimeo');

  if ($isYouTube) {
    preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $videoUrl, $match);
    $videoUrlCleaned = $match[1];
    $twoColVideoUrl = 'https://www.youtube.com/embed/'.$videoUrlCleaned;
  } else if ($isVimeo) {
    $videoUrlCleaned = (int) substr(parse_url($videoUrl, PHP_URL_PATH), 1);
    $twoColVideoUrl = 'https://player.vimeo.com/video/'.$videoUrlCleaned.'?badge=0&autoplay=1&loop=1';
  } else {
    $videoUrlCleaned = $videoUrl;
  }
@endphp

@if ($layout == 'layout-variation-1')
  @if ($videoUrl || $videoFile)
    <section class="fcp-section video-section v1 stick-bottom">
      <div class="section-inner-wrp">
        <div class="container">
          @if ($eyebrowHeading || $heading || $description)
            <div class="intro-content text-center">
              @if ($eyebrowHeading)
                <span class="eyebrow-heading">@php echo $eyebrowHeading @endphp</span>
              @endif
              @if ($heading)
                <h2>@php echo $heading @endphp</h2>
              @endif
              @if ($description)
                @php echo $description @endphp
              @endif
              @if ($button)
                <div class="button-wrp">
                  @include('partials.components.buttons',['buttonName'=>'primary-button','buttonUrl'=>$button['url'], 'buttonTitle'=>$button['title'], 'buttonTarget'=>$button['target']])
                </div>
              @endif
            </div>
          @endif
        </div>
        @if ($videoUrl)
          <div class="video-wrp">
            @if ($isYouTube)
              <iframe class="iframe-video video-url" src="https://www.youtube.com/embed/{{$videoUrlCleaned}}?background=1&loop=1&byline=0&title=0&mute=1&rel=0&showinfo=0&{{$controlsClass}}" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            @elseif($isVimeo)
              <iframe class="iframe-video video-url" src="https://player.vimeo.com/video/{{$videoUrlCleaned}}?loop=1&title=0&sidedock=0&{{$controlsClass}}&muted=1" frameborder="0" allowfullscreen></iframe>
            @else
              <iframe class="iframe-video video-url" src="{{$videoUrlCleaned}}" frameborder="0"></iframe>
            @endif
          <div class="video-thumb playvideo video-url" style="background-image: url(@php echo esc_url($videoThumbnail['url']); @endphp);">
            </div>
          </div>
        @endif
        @if ($videoFile)
          <div class="video-wrp">
            <video class="iframe-video video-file video-element" width="100%" height="auto" playsinline {{$controlsClass}} muted loop >
              <source src="@php echo $videoFile['url']; @endphp" type="video/mp4">
            </video>
          <div class="video-thumb playvideo video-file" style="background-image: url(@php echo esc_url($videoThumbnail['url']); @endphp);">
            </div>
          </div>
        @endif
      </div>
    </section>
  @endif
@elseif ($layout == 'layout-variation-2')
  @if ($videoUrl || $videoFile)
    <section class="fcp-section video-section v2 {{$videoPositionClass}}">
      <div class="container">
        <div class="section-inner-wrp">
          <div class="row m-0">
            <div class="col-12 col-lg-6 p-0 text-md-left text-center {{$col1Order}} content-outter-wrp">
              <div class="content-wrp d-none d-lg-flex">
                @if ($eyebrowHeading)
                  <span class="eyebrow-heading">@php echo $eyebrowHeading @endphp</span>
                @endif
                @if ($heading)
                  <h2>@php echo $heading @endphp</h2>
                @endif
                @if ($description)
                  @php echo $description @endphp
                @endif
                @if ($button)
                  <div class="button-wrp">
                    @include('partials.components.buttons',['buttonName'=>'primary-button','buttonUrl'=>$button['url'], 'buttonTitle'=>$button['title'], 'buttonTarget'=>$button['target']])
                  </div>
                @endif
              </div>
            </div>
            <div class="col-12 col-lg-6 p-0 {{$col2Order}}">
              <div class="intro-content d-block d-lg-none">
                @if ($eyebrowHeading)
                  <span class="eyebrow-heading">@php echo $eyebrowHeading @endphp</span>
                @endif
                @if ($heading)
                  <h3>@php echo $heading @endphp</h3>
                @endif
              </div>
              @if ($videoUrl)
                <div class="video-wrp">
                  <div class="video-thumb video-iframe-thumbnail video-url" style="background-image: url(@php echo esc_url($videoThumbnail['url']); @endphp);" data-toggle="modal" data-src="@php echo $twoColVideoUrl; @endphp" data-controls="{{$controlsClass}}" data-target="#myModal">
                  </div>
                  <div class="modal fade video-url" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-body">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="" id="video" allowscriptaccess="always" allow="autoplay"></iframe>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
              @if ($videoFile)
                <div class="video-wrp">
                  <div class="video-thumb video-iframe-thumbnail video-file" style="background-image: url(@php echo esc_url($videoThumbnail['url']); @endphp);" data-toggle="modal" data-src="@php echo $videoFile['url']; @endphp" data-controls="{{$controlsClass}}" data-target="#myModal">
                  </div>
                  <div class="modal fade video-file" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-body">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                          <div class="embed-responsive embed-responsive-16by9">
                            <iframe style="{{$controlsClass}}" class="embed-responsive-item" src="" id="video" allow="autoplay"></iframe>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
              <div class="content-wrp d-block d-lg-none">
                @if ($description)
                  @php echo $description @endphp
                @endif
                @if ($button)
                  <div class="button-wrp">
                    @include('partials.components.buttons',['buttonName'=>'primary-button','buttonUrl'=>$button['url'], 'buttonTitle'=>$button['title'], 'buttonTarget'=>$button['target']])
                  </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif
@endif
