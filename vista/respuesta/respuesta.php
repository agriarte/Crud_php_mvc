<!--del body para abajo-->

<div class="container-fluid">

    <div class="d-flex flex-column">
        <div class="mx-auto">
            <img class="img-fluid" src="./assets/img/pf250.png" alt="logo Preguntas Frecuentes">
        </div>

        <div class="mx-auto">
            <!--busqueda varias palabras-->  
            <form action="index.php" method="get">
                <div class="inline-block">               
                    <input name="c" value="respuesta"  type="hidden">             
                    <input name="a" value="Buscar"  type="hidden">             
                    <input name="t" value="busqueda en titulo" class="pull-right">

                    <button class="btn btn-primary">Buscar</ button>
                </div>
            </form>
        </div>
        <div class="mx-auto">
            <p ">Base de datos que comparte soluciones a averías de impresoras y otros temas relacionados con el servicio técnico de SDC. Contiene ayudas sobre códigos SC, procedimientos de instalación, mensajes de error Remote y un largo etc. A través del menú, podemos buscar y crear nuevo contenido. </p>
        </div>


        <div class="mx-auto">
            <!--agregar-->      
            <a class="btn btn-primary pull-left" href="?c=respuesta&a=Crud">Agregar</a>
        </div>

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



</html>
