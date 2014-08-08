<div class="modal-header">    
    <div id="response"></div>
</div>
<div class="modal-body">
{{ Form::open(array('url'=>'users/signin', 'class'=>'form-signin', 'id' => 'loginForm')) }}
	<h2 class="form-signin-heading">Please Login</h2>

	{{ Form::text('email', null, array('class'=>'input-block-level','id' => 'email', 'placeholder'=>'Email Address')) }}
	{{ Form::password('password', array('class'=>'input-block-level','id' => 'password', 'placeholder'=>'Password')) }}
        
        <div class="inRow">{{ Form::button('Login', array('class'=>'btn btn-large btn-primary btn-block','id' => 'btnLogin'))}}</div>
        <div class="inRow">{{ Form::button('Close', array('class'=>'btn btn-large btn-primary btn-block','id' => 'btnClose', 'data-dismiss'=>'modal'))}}</div>
        
{{ Form::close() }}
</div>