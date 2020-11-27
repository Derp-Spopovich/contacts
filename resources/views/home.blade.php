@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="jumbotron">
                        <h1 class="display-4">Hello!</h1>
                        <p class="lead">Hello this is the sample layout page for contacts</p>
                        <hr class="my-4">
                        <p>View Contacts</p>
                        <a class="btn btn-primary btn-lg" href="/contacts" role="button">contacts</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
