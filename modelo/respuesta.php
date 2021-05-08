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

//lista todos los registros, de momento no se usa
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

    //get ultimo Id
    //se usa para obtener el último Id de la bbdd. Este dato se necesita cuando se crea
    //nuevo registro para nombrar imagen con su IDxx de prefijo. El nuevo registro tendrá ultimoId + 1
    public function getUltimoId() {
        try {
            $result = array();

            //obtener ultimo Id creado, si la base de datos está vacía dará 1 aunque realmente
            //no sea ese

            $stm = $this->pdo->prepare("SELECT MAX(ID) FROM respuestas");
            $stm->execute();
            if ($result = $stm->fetch()) {
                return $result[0];
            }
        } catch (Exception $ex) {
            die($e->getMessage());
        }
    }

    //busca un registro por id, de momento no se usa
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

            session_start();
            $_SESSION['info'] = ' Registro Borrado';
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

            session_start();
            $_SESSION['info'] = ' Datos actualizados correctamente';

            return true;
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


        session_start();
        $_SESSION['info'] = ' Datos grabados correctamente';

        return true;
    }

    //busqueda con argumento de una o mas palabras
    public function Buscar() {
        try {
            $busqueda = $_REQUEST['t'];
            $operadorLogico = $_REQUEST['operador_logico'];

            $result = array();
            //separar la cadena en palabras
            $palabras = explode(' ', $busqueda);
            //generar query iterando palabras
            $sql = 'SELECT * FROM respuestas WHERE';
            for ($i = 0; $i < count($palabras); $i++) {
                $sql .= " TITULO like '%" . $palabras[$i] . "%' ";
                if ($i < count($palabras) - 1) {
                    $sql .= $operadorLogico;
                }
            }
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            
            //$numFilas = json_encode(sizeof($result));
            
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function actualizaFichero_vacio() {
        $id = $_REQUEST['id'];
        try {
            $sql = "UPDATE respuestas SET 
                      
                        FICHERO         = ''
                        						
			WHERE ID = ?";

            $this->pdo->prepare($sql)
                    ->execute(
                            array($id));

            session_start();
            $_SESSION['info'] = ' imagen borrada BBDD';
            header('index.php');
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getNumeroRows() {
        try {

            $stm = $this->pdo
                    ->prepare("SELECT COUNT(*) FROM respuestas;");
            $stm->execute();
            $count = $stm->fetch(PDO::FETCH_NUM); // Return array indexed by column number
            return reset($count); // Resets array cursor and returns first value (the count)
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
