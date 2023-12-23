@extends('layouts.admin')

@section('content')

    <style>
        .status.success{
            background: green;
            color:white;
            border-radius: 4px;
            text-align: center;
            padding: 3px;
        }
        .status.error{
            background: red;
            color:white;
            border-radius: 4px;
            text-align: center;
            padding: 3px;
        }
    </style>

    <div class="card">
              <div class="card-body">

                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Additional Data</th>
                    <th>Created At</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($banknotelogs as $b)
                      <tr>
                         <td>
                             {{$b->user_name}}
                         </td>
                          <td>
                             {{$b->email}}
                         </td>
                          <td>
                             {{$b->amount}}
                         </td>
                          <td>
                             {{$b->additional_data}}
                         </td>
                          <td>
                             {{$b->created_at->format('Y-m-d H:i:s')}}
                         </td>
                          <td>
                             <div class="status  {{$b->status == 1 ? 'success' : 'error'}}">
                                 {{$b->status ? 'success':'failed'}}
                             </div>
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                   <th>User Name</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Additional Data</th>
                    <th>Created At</th>
                    <th>Status</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
            </div>

@endsection
