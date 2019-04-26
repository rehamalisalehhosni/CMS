@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                  @if (!Auth::check()) 
                  <a href="auth/facebook" role="button" class="btn btn-info">FB Login</a>
                    Your Application's Landing Page.
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
