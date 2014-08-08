<div class="modal-header">      
    <div id="response"></div>
</div>
<div class="modal-body">
    {{ Form::open(array('url'=>'users/create', 'class'=>'form-signup', 'id' => 'registerForm')) }}
    <h2 class="form-signup-heading">Please Register</h2>

    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>

    {{ Form::text('firstname', null, array('class'=>'input-block-level', 'placeholder'=>'First Name','id' => 'fname')) }}
    {{ Form::text('lastname', null, array('class'=>'input-block-level', 'placeholder'=>'Last Name','id' => 'lname')) }}
    {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Email Address','id' => 'email')) }}
    {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password','id' => 'password')) }}
    {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Confirm Password','id' => 'cpassword')) }}
    
    <div class="inRow">{{ Form::button('Register', array('class'=>'btn btn-large btn-primary btn-block','id' => 'btnRegister'))}}</div>
    <div class="inRow">{{ Form::button('Close', array('class'=>'btn btn-large btn-primary btn-block','id' => 'btnClose', 'data-dismiss'=>'modal'))}}</div>
        
    {{ Form::close() }}
</div>
