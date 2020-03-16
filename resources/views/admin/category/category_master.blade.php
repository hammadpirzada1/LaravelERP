                      <div class="row">                        
                          <div class="col-md-4">
                              <div class="form-group">
                                {{ Form::label('title', 'Category Title') }}
                                {{ Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'Enter Category Name']) }}
                              </div>
                          </div>

                          <div class="col-md-4">
                              <div class="form-group">
                                {{ Form::label('parent', 'Parent') }}
                                {{ Form::text('parent', null, ['class'=>'form-control', 'placeholder'=>'Enter Category Parent']) }}
                              </div>
                          </div>

                          <div class="col-md-12">
                              {{Form::button(isset($model)? 'Update' : 'Save', ['class' => 'btn btn-dark','type' => 'submit'])}}
                          </div>   
                      </div>