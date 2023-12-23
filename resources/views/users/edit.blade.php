@extends('layouts.admin')

@section('content')

    <!-- Small boxes (Stat box) -->

    <!-- /.row -->
    <!-- Main row -->
    <div class="card col-lg-6">
        <!-- /.card-header -->
              <div class="card-body">
                  <h3>Users Create</h3>
                  <form action = "{{route('users.update', $user->id)}}" method="POST">
                      @method('PUT')
                    @csrf
                      <div class="form-group">
                         <label for = "">Name</label>
                          <input class="form-control" name="name" type = "text" value="{{$user->name}}" >
                          @error('name')
                          <p class="text-danger">{{$message}}</p>
                          @enderror
                     </div>
                      <div class="form-group">
                         <label for = "">Email</label>
                          <input class="form-control" name="email" type = "text" value="{{$user->email}}" >
                          @error('email')
                          <p class="text-danger">{{$message}}</p>
                          @enderror
                     </div>
                      <div class="form-group">
                         <label for = "">Balance</label>
                          <input class="form-control" name="balance" type = "number" value="{{$user->balance}}">
                          @error('balance')
                          <p class="text-danger">{{$message}}</p>
                          @enderror
                     </div>
                      <div class="form-group">
                         <label for = "">Password</label>
                          <input class="form-control" name="password" type = "password" >
                          @error('password')
                          <p class="text-danger">{{$message}}</p>
                          @enderror
                     </div>
                      <div class="form-group">
                         <label for = "">Password Confirmation</label>
                          <input class="form-control" name="password_confirmation" type = "password" >
                          @error('password_confirmation')
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
