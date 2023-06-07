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

if(isset ($_POST['operacion'])){
  //Enviaremos datos a la tabla + upload binario
  if($_POST['operacion'] == 'registrar'){
    $respuesta = [
      "status" => false,
      "message" => "",
    ];
    try{

      $rutaDestino = ''; // DEfinido en la estructura del proyecto
      $nombreArchivo  = ''; // Generar para evitar redundancia
      $nombreGuardar = 'NULL'; // Enviar a tabla en la DB

      //Paso 1: subir el archivo (si existe)
      if(isset($_FILES['fotografia'])){

        //Ruta
        $rutaDestino = './img/Personas/';

        //Nombre archivo (host)
        $nombreArchivo = sha1(date('c')) . ".jpg";

        //Ruta completa(ruta+nombre)
        $rutaDestino.= $nombreArchivo;

        if(move_uploaded_file($_FILES['fotografia']['tmp_name'], $rutaDestino)){
          $nombreGuardar = $nombreArchivo;
        }
      }

      $consulta = $conexion->prepare("INSERT INTO personas (apellidos, nombres, fotografia) VALUES(?,?,?)");
      $respuesta["status"] = $consulta->execute(
        array(
          $_POST['apellidos'],
          $_POST['nombres'],
          $nombreGuardar
        )
      );
    }catch(PDOException $e){
      $respuesta["message"] = "No se pudo completar. codigo: ". $e->getCode();
    }
    echo json_encode($respuesta);
  }
}