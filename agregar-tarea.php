<?php
    include('database.php');
    if(isset($_POST['nombre'])){
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $query = "INSERT INTO tareas(nombre, descripcion) VALUES ('$nombre', '$descripcion')";
        $result = mysqli_query($conexion, $query);
        if(!$result){
            die('Query Failed');
        }
        echo "Tarea Agregada";
    }


?>