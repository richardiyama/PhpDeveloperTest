@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>A simple ecommerce App </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('films.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>Film</th>
            <th>Description</th>
        </tr>
        @foreach ($posts as $post)
        <tr>
            <td>{{ $film->name }}</td>
            <td>{{ $film->description }}</td>
            <td>
                 <a class="btn btn-info" href="{{ route('films.show',$film->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('films.edit',$film->id) }}">Edit</a>
                <form action="{{ route('films.destroy',$film->id) }}" method="POST">
   
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

@endsection