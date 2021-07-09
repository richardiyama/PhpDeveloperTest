
@extends('admin.app')
@section('title') Film @endsection
=@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> Film</h1>
        </div>
    </div>
    @include('admin.partials.flash')
    <div class="row user">
       
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="tile">
                        <form action="{{ route('admin.films.store') }}" method="POST" role="form">
                        @csrf

<div class="row">
   <div class="col-xs-12 col-sm-12 col-md-12">
       <div class="form-group">
           <strong>Film Name:</strong>
           <input type="text" name="name" class="form-control" placeholder="Film Name">
       </div>
   </div>

   <div class="col-xs-12 col-sm-12 col-md-12">
       <div class="form-group">
         <strong>Description:</strong>
           <textarea class="form-control" style="height:150px" name="description" placeholder="Description"></textarea>
       </div>
   </div>

   <div class="col-xs-12 col-sm-12 col-md-12">
       <div class="form-group">
          <select class="form-control" name="genre_name" id="genre_name" required>
             <option selected>Select A Genre</option>
                 @foreach($genres as $genre)
             <option value="{{$genre->id}}">{{$genre->genre_name}}</option>
                 @endforeach
          </select>
       </div>
   </div>

   <div class="col-xs-12 col-sm-12 col-md-12 text-center">
           <button type="submit" class="btn btn-primary">Submit</button>
   </div>
</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

