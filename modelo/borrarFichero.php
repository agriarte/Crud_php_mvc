<?php

//si existe fichero en uploads lo borra

$nombre = $_POST['fichero'];


if (file_exists('../upload/'.$nombre)) {
    
    unlink('../upload/'.$nombre);
    echo "<script>location.href = 'index.php?c=respuesta&a=updateArchivo&i=69';</script>";
    echo "<script>location.href = 'index.php?c=respuesta&a=Crud&id=69';</script>";
    
    echo 'Imagen borrada del servidor.';
} else {
    echo getcwd() . "\n";
   //echo "Error. No existe:  $nombre";
}

?>
