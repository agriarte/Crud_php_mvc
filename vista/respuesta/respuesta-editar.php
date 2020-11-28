<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
?>

<h1 class="page-header">
    <?php echo $respuesta->ID != null ? '[Edición de Registro] ID' . $respuesta->ID . ' ' . $respuesta->TITULO : '[Nuevo Registro]'; ?>
</h1>
<!-- Card con form -->

<form id="frm-respuesta" action="?c=respuesta&a=Guardar" method="post" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?php echo $respuesta->ID; ?>" />
    <input type="hidden" name="fecha" value="<?php echo date("Y-m-d H:i:s") ?>" />
    <input type="hidden" name="fichero" value="<?php echo $respuesta->FICHERO; ?>" />
    <div class="row pt-5">
        <div class="col-12 col-sm-12 col-md-10 col-lg-9 mx-auto">
            <div class="card border-secondary ">
                <div class="p-1 bg-secondary text-white">
                    <div class="d-flex justify-content-end text-white-50"><div class="align-self-baseline" ><?php echo 'Id:' . $respuesta->ID . '&nbsp;'; ?><i class="far fa-calendar-alt">&nbsp;</i></i><?php echo $respuesta->FECHA; ?></div></div>

                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" name="titulo" value="<?php echo $respuesta->TITULO; ?>" class="form-control" placeholder="Introduce título" required>
                    </div>
                </div>
                <div class="p-1">
                    <div class="form-group">
                        <label>Comentario</label>
                        <input id="comentarioId" type="text" name="comentario" value="<?php echo $respuesta->COMENTARIO; ?>" class="form-control" placeholder="Introduce comentario" required>
                    </div>

                    <div class="form-group">
                        <input type="hidden" name="MAX_TAM" value="500Kb">
                        <!-- si no tengo imagen -->
                        <?php
                        if ($respuesta->FICHERO == "") {
                            echo '<div>Selecciona una imagen con tamaño inferior a 500Kb></div>';
                        } else {
                            echo '<div>Si quieres cambiar la imagen actual: <b>' . $respuesta->FICHERO . '</b> selecciona una nueva con tamaño inferior a 500Kb></div>';
                        }
                        ?> 
                        <input type="file" id="file-selector" name="fichero">
                        <p id="status"></p>
                        <?php
                        if ($respuesta->FICHERO != "") {
                            echo "<img id='output' src='./upload/" . $respuesta->FICHERO . "' class='img-fluid w-100 h-auto'  alt='[Nueva foto pendiente de carga]'/>";
                        }
                        ?>





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

            <!-- JS, Popper.js, and jQuery -->
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
            <script>
                $(document).ready(function () {

                    $("#frm-respuesta").submit(function () {
                        return $(this).validate();
                    });
                });



                //cambia imagen id=output de un input file id=file-selector
                const status = document.getElementById('status');
                const output = document.getElementById('output');
                if (window.FileList && window.File && window.FileReader) {
                    document.getElementById('file-selector').addEventListener('change', event => {
                        output.src = '';
                        status.textContent = '';
                        const file = event.target.files[0];
                        if (!file.type) {
                            status.textContent = 'Error: The File.type property does not appear to be supported on this browser.';
                            return;
                        }
                        if (!file.type.match('image.*')) {
                            status.textContent = 'Error: The selected file does not appear to be an image.'
                            return;
                        }
                        const reader = new FileReader();
                        reader.addEventListener('load', event => {
                            output.src = event.target.result;
                        });
                        reader.readAsDataURL(file);
                    });
                }


            </script>
            </body>
            </html>


