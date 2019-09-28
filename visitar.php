<?php
include("template/coneccion.php");
if(isset($_POST['code'])){

    $code= $_POST['code'];

    $sql = "SELECT nombre FROM eventos_info WHERE  codigo='" . $code . "';";
    $result = mysqli_query($coneccion, $sql);
    $row =  mysqli_fetch_assoc($result);
    echo $row['nombre'];
    
}else{
    echo"no data";
}
?>