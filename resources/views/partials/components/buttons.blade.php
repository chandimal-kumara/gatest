@switch($buttonName)
  @case('primary-button')
    @if ($buttonUrl && $buttonTitle)
      <a class="btn btn-primary" href="@php echo esc_url($buttonUrl); @endphp" target="@php echo esc_attr($buttonTarget); @endphp">@php echo $buttonTitle; @endphp
      </a>
    @endif
    @break
  @case('primary-button-v2')
    @if ($buttonUrl && $buttonTitle)
      <a class="btn btn-primary v2" href="@php echo esc_url($buttonUrl); @endphp" target="@php echo esc_attr($buttonTarget); @endphp">@php echo $buttonTitle; @endphp
      </a>
    @endif
    @break
  @case('secondary-button')
    @if ($buttonUrl && $buttonTitle)
      <a class="btn btn-secondary" href="@php echo esc_url($buttonUrl); @endphp" target="@php echo esc_attr($buttonTarget); @endphp">@php echo $buttonTitle; @endphp
      </a>
    @endif
    @break
  @case('cta-button')
    @if ($buttonUrl && $buttonTitle)
      <a class="btn btn-cta" href="@php echo esc_url($buttonUrl); @endphp" target="@php echo esc_attr($buttonTarget); @endphp">@php echo $buttonTitle; @endphp
      </a>
    @endif
    @break
  @case('menu-button')
    @if ($buttonUrl && $buttonTitle)
      <a class="btn btn-menu" href="@php echo esc_url($buttonUrl); @endphp" target="@php echo esc_attr($buttonTarget); @endphp">@php echo $buttonTitle; @endphp
      </a>
    @endif
    @break
  @case('read-more-button')
    @if ($buttonUrl && $buttonTitle)
      <a class="btn btn-read-more" href="@php echo esc_url($buttonUrl); @endphp" target="@php echo esc_attr($buttonTarget); @endphp">@php echo $buttonTitle; @endphp
      </a>
    @endif
    @break
  @default
    @if ($buttonUrl && $buttonTitle)
      <a class="btn btn-primary" href="@php echo esc_url($buttonUrl); @endphp" target="@php echo esc_attr($buttonTarget); @endphp">@php echo $buttonTitle; @endphp
      </a>
    @endif
@endswitch