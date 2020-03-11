@extends('admin.layouts.app')

@section('content_header')
    <div class="row mb-2">
      <div class="col-sm-6">
          <h1 class="m-0 text-dark">Category</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Category</a></li>
            <li class="breadcrumb-item active">{{$category->title}}</li>            
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
                  Category
                </h3>
                
              </div><!-- /.card-header -->

              <div class="card-body">
                <div class="tab-content p-0">
                  
                  <!-- Main card content.. -->

                    <div class="">
                    <div class="container">
                        <div class="form-group">
                            <strong>Title: </strong>
                            {{ $category->title}}
                        </div>
                    </div>
                    <div class="container">
                        <div class="form-group">
                            <strong>Parent: </strong>
                            {{ $category->parent}}
                        </div>
                    </div>
                  </div>
                  
                  @role('admin')
                  <div class="col-md-12">
                    <a class="btn btn-success" href="{{route('category.edit', $category->id)}}">Edit</a>

                    {{ Form::open(['method' => 'DELETE','route' => ['category.destroy', $category->id]]) }}
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
