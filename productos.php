<?php

function getConexion(){
  try{
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=dbajax;charset=UTF8","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
  }
  catch(Exception $e){
    die($e->getMessage());
  }
}

//MODELOS
$conexion = getConexion();

//CRUD
//Controlador 
if(isset($_POST['operacion'])){

  if($_POST['operacion'] == 'listar'){
    $consulta = $conexion->prepare("SELECT * FROM productos");
    $consulta->execute();
    $datosObtenidos = $consulta->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($datosObtenidos);
  }

  if($_POST['operacion'] == 'registrar'){ 
    //Arreglo que contiene el estado/mensaje del proceso
    $respuesta = [
      "status" => false,
      "msg" => ""
    ];

    try{
      $consulta = $conexion->prepare("INSERT INTO productos (nombre, marca, precio) VALUES (?,?,?)");
      $respuesta["status"] = $consulta->execute(
        array(
          $_POST['nombre'],
          $_POST['marca'],
          $_POST['precio']
        )
      );
    }
    catch(Exception $e){
      //die($e->getMessage());
      //getCode() - getFile() - getMessage() - getLine() - getPrevious() - getTraceAsString
      $respuesta["msg"] = "No se completo el proceso, codigo de error: ".$e->getCode();
    }

    echo json_encode($respuesta);
  }

  if($_POST['operacion'] == 'eliminar'){
    $eliminado = false;

    $respuesta = [
      "status" => false,
      "msg" => ""
    ];

    try{
      $consulta = $conexion->prepare("DELETE FROM productos WHERE idproducto = ?");
      $respuesta["status"] =  $consulta-> execute(array($_POST['idproducto']));
    }catch(Exception $e){
      $respuesta["msg"] = "No se pudo eliminar registro. Codigo error: ". $e->getCode();
    }
    echo json_encode($respuesta);
  }

  if($_POST['operacion'] == 'obtener'){
    
    try{
      $consulta = $conexion->prepare("SELECT * FROM productos WHERE idproducto = ?");
      $consulta ->execute(array($_POST['idproducto']));
      $resultado = $consulta->fetch(PDO::FETCH_ASSOC); //Return (método)
    }catch(Exception $e){
      die($e->getMessage());
    }

    //Si fuer un metodo esta linea va en el controller
    echo json_encode($resultado);
  }

  if($_POST['operacion'] == 'editar'){
    $respuesta = [
      "status" => false,
      "msg" => ""
    ];

    try{
      $consulta = $conexion->prepare("UPDATE productos SET nombre = ?, marca = ?, precio = ?, update_at = now() WHERE idproducto = ?");
      $respuesta['status'] = $consulta->execute(array(
        $_POST['nombre'],
        $_POST['marca'],
        $_POST['precio'],
        $_POST['idproducto']
      ));
    }catch(Exception $e){
      $respuesta["msg"] = "No se completo el proceso, codigo de error: ".$e->getCode();
    }
    

    echo json_encode($respuesta);
  }
}