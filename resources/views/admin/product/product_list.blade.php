@extends('admin.layouts.app')

@section('content_header')
    <div class="row mb-2">
      <div class="col-sm-6">
          <h1 class="m-0 text-dark">Product</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('product.index') }}">Product</a></li>
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
                  <strong>Product List</strong>
                </h4>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="btn btn-success btn-sm" id="add-product" data-toggle="modal" data-target="#AddProduct">Add</a>
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

                    <table class="table table-bordered table-responsive-lg table-hover">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Product Name</th>
                          <th>Category Name</th>
                          <th>Price</th>
                          <th>Unit</th>
                          <th>Discount %</th>
                          <th>Description</th>
                          <th>Thersold</th>
                          <th>Status</th>
                          <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=1;?>
                          @foreach($product as $key => $value)
                          <tr>
                            <td >{{$no++}}</td>
                            <td >{{$value->title }}</td>
                            <td >{{$value->product_category->title}}</td>                            
                            <td >{{$value->price }}</td>                                                 
                            <td >{{$value->unit->name}}</td>
                            <td >{{$value->discount }}</td>
                            <td > <p data-toggle="tooltip" title="{{$value->long_desc}}" style="cursor:help">{{$value->short_desc }}</p> </td> 
                            <td >{{$value->threshold }}</td>
                            <td >{{$value->status }}</td>                          
                            <td style="text-align: center;">
                              <a class="btn btn-info btn-sm" href="javascript:void(0)" id="view-product" data-id="{{$value->id}}" style="font-size: 10px">View</a>
                              @role('admin')
                              <a class="btn btn-warning btn-sm" href="javascript:void(0)" id="edit-product" data-id="{{$value->id}}"  style="font-size: 10px">Edit</a>
                              <a class="btn btn-danger btn-sm" href="javascript:void(0)" id="delete-product" data-id="{{$value->id}}"  style="font-size: 10px">Delete</a>
                              @endrole
                            </td>

                          </tr>
                          @endforeach 
                      </tbody>
                    </table>
                  </div>

                  <!-- /.Main card-content.. -->

                  <!-- /Add Product Area -->
                  <div class="modal fade" id="AddProduct" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="modal_title">Add Product</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /Add Form Content -->
                          
                          {{Form::open(['route' => 'product.store', 'method' => 'POST', 'class' => 'AddForm'])}}
                            @include('admin.product.product_master')
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
                  <!-- /.Add Product Area End -->

                  <!-- /Edit Product Area -->
                  <div class="modal fade" id="EditProduct" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Edit Product</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /Edit Form Content -->
                          
                          {{ Form::model($product, ['route'=>['product.update', '1'],'method'=>'PATCH' , 'class' => 'EditForm']) }}
                            <input type="hidden" id="prod_id" name="product_id" value=""/>
                            @include('admin.product.product_master')
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
                  <!-- /.Edit Product Area End -->


                  <!-- /Product Detail Area -->
                  <div class="modal fade" id="DetailProduct" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Product Details</h4>
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
                                <strong>Description: </strong>
                                <p id="d_desc"></p>
                            </div>
                            <div class="form-group">
                                <strong>Price: </strong>
                                <p id="d_price"></p>
                            </div>
                            <div class="form-group">
                                <strong>Status: </strong>
                                <p id="d_status"></p>
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
                  <!-- /.Product Details Area End -->                  

                  <!-- /Delete Product Area -->
                  <div class="modal fade" id="DeleteProduct" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Delete Product</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- /Delete Form Content -->
                          
                          <p>Are you sure you want to delete this product?</p>

                          <!-- /.Delete Form Content -->
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                          {{ Form::open(['method' => 'DELETE','route' => ['product.destroy', '1']]) }}
                            <input type="hidden" id="prod2_id" name="product_id" value=""/>
                            <button type="submit" class="btn btn-danger">Delete</button>
                          {{ Form::close() }}
                          
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.Delete Product Area End -->

      
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

        $('[data-toggle="tooltip"]').tooltip();

        $('body').on('click', '#add-product', function () {
          $('.AddForm').trigger("reset");
          $('#AddProduct').modal('show');              
        });

        /* When click edit user */
        $('body').on('click', '#edit-product', function () {
          var p_id = $(this).data('id');
          $('#prod_id').val(p_id);
          $.get('http://127.0.0.1:8000/admin/product/' + p_id + '/edit', function (data) {
              $('#EditProduct').modal('show');
              $('.EditForm #title').val(data.title);
              $('.EditForm #product_category_id').val(data.product_category_id);
              $('.EditForm #unit_id').val(data.unit_id);
              $('.EditForm #inventory_val').val(data.inventory_val);
              $('.EditForm #price').val(data.price);
              $('.EditForm #discount').val(data.discount);
              $('.EditForm #threshold').val(data.threshold);
              $('.EditForm #short_desc').val(data.short_desc);
              $('.EditForm #long_desc').val(data.long_desc);
          });
        });

        $('body').on('click', '#delete-product', function () {
          var p_id = $(this).data('id');
          $('#prod2_id').val(p_id);
          $('#DeleteProduct').modal('show');
        });

        
        $('body').on('click', '#view-product', function () {
          var p_id = $(this).data('id');
          $.get('http://127.0.0.1:8000/admin/product/' + p_id, function (data) {
            $('#DetailProduct').modal('show');
              $('#d_title').html(data.title);
              $('#d_price').html(data.price);
              $('#d_desc').html(data.long_desc);
              $('#d_status').html(data.status);
          });
        });

      });
    </script>
@endsection('new_script')
