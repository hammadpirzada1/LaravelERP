                    <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                {{Form::label('title','Product Name')}}
                                <div class="form-group {{$errors->has('title') ? 'has-error' : ''}} "></div>
                                  {{Form::text('title', null,['class' => 'form-control','id' => 'title','placeholder' => 'Enter Product'])}}
                                  {{$errors->first('title', 'product name required')}}                                
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                {{Form::label('product_category_id','Category')}}
                                <div class="form-group {{$errors->has('product_category_id') ? 'has-error' : ''}} "></div>

                                {{Form::select('product_category_id', $category_name, null, ['class' => 'form-control', 'id' => 'product_category_id'])}}

                                {{$errors->first('product_category_id','category field required')}}   
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                              {{Form::label('unit_id','Unit')}}

                              <div class="form-group {{$errors->has('unit_id') ? 'has-error' : ''}} "></div>                              
                              {{Form::select('unit_id', $unit_name, null, ['class' => 'form-control', 'id' => 'unit_id'])}}                              
                              {{$errors->first('unit_id','unit required')}}
                              </div>
                          </div>                          

                          <div class="col-md-4">
                              <div class="form-group">
                              {{Form::label('inventory_val','Inventory Valuation')}}

                              <div class="form-group {{$errors->has('inventory_val') ? 'has-error' : ''}} "></div>                              
                              {{Form::select('inventory_val', array('Fifo' => 'Fifo', 'Lifo' => 'Lifo'), 'FIFO', ['class' => 'form-control', 'id' => 'inventory_val'])}}                              
                              {{$errors->first('inventory_val','valuation required')}}
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                {{Form::label('price','Price in Rs.')}}

                                <div class="form-group {{$errors->has('price') ? 'has-error' : ''}} "></div>
                                {{Form::text('price', null,['class' => 'form-control','id' => 'price', 'placeholder' => 'Enter Price in Rs.'])}}
                                {{$errors->first('price', 'price value required')}}

                              </div>
                          </div>
                          
                          
                          <div class="col-md-4">
                              <div class="form-group">
                                {{Form::label('discount','Discount %')}}
                                <div class="form-group {{$errors->has('discount') ? 'has-error' : ''}} "></div>
                                {{Form::text('discount', null,['class' => 'form-control','id' => 'discount', 'placeholder' => 'Enter Discount %'])}}    
                                {{$errors->first('discount','discount value required')}}

                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                {{Form::label('threshold','Threshold')}}
                                <div class="form-group {{$errors->has('threshold') ? 'has-error' : ''}} "></div>
                                {{Form::text('threshold', null,['class'=>'form-control','id'=>'threshold','placeholder'=>'Enter Threshold'])}}
                                {{$errors->first('threshold','threshold value required')}}
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                {{Form::label('status','Status')}}
                                <div class="form-group {{$errors->has('status') ? 'has-error' : ''}} "></div>
                                {{Form::select('status',['pending' => 'pending', 'draft' => 'draft', 'completed' => 'completed'],'pending',['class' => 'form-control','id' => 'status'])}}    
                                {{$errors->first('status','status required')}}

                              </div>
                          </div>

                           <!-- short and long description textarea. -->
                           <div class="col-md-4">
                              <div class="form-group">
                                {{Form::label('short_desc','Short Description')}}
                                <div class="form-group {{$errors->has('short_desc') ? 'has-error' : ''}} "></div>
                                {{Form::text('short_desc', null,['class' => 'form-control','id' => 'short_desc','placeholder' => 'Enter Product Short Description'])}}
                                {{$errors->first('short_desc', 'short description required')}}
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                
                                {{Form::label('long_desc','Long Description')}}
                                <div class="form-group {{$errors->has('long_desc') ? 'has-error' : ''}} "></div>
                                {{Form::textarea('long_desc', null, ['class' => 'form-control','id' => 'long_desc','placeholder' => 'Enter Product Full Description', 'rows' => '3'])}}
                                {{$errors->first('long_desc', 'long description required')}}
                            </div>
                          </div>                          

                          <div class="col-md-4">
                              <div class="form-group">
                                <!-- {{Form::label('created_by','Created By')}}
                                <div class="form-group {{$errors->has('created_by') ? 'has-error' : ''}} "></div> -->
                                  {{Form::hidden('created_by',null, ['class' => 'form-control','id' => 'created_by', 'placeholder' => 'Created By', 'readonly' => 'true'])}}
                                  <!-- {{$errors->first('created_by','message')}} -->
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                <!-- {{Form::label('modified_by','Modified By')}}
                                <div class="form-group {{$errors->has('modified_by') ? 'has-error' : ''}} "></div> -->
                                {{Form::hidden('modified_by', null, ['class' => 'form-control','id' => 'modified_by', 'placeholder' => 'Modified By','readonly' => 'true'])}}
                                <!-- {{$errors->first('modified_by','message')}} -->
                              </div>
                          </div>
                          
                          <div class="col-md-12">
                            {{Form::button(isset($model)? 'Update' : 'Save', ['class' => 'btn btn-dark','type' => 'submit'])}}
                          </div>   
                      </div>