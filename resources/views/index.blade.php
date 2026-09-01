@extends('layouts.app')

@section('content')
  @include('partials.header')
  @include('partials.hero')
  {{-- @include('partials.about') --}}
  {{-- @include('partials.benefit') --}}
  @include('partials.event-preview')
  @include('partials.consultation')
  @include('partials.footer')
@endsection
