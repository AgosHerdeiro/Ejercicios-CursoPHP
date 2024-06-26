<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo APP_NAME . ' | ' . APP_DESCRIPTION ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/fontawesome-free/css/fontawesome.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin/custom.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
		 folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/admin/skins/_all-skins.min.css">
	<link rel="stylesheet"
		  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>

	<?php (isset($grocery_crud)) ? $this->load->view("admin/template/grocery_crud_header", ["grocery_crud" => $grocery_crud]) : '' ?>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

	<?php $this->load->view("admin/template/header"); ?>
	<?php $this->load->view("admin/template/nav"); ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1></h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li><a href="#">Tables</a></li>
				<li class="active">Simple</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="box">
				<div class="box-header">

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="box">
						<div class="box-header">
							<h1>
								{title}
							</h1>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<?php if (isset($body)) : ?>
								{body}
							<?php endif; ?>
							<?php (isset($grocery_crud)) ? $this->load->view("admin/template/grocery_crud", ["grocery_crud" => $grocery_crud]) : '' ?>
						</div>
						<!-- /.box-body -->
					</div>
				</div>
				<!-- /.box-body -->
			</div>
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<?php $this->load->view("admin/template/footer"); ?>
	<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>assets/js/admin/adminlte.min.js"></script>
<script src="<?php echo base_url() ?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url() ?>assets/js/admin/main.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.toaster.js"></script>

<?php if ($this->session->flashdata("text") != null): ?>
	<script>
		$.toaster({
			priority :'<?php echo $this->session->flashdata("type")?>',
			title :'<?php echo $this->session->flashdata("text")?>',
			message :''});
	</script>
<?php endif; ?>
</body>
</html>
