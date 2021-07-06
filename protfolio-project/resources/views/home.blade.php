@extends('layout.app')

@section('content')
@include('Component.HomeBanner')

@include('Component.Homeservices')
@include('Component.Homecourse')
@include('Component.Homeproject')
@include('Component.HomeContact')
@include('Component.HomeReview')

    
@endsection