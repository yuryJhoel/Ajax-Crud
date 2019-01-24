<?php

    include('database.php');

    $query = "SELECT * FROM tareas";
    $result = mysqli_query($conexion, $query);

    if(!$result){
        die('Query Failed'.mysqli_error($conexion));
    }

    $json = array();
    while($fila = mysqli_fetch_array($result)){
        $json[] = array(
            'nombre' =>$fila['nombre'],
            'descripcion' =>$fila['descripcion'],
            'id'=>$fila['id']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;


?>