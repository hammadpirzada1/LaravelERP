@extends('admin.layouts.app')

@section('content_header')
    <div class="row mb-2">
      <div class="col-sm-6">
          <h1 class="m-0 text-dark">Order</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('order.index') }}">Order</a></li>
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
                 <strong>Order List</strong>
                </h4>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="btn btn-success btn-sm" id="add-order" data-toggle="modal" data-target="#AddOrder">Add</a>
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
                          <th>Customer Name</th>
                          <th>Payment</th>
                          <th>Discount</th>
                          <th>Status</th>
                          <th>Items</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=1; $count=0; $dn = "" ?>
                          @foreach($order as $key => $value)
                          <?php if($value->discount_unit == "percentage"){
                              $dn = ' %';
                          }
                          else{
                              $dn = ' Rs.';
                          } ?>
                          <tr>
                            <td >{{$no++}}</td>
                            <td >{{$value->title}}</td>
                            <td >{{$value->user->name}}</td>                            
                            <td >{{$value->payment}}</td>
                            <td >{{$value->discount . $dn}}</td>
                            @if($value->status == "completed")
                              <td style="color: green"><b>{{$value->status}}</b></td>
                            @else
                              <td>{{$value->status}}</td>
                            @endif
                            @if(count($items_availability[$count]->product_masters)>0)
                              <td>Items Available</td>
                            @else
                              <td style="color: red">Not Available</td>
                            @endif
                            <td style="text-align: center;">
                              <a class="btn btn-info btn-sm" href="javascript:void(0)" id="view-order" data-id="{{$value->id}}" style="font-size: 10px">View</a>
                              @role('admin')
                              <a class="btn btn-success btn-sm" href="javascript:void(0)" id="item-order" data-id="{{$value->id}}"  style="font-size: 10px">Items</a>
                              <a class="btn btn-warning btn-sm" href="javascript:void(0)" id="edit-order" data-id="{{$value->id}}"  style="font-size: 10px">Edit</a>
                              @if($value->status == "completed")
                                
                              @else
                                <a class="btn btn-danger btn-sm" href="javascript:void(0)" id="delete-order" data-id="{{$value->id}}"  style="font-size: 10px">Delete</a>
                              @endif
                              @endrole
                            </td>
                          </tr>
                          <?php $count++;?>
                          @endforeach 
                      </tbody>
                    </table>
                  </div>

                  <!-- /.Main card-content.. -->

                  <!-- /Add Order Area -->
                  <div class="modal fade" id="AddOrder" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="modal_title">Add Order</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /Add Form Content -->
                          
                          {{Form::open(['route' => 'order.store', 'method' => 'POST', 'class' => 'AddForm'])}}
                            @include('admin.order.order_master')
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
                  <!-- /.Add Order Area End -->

                  <!-- /Add Order Items Area -->
                  <div class="modal fade" id="AddItems" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="modal_title">Add Order Items</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /Add Form Content -->
                          
                          <div class="row">
                            <form action="cart" method="GET" class="ItemForm">
                              <table class="table table-bordered table-responsive table-hover" id="table">
                                    <thead>
                                      <tr>
                                        <th width="50%">Item</th>
                                        <td width="50%" style="text-align: center;" colspan="2">
                                          <button type="button" class="btn btn-success btn-sm add-row">Add</button>
                                          <button type="button" class="btn btn-danger btn-sm delete-row">Remove</button>
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
                  <!-- /.Add Order Items Area End -->

                  <!-- /Edit Order Area -->
                  <div class="modal fade" id="EditOrder" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Order</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /Edit Form Content -->
                          
                          {{ Form::model($order, ['route'=>['order.update', '1'],'method'=>'PATCH' , 'class' => 'EditForm']) }}
                            <input type="hidden" id="ord_id" name="order_id" value=""/>
                            @include('admin.order.order_master')
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
                  <!-- /.Edit Order Area End -->


                  <!-- /Order Detail Area -->
                  <div class="modal fade" id="DetailOrder" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Order Details</h4>
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
                                <strong>Customer: </strong>
                                <p id="d_user_id"></p>
                            </div>
                            <div class="form-group">
                                <strong>Payment: </strong>
                                <p id="d_payment"></p>
                            </div>
                            <div class="form-group">
                                <strong>Discount: </strong>
                                <p id="d_discount"></p>
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
                  <!-- /.Order Details Area End -->                  

                  <!-- /Delete Order Area -->
                  <div class="modal fade" id="DeleteOrder" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Delete Order</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /Delete Form Content -->
                          
                          <p>Are you sure you want to delete this order?</p>

                          <!-- /.Delete Form Content -->
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          {{ Form::open(['method' => 'DELETE','route' => ['order.destroy', '1']]) }}
                            <input type="hidden" id="ord2_id" name="order_id" value=""/>
                            <button type="submit" class="btn btn-danger">Delete</button>
                          {{ Form::close() }}
                          
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.Delete Order Area End -->

       
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
        
        $('body').on('click', '#add-order', function () {
          $('.AddForm').trigger("reset");
          $('#AddOrder').modal('show');              
        });

        /* When click edit user */
        $('body').on('click', '#edit-order', function () {
          var p_id = $(this).data('id');
          $('#ord_id').val(p_id);
          $.get('http://127.0.0.1:8000/admin/order/' + p_id + '/edit', function (data) {
              $('#EditOrder').modal('show');
              $('.EditForm #title').val(data.title);
              $('.EditForm #status').val(data.status);
              $('.EditForm #payment').val(data.payment);
              $('.EditForm #discount').val(data.discount);
              $('.EditForm #discount_unit').val(data.discount_unit);
              $('.EditForm #purchase_unit').val(data.purchase_unit);
          });
        });

        $('body').on('click', '#delete-order', function () {
          var p_id = $(this).data('id');
          $('#ord2_id').val(p_id);
          $('#DeleteOrder').modal('show');
        });
        
        $('body').on('click', '#view-order', function () {
          var p_id = $(this).data('id');
          $.get('http://127.0.0.1:8000/admin/order/' + p_id, function (data) {
            $('#DetailOrder').modal('show');
            if(data[1].product_masters.length > 0)
            {
              $('#d_title').html(data[0].title);
              $('#d_user_id').html(data[0].user.name);
              $('#d_payment').html(data[0].payment);
              $('#d_discount').html(data[0].discount);
              $('#d_status').html(data[0].status);
              $('.item-p').html('');
              for(var i=0; i<data[1].product_masters.length; i++){
              $('.item-p').append('<li>'+data[1].product_masters[i].title+'</li>');
              }
            }
            else
            {
              $('#d_title').html(data[0].title);
              $('#d_user_id').html(data[0].user.name);
              $('#d_payment').html(data[0].payment);
              $('#d_discount').html(data[0].discount);
              $('#d_status').html(data[0].status);
              $('.item-p').html('No Item Found!');              
            }              
          });
        });

        var i_id = 0;
        var i_dis = 0;
        var i_dis_unit  = "";

        $('body').on('click', '#item-order', function () {
          var f_id = $(this).data('id');
          $('#form_id').val(f_id);
          $.get('http://127.0.0.1:8000/admin/order/' + f_id + '/edit', function (data) {
              $('#AddItems').modal('show');
              i_id = data.id;
              i_dis = data.discount;
              i_dis_unit = data.discount_unit;
              $(".ItemForm table tbody").html("");
          });
        });

        //add dynamic table rows for order items
        $(".add-row").click(function(){
          var markup = "<tr>" + 
          "<input type='hidden' class='form-control' id='order_master_id' name='order_master_id' value='' readonly='true'>" +
          "<td>"+
            "<select class='form-control' id='product_master_id[]' name='product_master_id[]'>"+
              "@foreach($product as $products)"+
                "<option value='{{ $products->id }}'> {{ $products->title }} </option>"+
              "@endforeach"+
            "</select>"+
          "</td>"+
          "<input type='hidden' class='form-control' id='discount' name='discount' value='' >"+
          "<input type='hidden' class='form-control' id='discount_unit' name='discount_unit' value='' >"+
          "<td style='text-align: center;'><input type='checkbox' name='record' class='form-control'></td> </tr>";
          $(".ItemForm table tbody").append(markup);
          $(".ItemForm #order_master_id").val(i_id);
          $(".ItemForm #discount").val(i_dis);
          $(".ItemForm #discount_unit").val(i_dis_unit);
      });
      
      // Find and remove selected table rows
      $(".delete-row").click(function(){
          $("table tbody").find('input[name="record"]').each(function(){
              if($(this).is(":checked")){
                  $(this).parents("tr").remove();
              }
          });
      });

      });
    </script>

@endsection('new_script')