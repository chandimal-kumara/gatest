{{--
  Template Name: Styleguide Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    <main id="site-content" role="main">
      <div class="container">
          <div class=" mb-5">
            <h1>Heading One</h1>
            <h2>Heading Two</h2>
            <h3>Heading Three</h3>
            <h4>Heading Four</h4>
            <h5>Heading Five</h5>
            {{-- <h6>Heading Six</h6> --}}
            <a href="#">Hyperlink Styling</a>
          </div>
          {{-- <div class="row">
              <div class="container">
                  <div class="col">
                      <blockquote>
                        Films that aim to show the effects of environmental factors on the development of character through depictions that emphasise the relationship between location and identity… social realism tend to be associated with an observational style of camerawork that emphasises situations and events and an episodic narrative structure, creating ‘kitchen sink’ dramas and ‘gritty’ character studies of the underbelly of urban life.
                      </blockquote>
                  </div>
              </div>
          </div> --}}
          <div class="row">
            <div class="col-12 col-lg-6 mb-5">
              <p>Primary Button</p>
              @include('partials.components.buttons',['buttonName'=>'primary-button','buttonUrl'=>'#', 'buttonTitle'=>"Click Here", 'buttonTarget'=>'_self'])
            </div>
            <div class="col-12 col-lg-6 mb-5">
              <p>Primary Button v2</p>
              @include('partials.components.buttons',['buttonName'=>'primary-button-v2','buttonUrl'=>'#', 'buttonTitle'=>"Click Here", 'buttonTarget'=>'_self'])
            </div>
            <div class="col-12 col-lg-6 mb-5 p-5 bg-enabled" style="background-color: #ddd">
              <p>Primary Button inside background section</p>
              @include('partials.components.buttons',['buttonName'=>'primary-button','buttonUrl'=>'#', 'buttonTitle'=>"Click Here", 'buttonTarget'=>'_self'])
            </div>
            <div class="col-12 col-lg-6 mb-5">
              <p>Secondary Button</p>
              @include('partials.components.buttons',['buttonName'=>'secondary-button','buttonUrl'=>'#', 'buttonTitle'=>"Click Here", 'buttonTarget'=>'_self'])
            </div>
            <div class="col-12 col-lg-6 mb-5">
              <p>Form Button</p>
              <div class="button-wrp-outter text-center text-sm-left">
                <div class="button-wrapper-form">
                  <input type="submit" value="Contact">
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-6 mb-5">
              <p>CTA Button</p>
              @include('partials.components.buttons',['buttonName'=>'cta-button','buttonUrl'=>'#', 'buttonTitle'=>"Click Here", 'buttonTarget'=>'_self'])
            </div>
            <div class="col-12 col-lg-6 mb-5">
              <p>Menu Button</p>
              @include('partials.components.buttons',['buttonName'=>'menu-button','buttonUrl'=>'#', 'buttonTitle'=>"Click Here", 'buttonTarget'=>'_self'])
            </div>
            <div class="col-12 col-lg-6 mb-5">
              <p>Read More Button</p>
              @include('partials.components.buttons',['buttonName'=>'read-more-button','buttonUrl'=>'#', 'buttonTitle'=>"Click Here", 'buttonTarget'=>'_self'])
            </div>
            <div class="col-12 col-lg-6">
              <ul>
                <li>Lorem ipsum dolor sit amet</li>
                <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>
                <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>
                <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet
                  <ul>
                    <li>Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>
                  </ul>
                </li>
                <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>
                <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>
              </ul>
            </div>
            <div class="col-12 col-lg-6">
              <ol>
                <li>Lorem ipsum dolor sit amet</li>
                <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>
                <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>
                <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet
                  <ol>
                    <li>Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>
                    <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>
                  </ol>
                </li>
                <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>
                <li>Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet Lorem ipsum dolor sit amet</li>
              </ol>
            </div>
          </div>
          <div>
        </div>
      </div>
    </main>
  @endwhile
@endsection