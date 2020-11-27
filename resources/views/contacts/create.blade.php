@extends('layouts.app')
@section('content')

    <h1 class="display-3">Create Contact</h1>
    <a href="/contacts">Go back</a>
    <form method="POST" action="{{route('contacts.store')}}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name">
            @error('name')
                <div class="text-danger">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="company">Company</label>
            <input type="text" class="form-control" name="company">
            @error('company')
                <div class="text-danger">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="tel" class="form-control" name="phone" min="0">
            @error('phone')
                <div class="text-danger">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email">
            @error('email')
                <div class="text-danger">
                    <p>{{$message}}</p>
                </div>
            @enderror
        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>

@endsection