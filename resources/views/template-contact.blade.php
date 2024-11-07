{{--
  Template Name: Contact Template
--}}

@extends('layouts.app')

@section('content')
  @while(have_posts()) @php the_post() @endphp
    @include('partials.contact.map-form-section')
  @endwhile
@endsection
