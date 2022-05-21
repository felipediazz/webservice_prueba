<?php

    include dirname(__DIR__).'/config/conexion.php';

  //Lista registros

  if($_SERVER['REQUEST_METHOD'] == 'GET')
  {
    $pdo = new Conexion();


    $json=array();



      $sql = $pdo->prepare("select * from PRODUCTO");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      echo json_encode($sql->fetchAll());
        
        $pdo=null;

  } // FIN Lista


?>