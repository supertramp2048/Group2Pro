<?php
    header('Access-Control-Allow-Origin: http://localhost:5173');
    //header('Access-Control-Allow-Origin: http://localhost:5174');//test
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    class ErrorHandler {
        public static function handleException($exception) : void {// nếu : void để trống thì cũng như nhau
            http_response_code(500);
            echo json_encode([
                "code" => $exception->getCode(),
                "message" => $exception->getMessage(),
                "file" => $exception->getFile(),
                "line" => $exception->getLine(),
            ]);
        }
}
?>