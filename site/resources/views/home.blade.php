@extends('layout.app')
@section('title','Home')

@section('content')

@include('component.homeBanner')
@include('component.homeService')
@include('component.homeCourse')
@include('component.homeProjects')
@include('component.homeContact')
@include('component.homeReview')



@endsection