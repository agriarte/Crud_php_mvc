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

<div class="container-fluid p-3">
<!-- logo segun tamaño-->
<div class="pt-5">
    <img class="d-none d-sm-none d-md-block mx-auto" src="./assets/img/pf250.png"/>
    <img  class="d-block d-sm-block d-md-none mx-auto" src="./assets/img/pf125.png" />
</div>

<div class="row px-5 pt-2 pb-5">
    <div class="col-xs-auto mx-auto">La base de datos con información de soporte para los técnicos de Sistemas Digitales Catalunya. </div>
</div>



<!--busqueda varias palabras-->  
<div class="row pt-5">
    <div class="col-11 col-sm-6 col-md-5 col-lg-4 mx-auto">
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
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//si form action envía BUSCAR, llamada al método Buscar del modelo con las palabras a buscar 
if (($_REQUEST['a']) == 'Buscar') {
    $accion = 'Buscar';
    foreach ($this->model->$accion() as $r):
        ?>
        <!-- Card -->
        <div class="row pt-5">
            <div class="col-11 col-sm-9 col-md-8 col-lg-9 mx-auto">
                <div class="card">
                    <!-- Card content -->
                    <div class="card-body">

                        <!-- Title -->
                        <h4 class="card-title"><?php echo $r->TITULO; ?></h4>
                        <hr>
                        <!-- Text -->
                        <p class="card-text"><?php echo $r->COMENTARIO; ?></p>

                        <p class="card-text"><?php echo $r->FICHERO; ?></p>

                    </div>

                    <!-- Card footer -->
                    <div class="rounded-bottom mdb-color lighten-3 text-center pt-3">
                        <ul class="list-unstyled list-inline font-small">
                            <li class="list-inline-item pr-2 white-text"><i class="far fa-clock pr-1"></i><?php echo $r->FECHA; ?></li>
                            <li class="list-inline-item pr-2"><a  class="btn btn-warning" href="?c=respuesta&a=Crud&id=<?php echo $r->ID; ?>">Editar</a></li>
                            <li class="list-inline-item pr-2"> <a  class="btn btn-danger" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=respuesta&a=Eliminar&id=<?php echo $r->ID; ?>">Eliminar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card -->

        <?php
    endforeach;
}
?>
</div>
</tbody>
</table> 


</body>



</html>
