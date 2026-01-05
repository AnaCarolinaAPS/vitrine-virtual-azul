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
            //     targets: [ 0 ],
            //     visible: false,
            //     searchable: false
            // }]
        });
    });

    //pupolate altmodal
    $(document).ready(function(){
        $(document).on('shown.bs.modal','#AltModal', function (event) {
            var button = $(event.relatedTarget) // objeto que disparó el modal
            var codigo = button.data('codigo')
            var producto = button.data('producto')
            var prodprecio = button.data('prodprecio')
            var prodcuota = button.data('prodcuota')
            var prodvalor = button.data('prodvalor')
            var precio = button.data('precio')
            var cuota = button.data('cuota')
            var valor = button.data('valor')
            
            if (precio == null) {
                precio = prodprecio;
            }
            if (cuota == null) {
                cuota = prodcuota;
            }
            if (valor == null) {
                valor = prodvalor;
            }
            
            // Actualiza los datos del modal
            var modal = $(this)
            modal.find('.modal-title').text('Producto ' + producto);
            modal.find('#codigo').val(codigo);
            modal.find('#producto').val(producto);
            modal.find('#prodprecio').val(formatMoney(prodprecio));
            modal.find('#prodcuota').val(prodcuota);
            modal.find('#prodvalor').val(formatMoney(prodvalor));
            modal.find('#precio').val(formatMoney(precio));
            modal.find('#cuota').val(cuota);
            modal.find('#valor').val(formatMoney(valor));
        })
    });

    function formatMoney(amount, decimalCount = 0, decimal = ",", thousands = ".") {
        try {
          decimalCount = Math.abs(decimalCount);
          decimalCount = isNaN(decimalCount) ? 2 : decimalCount;
      
          const negativeSign = amount < 0 ? "-" : "";
      
          let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
          let j = (i.length > 3) ? i.length % 3 : 0;
      
          return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
        } catch (e) {
          console.log(e)
        }
    };
    
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
                document.getElementById("img-fondo").src = e.target.result;
                // $(input).next().attr('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
        }
        else {
            var img = input.value;
            document.getElementById("img-fondo").src=img;
            // $(input).next().attr('src',img);
        }
    } 
    
    function verificaMostraBotao(){
        $('#fileToUpload').each(function(index){
            if ($('#fileToUpload').eq(index).val() != ""){
                readURL(this);
                $('.hide').show();
            }
        });
    }
    
    $('#fileToUpload').on("change", function(){
      verificaMostraBotao();
    });
    
    $('.hide').on("click", function(){
        $(document.body).append($('<input />', {type: "file" }).change(verificaMostraBotao));
        $(document.body).append($('<img />'));
        $('.hide').hide();
    });

    //función responsable por mostrar la imagen que el usuario eligió en el elemento img
    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById("img-promo").src = e.target.result;
                // $(input).next().attr('src', e.target.result)
            };
            reader.readAsDataURL(input.files[0]);
        }
        else {
            var img = input.value;
            document.getElementById("img-promo").src=img;
            // $(input).next().attr('src',img);
        }
    } 
    
    function verificaMostraBotao2(){
        $('#fileToUpload2').each(function(index){
            if ($('#fileToUpload2').eq(index).val() != ""){
                readURL2(this);
                $('.hide').show();
            }
        });
    }
    
    $('#fileToUpload2').on("change", function(){
      verificaMostraBotao2();
    });
    
    $('.hide').on("click", function(){
        $(document.body).append($('<input />', {type: "file" }).change(verificaMostraBotao2));
        $(document.body).append($('<img />'));
        $('.hide').hide();
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