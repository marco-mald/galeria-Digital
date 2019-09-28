<?php 
include("template/coneccion.php");

$data =[];

$sql = "SELECT * FROM eventos_info;";
$result = mysqli_query($coneccion, $sql);

while ($row = mysqli_fetch_assoc($result))
 {
    array_push($data,json_encode($row));
 }


echo json_encode($data);

?>
