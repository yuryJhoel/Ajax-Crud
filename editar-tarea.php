<?php

    include('database.php');

    $id =  $_POST['id'];
    $nombre =  $_POST['nombre'];
    $descripcion =  $_POST['descripcion'];

    $query = "UPDATE tareas SET nombre='$nombre', descripcion='$descripcion' WHERE id='$id'";
    $result = mysqli_query($conexion, $query);

    if(!$result) {
        die('Query Failed');
    }
    echo "Tarea Actualizada exitosamente";

?>