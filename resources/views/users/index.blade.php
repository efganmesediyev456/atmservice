@extends('layouts.admin')

@section('content')

    <!-- Small boxes (Stat box) -->

    <!-- /.row -->
    <!-- Main row -->
    <div class="card">
        <!-- /.card-header -->
              <div class="card-body">
                  <a href = "{{route('users.create')}}" class="btn btn-primary">Create</a> <br> <br>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Balance</th>
                      <th>Edit/Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($users as $b)
                      <tr>
                          <td>{{$b->name}}</td>
                          <td>{{$b->email}}</td>
                          <td>{{$b->balance}}</td>
                          <td class="d-flex" style="gap:8px;">
                              <a class="btn btn-sm btn-success" href = "{{route('users.edit', $b->id)}}">Edit</a>

                                  <form action = "{{route('users.destroy', $b->id)}}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <a  class="btn btn-sm btn-danger" onclick="if(confirm('Are you sure?')) {this.parentNode.submit()} else {return false;}">
                                      Delete
                                      </a>
                                  </form>

                          </td>
                      </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Name</th>
                    <th>Email</th>
                    <th>Balance</th>
                      <th>Edit/Delete</th>

                  </tr>
                  </tfoot>
                </table>
              </div>
        <!-- /.card-body -->
            </div>
    <!-- /.row (main row) -->

@endsection
