@extends('admin.layouts.app')

@section('content_header')
    <div class="row mb-2">
      <div class="col-sm-6">
          <h1 class="m-0 text-dark">Purchases</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('purchase.index') }}">Purchase</a></li>
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
                  <strong>Purchases List</strong>
                </h4>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="btn btn-success btn-sm" id="add-purchase" data-toggle="modal" data-target="#AddPurchase">Add</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content p-0">
                  
                  <!-- Main card content.. -->

                  
                  
                  <div class="container">
                    <div class="row">
                   
                    </div>

                    <table class="table table-bordered table-responsive-lg table-hover dataTable" role="grid" aria-describedby="table_info" id="table">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" aria-label="">No.</th>
                          <th>Product Title</th>
                          <th>Vendor</th>
                          <th>Total Invoice</th>
                          <th>Discount</th>
                          <th>Amount Paid</th>
                          <th>Amount Due</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php $no=1;?>
                          @foreach($purchase as $key => $value)
                          <tr>
                            <td >{{$no++}}</td>
                            <td >{{$value->title }}</td>
                            <td >{{$value->user_id}}</td>                            
                            <td >{{$value->total_invoice }}</td>                                                 
                            <td >{{$value->discount}}</td>
                            <td >{{$value->amount_paid }}</td>
                            <td >{{$value->amount_due }}</td>                          
                            <td style="text-align: center;">
                              <a class="btn btn-info btn-sm" href="javascript:void(0)" id="view-purchase" data-id="{{$value->id}}" style="font-size: 10px">View</a>
                              @role('admin')
                              <a class="btn btn-warning btn-sm" href="javascript:void(0)" id="edit-purchase" data-id="{{$value->id}}"  style="font-size: 10px">Edit</a>
                              <a class="btn btn-danger btn-sm" href="javascript:void(0)" id="delete-purchase" data-id="{{$value->id}}"  style="font-size: 10px">Delete</a>
                              @endrole
                            </td>
                          </tr>
                          @endforeach
                         
                      </tbody>
                    </table>
                  </div>

                  <!-- /.Main card-content.. -->

                  <!-- /Add Purchase Area -->
                  <div class="modal fade" id="AddPurchase" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="modal_title">Add Purchase</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /Add Form Content -->
                          
                          {{Form::open(['route' => 'purchase.store', 'method' => 'POST', 'class' => 'AddForm'])}}
                            @include('admin.purchase.purchase_master')
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
                  <!-- /.Add Purchase Area End -->

                  <!-- /Edit Purchase Area -->
                  <div class="modal fade" id="EditPurchase" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Purchase</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /Edit Form Content -->
                          
                          {{ Form::model($purchase, ['route'=>['purchase.update', '1'],'method'=>'PATCH' , 'class' => 'EditForm']) }}
                            @include('admin.purchase.purchase_master')                          
                            <input type="hidden" id="pur_id" name="purchase_id" value=""/>
                          {{ Form::close() }}

                          <!-- /.Edit Form Content -->
                        </div>
                        <!-- <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-dark">Save</button>
                        </div> -->
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.Edit Purchase Area End -->


                  <!-- /Purchase Detail Area -->
                  <div class="modal fade" id="DetailPurchase" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Purchase Details</h4>
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
                                <strong>Discount: </strong>
                                <p id="d_discount"></p>
                            </div>               
                            <div class="form-group">
                                <strong>Total Invoice: </strong>
                                <p id="d_invoice"></p>
                            </div>
                            <div class="form-group">
                                <strong>Amount Paid: </strong>
                                <p id="d_paid"></p>
                            </div>
                            <div class="form-group">
                                <strong>Amount Due: </strong>
                                <p id="d_due"></p>
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
                  <!-- /.Purchase Details Area End -->                  

                  <!-- /Delete Purchase Area -->
                  <div class="modal fade" id="DeletePurchase" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Delete Purchase</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /Delete Form Content -->
                          
                          <p>Are you sure you want to delete this record?</p>

                          <!-- /.Delete Form Content -->
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          {{ Form::open(['method' => 'DELETE','route' => ['purchase.destroy', '1']]) }}
                            <input type="hidden" id="pur2_id" name="purchase_id" value=""/>
                            <button type="submit" class="btn btn-danger">Delete</button>
                          {{ Form::close() }}
                          
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.Delete Purchase Area End -->

      
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

        $('body').on('click', '#add-purchase', function () {
          $('.AddForm').trigger("reset");
          $('#AddPurchase').modal('show');              
        });

        /* When click edit user */
        $('body').on('click', '#edit-purchase', function () {
          var p_id = $(this).data('id');
          $('#pur_id').val(p_id);
          $.get('http://127.0.0.1:8000/admin/purchase/' + p_id + '/edit', function (data) {
              $('#EditPurchase').modal('show');
              $('.EditForm #title').val(data.title);
              $('.EditForm #user_id').val(data.user_id);
              $('.EditForm #total_invoice').val(data.total_invoice);
              $('.EditForm #discount').val(data.discount);
              $('.EditForm #discount_unit').val(data.discount_unit);
              $('.EditForm #amount_paid').val(data.amount_paid);
              $('.EditForm #amount_due').val(data.amount_due);

          });
        });

        $('body').on('click', '#delete-purchase', function () {
          var p_id = $(this).data('id');
          $('#pur2_id').val(p_id);
          $('#DeletePurchase').modal('show');
        });

        
        $('body').on('click', '#view-purchase', function () {
          var p_id = $(this).data('id');
          $.get('http://127.0.0.1:8000/admin/purchase/' + p_id, function (data) {
            $('#DetailPurchase').modal('show');
              $('#d_title').html(data.title);
              $('#d_discount').html(data.discount);
              $('#d_invoice').html(data.total_invoice);
              $('#d_paid').html(data.amount_paid);
              $('#d_due').html(data.amount_due);
          });
        });

      });
    </script>

<script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="https://adminlte.io/themes/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
@endsection('new_script')