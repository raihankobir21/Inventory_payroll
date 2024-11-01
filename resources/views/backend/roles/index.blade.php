@extends('layouts.backend')


@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            

            <div class="card">
              <div class="card-header">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h4>Role List</h4>
                  </div>
                  <div class="col-sm-6 float-sm-right">
                        <a href="{{ route('roles.create') }}" class="btn btn-info float-sm-right"><i class="fas fa-plus-circle"></i> Add New Role</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="table-responsive">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>

                         <tr>
                           <th>No</th>
                           <th>Name</th>
                           <th width="280px">Action</th>
                         </tr>
                  </thead>

                  <tbody>
                         @foreach ($data as $key => $d)

                            <tr>

                              <td>{{ ++$i }}</td>

                              <td>{{ $d->name }}</td>

                              

                              <td>

                                        <a class="btn btn-primary btn-sm" href="{{ route('roles.show',$d->id) }}"  data-toggle="tooltip" data-placement="left" title="Edit"><i class="fas fa-eye"></i></a>

                                        


                                        @can('user-edit')
                                          <a class="btn btn-success btn-sm" href="{{ route('roles.edit',$d->id) }}"  data-toggle="tooltip" data-placement="left" title="Edit"><i class="fas fa-edit"></i></a>
                                        @endcan

                                        @can('user-delete')
                                            <a class="btn btn-danger btn-sm show-modal" href="#" data-toggle="tooltip" data-placement="top" title="Delete" value-id="{{$d->id}}" value-title="Delete" message= "Are you sure? You want to delete ?" method="Post" action="roles" ><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                                        @endcan



                                         
                                      </form>

                                </td>

                            </tr>

                           @endforeach

                  </tbody>
                  
                  <tfoot>
                       <tr>

                         <th>No</th>

                         <th>Name</th>

                         <th width="280px">Action</th>

                       </tr>

                  </tfoot>

                  
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
    </section>
    <!-- /.content -->
  </div>

 @endsection

