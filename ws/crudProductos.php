<?php

    include dirname(__DIR__).'/config/conexion.php';
    
    
    
    //include 'conexion.php';
    
    //$pdo = new Conexion();
   /* 
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        if(isset($_GET['id']))
            {
            
            $sql = $pdo->prepare("SELECT * FROM tipo_usuario WHERE id_tipo_usuario=:id");
            $sql->bindValue(':id', $_GET['id']);
            $sql->execute();
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            header("HTTP/1.1 200 hay datos");
            echo json_encode($sql->fetchAll());
            exit;
            
    } else {
        
        
        $sql = $pdo->prepare("SELECT * FROM tipo_usuario");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        
        header("HTTP/1.1 200 HOLA ESTA BIEN?");
        echo json_encode($sql->fetchAll());
        exit;
        
    }
   */
    
//  } /* termina el get */


  //Insertar registro

  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $_producto = json_decode(file_get_contents('php://input'), true);

    //echo $_producto['precio'];


    $pdo = new Conexion();
    /*
    $categoria = $_POST['categoria'];
    $sub_categoria = $_POST['sub_categoria'];
    $tipo = $_POST['tipo'];
    $nombre_prod = $_POST['nombre_prod'];
    $descripcion = $_POST['descripcion'];
    $marca = $_POST['marca'];
    $precio = $_POST['precio'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $imagen = $_POST['imagen'];
    */

    $categoria = $_producto['categoria'];
    $sub_categoria = $_producto['sub_categoria'];
    $tipo = $_producto['tipo'];
    $nombre_prod = $_producto['nombre_prod'];
    $descripcion = $_producto['descripcion'];
    $marca = $_producto['marca'];
    $precio = $_producto['precio'];
    $fecha_ingreso = $_producto['fecha_ingreso'];
    $imagen = $_producto['imagen'];



      $sql = "INSERT INTO PRODUCTO(categoria,sub_categoria,tipo,nombre_prod,descripcion,marca,precio,fecha_ingreso,imagen) VALUES (?,?,?,?,?,?,?,?,?)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $categoria, PDO::PARAM_STR);
      $stmt->bindParam(2, $sub_categoria, PDO::PARAM_STR);
      $stmt->bindParam(3, $tipo, PDO::PARAM_STR);
      $stmt->bindParam(4, $nombre_prod, PDO::PARAM_STR);
      $stmt->bindParam(5, $descripcion, PDO::PARAM_STR);
      $stmt->bindParam(6, $marca, PDO::PARAM_STR);
      $stmt->bindParam(7, $precio, PDO::PARAM_INT);
      $stmt->bindParam(8, $fecha_ingreso, PDO::PARAM_STR);
      $stmt->bindParam(9, $imagen, PDO::PARAM_STR);
      
     // $stmt->bind_param('ssssssiss',$categoria,$sub_categoria,$tipo,$nombre_prod,$descripcio,$marca,$precio,$fecha_ingreso,$imagen);
      
      if($stmt->execute()){

          $json['response']= "Registro insertado";
          echo json_encode($json);

        }else{
          $json['response']=$stmt->error;
          //echo $stmt->error ;
          echo json_encode($json);
        }
        
        $pdo=null;
        exit;


      //$stmt->execute();
      //$idPost = $pdo->lastInsertId();
      /*if($idPost)
      {
          header("HTTP/1.1 200 Ok");
          echo json_encode($idPost);
          exit;
      }*/
  } // FIN INSERTAR




  /*
  //Insertar registro
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
      $sql = "INSERT INTO PRODUCTO(categoria,sub_categoria,tipo,nombre_prod,descripcion,marca,precio,fecha_ingreso,imagen) VALUES (?,?,?,?,?,?,?,?,?);";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':nombre', $_POST['tipo_usuario']);
      $stmt->execute();
      $idPost = $pdo->lastInsertId();
      if($idPost)
      {
          header("HTTP/1.1 200 Ok");
          echo json_encode($idPost);
          exit;
      }
  }
   */
    //Actualizar registro

  if($_SERVER['REQUEST_METHOD'] == 'PUT')
  {
      $_producto = json_decode(file_get_contents('php://input'), true);

    $pdo = new Conexion();

    $id = $_producto['id'];
    $categoria = $_producto['categoria'];
    $sub_categoria = $_producto['sub_categoria'];
    $tipo = $_producto['tipo'];
    $nombre_prod = $_producto['nombre_prod'];
    $descripcion = $_producto['descripcion'];
    $marca = $_producto['marca'];
    $precio = $_producto['precio'];
    $fecha_ingreso = $_producto['fecha_ingreso'];
    $imagen = $_producto['imagen'];



      $sql = "UPDATE PRODUCTO SET categoria=?,sub_categoria=?,tipo=?,nombre_prod=?,descripcion=?,marca=?,precio=?,fecha_ingreso=?,imagen=? WHERE id_producto=?";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $categoria, PDO::PARAM_STR);
      $stmt->bindParam(2, $sub_categoria, PDO::PARAM_STR);
      $stmt->bindParam(3, $tipo, PDO::PARAM_STR);
      $stmt->bindParam(4, $nombre_prod, PDO::PARAM_STR);
      $stmt->bindParam(5, $descripcion, PDO::PARAM_STR);
      $stmt->bindParam(6, $marca, PDO::PARAM_STR);
      $stmt->bindParam(7, $precio, PDO::PARAM_INT);
      $stmt->bindParam(8, $fecha_ingreso, PDO::PARAM_STR);
      $stmt->bindParam(9, $imagen, PDO::PARAM_STR);
      $stmt->bindParam(10, $id, PDO::PARAM_INT);
      
      if($stmt->execute()){

          $json['response']= "Registro modificado";
          echo json_encode($json);

        }else{
          $json['response']=$stmt->error;
          echo json_encode($json);
        }
        
        $pdo=null;
        exit;
  }
    
  
  //Eliminar registro
  if($_SERVER['REQUEST_METHOD'] == 'DELETE')
  {

    // Para el troubleshooting
    $_producto = json_decode(file_get_contents('php://input'), true);
    $id = $_producto['id'];
    //

    $pdo = new Conexion();

      $sql = "DELETE FROM PRODUCTO WHERE id_producto=?";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(1, $id, PDO::PARAM_INT);

      if($stmt->execute()){

        $json['response']= "Registro eliminado";
        echo json_encode($json);

      }else{
        $json['response']=$stmt->error;
        echo json_encode($json);
      }
      
      $pdo=null;
      exit;
  }
 


  if($_SERVER['REQUEST_METHOD'] == 'GET')
  {

    $_producto = json_decode(file_get_contents('php://input'), true);
    $id = $_producto['id'];

    $pdo = new Conexion();


    $json=array();

      $sql = $pdo->prepare("select * from PRODUCTO where id_producto=?");
      $sql->bindParam(1, $id, PDO::PARAM_INT);
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      echo json_encode($sql->fetchAll());
        
        $pdo=null;
        exit;

  } // FIN Lista



  //Si no corresponde a ninguna opci�n anterior
  header("HTTP/1.1 400 Bad Request");
    


  


?>