
                      <div class="row">                        
                          <!-- <div class="col-md-4">
                              <div class="form-group">
                                {{ Form::label('user_id', 'Customer ID') }}
                               
                                {{ Form::text('user_id', Auth::id(), ['class'=>'form-control', 'placeholder'=>'Enter User ID', 'readonly' => 'true' ]) }}
                              </div>
                          </div> -->
                          {{ Form::hidden('user_id', Auth::id(), ['class'=>'form-control', 'placeholder'=>'Enter User ID', 'readonly' => 'true' ]) }}

                          <div class="col-md-4">
                              <div class="form-group">
                                {{ Form::label('title', 'Title') }}
                                {{ Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Enter Order Title']) }}
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                {{Form::label('status','Status')}}
                                {{Form::select('status',['pending' => 'pending', 'draft' => 'draft', 'completed' => 'completed'],'pending',['class' => 'form-control','id' => 'status'])}}
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                {{ Form::label('payment', 'Payment') }}
                                {{ Form::text('payment', null, ['class'=>'form-control', 'placeholder'=>'Enter Payment']) }}
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                {{ Form::label('discount', 'Discount') }}
                                {{ Form::text('discount', null, ['class'=>'form-control', 'placeholder'=>'Enter Discount']) }}
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                {{Form::label('discount_unit','Discount Unit')}}
                                {{Form::select('discount_unit',['percentage' => 'percentage', 'amount' => 'amount'],'percentage',['class' => 'form-control','id' => 'discount_unit'])}}
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                {{ Form::label('purchase_unit', 'Purchase Unit') }}
                                {{ Form::text('purchase_unit', null, ['class'=>'form-control', 'placeholder'=>'Enter Purchase Unit']) }}
                              </div>
                          </div>

                          <div class="col-md-12">
                              {{Form::button(isset($model)? 'Update' : 'Save', ['class' => 'btn btn-dark','type' => 'submit' , 'id' => 'save-button'])}}
                          </div>
                      </div>