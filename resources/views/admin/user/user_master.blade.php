<div class="row">
                        <div class="col-md-12">
                              <div class="form-group">
                                {{Form::label('name','Name')}}
                                <div class="form-group {{$errors->has('name') ? 'has-error' : ''}} "></div>
                                {{Form::text('name', null,['class'=>'form-control','id'=>'name','placeholder'=>'Enter Name'])}}
                                
                                <!-- {{$errors->first('category_id','<p class="help-block">:message</p>')}} -->
                                    
                              </div>
                        </div>    
                          <div class="col-md-12">
                              <div class="form-group">
                                {{Form::label('email','Email')}}
                                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}} "></div>
                                  {{Form::text('email', null,['class' => 'form-control','id' => 'email','placeholder' => 'Enter Email'])}}
                                  <!-- {{$errors->first('title','<p class="help-block">:message</p>')}} -->
                                
                              </div>
                          </div>

                          <div class="col-md-12">
                              <div class="form-group">

                              {{Form::label('role_id','Role')}}

                              <div class="form-group {{$errors->has('status') ? 'has-error' : ''}} "></div>
                              {{Form::select('role_id', $role_name, null, ['class' => 'form-control', 'id' => 'role_id'])}}

                              {{$errors->first('role_id','message')}}
                              <!-- {{$errors->first('unit','<p class="help-block">:message</p>')}} -->

                              </div>
                          </div>
                          
                          <div class="col-md-12">
                            {{Form::button(isset($model)? 'Update' : 'Save', ['class' => 'btn btn-primary','type' => 'submit'])}}
                          </div>   
                      </div>