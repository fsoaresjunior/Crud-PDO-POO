<?php

/**
 * Class DB
 */
class DB
{
    /**
     * @var PDO recebe uma instância de PDO
     */
    private static $instance;

    /**
     * @var array recebe os dados do arquivo db_conf.ini
     */
    private static $data;


    /**
     * DB constructor.
     */
    private function __construct()
    {
    }

    /**
     * Captura as informações do arquivo db_conf.ini.
     * Retorna os dados do arquivo.
     *
     * @return array|bool dados do arquivo.
     */
    public static function data()
    {
        if (file_exists("db_conf.ini")) {
            return parse_ini_file("db_conf.ini");
        }
    }

    /**
     * Faz a conexão com o banco de dados.
     * Utiliza os dados retonados do método data().
     *
     * @see data()
     * @return PDO
     */
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
