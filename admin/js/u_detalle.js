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
		order: [[ 1, "asc" ]],
		orientation: 'landscape',
		pageSize: 'LEGAL',
		buttons: [
			'copyHtml5',
			'excelHtml5',
			'pdfHtml5'
		]
	});
});

//función responsable por mostrar la imagen que el usuario eligió en el elemento img
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
			document.getElementById("img").src = e.target.result;
			document.getElementById("img-alt").src = e.target.result;
	        // $(input).next().attr('src', e.target.result)
	    };
	    reader.readAsDataURL(input.files[0]);
    }
    else {
        var img = input.value;
		document.getElementById("img").src=img;
		document.getElementById("img-alt").src=img;
        // $(input).next().attr('src',img);
    }
} 

function verificaMostraBotao(){
    $('input[type=file]').each(function(index){
        if ($('input[type=file]').eq(index).val() != ""){
            readURL(this);
            $('.hide').show();
        }
    });
}

$('input[type=file]').on("change", function(){
  verificaMostraBotao();
});

$('.hide').on("click", function(){
    $(document.body).append($('<input />', {type: "file" }).change(verificaMostraBotao));
    $(document.body).append($('<img />'));
    $('.hide').hide();
});

// $('#AltModal').on('show.bs.modal', function (event) {
$(document).ready(function(){
	$(document).on('shown.bs.modal','#AltModal', function (event) {
		var button = $(event.relatedTarget) // objeto que disparó el modal
		var codigo = button.data('codigo')
		var url = button.data('url')
		var orden = button.data('orden')
		var activo = button.data('activo')
		
		console.log(activo);
		// Actualiza los datos del modal
		var modal = $(this)
		modal.find('.modal-title').text('Imagen ' + url);
		modal.find('#codigo').val(codigo);
		modal.find('#imgurl').val(url);
		document.getElementById("img-alt").src="img/productos/"+url;
		modal.find('#orden').val(orden);

		if (activo == "1") {
			$('#toggle-activo').bootstrapToggle('on')
		} else {
			$('#toggle-activo').bootstrapToggle('off')
		}
		
	})
});

// modal para confirmar si quiere remover el registro (WAREHOUSE)
var modalConfirm = function(callback){
	//botón que llama el modal
	$("#btn-confirmarpr").on("click", function(){
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
	//Acciones si el usuario confirma
	if(confirm){
		$("#btn-excluirpr").click();
	}
});

// modal para confirmar si quiere remover el registro (PACOTE)
var excPaqueteConfirm = function(callback){
	//botón que llama el modal
	$("#btn-confirmar").on("click", function(){
		$("#ExcModal").modal('show');
	});

	//si quiere remover el registro
	$("#excmodal-btn-si").on("click", function(){
		callback(true);
		$("#ExcModal").modal('hide');
	});
	//si no quiere remover el registro
	$("#excmodal-btn-no").on("click", function(){
		callback(false);
		$("#ExcModal").modal('hide');
	});
};
//función que trabaja con la respuesta del modal (sí o no)
excPaqueteConfirm(function(confirm){
	//Acciones si el usuario confirma
	if(confirm){
		$("#btn-excluir").click();
	}
});

// formato para campos moneda
String.prototype.reverse = function(){
	return this.split('').reverse().join('');
};

function formatoMoneda(campo, evento){
	var tecla = (!evento) ? window.event.keyCode : evento.which;
	var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
	var resultado  = "";
	var mascara = "###.###.###.###";
	mascara = mascara.reverse();
	for (var x=0, y=0; x<mascara.length && y<valor.length;) {
		if (mascara.charAt(x) != '#') {
			resultado += mascara.charAt(x);
			x++;
		} else {
			resultado += valor.charAt(y);
			y++;
			x++;
		}
	}
	campo.value = resultado.reverse();
}

function formatoNro(campo, evento){
	var tecla = (!evento) ? window.event.keyCode : evento.which;
	var valor  =  campo.value.replace(/[^\d]+/gi,'').reverse();
	var resultado  = "";
	var mascara = "#####";
	mascara = mascara.reverse();
	for (var x=0, y=0; x<mascara.length && y<valor.length;) {
		if (mascara.charAt(x) != '#') {
			resultado += mascara.charAt(x);
			x++;
		} else {
			resultado += valor.charAt(y);
			y++;
			x++;
		}
	}
	campo.value = resultado.reverse();
}