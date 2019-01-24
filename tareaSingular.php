<?php

 include('database.php');
 $id = $_POST['id'];
 $query = "SELECT * FROM tareas WHERE id = $id";
 $result = mysqli_query($conexion, $query);

 if(!$result) {
     die('Query Failed');
 }
 $json = array();
 while($fila = mysqli_fetch_array($result)){
     $json[] = array(
         'nombre'=>$fila['nombre'],
         'descripcion'=>$fila['descripcion'],
         'id' =>$fila['id']
     );
 }
 $jsonString = json_encode($json[0]);
 echo $jsonString;
?>