@php
  $logo = get_field('site_logo','options');
  $stickyLogo = get_field('site_logo_sticky','options');
  $contactButton = get_field('site_contact_link','options');
@endphp

<header class="header">
  <div class="container-xl">
    <div class="header-container">
      <div class="logo-wrp">
        <a href="/">
          @if ($logo)
            <img class="default" src="@php echo esc_url($logo['url']); @endphp" alt="@php echo esc_attr($logo['alt']); @endphp" />
          @endif
          @if ($stickyLogo)
            <img class="sticky" src="@php echo esc_url($stickyLogo['url']); @endphp" alt="@php echo esc_attr($stickyLogo['alt']); @endphp" />
          @endif
        </a>
      </div>
      <div class="menu-wrp">
        <nav class="nav-primary">
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'depth' => '3']) !!}
          @endif
        </nav>
        @if ($contactButton)
          <div class="contact-btn-wrp">
            @include('partials.components.buttons',['buttonName'=>'menu-button','buttonUrl'=>$contactButton['url'], 'buttonTitle'=>$contactButton['title'], 'buttonTarget'=>$contactButton['target']])
          </div>
        @endif
      </div>
      <div class="mobile-burger-icon">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
</header>

<div class="mobile-menu">
  <div class="menu-wrp">
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'depth' => '3', 'walker' => new submenu_wrap]) !!}
      @endif
      @if ($contactButton)
        <div class="contact-btn-wrp">
          <a href="@php echo esc_url($contactButton['url']); @endphp" target="@php echo esc_attr($contactButton['target']) @endphp">@php echo esc_attr($contactButton['title']) @endphp</a>
        </div>
      @endif
    </nav>
  </div>
</div>

<div class="sticky-overlay"></div>