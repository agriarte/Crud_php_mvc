<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Editar/Nueva entrada</title>
        <script src="./assets/js/compressor.js"></script>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <script>


        </script>

    </head>
    <body>

        <?php
        error_reporting(E_ERROR | E_WARNING | E_PARSE);
        ?>
        <script>
            function BorrarImagen()
            {
                console.log("BorrarImagen()")
                //alert de confirmacion
                if (confirm("¿Borrar imagen? Alerta, está operación no se puede deshacer")) {
                    //borrar fisicamente imagen de servidor con ajax

                    // Cogemos de bbdd el nombre de imagen
                    var nombreImagen = "<?php echo $respuesta->FICHERO; ?>";
                    // Función que envía y recibe respuesta con AJAX
                    $.ajax({
                        type: 'POST', // Envío con método POST
                        url: './modelo/borrarFichero.php', // Fichero destino (el PHP que trata los datos)
                        data: {fichero: nombreImagen
                        } // Datos que se envían
                    }).done(function (msg) {  // Función que se ejecuta si todo ha ido bien
                        //borrar imagen de pantalla,cambio de texto, actualiza bbdd con FICHERO="";
                        document.getElementById('file-chosen').value = "(se admite jpg, png o gif)";
                        document.getElementById('output').src = "";
                        //ocultar boton borrar imagen
                        document.getElementById('botonBorrarImagen').style.visibility = 'hidden';
                        //borrar fichero de bbdd
                        var idImg = <?php echo $respuesta->ID; ?>;
                        window.location.href = "?c=respuesta&a=updateArchivo&id=" + idImg;
                        //window.location = "?c=respuesta&a=Crud&id=" + idImg;
                         // Escribimos en el div consola el mensaje devuelto
                        $("#consola").html(msg);
                    }).fail(function (jqXHR, textStatus, errorThrown) { // Función que se ejecuta si algo ha ido mal
                        // Mostramos en consola el mensaje con el error que se ha producido
                        $("#consola").html("The following error occured: " + textStatus + " " + errorThrown);
                    });


                }
            }
        </script>

        <!--empieza navbar -->    
        <nav class="navbar navbar-expand fixed-top  bg-info navbar-dark sticky-top">
            <a class="navbar-brand" href="https://www.tallerdeapps.com/" target="_blank"><img src="./assets/img/logo36.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="https://www.tallerdeapps.com/" target="_blank">El taller de las Apps</a>
                </li>
            </ul>
            <a class="btn btn-outline-dark text-white-50 btn-xs" href="?c=respuesta&a=Crud"><i class="far fa-file-alt"></i></i>  Crear Respuesta</a>
        </nav><!-- fin de navbar-->

        <div class="container-fluid ">
            <!-- Card con letrero modo editar-nuevo -->
            <div class="row pt-5">
                <div class="col-12 col-sm-12 col-md-10 col-lg-9 mx-auto">
                    <div class="card border-secondary ">
                        <div class="p-1 bg-dark text-white-50">
                            <h5 class="page-header">
                                <?php echo $respuesta->ID != null ? '[Editar] ID' . $respuesta->ID . ' ' . $respuesta->TITULO : '[Nuevo Registro]'; ?>
                            </h5>  
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card con form -->
            <div class="row pt-1">
                <div class="col-12 col-sm-12 col-md-10 col-lg-9 mx-auto">
                    <div class="card border-secondary ">
                        <div class="p-1 bg-secondary text-white">
                            <form id="frm-respuesta" action="?c=respuesta&a=Guardar" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $respuesta->ID; ?>" />
                                <input type="hidden" name="fecha" value="<?php echo date("Y-m-d H:i:s") ?>" />
                                <input type="hidden" name="fichero" value="<?php echo $respuesta->FICHERO; ?>" />

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
                        </div>
                        <div class="p-1 bg-secondary text-white">
                            <label>Imagen (opcional)</label>
                            <div class="form-group">
                                <?php
                                if ($respuesta->FICHERO == "") {
                                    //al entrar a la vista editar caso 1 no hay foto
                                    //se muestra un mensaje de texto para entrar una foto, botonCargarImagen visible, botonBorrarImagen oculto, imagen en blanco
                                    echo "<div id='msjCambiarImg'>**Puedes subir una imagen</div>";
                                    //<!-- actual upload which is hidden -->
                                    echo"<input type='file' id='actual-btn' hidden name='nombreFichero'/>";
                                    //<!-- our custom upload button -->
                                    echo "<label class='btn btn-sm btn-dark m-1' for='actual-btn'><i class='fas fa-camera'></i>&nbsp;Buscar imagen</label>";
                                    //<!-- name of file chosen -->
                                    echo "<span class='m-1' id='file-chosen'>(se admite jpg, png o gif)</span>";
                                    // <!-- oculto, sirve para copiar blob -->
                                    echo "<input type='hidden' id='imagen-temp' name='imagen-copia'>";
                                    // hueco para imagen en blanco
                                    echo "<img id='output' class='img-fluid w-100 h-auto'/>";
                                } else {

                                    //caso 2, hay imagen en registro
                                    //mostrar otro texto, botonBorrarImagen visible, botonCargarImagen oculto, mostrar imagen,
                                    //mensaje cambiar imagen
                                    echo "<div id='msjCambiarImg'>Si quieres cambiar la imagen actual: <b>" . $respuesta->FICHERO . "</b> selecciona una nueva</div>";
                                    //conjunto inputs file html
                                    //<!-- actual upload which is hidden -->
                                    echo"<input type='file' id='actual-btn' hidden name='nombreFichero'/>";
                                    //<!-- our custom upload button -->
                                    echo "<label class='btn btn-sm btn-dark m-1' for='actual-btn'><i class='fas fa-camera'></i>&nbsp;Buscar imagen</label>";
                                    //<!-- name of file chosen -->
                                    echo "<span class='m-1' id='file-chosen' name='file-chosen'>$respuesta->FICHERO</span>";
                                    // <!-- oculto, sirve para copiar blob -->
                                    echo "<input type='hidden' id='imagen-temp' name='imagen-copia'>";
                                    //boton borrar imagen
                                    echo "<input id='botonBorrarImagen' type='button' class='btn btn-sm btn-dark m-1 text-white-50' value='Borrar imagen actual' onclick='BorrarImagen();'>";
                                    //imagen 
                                    echo "<img id='output' src='./upload/" . $respuesta->FICHERO . "' class='img-fluid w-100 h-auto'/>";
                                }
                                ?>
                            </div>
                            <div id="status"></div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <a href="./index.php" id="cancel" name="cancel" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
                                <button class="mx-2 align-self-baseline btn btn-primary"><i class="fas fa-file-upload"></i> Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /card -->
            <script>
                //poner nombre imagen en file-chosen
                const actualBtn = document.getElementById('actual-btn');
                const fileChosen = document.getElementById('file-chosen');
                actualBtn.addEventListener('change', function () {
                    fileChosen.textContent = this.files[0].name
                })
            </script>
        </form>
        <div class="row pt-1">
            <div class="col-12 col-sm-12 col-md-10 col-lg-9 mx-auto">
                <div class="alert-danger d-flex justify-content-center" id="consola">
                </div>
            </div>

        </div><!-- /div container -->


        <script>

            //bloque que escucha entrada de archivo en input.
            //si se produce lo carga en memoria y lo muestra redimensionado y comprimido
            //EVENTO change en Jquery: $('#image').change(function (e) {
            var fotoId = document.getElementById('actual-btn');
            fotoId.addEventListener('change', (e) => {

                console.log("evento input file");

                var img = e.target.files[0];
                if (!(/\.(jpg|png|gif)$/i).test(img.name)) {
                    alert('El archivo a adjuntar no es una imagen jpg, png o gif');
                } else {

                    new Compressor(img, {
                        quality: 0.5,
                        maxWidth: 1200,
                        maxHeight: 1200,
                        success(result) {
                            var reader = new FileReader();
                            reader.readAsDataURL(result);
                            reader.onloadend = function () {
                                var base64data = reader.result;
                                //en Juery: $('#image-temp').val(base64data);
                                document.getElementById('imagen-temp').value = base64data;

                                const blobUrl = URL.createObjectURL(result) // result is the Blob object
                                document.getElementById('output').src = blobUrl // image is the image element from the DOM

                                console.log(result);
                                console.log(reader);
                            }
                        },
                    });
                }
            });
        </script>
</body>
</html>


