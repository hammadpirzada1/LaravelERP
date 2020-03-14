@extends('admin.layouts.app')

@section('content_header')
    <div class="row mb-2">
      <div class="col-sm-6">
          <h1 class="m-0 text-dark">Warehouse</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('warehouse.index') }}">Warehouse</a></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
@endsection('content_header')

@section('content_body')

    <div class="row">
      <section class="col-md-12">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card card-dark">
              <div class="card-header">
                <h4 class="card-title">
                  <i class="fas mr-1"></i>
                  Warehouse List
                </h4>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="btn btn-success btn-sm" id="add-warehouse" data-toggle="modal" data-target="#AddWarehouse">Add</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content p-0">
                  
                  <!-- Main card content.. -->
                  <div class="container">
                    <table class="table table-bordered table-responsive-lg table-hover">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Title</th>
                          <th>Location</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=1;?>
                          @foreach($warehouse as $key => $value)
                          <tr>
                            <td >{{$no++}}</td>
                            <td >{{$value->title}}</td>
                            <td >{{$value->location }}</td>
                            <td >{{$value->status }}</td>
                            
                            <td style="text-align: center;">
                              <a class="btn btn-info btn-sm" href="javascript:void(0)" id="view-warehouse" data-id="{{$value->id}}" style="font-size: 10px">View</a>
                              @role('admin')
                              <a class="btn btn-warning btn-sm" href="javascript:void(0)" id="edit-warehouse" data-id="{{$value->id}}"  style="font-size: 10px">Edit</a>
                              <a class="btn btn-danger btn-sm" href="javascript:void(0)" id="delete-warehouse" data-id="{{$value->id}}"  style="font-size: 10px">Delete</a>
                              @endrole
                            </td>
                          </tr>
                          @endforeach 
                      </tbody>
                    </table>
                  </div>

                  <!-- /.Main card-content.. -->

                  <!-- /Add Warehouse Area -->
                  <div class="modal fade" id="AddWarehouse" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="modal_title"></h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /Add Form Content -->
                          
                          {{Form::open(['route' => 'warehouse.store', 'method' => 'POST', 'class' => 'AddForm'])}}
                            @include('admin.warehouse.warehouse_master')
                          {{ Form::close() }}

                          <!-- /.Add Form Content -->
                        </div>
                        <!-- <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>                          
                        </div> -->
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.Add Warehouse Area End -->

                   <!-- /Edit Warehouse Area -->
                  <div class="modal fade" id="EditWarehouse" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Warehouse</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /Edit Form Content -->
                          {{ Form::model($warehouse, ['route'=>['warehouse.update', '1'],'method'=>'PATCH' , 'class' => 'EditForm']) }}
                            <input type="hidden" id="warehouse_id" name="warehouse_id" value=""/>
                            @include('admin.warehouse.warehouse_master')
                          {{ Form::close() }}

                          <!-- /.Edit Form Content -->
                        </div>
                        <!-- <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button> -->
                          <!-- <button type="submit" class="btn btn-primary">Save</button> -->
                          
                        <!-- </div> -->
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.Edit Warehouse Area End -->

                   <!-- /Warehouse Detail Area -->
                  <div class="modal fade" id="DetailWarehouse" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Warehouse Details</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                            <div class="form-group">
                                <strong>Title: </strong>
                                <label id="d_title"></label>
                            </div>                
                            <div class="form-group">
                                <strong>Location: </strong>
                                <label id="d_location"></label>
                            </div>
                            <div class="form-group">
                                <strong>Status: </strong>
                                <label id="d_status"></label>
                            </div>

                        </div>
                        <!-- <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>                          
                        </div> -->
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.Warehouse Details Area End -->

                   <!-- /Delete Warehouse Area -->
                  <div class="modal fade" id="DeleteWarehouse" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Delete Warehouse</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /Delete Form Content -->
                          
                          <p>Are you sure you want to delete this warehouse?</p>

                          <!-- /.Delete Form Content -->
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          {{ Form::open(['method' => 'DELETE','route' => ['warehouse.destroy', '1']]) }}
                            <input type="hidden" id="warehouse2_id" name="warehouse_id" value=""/>
                            <button type="submit" class="btn btn-danger">Delete</button>
                          {{ Form::close() }}
                          
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.Delete Warehouse Area End -->
       
                </div>
              </div><!-- /.card-body -->

        </div>
        <!-- /.card -->
      </section>
    </div>
    

@endsection('content_body')

@section('new_script')
    <script type="text/javascript">
      $(document).ready(function (){

        $('body').on('click', '#add-warehouse', function () {
          $('.AddForm').trigger("reset");
          $('#modal_title').html('Add Warehouse');
          $('#AddWarehouse').modal('show');              
        });

        /* When click edit user */
        $('body').on('click', '#edit-warehouse', function () {
          var w_id = $(this).data('id');
          $('#warehouse_id').val(w_id);
          $.get('http://127.0.0.1:8000/warehouse/' + w_id + '/edit', function (data) {
              $('#EditWarehouse').modal('show');
              $('.EditForm #title').val(data.title);
              $('.EditForm #location').val(data.location);
              $('.EditForm #status').val(data.status);
          });
        });

        $('body').on('click', '#delete-warehouse', function () {
          var w_id = $(this).data('id');
          $('#warehouse2_id').val(w_id);
          $('#DeleteWarehouse').modal('show');
        });

        
        $('body').on('click', '#view-warehouse', function () {
          var w_id = $(this).data('id');
          $.get('http://127.0.0.1:8000//warehouse/' + w_id, function (data) {
            $('#DetailWarehouse').modal('show');
              $('#d_title').html(data.title);
              $('#d_location').html(data.location);
              $('#d_status').html(data.status);
          });
        });

      });
    </script>
@endsection('new_script')