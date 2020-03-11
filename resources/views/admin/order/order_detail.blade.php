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
            <li class="breadcrumb-item active">{{$order->title}}</li>            
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
                  Order
                </h3>
                
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content p-0">
                  
                  <!-- Main card content.. -->

                    <div class="">
                      <div class="container">
                        <div class="form-group">
                            <strong>User ID: </strong>
                            {{ $order->user_id}}
                        </div>
                    </div>
                    <div class="container">
                        <div class="form-group">
                            <strong>Title: </strong>
                            {{ $order->title}}
                        </div>
                    </div>
                    <div class="container">
                        <div class="form-group">
                            <strong>Status: </strong>
                            {{ $order->status}}
                        </div>
                    </div>
                    <div class="container">
                        <div class="form-group">
                            <strong>Payment: </strong>
                            {{ $order->payment}}
                        </div>
                    </div>
                    <div class="container">
                        <div class="form-group">
                            <strong>Discount: </strong>
                            {{ $order->discount}}
                        </div>
                    </div>
                    <div class="container">
                        <div class="form-group">
                            <strong>Discount Unit: </strong>
                            {{ $order->discount_unit}}
                        </div>
                    </div>

                    <div class="container">
                        <div class="form-group">
                            <strong> Items: </strong>
                            <ul>
                            @foreach($item->product_masters as $items)
                            <li>{{$items->title}}</li>
                            @endforeach
                            </ul>
                        </div>
                    </div>

                  </div>
                
                @role('admin')
                <div class="col-md-12">
                    <a class="btn btn-success" href="{{route('order.edit', $order->id)}}">Edit</a>

                    {{ Form::open(['method' => 'DELETE','route' => ['order.destroy', $order->id]]) }}
                      <button type="submit" class="btn btn-danger">Delete</button>
                    {{ Form::close() }}
                </div>
                @endrole
                  

                  <!-- /.Main card-content.. -->
       
                </div>
              </div><!-- /.card-body -->

        </div>
        <!-- /.card -->
      </section>
    </div>
    

@endsection('content_body')
