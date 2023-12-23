@extends('layouts.admin')

@section('content')

    <!-- Small boxes (Stat box) -->


    <!-- /.row -->
    <!-- Main row -->
    <div class="card">
        <!-- /.card-header -->
              <div class="card-body">
                  <a href = "/admin/banknotes/create" class="btn btn-primary">Create</a> <br> <br>

                  <p style="margin:20px 0; color:green; font-size: 34px;">Total Amount --- {{$banknotes->map(function($e){return $e->price * $e->count;})->sum()}}</p>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Count</th>
                      <th>Edit/Delete</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($banknotes as $b)
                      <tr>
                          <td>{{$b->title}}</td>
                          <td>{{$b->price}}</td>
                          <td>{{$b->count}}</td>
                          <td class="d-flex" style="gap:8px;">
                              <a class="btn btn-sm btn-success" href = "{{route('banknotes.edit', $b->id)}}">Edit</a>

                                  <form action = "{{route('banknotes.destroy', $b->id)}}" method="POST">
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
                   <th>Title</th>
                    <th>Price</th>
                    <th>Count</th>

                      <th>Edit/Delete</th>

                  </tr>
                  </tfoot>
                </table>
              </div>
        <!-- /.card-body -->
            </div>
    <!-- /.row (main row) -->

@endsection
