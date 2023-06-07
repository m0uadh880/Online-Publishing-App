<?php
set_include_path(get_include_path() . PATH_SEPARATOR . $_SERVER['DOCUMENT_ROOT']);

class ConnexionPDO
{
    private $_dbname;
    private $_user;
    private $_password;
    private $_host;
    private static $_bdd = null;

    private function __construct()
    {
        $config = parse_ini_file('config.ini');
        $this->_dbname = $config['db_name'];
        $this->_user = $config['db_user'];
        $this->_password = $config['db_password'];
        $this->_host = $config['db_host'];

        try {
            self::$_bdd = new PDO("mysql:host=" . $this->_host . ";dbname=".
                $this->_dbname . ";charset=utf8", $this->_user, $this->_password,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$_bdd){
            new ConnexionPDO();
        }return (self::$_bdd);
    }

}
