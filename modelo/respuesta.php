<?php

class respuesta {

    private $pdo;
    public $id;
    public $Titulo;
    public $Fecha;
    public $Comentario;
    public $Fichero;

    public function __CONSTRUCT() {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

//lista todos los registros, no se usa
    public function Listar() {
        try {
            $result = array();

            $stm = $this->pdo->prepare("SELECT * FROM respuestas");
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //busca un registro por id
    public function Obtener($id) {
        try {
            $result = array();
            $stm = $this->pdo
                    ->prepare("SELECT * FROM respuestas WHERE ID = ?");
            $stm->execute(array($id));
            $result = $stm->fetch(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //borra registro por id
    public function Eliminar($id) {
        try {
            $stm = $this->pdo
                    ->prepare("DELETE FROM respuestas WHERE ID = ?");

            $stm->execute(array($id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //recibe array con los campos a actualizar y el id del registro
    public function Actualizar($data) {
        try {
            $sql = "UPDATE respuestas SET 
                        TITULO      	= ?,
			FECHA           = ?, 
			COMENTARIO      = ?,
                        FICHERO         = ?
                        						
			WHERE ID = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->Titulo,
                                $data->Fecha,
                                $data->Comentario,
                                $data->Fichero,
                                $data->id
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //grabar nuevo registro
    public function Registrar(respuesta $data) {

        //data contiene $respuesta desde controladorid

        try {
            $sql = "INSERT INTO respuestas (TITULO,FECHA,COMENTARIO,FICHERO) 
		        VALUES (?, ?, ?, ?)";

            $this->pdo->prepare($sql)
                    ->execute(
                            array(
                                $data->Titulo,
                                $data->Fecha,
                                $data->Comentario,
                                $data->Fichero
                            )
            );
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //busqueda con argumento de una o mas palabras
    public function Buscar() {
        try {
            $busqueda = $_REQUEST['t'];

            $result = array();
            //separar la cadena en palabras
            $palabras = explode(' ', $busqueda);
            //generar query iterando palabras
            $sql = 'SELECT * FROM respuestas WHERE';
            for ($i = 0; $i < count($palabras); $i++) {
                $sql .= " TITULO like '%" . $palabras[$i] . "%' ";
                if ($i < count($palabras) - 1) {
                    $sql .= " or ";
                }
            }
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
