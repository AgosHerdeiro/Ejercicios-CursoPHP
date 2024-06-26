<div class="login-box">
	<div class="login-logo">
		<a href=""><b><?php echo APP_NAME ?></a>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">Iniciar sesión</p>

		<?php echo form_open('login'/*, ['class' => 'std-form']*/); ?>
		<div class="form-group has-feedback">
			<input name="username" class="form-control" placeholder="Usuario o email" type="text">
			<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
		</div>
		<div class="form-group has-feedback">
			<input name="password" class="form-control" placeholder="Password" type="password">
			<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		</div>
		<div class="row">
			<div class="col-xs-8">

			</div>
			<!-- /.col -->
			<div class="col-xs-4">
				<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
			</div>
			<!-- /.col -->
		</div>

		<input type="hidden" id="max_allowed_attempts" value="<?php echo config_item('max_allowed_attempts'); ?>"/>
		<input type="hidden" id="mins_on_hold" value="<?php echo(config_item('seconds_on_hold') / 60); ?>"/>

		</form>
		<!-- /.social-auth-links -->

		<a href="#">Olvidé contraseña</a><br>
		<a href="register" class="text-center">Registrarse</a>

	</div>
	<!-- /.login-box-body -->
</div>
