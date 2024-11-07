@php
  $heading = get_field('home_banner_heading');
  $subHeading = get_field('home_banner_sub_heading');
  $image = get_field('home_banner_image');
  $button = get_field('home_banner_button');
  $layoutType = '';
  // $cookieValue = explode(',', $_COOKIE['popupCookieAllowed']);

  $videoOptions = get_field('home_banner_video_options');

  if ($videoOptions == 'link') {
    $videoUrl = get_field('home_banner_video');
-
    $isYouTube = strpos($videoUrl, 'youtu');
    $isVimeo = strpos($videoUrl, 'vimeo');

    if ($isYouTube) {
      preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $videoUrl, $match);

      $videoUrlCleaned = $match[1];
      $finalUrl = "https://www.youtube.com/embed/".$videoUrlCleaned."?background=1&autoplay=1&loop=1&byline=0&title=0&mute=1&rel=0&showinfo=0&controls=0&playlist=".$videoUrlCleaned;
    } else if ($isVimeo) {
      $videoUrlCleaned = (int) substr(parse_url($videoUrl, PHP_URL_PATH), 1);
      $finalUrl = "https://player.vimeo.com/video/".$videoUrlCleaned."?autoplay=1&loop=1&title=0&sidedock=0&controls=0&muted=1";
    } else {
      $videoUrlCleaned = $videoUrl;
      $finalUrl = $videoUrlCleaned;
    }

    if ($videoUrl) {
      $layoutType = 'has-video';
    } else {
      $layoutType = '';
    }
  } else if ($videoOptions == 'file') {
    $videoFile = get_field('home_banner_video_file');
  }
@endphp

<section class="home-banner-section {{ $layoutType }}" id="home-banner-section" style="background-image: url('{{ $image['url'] }}')">
  @include('partials.header')
  <div class="slogan-wrp">
    <div class="container">
      @if($heading)
        <div class="title-wrp">
          <h1>@php echo $heading @endphp</h1>
          <div class="description xl-para">@php echo $subHeading @endphp</div>
          <div class="buttons-wrp has-background">
            @if($button)
              @include('partials.components.buttons',['buttonName'=>'primary-button','buttonUrl'=>$button['url'], 'buttonTitle'=>$button['title'], 'buttonTarget'=>$button['target']])
            @endif
            <span class="btn btn-primary" id="home-banner-button">Click Me</span>
          </div>
        </div>
      @endif
    </div>
  </div>
  @if ($layoutType == 'has-video')
    <div class="banner-video-wrp">
      <div class="vimeo-wrapper">
        <div id="hidden-iframe-url" class="d-none">@php echo $finalUrl; @endphp</div>
        <iframe id="home-banner-iframe" src="" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
      </div>
    </div>
  @endif
  @if ($videoFile)
    <div class="banner-video-wrp">
      <div class="vimeo-wrapper">
        <div id="hidden-video-file" class="d-none">@php echo $videoFile['url'] @endphp</div>
        <video id="home-banner-video" width="100%" height="auto" playsinline autoplay muted loop >
          <source src="" type="video/mp4">
        </video>
      </div>
    </div>
  @endif
</section>
