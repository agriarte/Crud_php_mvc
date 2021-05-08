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
                    document.getElementById('output').src = "";
                    //ocultar boton borrar imagen
                    //document.getElementById('botonBorrarImagen').style.visibility = 'hidden';
                    document.getElementById('cambioImagen').value = "";
                    document.getElementById('file-chosen').textContent = "(no hay imagen)";
                    document.getElementById('msjCambiarImg').textContent = "Se admiten jpg, gif, png o directamente de la cámara";
                }
            }

            //evitar submit form al pulsar enter
            window.addEventListener('keydown', function (e) {
                if (e.keyIdentifier == 'U+000A' || e.keyIdentifier == 'Enter' || e.keyCode == 13) {
                    if (e.target.nodeName == 'INPUT' && e.target.type == 'text') {
                        e.preventDefault();
                        return false;
                    }
                }
            }, true);
        </script>

        <!--empieza navbar -->    
        <nav class="navbar navbar-expand fixed-top  bg-info navbar-dark sticky-top">
            <a class="navbar-brand" href="https://www.tallerdeapps.com/" target="_blank"><img src="./assets/img/logoTaller36.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <!-- vacio de momento -->
                </li>
            </ul>
            <a class="btn btn-outline-dark text-white-50 btn-xs" href="?c=respuesta&a=Crud"><i class="far fa-file-alt"></i></i>  Nuevo Tema</a>
        </nav><!-- fin de navbar-->

        <div class="container-fluid ">
            <!-- Card con letrero modo editar-nuevo -->
            <div class="row pt-5">
                <div class="col-12 col-sm-12 col-md-10 col-lg-9 mx-auto">
                    <div class="card border-secondary ">
                        <div class="p-1 bg-dark text-white-50">
                            <h5 class="page-header">
                                <?php echo $respuesta->ID != null ? '[modo Editar] ID' . $respuesta->ID . ' ' . $respuesta->TITULO : '[Nuevo Registro]'; ?>
                            </h5>  
                        </div>
                    </div>
                </div>
            </div>
            <!-- Card con form -->
            <div class="row pt-1">
                <div class="col-12 col-sm-12 col-md-10 col-lg-9 mx-auto">
                    <div class="card border-secondary ">
                        <form id="frm-respuesta" action="?c=respuesta&a=Guardar" method="post" enctype="multipart/form-data">
                            <div class="p-1 bg-secondary text-white">

                                <input type="hidden" name="id" value="<?php echo $respuesta->ID; ?>" />
                                <input type="hidden" name="fecha" value="<?php echo date("Y-m-d H:i:s") ?>" />
                                <input type="hidden" name="ficherodb" value="<?php echo $respuesta->FICHERO; ?>" />
                                <input type="hidden" id="cambioImagen" name="cambio" value="igual"/>

                                <div class="d-flex justify-content-end text-white-50"><div class="align-self-baseline" ><?php echo 'Id:' . $respuesta->ID . '&nbsp;'; ?><i class="far fa-calendar-alt">&nbsp;</i></i><?php echo $respuesta->FECHA; ?></div></div>

                                <div class="form-group">
                                    <label>Título</label>
                                    <input type="text" name="titulo" value="<?php echo $respuesta->TITULO; ?>" class="form-control p-1" placeholder="Introduce título" required>
                                </div>
                            </div>
                            <div class="p-1">
                                <div class="form-group">
                                    <label>Comentario</label>
                                    <!-- <input id="comentarioId" type="text" name="comentario" rows="7" value="<?php echo $respuesta->COMENTARIO; ?>" class="form-control" placeholder="Introduce comentario" required> -->
                                    <textarea class="form-control p-1" id="comentarioId" name="comentario" placeholder="Introduce comentario" rows="7" required><?php echo $respuesta->COMENTARIO; ?></textarea>
                                </div>

                            </div>
                            <div class="p-1 bg-secondary text-white">
                                <label>Imagen (opcional)</label>
                                <div class="form-group">
                                    <div id="divBotonera"></div>
                                    <script>
                                        /* valor en bbdd de fichero.  */
                                        let ficheroddbb = <?= json_encode($respuesta->FICHERO) ?>;
                                        if (ficheroddbb === '' || ficheroddbb === null) {
                                            document.getElementById("divBotonera").innerHTML =
                                                    '<div id="msjCambiarImg">Se admiten jpg, gif, png o directamente de la cámara</div>' +
                                                    '<input type="file" id="actual-btn" hidden name="nombreFichero"/>' +
                                                    '<label class="btn btn-sm btn-dark" for="actual-btn"><i class="fas fa-camera"></i>&nbsp;Buscar imagen</label>' +
                                                    '<span class="m-1" id="file-chosen" name="ficheroseleccionado">(no hay imagen)</span>' +
                                                    '<input type="hidden" id="imagen-temp" name="imagen-copia">' +
                                                    '<input id="botonBorrarImagen" type="button" class="btn btn-sm btn-dark" value="Borrar imagen actual" onclick="BorrarImagen();">' +
                                                    '<img id="output" src="" class="img-fluid w-100 h-auto"/>';
                                        } else {
                                            let texto = "Si quieres cambiar la imagen actual: <b>" + ficheroddbb + "</b> selecciona una nueva";
                                            document.getElementById("divBotonera").innerHTML =
                                                    '<div id="msjCambiarImg">' + texto + '</div>' +
                                                    '<input type="file" id="actual-btn" hidden name="nombreFichero"/>' +
                                                    '<label class="btn btn-sm btn-dark " for="actual-btn"><i class="fas fa-camera"></i>&nbsp;Buscar imagen</label>' +
                                                    '<span class="m-1" id="file-chosen" name="ficheroseleccionado">' + ficheroddbb + '</span>' +
                                                    '<input type="hidden" id="imagen-temp" name="imagen-copia">' +
                                                    '<input id="botonBorrarImagen" type="button" class="btn btn-sm btn-dark " value="Borrar imagen actual" onclick="BorrarImagen();">' +
                                                    '<img id="output" src="./upload/' + ficheroddbb + '" class="img-fluid w-100 h-auto"/>';

                                        }

                                    </script>

                                </div>
                                <div id="status"></div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-end">
                                    <a href="./index.php" id="cancel" name="cancel" class="btn btn-danger"><i class="fas fa-ban"></i> Cancelar</a>
                                    <button class="mx-2 align-self-baseline btn btn-primary"><i class="fas fa-file-upload"></i> Guardar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- /card -->

        </form>
        <div class="row pt-1">
            <div class="col-12 col-sm-12 col-md-10 col-lg-9 mx-auto">
                <div class="alert-danger d-flex justify-content-center" id="consola">
                </div>
            </div>

        </div><!-- /div container -->



        <script>
            //poner nombre imagen en file-chosen al Guardar
            //tambien meto en el input hidden 'cambioImagen' el valor del input para llevarlo mediante $_POST
            //a respuesta.controlador. Pueden haber 3 casos:
            //1- si vale "igual" no hacer nada. N
            //2- si vale "" se ha pulsado Borrar Imagen
            //   desde respuesta.controlador se borrará la imagen almacenada en $respuesta->FICHERO
            //3- si vale "imagenXX.jpg" si existe una imagen en  $respuesta->FICHERO borrarla y a continuacion cargar nueva 
            //   y guardar datos en bbdd. 
            const actualBtn = document.getElementById('actual-btn');
            const fileChosen = document.getElementById('file-chosen');
            const cImagen = document.getElementById('cambioImagen');

            actualBtn.addEventListener('change', function () {
                //mostrar nombre imagen
                let nuevaImagen = this.files[0].name;
                fileChosen.textContent = nuevaImagen;

                //esta var me la llevo al controlador para saber si ha cambiado la imagen['cambio']
                if (nuevaImagen) {
                    cImagen.value = nuevaImagen;
                }

            })
        </script>


        <script>

            //bloque que escucha entrada de archivo en input.
            //si hay nueva imagen la carga en memoria y lo muestra redimensionado y comprimido
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
                            }
                        },
                    });
                }
            });
        </script>
</body>
</html>


