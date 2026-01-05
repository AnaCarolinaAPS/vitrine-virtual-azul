<?php if (isset($mensaje)) {?>
$(document).ready(function(){
	$("#modal-mensaje").modal("show");
});
<?php
	unset($mensaje);
} ?>

//DataTable
$(document).ready(function() {
	$('#tabladatos').DataTable( {
		dom: 'Bfrtip',
		order: [[ 0, "asc" ]],
		orientation: 'landscape',
		pageSize: 'LEGAL',
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'pdfHtml5'
		]//, 
		// columnDefs: [{
		// 	targets: [ 0 ],
		// 	visible: false,
		// 	searchable: false
		// }]
	});
});

// $('#AltModal').on('show.bs.modal', function (event) {
$(document).ready(function(){
	$(document).on('shown.bs.modal','#AltModal', function (event) {
		var button = $(event.relatedTarget) // objeto que disparó el modal
		var codigo = button.data('codigo')
		var nombre = button.data('nombre')
		var activo = button.data('activo')
		var menu = button.data('menu')
		var categoria = button.data('categoria')

		console.log(categoria);
		// Actualiza los datos del modal
		var modal = $(this)
		modal.find('.modal-title').text('Categoría ' + nombre);
		modal.find('#codigo').val(codigo);
		modal.find('#nombre').val(nombre);
		modal.find('#categoria').val(categoria);
		$('.selectpicker').selectpicker('refresh');
		
		if (activo == "1") {
			$('#activo').bootstrapToggle('on')
		} else {
			$('#activo').bootstrapToggle('off')
		}

		if (menu == "1") {
			$('#menu').bootstrapToggle('on')
		} else {
			$('#menu').bootstrapToggle('off')
		}
	})
});

// modal para confirmar si quiere remover el registro
var modalConfirm = function(callback){
	//botón que llama el modal
	$("#btn-confirmar").on("click", function(){
		$("#mi-modal").modal('show');
	});

	//si quiere remover el registro
	$("#modal-btn-si").on("click", function(){
		callback(true);
		$("#mi-modal").modal('hide');
	});

	//si no quiere remover el registro
	$("#modal-btn-no").on("click", function(){
		callback(false);
		$("#mi-modal").modal('hide');
	});
};
//función que trabaja con la respuesta del modal (sí o no)
modalConfirm(function(confirm){
	if(confirm){
		//Acciones si el usuario confirma
		$("#btn-excluir").click();
	}
});