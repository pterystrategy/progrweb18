<?php

class Banco {

    private static $dbNome = 'roteiro18';
    private static $dbHost = 'localhost';
    private static $dbUsuario = 'root';
    private static $dbSenha = 'toor';
    private static $conexao = null;

    private function __construct() {

    }

    public static function conectar() {
        if (null == self::$conexao) {
            try {


                self::$conexao = new PDO("mysql:host=" . self::$dbHost . "; dbname=" . self::$dbNome . "; charset=utf8", self::$dbUsuario, self::$dbSenha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            } catch (PDOException $exception) {
                die($exception->getMessage());
            }
        }
        return self::$conexao;
    }

    public static function desconectar() {
        self::$conexao = null;
    }

}

?>
