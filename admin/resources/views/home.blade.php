@extends('layout.app')

@section('title','Home')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$totalvisitor}}</h3>
                    <h3 class="count-card-title">Total Visitor</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$totalservice}}</h3>
                    <h3 class="count-card-title">Total Services</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$totalproject}}</h3>
                    <h3 class="count-card-title">Total Project</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$totalcourse}}</h3>
                    <h3 class="count-card-title">Total Courses</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$totalcontact}}</h3>
                    <h3 class="count-card-title">Total Contact</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 p-2">
            <div class="card">
                <div class="card-body">
                    <h3 class="count-card-title">{{$totalreview}}</h3>
                    <h3 class="count-card-title">Total Reviews</h3>
                </div>
            </div>
        </div>


    </div>


</div>
    
@endsection