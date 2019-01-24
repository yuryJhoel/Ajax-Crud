<?php
include('database.php');

if(isset($_POST['id'])){
    $id = $_POST['id'];
    
    $query = "DELETE FROM tareas WHERE id = $id";
    $result = mysqli_query($conexion, $query);
    if(!$result){
        die('Query Failde.');
    }
    echo "Tarea Eliminado con Exito";
}
?>