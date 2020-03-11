@extends('admin.layouts.app')

@section('content_header')
    <div class="row mb-2">
      <div class="col-sm-6">
          <h1 class="m-0 text-dark">Order</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('order.index') }}">Order</a></li>
            <li class="breadcrumb-item active">Add Order</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
@endsection('content_header')

@section('content_body')

<div class="row">
      <section class="col-md-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas mr-1"></i>
                  Cart
                </h3>
                
              </div><!-- /.card-header -->
              <!-- <?php
                $order_id = 0;
                if($order_master->id !=null){ 
                  $order_id = $order_master->id; 
                }
                else{ 
                  $order_id = null; 
                }              
              ?> -->
              
              <div class="card-body">
                <div class="tab-content p-0">
                  
                  <!-- Main card content.. -->
                    
                                     
                    <div class="container">
                      <div class="row">
                      <form action="cart" method="GET">
                        <table class="table table-bordered table-responsive-lg table-hover" id="table">
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
                              <button class="btn btn-primary" type="submit" value="submit">Submit</button>
                        </table>
                      </form>
                      </div>
                    </div> 
                                    
                    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

                    <script>
                          $(document).ready(function(){
                              $(".add-row").click(function(){
                                  // var product_master_id = $("#product_id").val();
                                  var markup = "<tr>" + 
                                  "<input type='hidden' class='form-control' id='order_master_id' name='order_master_id' value='{{$order_master->id}}' readonly='true'>" +
                                  "<td>"+
                                    "<select class='form-control' id='product_master_id[]' name='product_master_id[]'>"+
                                      "@foreach($product as $products)"+
                                        "<option value='{{ $products->id }}'> {{ $products->title }} </option>"+
                                      "@endforeach"+
                                    "</select>"+
                                  "</td>"+
                                  "<input type='hidden' class='form-control' id='discount' name='discount' value='{{$order_master->discount}}' >"+
                                  "<input type='hidden' class='form-control' id='discount_unit' name='discount_unit' value='{{$order_master->discount_unit}}' >"+
                                  "<td style='text-align: center;'><input type='checkbox' name='record' class='form-control'></td> </tr>";
                                  $("table tbody").append(markup);
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

                  <!-- /.Main card-content.. -->
       
                </div>
              </div><!-- /.card-body -->

        </div>
        <!-- /.card -->
      </section>
    </div>

@endsection('content_body')