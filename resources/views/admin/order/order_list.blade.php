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
      <section class="col-md-12 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas mr-1"></i>
                  Order List
                </h3>
                
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
                          <th style="text-align: center;"><a class="btn btn-success" style="font-size: 10px" href="{{route('order.create')}}">Add</a></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $no=1; $dn = "" ?>
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
                            <td >{{$value->status}}</td>
                            <td style="text-align: center;">
                              <a class="btn btn-info btn-sm" href="{{route('order.show',$value->id)}}" style="font-size: 10px">Show
                              </a>
                            </td>
                          </tr>
                          @endforeach 
                      </tbody>
                    </table>
                  </div>

                  <!-- /.Main card-content.. -->
       
                </div>
              </div><!-- /.card-body -->

        </div>
        <!-- /.card -->
      </section>
    </div>
    

@endsection('content_body')
