@php
  $eyebrowHeading = get_sub_field('fcp_posts_eyebrow_heading');
  $heading = get_sub_field('fcp_posts_heading');
  $description = get_sub_field('fcp_posts_description');
  $posts = get_sub_field('fcp_posts');
  $button = get_sub_field('fcp_posts_button');
  $count = 0;
@endphp

@if ($posts)
  <section class="fcp-section posts-section news-listing-section">
    <div class="container">
      <div class="section-inner-wrp">
        @if ($eyebrowHeading || $heading || $description)
          <div class="intro-content text-center">
            @if ($eyebrowHeading)
              <span class="eyebrow-heading">@php echo $eyebrowHeading @endphp</span>
            @endif
            @if ($heading)
              <h2>@php echo $heading @endphp</h2>
            @endif
            @if ($description)
              <p>@php echo $description; @endphp</p>
            @endif
          </div>
        @endif
        <div class="news-wrp">
          <div class="featured-news-wrp row">
            <div class="news-item-wrp col-12">
              @php
                $featuredPost = $posts[0];
                $permalink = get_permalink( $featuredPost->ID );
                $title = get_the_title( $featuredPost->ID );
                $image = get_the_post_thumbnail_url($featuredPost->ID);
                $date = get_the_date('F d Y',$featuredPost->ID);
                $excerpt = get_the_excerpt($featuredPost->ID);
              @endphp
              <a class="news-item" href="@php echo $permalink; @endphp">
                <div class="row">
                  <div class="col-12 col-lg-6">
                    @if ($image)
                      <div class="image-wrp">
                        <img src="@php echo $image; @endphp">
                      </div>
                    @endif
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
          </div>
          <div class="other-news-wrp row">
            @foreach ($posts as $post)
              @php
                $count++;
                $permalink = get_permalink( $post->ID );
                $title = get_the_title( $post->ID );
                $date = get_the_date('F d Y',$post->ID);
                $excerpt = get_the_excerpt($post->ID);
              @endphp
              @if ($count > 1)
                <div class="news-item-wrp col-12 col-lg-6">
                  <a class="news-item" href="@php echo $permalink; @endphp">
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
                    </div>
                    @if ($permalink)
                      <div class="button-wrp">
                        <span class="btn btn-read-more">Read More</span>
                      </div>
                    @endif
                  </a>
                </div>
              @endif
            @endforeach
          </div>
        </div>
        @if ($button)
          <div class="button-wrp text-center">
            @include('partials.components.buttons',['buttonName'=>'primary-button','buttonUrl'=>$button['url'], 'buttonTitle'=>$button['title'], 'buttonTarget'=>$button['target']])
          </div>
        @endif
      </div>
    </div>
  </section>
@endif

