@php
  $haveFeaturedNews = get_field('news_listing_is_there_featured_post');

  $count = 0;
  $count2 = 0;
  $count3 = 0;

  $leftItems = [];
  $rightItems = [];
  $mobileItems = [];

  $excludingPosts = [];

  if ($haveFeaturedNews) {
    $featuredClass = "have-featured";
    $featuredNewsItems = get_field('news_listing_featured_post');

    foreach ($featuredNewsItems as $item) {
      array_push($excludingPosts, $item->ID);
    }
  } else {
    $featuredClass = "no-featured";
  }

  $args = array(
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'ASC',
    'post__not_in' => $excludingPosts,
  );

  $news = get_posts( $args );
@endphp

<section class="news-listing-section {{$featuredClass}}">
  <div class="container">
    <div class="section-inner-wrp">
      <div class="news-wrp">
        @if ($haveFeaturedNews && $featuredNewsItems)
          <div class="featured-news-wrp row">
            @foreach ($featuredNewsItems as $featuredNews)
              @php
                $permalink = get_permalink( $featuredNews->ID );
                $title = get_the_title( $featuredNews->ID );
                $image = get_the_post_thumbnail_url($featuredNews->ID);
                $date = get_the_date('d/m/Y',$featuredNews->ID);
                $excerpt = get_the_excerpt($featuredNews->ID);
              @endphp
              <div class="news-item-wrp col-12">
                <a class="news-item" href="@php echo $permalink; @endphp">
                  <div class="row">
                    <div class="col-12 col-lg-6">
                      <div class="image-wrp">
                        <img src="@php echo $image; @endphp" alt="@php echo $title @endphp">
                      </div>
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="content-wrp">
                        <div class="description-wrp">
                          @if ($date)
                            <span class="posts-date s-para">@php echo $date; @endphp</span>
                          @endif
                          @if ($title)
                            <h4>@php echo $title; @endphp</h4>
                          @endif
                          @if ($excerpt)
                            <p>@php echo $excerpt; @endphp</p>
                          @endif
                        </div>
                        @if ($permalink)
                          <div class="button-wrp">
                            <span class="btn btn-read-more">Read More</span>
                          </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        @endif
        <div class="other-news-wrp">
          @foreach ($news as $newsData)
            @php
              $count++;
  
              $permalink = get_permalink( $newsData->ID );
              $title = get_the_title( $newsData->ID );
              $date = get_the_date('d/m/Y',$newsData->ID);
              $excerpt = get_the_excerpt($newsData->ID);
  
              $data = [$permalink, $title, $date, $excerpt];
              $data = [$permalink, $title, $date, $excerpt];
  
              if ($count % 2 == 0) {
                array_push($rightItems, $data);
                array_push($mobileItems, $data);
              } else {
                array_push($leftItems, $data);
                array_push($mobileItems, $data);
              }
            @endphp
          @endforeach
          <div class="row">
            <div class="left-items col-6 d-none d-lg-block">
              @foreach ($leftItems as $leftItem)
                <div class="news-item-wrp" style="display: none">
                  <a class="news-item" href="@php echo $leftItem[0] @endphp">
                    <div class="content-wrp">
                      <div class="description-wrp">
                        @if ($leftItem[2])
                          <span class="posts-date s-para">@php echo $leftItem[2]; @endphp</span>
                        @endif
                        @if ($leftItem[1])
                          <h4>@php echo $leftItem[1]; @endphp</h4>
                        @endif
                        @if ($leftItem[3])
                          <p>@php echo $leftItem[3]; @endphp</p>
                        @endif
                      </div>
                    </div>
                    @if ($leftItem[0])
                      <div class="button-wrp">
                        <span class="btn btn-read-more">Read More</span>
                      </div>
                    @endif
                  </a>
                </div>
              @endforeach
            </div>
            <div class="right-items col-6 d-none d-lg-block">
              @foreach ($rightItems as $rightItem)
                <div class="news-item-wrp" style="display: none">
                  <a class="news-item" href="@php echo $rightItem[0] @endphp">
                    <div class="content-wrp">
                      <div class="description-wrp">
                        @if ($rightItem[2])
                          <span class="posts-date s-para">@php echo $rightItem[2]; @endphp</span>
                        @endif
                        @if ($rightItem[1])
                          <h4>@php echo $rightItem[1]; @endphp</h4>
                        @endif
                        @if ($rightItem[3])
                          <p>@php echo $rightItem[3]; @endphp</p>
                        @endif
                      </div>
                    </div>
                    @if ($rightItem[0])
                      <div class="button-wrp">
                        <span class="btn btn-read-more">Read More</span>
                      </div>
                    @endif
                  </a>
                </div>
              @endforeach
            </div>
            <div class="mobile-items col-12 d-block d-lg-none">
              @foreach ($mobileItems as $mobileItem)
                <div class="news-item-wrp" style="display: none">
                  <a class="news-item" href="@php echo $mobileItem[0] @endphp">
                    <div class="content-wrp">
                      <div class="description-wrp">
                        @if ($mobileItem[2])
                          <span class="posts-date s-para">@php echo $mobileItem[2]; @endphp</span>
                        @endif
                        @if ($mobileItem[1])
                          <h4>@php echo $mobileItem[1]; @endphp</h4>
                        @endif
                        @if ($mobileItem[3])
                          <p>@php echo $mobileItem[3]; @endphp</p>
                        @endif
                      </div>
                    </div>
                    @if ($mobileItem[0])
                      <div class="button-wrp">
                        <span class="btn btn-read-more">Read More</span>
                      </div>
                    @endif
                  </a>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <div class="button-wrp text-center d-none d-lg-block" id="loadMoreDesktop">
        <span class="btn btn-primary">Load More</span>
      </div>
      <div class="button-wrp text-center d-block d-lg-none" id="loadMoreMobile">
        <span class="btn btn-primary">Load More</span>
      </div>
    </div>
  </div>
</section>
