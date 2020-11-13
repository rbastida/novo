<?php
namespace App\Config;
use App\Config\Appconf;


class DB {

    protected static $instance = null;

    protected function __construct() {
        
    }

    protected function __clone() {
        
    }

    public static function instance() {
        
        if (self::$instance === null) {
            $opt = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => FALSE,
            );
            $dsn = 'mysql:host=' . AppConf::DBHOST . ';dbname=' . AppConf::DBNAME . ';charset=' . AppConf::DBCHARSET;
            self::$instance = new PDO($dsn, AppConf::DBUSER, AppConf::DBPASSWORD, $opt);
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args) {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function run($sql, $args = []) {
        
        if (!$args) {
            return self::instance()->query($sql);
        }
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

}