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
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/blog/custom.css">
	<link rel="stylesheet"
		  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php $this->load->view("blog/template/header"); ?>
<section class="container">
	{body}
</section>
<?php $this->load->view("blog/template/footer"); ?>

<script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
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
