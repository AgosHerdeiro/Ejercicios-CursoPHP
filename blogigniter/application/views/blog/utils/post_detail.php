<div class="card">
	<div class="card-header">
		<img src="<?php echo image_post($post->post_id) ?>" alt="">
	</div>
	<div class="card-body">
		<h1><?php echo $post->title ?></h1>
		<p><?php echo $post->content ?></p>
		<a class="btn btn-danger"
		   href="<?php echo base_url() ?>blog/category/<?php echo $post->c_url_clean ?>"><?php echo $post->category ?></a>
	</div>

</div>
