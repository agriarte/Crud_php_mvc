<!--del body para abajo-->
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

<div class="p-3">
    <!-- logo segun tamaño-->
    <div class="pt-5">
        <img class="d-none d-sm-none d-md-block mx-auto" src="./assets/img/pf250.png"/>
        <img  class="d-block d-sm-block d-md-none mx-auto" src="./assets/img/pf125.png" />
    </div>

    <div class="row pt-1">
        <div class="col-12 col-sm-12 col-md-10 col-lg-9 mx-auto">
            <h5 class="d-flex justify-content-center text-justify">La base de datos con información de soporte para los técnicos de Sistemas Digitales Catalunya</h5>
        </div>
    </div>

    <!--busqueda varias palabras-->  
    <div class="row pt-5">
        <div class="col-12 col-sm-6 col-md-5 col-lg-4 mx-auto">
            <form action="index.php" method="get">
                <div class="input-group">
                    <input name="c" value="respuesta"  type="hidden">             
                    <input name="a" value="Buscar"  type="hidden">         
                    <input name="t" type="text" class="form-control" placeholder="ej: error remote, J052 MPC407,...">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>  
                    </div>
                </div>
            </form>
        </div>
    </div>


    <?php
    session_start();
    //$_SESSION['info']='demo text';
    //print_r($_SESSION['info']);
    if (isset($_SESSION['info'])) {
        ?>

        <div class="row">
            <div id="mensajeAlert" class="alert alert-dismissible fade show alert-success col-xs-auto mx-auto" style="margin-top:20px;">
                <i class="fas fa-clipboard-check"></i><?php echo $_SESSION['info']; ?>
            </div>
        </div>

        <script type="text/javascript">
            setTimeout(function () {

                // Closing the alert 
                $('#mensajeAlert').alert('close');
            }, 5000);
        </script> 




        <?php
        unset($_SESSION['info']);
    }
    ?>
    <?php
    error_reporting(E_ERROR | E_WARNING | E_PARSE);

//si form action envía BUSCAR, llamada al método Buscar del modelo con las palabras a buscar 
    if (($_REQUEST['a']) == 'Buscar') {
        $accion = 'Buscar';
        foreach ($this->model->$accion() as $r):
            ?>
            <!-- Card -->
            <div class="row pt-5">
                <div class="col-12 col-sm-12 col-md-10 col-lg-9 mx-auto">
                    <div class="card border-secondary ">
                        <div class="p-1 bg-secondary text-white">
                            <div class="d-flex justify-content-end text-white-50"><div class="align-self-baseline" ><?php echo 'Id:' . $r->ID . '&nbsp;'; ?><i class="far fa-calendar-alt">&nbsp;</i></i><?php echo $r->FECHA; ?></div></div>
                            <h5 class="card-title"><?php echo $r->TITULO; ?></h5>
                        </div>
                        <div class="p-1">
                            <p class="card-text"><?php echo $r->COMENTARIO; ?></p>
                            <p class="card-text"><?php echo $r->FICHERO; ?></p>

                            <?php
                            if ($r->FICHERO != "") {
                                echo "<img src='./upload/" . $r->FICHERO . "' class='img-fluid w-100 h-auto'  />";
                            }
                            ?>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <a  class="mx-2 btn btn-danger align-self-baseline" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=respuesta&a=Eliminar&id=<?php echo $r->ID; ?>"><i class="far fa-trash-alt"></i> Borrar</a>
                                <a  class="btn btn-warning  align-self-baseline" href="?c=respuesta&a=Crud&id=<?php echo $r->ID; ?>"><i class="far fa-edit"></i> Editar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        endforeach;
    }
    ?>
</div>
</tbody>

<!-- JS, Popper.js, and jQuery -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>
