<!--del body para abajo-->
<?php
//para evitar warnings, session_start debe iniciarse antes que ningún DIV
//mas adelante usaremos la variable de sesion Info para recibir texto para el toast
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
?>
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

<!-- principal -->
<div class="container-fluid p-1">
    <!-- logo segun tamaño-->
    <div class="pt-5">
        <img class="d-none d-sm-none d-md-block mx-auto" src="./assets/img/pf250.png"/>
        <img  class="d-block d-sm-block d-md-none mx-auto" src="./assets/img/pf125.png" />
    </div>

    <div class="row pt-1">
        <div class="col-12 col-sm-12 col-md-10 col-lg-10 mx-auto">
            <h5 class="d-flex justify-content-center text-justify">La base de datos con información de soporte para los técnicos de Sistemas Digitales Ricoh</h5>
        </div>
    </div>

    <!--busqueda varias palabras-->
    <form id="formBuscar" action="index.php">
        <div class="row pt-5 pb-2">

            <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-4 mx-auto">
                <div class="small">Total Registros:&nbsp;<?php echo $this->model->getNumeroRows() ?></div>
                <div class="input-group">
                    <input name="c" value="respuesta"  type="hidden">             
                    <input name="a" value="Buscar"  type="hidden">         
                    <input name="t" type="text" class="form-control" placeholder="ej: error remote, J052 MP C407,...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>  
                    </div>
                </div>
            </div>
        </div>
        <div class="row pb-3">
            <div class="col-12 d-flex justify-content-center text-justify">
                <label class="palabrasPq">Todas las palabras
                    <input type="radio" name="operador_logico" value=" and ">
                    <span class="checkmark"></span>
                </label>
                <label class="palabrasPq">&nbsp;&nbsp;&nbsp;Cualquier palabra
                    <input type="radio" checked="checked" name="operador_logico" value=" or ">
                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
    </form>

    <div class="row pb-2">
        <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-4 mx-auto">

            <div id="ayudaCard" class="card">
                <div class="card-header p-0">
                    <div class="bg-dark text-white-50 d-flex">
                        <div class="mx-auto"><i class="far fa-question-circle"></i>&nbsp;Ayuda</div>
                        <div>
                            <button data-dismiss="alert" data-target="#ayudaCard" type="button" class="close text-white-50" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-1"> Para listar todas las entradas pulsa directamente sobre la lupa.<br>
                        Usar el nombre original de los equipos respetando espacios. Ejemplo: IM C2000<br></div> 
                </div>
            </div>
        </div>
        <br>

        <div id="snackbar"></div>

        <?php
// si llega info lanzamos snackbar
//
        if (isset($_SESSION['info'])) {
            ?>
            <script type="text/javascript">
                let info = '<?php echo htmlspecialchars($_SESSION['info']); ?>';
                document.getElementById("snackbar").innerHTML = '<i class=\"fas fa-clipboard-check\"></i><div>&nbsp;' + info + '</div>';

                function mySnackBar() {
                    var x = document.getElementById("snackbar");
                    x.className = "show";
                    setTimeout(function () {
                        x.className = x.className.replace("show", "");
                    }, 6000);
                }


                mySnackBar();
            </script>

            <?php
            unset($_SESSION['info']);
        }
        ?>
        <script>
            function scrollToTargetAdjusted(el) {
                var element = document.getElementById(el);
                var headerOffset = 100;
                var elementPosition = element.getBoundingClientRect().top;
                var offsetPosition = elementPosition - headerOffset;

                window.scrollTo({
                    top: offsetPosition,
                    behavior: "smooth"
                });
            }
        </script>

        <div id="resultados"></div>


        <?php
//si form action envía BUSCAR, llamada al método Buscar del modelo con las palabras a buscar 
        if (($_REQUEST['a']) == 'Buscar') {
            $accion = 'Buscar';

            $unaVez = 0;
            $result = $this->model->$accion();

            if (sizeof($result) == 0) {
                ?>
                <div id="resultados" class="row pb-2">
                    <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-4 mx-auto">
                        <div class="alert alert-warning d-flex justify-content-center align-items-baseline text-justify " role="alert">
                            <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;Sin resultados
                        </div>
                    </div>
                </div>

                <?php
            } else {

                foreach ($result as $r):
                    if ($unaVez == 0) {
                        $unaVez = 1;
                        $numFilas = json_encode(sizeof($result));
                        echo '<div id="resultados" class="col-12 col-sm-12 col-md-10 col-lg-9 mx-auto px-2 pb-0 small">Encontrados ' . $numFilas . ' resultados</div>';
                    }
                    ?>
                    <!-- Card -->
                    <div class="row m-0 pt-0">
                        <div class="col-12 col-sm-12 col-md-10 col-lg-9 mx-auto p-1">
                            <div class="card border-secondary ">
                                <div class="bg-secondary text-white">
                                    <div class="d-flex justify-content-end text-white-50"><div class="align-self-baseline" ><?php echo 'Id:' . $r->ID . '&nbsp;'; ?><i class="far fa-calendar-alt">&nbsp;</i></i><?php echo $r->FECHA; ?></div></div>
                                    <h5 class="card-title mx-1"><?php echo $r->TITULO; ?></h5>
                                </div>
                                <div>
                                    <pre id="miPreformatText" name="comentario" ><?php echo $r->COMENTARIO; ?></pre>
                                </div>
                                <div class="bg-secondary d-flex justify-content-end text-white-50">
                                    <p class="card-text "><?php echo $r->FICHERO; ?></p>
                                </div>
                                <?php
                                if ($r->FICHERO != "") {
                                    echo "<img src='./upload/" . $r->FICHERO . "' class='img-fluid w-100 h-auto'  />";
                                }
                                ?>
                            </div>
                            <div class="card-footer bg-light pt-1">
                                <div class="d-flex justify-content-end">
                                    <a  class="btn btn-warning  align-self-baseline" href="?c=respuesta&a=Crud&id=<?php echo $r->ID; ?>"><i class="far fa-edit"></i> Editar</a>
                                    <a class="mx-2 btn btn-danger align-self-baseline" href="#" data-href="?c=respuesta&a=Eliminar&id=<?php echo $r->ID; ?>" data-toggle="modal" data-target="#confirm-delete"><span class="far fa-trash-alt"></span> Borrar</a>
                                </div>
                            </div>
                        </div>
                    </div>         
                    <?php
                endforeach;
            }
            echo '<script>scrollToTargetAdjusted("resultados");</script>';
        }
        ?> 
    </div> <!-- /div resultados  -->
</div> <!-- /div container  -->

<!-- Modal -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title" id="myModalLabel">Eliminar Registro</h4>
            </div>

            <div class="modal-body">
                ¿Desea eliminar este registro?
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn-ok">Confirmar</a>
            </div>
        </div>
    </div>
</div>
<!-- script Modal -->

</div>
<script>
    $('#confirm-delete').on('show.bs.modal', function (e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        //no hace falta $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
</script>



<!-- JS, Popper.js, and jQuery -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


</body>
</html>
