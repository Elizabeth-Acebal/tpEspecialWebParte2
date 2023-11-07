<?php

    class APIview{
        public function response($data, $status){
            //Avisa que envia obj json
            header("content-Type: application/json");
            //concatena el codigo de respuesta con el mensaje
            header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
            echo json_encode($data);

        }

        //Devuelve el status de respuesta según el código solicitado.

        private function _requestStatus($code){
            $status = array(
            200 => "OK",
            404 => "Not found",
            500 => "Internal Server Error"
            );
            return (isset($status[$code]))? $status[$code] : $status[500];
        }
    }