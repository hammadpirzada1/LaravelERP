<div class="row">
    <div class="col-md-4">
        <div class="form-group">
        {{Form::label('title','Purchase Title')}}
        <div class="form-group {{$errors->has('title') ? 'has-error' : ''}} "></div>
            {{Form::text('title', null,['class' => 'form-control','id' => 'title','placeholder' => 'Enter Purchase Title'])}}
            {{$errors->first('title', 'purchase title required')}}                                
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
        {{Form::label('user_id','Vendor')}}
        <div class="form-group {{$errors->has('user_id') ? 'has-error' : ''}} "></div>
        {{Form::select('user_id', $user_id, null, ['class' => 'form-control', 'id' => 'user_id'])}}
        {{$errors->first('user_id','vendor required')}}   
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
        {{Form::label('total_invoice','Total Invoice')}}
        <div class="form-group {{$errors->has('total_invoice') ? 'has-error' : ''}} "></div>
        {{Form::text('total_invoice', null,['class' => 'form-control','id' => 'total_invoice', 'placeholder' => 'Enter Total Invoice'])}}
        {{$errors->first('total_invoice', 'invoice value required')}}
        </div>
    </div>                        

    <div class="col-md-4">
        <div class="form-group">
        {{Form::label('discount','Discount')}}
        <div class="form-group {{$errors->has('discount') ? 'has-error' : ''}} "></div>
        {{Form::text('discount', null,['class' => 'form-control','id' => 'discount', 'placeholder' => 'Enter Discount'])}}    
        {{$errors->first('discount','discount value required')}}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
          {{Form::label('discount_unit','Discount Unit')}}
            <div class="form-group {{$errors->has('discount_unit') ? 'has-error' : ''}} "></div>
          {{Form::select('discount_unit',['percentage' => 'percentage', 'amount' => 'amount'],'percentage',['class' => 'form-control','id' => 'discount_unit'])}}
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
        {{Form::label('amount_paid','Amount Paid')}}

        <div class="form-group {{$errors->has('amount_paid') ? 'has-error' : ''}} "></div>
        {{Form::text('amount_paid', null,['class' => 'form-control','id' => 'amount_paid', 'placeholder' => 'Enter Amount Paid'])}}
        {{$errors->first('amount_paid', 'amount paid value required')}}

        </div>
    </div>
    
    <div class="col-md-4">
        <div class="form-group">
        {{Form::label('amount_due','Amount Due')}}

        <div class="form-group {{$errors->has('amount_due') ? 'has-error' : ''}} "></div>
        {{Form::text('amount_due', null,['class' => 'form-control','id' => 'amount_due', 'placeholder' => 'Enter Amount Due'])}}
        {{$errors->first('amount_due', 'amount paid value required')}}

        </div>
    </div>
                           
    <div class="col-md-12">
    {{Form::button(isset($model)? 'Update' : 'Save', ['class' => 'btn btn-dark','type' => 'submit'])}}
    </div>  

</div>