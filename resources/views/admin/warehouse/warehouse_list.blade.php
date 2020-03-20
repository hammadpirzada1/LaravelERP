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
                          <th>Products</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no = 1;
                              $count = 0;?>
                          @foreach($warehouse as $key => $value)
                          <tr>
                            <td >{{$no++}}</td>
                            <td >{{$value->title}}</td>
                            <td >{{$value->location}}</td>
                            @if($value->status == "inactive")
                              <td style="color: red">{{$value->status}}</td>
                            @else
                              <td>{{$value->status}}</td>
                            @endif
                            @if(count($ware_house[$count]->product_masters)>0)
                              <td>Products Available</td>
                            @else
                              <td style="color: red">Not Available</td>
                            @endif
                            <td style="text-align: center;">
                              <a class="btn btn-info btn-sm" href="javascript:void(0)" id="view-warehouse" data-id="{{$value->id}}" style="font-size: 10px">View</a>
                              @role('admin')
                              <a class="btn btn-success btn-sm" href="javascript:void(0)" id="item-order" data-id="{{$value->id}}"  style="font-size: 10px">Items</a>
                              <a class="btn btn-warning btn-sm" href="javascript:void(0)" id="edit-warehouse" data-id="{{$value->id}}"  style="font-size: 10px">Edit</a>
                              <a class="btn btn-danger btn-sm" href="javascript:void(0)" id="delete-warehouse" data-id="{{$value->id}}"  style="font-size: 10px">Delete</a>
                              @endrole
                            </td>
                          </tr>
                          <?php $count++;?>
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

                   <!-- /Add Product To Warehouse Area -->
                  <div class="modal fade" id="AddItems" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="modal_title">Add Products</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /Add Form Content -->
                          
                          <div class="row">
                            <form action="addProducts" method="GET" class="ItemForm">
                              <table class="table table-bordered table-responsive table-hover" id="table">
                                    <thead>
                                      <tr>
                                        <th>Item</th>
                                        <td style="text-align: center;" colspan="2">
                                          <button type="button" class="btn btn-success add-row">Add</button>
                                          <button type="button" class="btn btn-danger delete-row">Remove</button>
                                        </td>               
                                      </tr>
                                    </thead>
                                    <tbody>     
                                      <!-- table dynamic rows -->
                                    </tbody>
                              </table>
                              <button class="btn btn-dark" type="submit" value="submit">Submit</button>
                            </form>
                          </div>                          

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
                  <!-- /.Add Product To Warehouse Area End -->

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
                          <!-- <button type="submit" class="btn btn-dark">Save</button> -->
                          
                        <!-- </div> -->
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.Edit Warehouse Area End -->

                   <!-- /Warehouse Detail Area -->
                  <div class="modal fade" id="DetailWarehouse" aria-hidden="true">
                    <div class="modal-dialog">
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
                                <p id="d_title"></p>
                            </div>                
                            <div class="form-group">
                                <strong>Location: </strong>
                                <p id="d_location"></p>
                            </div>
                            <div class="form-group">
                                <strong>Status: </strong>
                                <p id="d_status"></p>
                            </div>
                            <div class="form-group">
                              <strong> Items: </strong>
                              <ul class="item-p">
                              </ul>
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
          $.get('http://127.0.0.1:8000/admin/warehouse/' + w_id + '/edit', function (data) {
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

        var i_id = 0;

        $('body').on('click', '#item-order', function () {
          var f_id = $(this).data('id');
          $('#form_id').val(f_id);
          $.get('http://127.0.0.1:8000/admin/warehouse/' + f_id + '/edit', function (data) {
              $('#AddItems').modal('show');
              i_id = data.id;
              $(".ItemForm table tbody").html("");
          });
        });

        //add dynamic table rows for order items
        $(".add-row").click(function(){
          var markup = "<tr>" + 
          "<input type='hidden' class='form-control' id='warehouse_master_id' name='warehouse_master_id' value='' readonly='true'>" +
          "<td>"+
            "<select class='form-control' id='product_master_id[]' name='product_master_id[]'>"+
              "@foreach($product as $products)"+
                "<option value='{{ $products->id }}'> {{ $products->title }} </option>"+
              "@endforeach"+
            "</select>"+
          "</td>"+
          "<td style='text-align: center;'><input type='checkbox' name='record' class='form-control'></td> </tr>";
          $(".ItemForm table tbody").append(markup);
          $(".ItemForm #warehouse_master_id").val(i_id);
      });

        $('body').on('click', '#view-warehouse', function () {
          var w_id = $(this).data('id');
          $.get('http://127.0.0.1:8000/admin/warehouse/' + w_id, function (data) {
            $('#DetailWarehouse').modal('show');
              if(data[1].product_masters.length > 0)
              {
                $('#d_title').html(data[0].title);
                $('#d_location').html(data[0].location);
                $('#d_status').html(data[0].status);
                $('.item-p').html('');
                for(var i=0; i<data[1].product_masters.length; i++){
                $('.item-p').append('<li>'+data[1].product_masters[i].title+'</li>');
                }
              }
              else
              {
                $('#d_title').html(data[0].title);
                $('#d_location').html(data[0].location);
                $('#d_status').html(data[0].status);
                $('.item-p').html('No Item Found!');              
              }
          });
        });

      });
    </script>
@endsection('new_script')