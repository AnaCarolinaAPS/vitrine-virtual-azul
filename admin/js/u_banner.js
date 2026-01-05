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
        ], 
		columnDefs: [{
			targets: [ 0 ],
			visible: false,
			searchable: false
		}]
    });
});

// Ajusta los itenes para que se vean en el modal
$(document).ready(function(){
	$(document).on('shown.bs.modal','#AltModal', function (event) {
		var button = $(event.relatedTarget) // objeto que disparó el modal
		var codigo = button.data('codigo')
		var url = button.data('url')
		var img = button.data('img')
		var alternativo = button.data('alternativo')
		var orden = button.data('orden')
		var activo = button.data('activo')
		
		// Actualiza los datos del modal
		var modal = $(this)
		modal.find('.modal-title').text('Banner ' + img);
		modal.find('#codigo').val(codigo);
		document.getElementById("img-alt").src="img/banners/"+img;
        modal.find('#imgurl').val(img);
        modal.find('#orden').val(orden);
        modal.find('#alternativo').val(alternativo);

		if (activo == "1") {
			$('#toggle-activo').bootstrapToggle('on')
		} else {
			$('#toggle-activo').bootstrapToggle('off')
		}
        
        if (url.substring(0, 6) == "promo-") {
            // console.log(url.substring(6));
            modal.find('#linktype-alt').val("promociontype-alt");
            $('.selectpicker').selectpicker('refresh');
            modal.find('#promocion').val(url.substring(6));
            $('.selectpicker').selectpicker('refresh');
            $('.linktype-alt').hide();
            $('#promociontype-alt').show();
        } else if (url.substring(0, 23) == "catalogo.php?categoria=") {
            console.log(url.substring(23));
            modal.find('#linktype-alt').val("categoriatype-alt");
            $('.selectpicker').selectpicker('refresh');
            modal.find('#categoria').val(url.substring(23));
            $('.selectpicker').selectpicker('refresh');
            $('.linktype-alt').hide();
            $('#categoriatype-alt').show();
        } else if (url.substring(0, 17) == "producto.php?cod=") {
            // console.log(url.substring(17));
            modal.find('#linktype-alt').val("productotype-alt");
            $('.selectpicker').selectpicker('refresh');
            modal.find('#producto').val(url.substring(17));
            $('.selectpicker').selectpicker('refresh');
            $('.linktype-alt').hide();
            $('#productotype-alt').show();
        } else {
            // console.log("URL EXTERNA");
            modal.find('#linktype-alt').val("otrotype-alt");
            $('.selectpicker').selectpicker('refresh');
            modal.find('#link').val(url);
            $('.linktype-alt').hide();
            $('#otrotype-alt').show();
        }
	})
});

// modal para confirmar si quiere remover el registro
var modalConfirm = function(callback){
    //botón que llama el modal
    $("#btn-confirmar").on("click", function(){
        $("#ExcModal").modal('show');
    });

    //si quiere remover el registro
    $("#modal-btn-si").on("click", function(){
        callback(true);
        $("#ExcModal").modal('hide');
    });

    //si no quiere remover el registro
    $("#modal-btn-no").on("click", function(){
        callback(false);
        $("#ExcModal").modal('hide');
    });
};
//función que trabaja con la respuesta del modal (sí o no)
modalConfirm(function(confirm){
    if(confirm){
        //Acciones si el usuario confirma
        $("#btn-excluir").click();
    }
});

//función que trabaja con el select para cargar las posibilidades de links
$(document).ready(function() {
    $('#linktype').change(function(){
        $('.linktype').hide();
        $('#' + $(this).val()).show();
    });
    $('#linktype-alt').change(function(){
        $('.linktype-alt').hide();
        $('#' + $(this).val()).show();
    });
});

//función que no permite texto en los campos de nro
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