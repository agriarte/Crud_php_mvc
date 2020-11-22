<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>

<h1 class="page-header">
    <?php echo $respuesta->ID != null ? 'Edición de Registro: ' . $respuesta->TITULO : 'Nuevo Registro'; ?>
</h1>

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


<!-- Card con form -->
<form id="frm-respuesta" action="?c=respuesta&a=Guardar" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?php echo $respuesta->ID; ?>" />
    <div class="row pt-5">
        <div class="col-12 col-sm-12 col-md-10 col-lg-9 mx-auto">
            <div class="card border-secondary ">
                <div class="p-1 bg-secondary text-white">
                    <div class="d-flex justify-content-end text-white-50"><div class="align-self-baseline" ><?php echo 'Id:' . $respuesta->ID . '&nbsp;'; ?><i class="far fa-calendar-alt">&nbsp;</i></i><?php echo $respuesta->FECHA; ?></div></div>
                    <div class="form-group">
                        <label>Titulo</label>
                        <input type="text" name="titulo" value="<?php echo $respuesta->TITULO; ?>" class="form-control" placeholder="Introduce título" required>
                    </div>
                </div>
                <div class="p-1">
                    <div class="form-group">
                        <label>Comentario</label>
                        <input type="text" name="comentario" value="<?php echo $respuesta->COMENTARIO; ?>" class="form-control" placeholder="Introduce comentario" required>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="./index.php" id="cancel" name="cancel" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
                        <button class="mx-2 align-self-baseline btn btn-primary"><i class="fas fa-file-upload"></i> Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        $("#frm-respuesta").submit(function () {
            return $(this).validate();
        });
    })
</script>