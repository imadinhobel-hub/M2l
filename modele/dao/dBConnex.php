<?php
class dBConnex extends PDO {
    private static $instance;

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new dBConnex();
        }
        return self::$instance;
    }

    private function __construct() {
        try {
            parent::__construct(Param::$dsn, Param::$user, Param::$pass);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "❌ Connexion échouée : " . $e->getMessage();
            die();
        }
    }
    
}
