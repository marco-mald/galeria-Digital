<?php
include("template/coneccion.php");
/*
script para crear evento FUNCIONES:
- Crear carpeta del evento.
- Crear Index del evento, Este tendra el nombre del evento Ejemplo: xvaños.php
- Añadir imagenes a carpeta del evento.
- Crear Id_evento en base de datos y añade imagenes a la BD.
*/
if (isset($_POST['nombre'])) {
    try {
        ///recover data form
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $xpagina = $_POST['xpagina'];
        $descrip = $_POST['descrip'];
        //find for a event with the same name 
        $sql = "SELECT nombre FROM evento WHERE  nombre='" . $nombre . "';";
        $result = mysqli_query($coneccion, $sql);
        $row =  mysqli_fetch_assoc($result);
        //if existe break the code
        if ($nombre === $row['nombre']) {
            echo "Ya existe evento";
            exit("Ya existe");
        }
        ///else, add the new event and 
        $sql = "INSERT INTO evento(nombre,descripcion) VALUES('" . $nombre . "','" . $descrip . "');";
        $result = mysqli_query($coneccion, $sql);

        ///recover the identificator
        $sql = "SELECT id FROM evento WHERE  nombre='" . $nombre . "';";
        $result = mysqli_query($coneccion, $sql);
        $row =  mysqli_fetch_assoc($result);
        $id = $row['id'];

        ///create pass code to event
        $code = uniqid("id_", true);
        $sql = "INSERT INTO invitacion(codigo,id_evento) VALUES('" . $code . "','" . $id . "');";
        $result = mysqli_query($coneccion, $sql);

        //crear carpeta y copiar las platillas de template
        $curdir = getcwd();
        ///si ya existe evento
        if (file_exists($curdir . "/events/" . $nombre)) {
            echo "Ya existe un evento con este nombre";
        } else {
            //crear evento 
            mkdir($curdir . "/events/" . $nombre, 0777);
            copy($curdir . "/template/index.php", $curdir . "/events/" . $nombre . "/index.php");
            copy($curdir . "/template/RealizarPedido.php", $curdir . "/events/" . $nombre . "/RealizarPedido.php");
            mkdir($curdir . "/events/" . $nombre . "/raiz", 0777);

            $nuevoarchivo = fopen($curdir . "/events/" . $nombre . '/id.php', "w+");
            fwrite($nuevoarchivo, "<?php define('ID',$id); define('NAME_EV','$nombre'); define('DES_EV','$descrip'); define('X_PAG',$xpagina);  ?>");
            fclose($nuevoarchivo);

            for ($i = 1; $i <= $cantidad; $i++) {
                $sql = "INSERT INTO imagen(id,imagen,id_evento) values('$i','$i.jpg','$id');";
                $result = mysqli_query($coneccion, $sql);
            }

            ///convert response to json obj with code of
            $arr = array('Realizado' => $code);
            echo json_encode($arr);
            
        }
    } catch (Exception $e) {
        echo $e;
    }
} else {
    echo 'Error No Recibio parametros';
}
?>
