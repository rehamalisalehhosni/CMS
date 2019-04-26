@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
                <h4>Your Name is: {{ Auth::user()->name }}</h4>
                <h4>Your Name is: {{ Auth::user()->email }}</h4>
                <img src="{{ Auth::user()->avatar }}" width="200px" height="200px"/>
            </div>
        </div>
    </div>
</div>
@endsection
