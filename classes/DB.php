<?php

class DB
{
    private static $instance;
    private static $data;

    private function __construct()
    {
    }

    public static function data()
    {
        if (file_exists("db_conf.ini")) {
            return parse_ini_file("db_conf.ini");
        }
    }

    public static function getInstance()
    {
        self::$data = self::data();

        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO('mysql:host='.self::$data['HOST'].';dbname='.self::$data['DBNAME'], self::$data['USER'], self::$data['PASSWORD']);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$instance;
    }
}
