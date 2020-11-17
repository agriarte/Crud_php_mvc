<!--del body para abajo-->

<div class="d-flex justify-content-between bg-secondary mb-3">
    <div class="p-2"><a class="btn btn-primary " href="?c=respuesta&a=Crud">Agregar</a></div>
    <div class="p-2 bg-warning">

        <form class="form-inline">
            <input class="form-control" placeholder="Search" type="text">
            <button class="btn btn-secondary" type="submit">Search</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="mx-auto col-xs-12 col-sm-6">Nueva pregunta</div>
    <div class="mx-auto col-xs-12 col-sm-6">Buscar</div>
</div>



<div class="fab-container">
     
    <div class="fab fab-icon-holder">
        <p> <i class="fas fa-plus"></i>nueva pregunta</p>
        
    </div>

</div>




<div class="row">
    <div class="col-12 pt-5 text-center ">

        <img class="img-fluid" src="./img/tallergrande729.png" alt="logo">

    </div>
    <div class="col-12 text-center">
        <div class="text-white" >
            <p class="text-responsive">Desarrollo de aplicaciones de escritorio y móvil</p>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 pt-5 text-center ">
            <img class="img-fluid" src="./assets/img/pf250.png" alt="logo Preguntas Frecuentes">
        </div>
        <div class="col-12 text-center">
            <div class="" >
                <p class="text-center">Base de datos que comparte soluciones a averías de impresoras y otros temas relacionados con el servicio técnico de SDC. Contiene ayudas sobre códigos SC, procedimientos de instalación, mensajes de error Remote y un largo etc. A través del menú, podemos buscar y crear nuevo contenido. </p>
            </div>
        </div>
    </div>

    <!--Este SI-->
    <a class="btn btn-primary pull-left" href="?c=respuesta&a=Crud">Agregar</a>
    <form action="index.php" method="get">
        <div class="inline-block">               
            <input name="c" value="respuesta"  type="hidden">             
            <input name="a" value="Buscar"  type="hidden">             
            <input name="t" value="busqueda en titulo" class="pull-right">

            <button class="btn btn-primary pull-right">Buscar</ button>
        </div>
    </form>







</div>
<br><br><br>

<table class="table  table-striped  table-hover" id="tabla">
    <thead>
        <tr>
            <th style="width:120px; background-color: #5DACCD; color:#fff">Titulo</th>
            <th style="width:180px; background-color: #5DACCD; color:#fff">Fecha</th>
            <th style=" background-color: #5DACCD; color:#fff">Comentario</th>
            <th style=" background-color: #5DACCD; color:#fff">Fichero</th>

        </tr>
    </thead>
    <tbody>
        <?php
        error_reporting(E_ERROR | E_WARNING | E_PARSE);

        if (($_REQUEST['a']) == 'Buscar') {
            $accion = 'Buscar';
        } else {
            $accion = 'Listar';
        }

        echo "<br>VISTA<br> Accion = $accion<br>";

        foreach ($this->model->$accion() as $r):
            ?>      
            <tr>
                <td><?php echo $r->TITULO; ?></td>
                <td><?php echo $r->FECHA; ?></td>
                <td><?php echo $r->COMENTARIO; ?></td>
                <td><?php echo $r->FICHERO; ?></td>

                <td>
                    <a  class="btn btn-warning" href="?c=respuesta&a=Crud&id=<?php echo $r->ID; ?>">Editar</a>
                </td>
                <td>
                    <a  class="btn btn-danger" onclick="javascript:return confirm('¿Seguro de eliminar este registro?');" href="?c=respuesta&a=Eliminar&id=<?php echo $r->ID; ?>">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table> 

</body>
<!-- JS, Popper.js, and jQuery -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>




</html>
