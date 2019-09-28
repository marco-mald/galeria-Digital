<?php
 $valorId= $imagen['id'];
 $txtId = "number".$valorId."";
?>

<div >
<div class="tz-gallery">          
    <a class='lightbox' href='raiz/<?php echo $imagen["imagen"]; ?>'>
    <img class="card-img-top mt-3" src="raiz/<?php echo $imagen["imagen"]; ?>" > 
    </a>          
 </div>    
    <?php $listar="<form>
        <div class='value-button decrease' id='$valorId' onclick='decreaseValue($valorId)' value='Decrease Value'>-</div>
        <input class='number' type='number'  id='$txtId' value='0' disabled/>
        <div class='value-button increase' id='$valorId' onclick='increaseValue($valorId)' value='Increase Value'>+</div>
    </form>";?>
    <?php  echo $listar; ?>
</div>


