<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="<?php echo base_url() . 'blog' ?>">
		<img class="logo" src="<?php echo base_url() . 'assets/img/logo.png' ?>" alt="">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
			aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="#"><?php echo APP_NAME ?> <span class="sr-only">(current)</span></a>
			</li>
		</ul>
		<form class="form-inline my-2 my-lg-0">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false">Dropdown
					</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<a class="dropdown-item" href="#">Something else here</a>
						<div role="separator" class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Separated link</a>
					</div>
					<input type="text" class="form-control" placeholder="Recipient's username"
						   aria-label="Recipient's username" aria-describedby="basic-addon2">
					<div class="input-group-append">
						<button class="btn btn-outline-secondary" type="button">Button</button>
					</div>
				</div>
		</form>
		<ul class="nav navbar-nav navbar-right user-options">
			<?php if ($this->session->userdata("id") != NULL): ?>
				<li title="Login">
					<a href="#">
						<span class="fa fa-user fa-2x"></span>
					</a>
				</li>
				<li title="Favoritos">
					<a href="#">
						<span class="fa fa-heart fa-2x"></span>
					</a>
				</li>
				<li title="Cerrar sesión">
					<a href="<?php echo base_url() . 'app/logout' ?>">
						<span class="fa fa-sign-out fa-2x"></span>
					</a>
				</li>
			<?php else: ?>
				<li title="Login">
					<a href="login">
						<span class="fa fa-sign-in fa-2x"></span>
					</a>
				</li>
			<?php endif; ?>
		</ul>
	</div>
</nav>
