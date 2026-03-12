<?php

class Database {

    private static $connection;

    public static function getConnection() {

        if (!self::$connection) {

            try {

                self::$connection = new PDO(
                    "mysql:host=localhost;dbname=fleet_saas;charset=utf8",
                    "root",
                    "root123"
                );

                self::$connection->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

            } catch (PDOException $e) {

                die("Erro de conexão: " . $e->getMessage());

            }

        }

        return self::$connection;
    }
}