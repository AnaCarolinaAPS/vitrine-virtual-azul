<?php if (isset($mensaje)) {?>
$(document).ready(function(){
    $("#modal-mensaje").modal("show");
});
<?php
    unset($mensaje);
} ?>