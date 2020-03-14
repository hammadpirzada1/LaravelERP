<div class="row">
                        <div class="col-md-4">
                              <div class="form-group">
                                {{Form::label('title','Title')}}
                                <div class="form-group {{$errors->has('title') ? 'has-error' : ''}} "></div>
                                {{Form::text('title', null,['class'=>'form-control','id'=>'title','placeholder'=>'Enter Title'])}}
                                
                                <!-- {{$errors->first('category_id','<p class="help-block">:message</p>')}} -->
                                    
                              </div>
                        </div>    
                          <div class="col-md-4">
                              <div class="form-group">
                                {{Form::label('location','Location')}}
                                <div class="form-group {{$errors->has('location') ? 'has-error' : ''}} "></div>
                                  {{Form::text('location', null,['class' => 'form-control','id' => 'location','placeholder' => 'Enter Location'])}}
                                  <!-- {{$errors->first('title','<p class="help-block">:message</p>')}} -->
                                
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">

                              {{Form::label('status','Status')}}

                              <div class="form-group {{$errors->has('status') ? 'has-error' : ''}} "></div>
                              {{Form::select('status',['active' => 'active', 'inactive' => 'inactive'],'inactive', ['class' => 'form-control','id' => 'status'])}}
                              <!-- {{$errors->first('unit','<p class="help-block">:message</p>')}} -->

                              </div>
                          </div>
                          
                          <div class="col-md-12">
                            {{Form::button(isset($model)? 'Update' : 'Save', ['class' => 'btn btn-primary','type' => 'submit'])}}
                          </div>   
                      </div>