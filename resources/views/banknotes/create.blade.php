@extends('layouts.admin')

@section('content')

    <!-- Small boxes (Stat box) -->

    <!-- /.row -->
    <!-- Main row -->
    <div class="card col-lg-6">
        <!-- /.card-header -->
              <div class="card-body">
                  <h3>Banknotes Create</h3>
                  <form action = "{{route('banknotes.store')}}" method="POST">
                    @csrf
                     <div class="form-group">
                         <label for = "">Title</label>
                          <input class="form-control" name="title" type = "text" >
                         @error('title')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                     </div>
                      <div class="form-group">
                         <label for = "">Price</label>
                          <input class="form-control" name="price" type = "number" >
                          @error('price')
                          <p class="text-danger">{{$message}}</p>
                          @enderror
                     </div>
                      <div class="form-group">
                         <label for = "">Count</label>
                          <input class="form-control" name="count" type = "number" >
                          @error('count')
                          <p class="text-danger">{{$message}}</p>
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
