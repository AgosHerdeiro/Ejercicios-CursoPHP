<table class="table table-condensed">
	<tbody>
	<tr>
		<th style="width: 10px">#</th>
		<th>Nombre</th>
		<th>Acciones</th>
	</tr>
	<?php foreach ($categories as $key => $c) : ?>
		<tr>
			<td><?php echo $c->category_id ?></td>
			<td><?php echo $c->name ?></td>
			<td>
				<a class="btn btn-sm btn-primary"
				   href="<?php echo base_url() . 'admin/category_save/' . $c->category_id ?>">
					<i class="fa fa-pencil"></i> Editar
				</a>
				<br>
				<a class="btn btn-sm btn-danger"
				   data-toggle="modal" data-target="#deleteModal"
				   href="#"
				   data-categoryid="<?php echo $c->category_id ?>">
					<i class="fa fa-remove"></i> Eliminar
				</a>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">New message</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-danger" id="borar-category" data-dismiss="modal">Eliminar</button>
			</div>
		</div>
	</div>
</div>

<script>
	var categoryid = 0;
	var buttonDelete;

	// Abrir el modal
	$('#deleteModal').on('show.bs.modal', function (event) {
		buttonDelete = $(event.relatedTarget)
		categoryid = buttonDelete.data('categoryid')
		var modal = $(this)
		modal.find('.modal-title').html('¿Seguro que desea eliminar la Categoría seleccionada? <br> Id de la categoría: ' + categoryid);
	})

	// Llamar a eliminar
	$("#borar-category").click(function () {
		$.ajax({
			url: "<?php echo base_url() ?>admin/category_delete/" + categoryid
		}).done(function (res) {
			if (res == 1) {
				$(buttonDelete).parent().parent().remove();
			}
		});
	});
</script>
