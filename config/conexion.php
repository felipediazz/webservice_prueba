<?php
/*
 Clase de conexi�n a MySQL con PDO
 Marko Robles
 C�digos de Programaci�n
 */
class Conexion extends PDO
{
    private $hostBd = 'us-cdbr-east-05.cleardb.net';
    private $nombreBd = 'heroku_6752731b5d11066';
    private $usuarioBd = 'b0213c96fda657';
    private $passwordBd = '78319b84';
    
    public function __construct()
    {
        try{
            parent::__construct('mysql:host=' . $this->hostBd . ';dbname=' . $this->nombreBd . ';charset=utf8', $this->usuarioBd, $this->passwordBd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            
        } catch(PDOException $e){
            echo 'Error: ' . $e->getMessage();
            exit;
        }
    }

   

}
?>