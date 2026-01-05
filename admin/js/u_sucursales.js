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
		var ubicacion = button.data('ubicacion')
		var ciudad = button.data('ciudad')
		var telefono = button.data('telefono')
		var celular = button.data('celular')
		var maps = button.data('maps')
		var activo = button.data('activo')

		// Actualiza los datos del modal
		var modal = $(this)
		modal.find('.modal-title').text('Sucursal ' + nombre);
		modal.find('#codigo').val(codigo);
		modal.find('#nombre').val(nombre);
		modal.find('#ubicacion').val(ubicacion);
		modal.find('#ciudad').val(ciudad);
		modal.find('#telefono').val(telefono);
		modal.find('#celular').val(celular);
		modal.find('#maps').val(maps);
		if (activo == "1") {
			$('#activo').bootstrapToggle('on')
		} else {
			$('#activo').bootstrapToggle('off')
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