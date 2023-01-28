<?php

    class DiscosController {

        function __construct() {
            $this->model = new DiscosModel();
        }

        function index() {
            $discos = $this->model->getDiscos();
            echo json_encode($discos);
        }

        function nuevo() {
            $postdata = file_get_contents("php://input");
            //var_dump($postdata);
            $request = json_decode($postdata, true);
            // var_dump($request);
            if (count($request) > 0) {
                $disco = new Disco(
                    0,
                    $request["nombre"],
                    $request["duracion"],
                    $request["casa_discografica"],
                    $request["fecha_edicion"],
                    $request["imagen"],
                    ''
                );
                $ok = $this->model->createDisco($disco);
                if ($ok) {
                    $res = [
                        "status" => 201,
                        "ok" => true,
                        "message" => "Disco creado."
                    ];
                } else {
                    $res = [
                        "status" => 500,
                        "ok" => false,
                        "message" => "Se ha producido un error."
                    ];
                }
                http_response_code($res["status"]);
                echo json_encode($res);
            } else {
                $res = [
                    "status" => 400,
                    "ok" => false,
                    "message" => "No se han recibido los datos."
                ];
                http_response_code($res["status"]);
                echo json_encode($res);
            }  
        }

        function updateDisco($params) {
            if (isset($params["id"]) && $params["id"] > 0) {
                $postdata = file_get_contents("php://input");
                //var_dump($postdata);
                $request = json_decode($postdata, true);
                // var_dump($request);                        

                if (count($request) >= 0) {
                    $disco = $this->model->getDisco($params["id"]);
                    $imagen = $disco->imagen;
                    $disco = new Disco(
                        $params["id"],
                        $request["nombre"],
                        $request["duracion"],
                        $request["casa_discografica"],
                        $request["fecha_edicion"],
                        $imagen
                    );
                    $ok = $this->model->updateDisco($disco);
                    if ($ok) {
                        $res = [
                            "status" => 200,
                            "ok" => true,
                            "message" => "Disco actualizado."
                        ];
                    } else {
                        $res = [
                            "status" => 500,
                            "ok" => false,
                            "message" => "Se ha producido un error."
                        ];
                    }
                    http_response_code($res["status"]);
                    echo json_encode($res);
                } else {
                    $res = [
                        "status" => 400,
                        "ok" => false,
                        "message" => "No se han recibido los datos."
                    ];
                    http_response_code($res["status"]);
                    echo json_encode($res);
                }
            } else {
                $res = [
                    "status" => 400,
                    "ok" => false,
                    "message" => "Falta id del disco."
                ];
                http_response_code($res["status"]);
                echo json_encode($res);
            }
        }

        function getDiscoById($params) {
            //var_dump($params);
            if (isset($params["id"]) && $params["id"] > 0) {
                $disco = $this->model->getDisco($params["id"]);
                // var_dump($disco);
                if ($disco) {
                    $res = [
                        "data" => $disco,
                        "status" => 200,
                        "ok" => true,
                        "message" => "Disco encontrado."
                    ];
                    http_response_code($res["status"]);
                    echo json_encode($res);
                } else {
                    $res = [
                        "status" => 404,
                        "ok" => false,
                        "message" => "Disco no encontrado."
                    ];
                    http_response_code($res["status"]);
                    echo json_encode($res);
                }
            } else {
                $res = [
                    "status" => 400,
                    "ok" => false,
                    "message" => "Falta id del disco."
                ];
                http_response_code($res["status"]);
                echo json_encode($res);
            }
        }

        function deleteDisco($params) {
            $ok = $this->model->deleteDisco($params["id"]);
            if ($ok) {
                $res = [
                    "status" => 200,
                    "ok" => true,
                    "message" => "Disco eliminado."
                ];
                http_response_code($res["status"]);
                echo json_encode($res);
            } else {
                $res = [
                    "status" => 400,
                    "ok" => true,
                    "message" => "El disco no se ha podido eliminar. Posiblemente tenga datos relacionados."
                ];
                http_response_code($res["status"]);
                echo json_encode($res);
            }
        }
    }