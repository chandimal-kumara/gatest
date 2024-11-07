{{--
  Template Name: Home Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.home.banner-section')
    @include('partials.home.company-statistics')
    @include('partials.home.about-us')
    @include('partials.home.logo-section')
    @include('partials.home.cta-section')
    @include('partials.home.case-studies')
  @endwhile
@endsection
