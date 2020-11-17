<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>

<h1 class="page-header">
    <?php echo $respuesta->ID != null ? $respuesta->TITULO : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
    <li><a href="?c=respuesta">Respuesta</a></li>
    <li class="active"><?php echo $respuesta->ID != null ? $respuesta->TITULO : 'Nuevo Registro'; ?></li>
</ol>

<form id="frm-respuesta" action="?c=respuesta&a=Guardar" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?php echo $respuesta->ID; ?>" />

    <div class="form-group">
        <label>Titulo</label>
        <input type="text" name="titulo" value="<?php echo $respuesta->TITULO; ?>" class="form-control" placeholder="Introduce título" required>
    </div>

    <div class="form-group">
        <label>Fecha</label>
        <input type="text" name="fecha" value="<?php echo $respuesta->FECHA; ?>" class="form-control" placeholder="Introduce fecha" required>
    </div>

    <div class="form-group">
        <label>Comentario</label>
        <input type="text" name="comentario" value="<?php echo $respuesta->COMENTARIO; ?>" class="form-control" placeholder="Introduce comentario" required>
    </div>

    <div class="form-group">
        <label>Fichero</label>
        <input type="text" name="fichero" value="<?php echo $respuesta->FICHERO; ?>" class="form-control" placeholder="Imagen o PDF" required>
    </div>

    <hr />

    <div class="text-right">
        <button class="btn btn-primary">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        $("#frm-respuesta").submit(function () {
            return $(this).validate();
        });
    })
</script>