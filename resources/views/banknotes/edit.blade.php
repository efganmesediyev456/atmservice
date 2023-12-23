@extends('layouts.admin')

@section('content')

    <!-- Small boxes (Stat box) -->

    <!-- /.row -->
    <!-- Main row -->
    <div class="card col-lg-6">
        <!-- /.card-header -->
              <div class="card-body">
                  <h3>Banknotes Create</h3>
                  <form action = "{{route('banknotes.update', $banknote->id)}}" method="POST">
                    @csrf
                      @method('PUT')
                      <div class="form-group">
                         <label for = "">Title</label>
                          <input value="{{$banknote->title}}" class="form-control" name="title" type = "text" >
                          @error('title')
                          <p class="text-danger">{{$message}}</p>
                          @enderror
                     </div>
                      <div class="form-group">
                         <label for = "">Price</label>
                          <input value="{{$banknote->price}}" class="form-control" name="price" type = "number" >
                          @error('price')
                          <p  class="text-danger">{{$message}}</p>
                          @enderror
                     </div>
                      <div class="form-group">
                         <label for = "">Count</label>
                          <input value="{{$banknote->count}}" class="form-control" name="count" type = "number" >
                          @error('count')
                          <p  class="text-danger">{{$message}}</p>
                          @enderror
                     </div>
                      <div class="form-group">
                          <input type = "submit" value="submit" class="btn btn-primary">
                      </div>
                  </form>
              </div>
        <!-- /.card-body -->
            </div>
    <!-- /.row (main row) -->

@endsection
