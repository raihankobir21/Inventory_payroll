@extends('layouts.app')


@section('content')

      <div class="container justify-content-center">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <div class="card-header">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h4>Capital List</h4>
                  </div>
                  <div class="col-sm-6 float-sm-right">
                        <a href="{{ route('capitals.create') }}" class="btn btn-info float-sm-right"><i class="fas fa-plus-circle"></i> Add New Capital</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               
              <div class="table-responsive">
             
                <table id="example1" class="table table-bordered table-striped">
                  
                <thead>
                    <tr>
                        <th>Sl No</th>
                        <th>Amount</th>
                        <th>Expense</th>
                        <th>Remain Balance</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $capital)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ number_format($capital->amount, 2) }}</td>
                        <td>{{ number_format($capital->expense, 2) }}</td>
                        <td>{{ number_format($capital->remain_balance, 2) }}</td>
                        <td>{{ $capital->purpose }}</td>
                        <td>{{ $capital->count_status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>
                            <a href="{{ route('capitals.show', $capital->id) }}" class="btn btn-info">Show</a>
                            <a href="{{ route('capitals.edit', $capital->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('capitals.destroy', $capital->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                  
                  
                </table>

                  <br/>
                  {!! $data->links("pagination::bootstrap-4") !!}

              </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->

 @endsection

