<?php
    include('database.php');

    $search = $_POST['search'];
    if(!empty($search)){
        $query = "SELECT * FROM tareas WHERE nombre LIKE '$search%'";
        $result = mysqli_query($conexion, $query);
        if(!$result){
            die('Error de consulta'. mysqli_error($conexion));
        }
        $json = array();
        while($fila = mysqli_fetch_array($result)){
            $json[] = array(
                'nombre'=>$fila['nombre'],
                'descripcion'=>$fila['descripcion'],
                'id'=>$fila['id']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }



?>