@extends('layouts.app')
@section('content')

    <div>
        @if (session('success'))
            <div class="alert alert-success text-center">
                <p>{{session('success')}}</p>
            </div>
        @endif
    </div>

    <h1 class="display-3">Contacts</h1>
    <a href="contacts/create">Create Contact</a>

    <div class="float-right">
        <label for="search">Search by name</label>
        <input type="text" class="form-controller" id="search" name="search">
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Company</th>
                <th scope="col">Phone</th>
                <th scope="col">Email</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach ($contacts as $contact)
                <tr>
                    <td>{{$contact->name}}</td>
                    <td>{{$contact->company}}</td>
                    <td>{{$contact->phone}}</td>
                    <td>{{$contact->email}}</td>
                    <td>
                        @can('edit', $contact)
                            <a href="{{route('contacts.edit', $contact->id)}}" class="btn btn-primary">Edit</a>
                        @endcan
                    </td>
                    <td>
                        @can('edit', $contact)
                            <form action="{{route('contacts.destroy', $contact->id)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $contacts->links() }}
@endsection