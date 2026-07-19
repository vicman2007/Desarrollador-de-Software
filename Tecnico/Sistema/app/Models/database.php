<?php

// Clase de conexión
class Database {
    private $bdhost = 'localhost';
    private $bdname = 'pasteler_misves';
    private $bdUsuario = 'pasteler_desarrollo';
    private $bdContra = 'D3s4rr0ll02025';
    private $connected = false;

    public function StartUp() {
        try {
            $objPDO = new PDO(
                'mysql:host=' . $this->bdhost . ';dbname=' . $this->bdname . ';charset=utf8',
                $this->bdUsuario,$this->bdContra
            );
            $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connected = true;
            return $objPDO;
        } catch (PDOException $e) {
            $this->connected = false;
            return null;
        }
    }
    public function isConnected() {
        return $this->connected;
    }
    public function desconectar() {
        $this->connected = false;
        return null;
    }
}