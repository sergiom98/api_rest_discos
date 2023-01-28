<?php
    class DiscosModel {

        function __construct() {
            $this->db = ConexionDB::conectar();
        }

        function getDiscos() {
            try {
                $discos = [];
                $sql = "SELECT * FROM discos";
                $result = $this->db->query($sql);
                foreach ($result as $value) {
                    $discos[] = $this->convertFromAssoc($value);
                }
                return $discos;
            } catch (PDOException $e) {
                echo "Error. " . $e->getMessage();
                exit("Error. " . $e->getMessage());
            }
        }

        function getDisco($id) {
            try {
                $sql = "SELECT * FROM discos WHERE id_disco = $id";
                $result = $this->db->query($sql);
                $disco = $result->fetchAll();
                if (count($disco) > 0) {
                    return $this->convertFromAssoc($disco[0]);
                } else {
                    return false;
                }

            } catch (PDOException $e) {
                echo "Error. " . $e->getMessage();
                exit("Error. " . $e->getMessage());
            }
        }

        function updateDisco($disco) {
            $ok = false;
            try {
                $sql = "UPDATE discos 
                    SET nombre = '$disco->nombre',
                        duracion = '$disco->duracion',
                        casa_discografica = '$disco->casa_discografica',
                        fecha_edicion = $disco->fecha_edicion,
                        imagen = $disco->imagen,
                        WHERE id_disco = $disco->id_disco";
                $resultado = $this->db->exec($sql);
                if ($resultado) {
                    $ok = true;
                } else {
                    $ok = false;
                }
        
            } catch (PDOException $e) {
                $ok = false;
            }
            return $ok;
        }
    
        function createDisco($disco) {
            $ok = false;
            try {
                $sql = "INSERT INTO discos (nombre, duracion, casa_discografica, 
                fecha_edicion, imagen) 
                VALUES (
                    '$disco->nombre',
                    '$disco->duracion',
                    '$disco->casa_discografica',
                    '$disco->fecha_edicion',
                    '$disco->imagen')";
                // var_dump($sql);
                $resultado = $this->db->exec($sql);
                if ($resultado) {
                    $ok = true;
                } else {
                    $ok = false;
                }
        
            } catch (PDOException $e)  {
                $ok = false;
            }
            return $ok;
        }
    
        function deleteDisco($id) {
            try {
                $sql = 'DELETE FROM discos WHERE id_disco=' . $id;
                $resultado = $this->db->exec($sql);
                return $resultado;
            } catch(Exception $e) {
                return false;
                //throw new Exception("No se ha podido conectar con la base de datos", 1);
            }
            return false;
        }

        private function convertFromAssoc($disco) {
            return new Disco(
                $disco['id_disco'],
                $disco['nombre'],
                $disco['duracion'],
                $disco['casa_discografica'],
                $disco['fecha_edicion'],
                $disco['imagen'],
            );
        }
    }