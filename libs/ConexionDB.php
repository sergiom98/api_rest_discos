<?php

    class ConexionDB {
        const DNS = "mysql:host=localhost;dbname=ejercicio4;port=3306;charset=UTF8";
        const USUARIO = 'root';
        const PASS = '';
    
        public static function conectar() {
            try {
                $conexion = new PDO(ConexionDB::DNS, ConexionDB::USUARIO, ConexionDB::PASS);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Error en la línea: " . $e->getLine();
                die("Error. " . $e->getMessage());
            }
            return $conexion;
        }

    }