<?php
$valorId = $imagen['id'];
$txtId = "number" . $valorId . "";

$listar = "<form>
    <div class='value-button decrease' id='$valorId' onclick='decreaseValue($valorId)' value='Decrease Value'>-</div>
    <input class='number' type='number'  id='$txtId' value='0' disabled/>
    <div class='value-button increase' id='$valorId' onclick='increaseValue($valorId)' value='Increase Value'>+</div>
            </form>";

?>
<div style="padding:10px;" class="col-sm-12 col-md-4 inline-block">
    <div class="paper">
        <a class='lightbox' href='raiz/<?php echo $imagen["imagen"]; ?>'>
            <img src="raiz/<?php echo $imagen["imagen"]; ?>">
        </a>
        <?php echo $listar; ?>
    </div>
</div>