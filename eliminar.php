<?php
include("template/coneccion.php");

if (isset($_POST['id'])){
    $id = $_POST['id'];

    $sql = "DELETE FROM evento WHERE id = '$id' ;";
    $result = mysqli_query($coneccion, $sql);
    if($result){
        echo"ok";
    }else{
        echo"error";
    }

}else{
    echo "error, no event selected";
}

?>