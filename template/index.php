<?php
//Identificador de evento
include("id.php");
$evento = ID;
$name_ev = NAME_EV;
$des_ev = DES_EV;
$x_pag = X_PAG;

include_once  '../../template/imagenes.php';
$imagenes = new GALERIA($x_pag, $evento);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>manejar imagenes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css"> -->
    <!---CDN EFECTOS DE  GALERIA  -->
    <link rel="stylesheet" href="../../template/css/baguette-css.css">
    <link rel="stylesheet" href="../../template/css/gallery-grid.css">
    <link rel="stylesheet" href="../../template/css/main.css">
</head>

<body>
    <div id="cont" class="container gallery-container">
        <h1> <?php echo $des_ev; ?> </h1>
        <div class="tz-gallery">
            <div class="row">
                <!--- mapeo de contenido -->
                <div>
                    <?php
                    $imagenes->mostrarImagenes($evento);
                    ?>
                </div>
            </div>
            <!--- paginado -->
            <div id="paginas">
                <?php
                $imagenes->mostrarPaginas();
                ?>
            </div>
        </div>
    </div>
    <div id="footer">
        <!-- Grid row -->
        <h4 class="txt" style="margin:5px; margin-bottom: 15px;">Resumen del pedido </h4>
        <div class="row">
            <!-- Grid column -->
            <div class="col-md-2 mx-auto">
                <div class="row">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-8">
                        <b>Fotos Seleccionadas</b>
                    </div>
                    <div class="col-sm-2">
                        <p id="seleccionadas">#</p>
                    </div>
                </div>
            </div>

            <div class="col-md-2 mx-auto">
                <div class="row">
                    <div class="col-sm-9">
                        <b>Fotos incluidas</b>
                    </div>
                    <div class="col-sm-3">
                        <p id="incluidas">10</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mx-auto">
                <div class="row">
                    <div class="col-sm-9">
                        <b>Fotos extras</b>
                    </div>
                    <div class="col-sm-3">
                        <p id="extras">#</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mx-auto">
                <div class="row">
                    <div class="col-sm-9">
                        <p data-toggle="tooltip" title="Marcando esta opcion Incluye una copia digital de 
                                                 alta calidad. ">Incluir digitales </p>
                    </div>
                    <div class="col-sm-3">
                        <input type="checkbox" id="check" onchange='handleChange(this);' value="">
                    </div>
                </div>
            </div>
            <div class="col-md-2 mx-auto">
                <div class="row">
                    <div class="col-sm-9">
                        <b>Total a pagar</p>
                    </div>
                    <div class="col-sm-3">
                        <p id="total">#</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mx-auto">
                <button type="button" onclick="btn();" class="btn btn-success">Realizar
                    pedido</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        /// run baguette gallery 
        baguetteBox.run('.tz-gallery');
        ///arreglos para llevar control de pedido 
        var idfoto = [];
        var cantidad = [];
        var digital = "false";

        if (sessionStorage.getItem("idfoto") == null) {} else {
            ///recuperar resumen de pedido
            idfoto = JSON.parse(sessionStorage.getItem("idfoto"));
            cantidad = JSON.parse(sessionStorage.getItem("cantidad"));
            digital = sessionStorage.getItem("digital");
        }

        function link() {
            //guardar estado de venta
            sessionStorage.setItem("idfoto", JSON.stringify(idfoto));
            sessionStorage.setItem("cantidad", JSON.stringify(cantidad));
            sessionStorage.setItem("digital", digital);
            //arreglo de componentes pagina actual 
            var val_comp = [];
            ///obtener valores input pagina
            var i = 0;
            $('#cont').find('input').each(function() {
                var id = this.id;
                var val = document.getElementById(id).value;
                val_comp[i] = val;
                i++;
            });
            //obtener Numero de  pagina actual
            var pag_actual = $(".actual", "#cont").text();
            //guardar arreglo con nombre de la pagina 
            sessionStorage.setItem("p" + pag_actual, JSON.stringify(val_comp));
        }

        function btn() {
            //realizar el pedido, mandar arreglo de fotos y cantidad
            var res = confirm('Una vez realizado el pedido, No se puede modificar, ¿Desea continuar?');
            if (res == true) {
                $.ajax({
                    type: "POST",
                    url: "RealizarPedido.php",
                    data: {
                        id: idfoto,
                        cantidad: cantidad,
                        digitales: digital
                    },
                    //capturar resultado
                    success: function(result) {
                        //borrar las variables session
                        Object.keys(sessionStorage)
                            .forEach(function(k) {
                                sessionStorage.removeItem(k);
                            });
                        //recargar pagina 
                        location.reload();
                        //resultado
                        alert(result);
                    }
                });
            }
        }

        document.addEventListener("DOMContentLoaded", evt => {
            ///actualizar resumen pedido
            actualizar(0, 0);
            //obtener pagina actual galeria
            var pag_actual = $(".actual", "#cont").text();
            //si ya se guardaron valores de esta pagino
            if (sessionStorage.getItem("p" + pag_actual) == null) {} else {
                //recuperar valores de controles
                var recup = JSON.parse(sessionStorage.getItem("p" + pag_actual));
                //ciclo llenado inputs
                var i = 0;
                $('#cont').find('input').each(function() {
                    var id = this.id;
                    document.getElementById(id).value = recup[i];
                    i++;
                });
            }
            //recuperar checbox
            var dig = sessionStorage.getItem("digital");
            if (dig == "Si") {
                document.getElementById("check").checked = true;
            } else {
                document.getElementById("check").checked = false;
            }
        });

        function actualizar(id, val) {
            ///actualizar valor del si existe en arreglo
            var existe = false;
            for (let i = 0; i < idfoto.length; i++) {
                if (id == idfoto[i]) {
                    cantidad[i] = val;
                    existe = true;
                }
                ///si la cantidad es 0 eliminar elemento 
                if (cantidad[i] < 1) {
                    idfoto.splice(i, 1);
                    cantidad.splice(i, 1);
                }
            }
            //agregar elemento si no existe
            if (existe == false) {
                idfoto[idfoto.length] = id;
                cantidad[cantidad.length] = val;
            }
            existe = false;
            var total_fotos = 0;
            for (let i = 0; i < cantidad.length; i++) {
                total_fotos = total_fotos + cantidad[i];
            }
            //total fot seleccionadas
            $("#seleccionadas").text(total_fotos);
            ///si se exeden las fotos incluidas del paqte
            if (total_fotos > 10) {
                var extra = total_fotos - 10;
                $("#extras").text(extra);
                $("#total").text("$" + extra * 15);
            } else {
                $("#extras").text(0);
                $("#total").text("$" + 0);
            }
        }

        function handleChange(checkbox) {
            if (checkbox.checked == true) {
                digital = "Si";
            } else {
                digital = "No";
            }
        }



        ////incremento y decremento de controles 
        var valueInitial = 0;
        var valId = "";
        var value = 0;

        function increaseValue(id) {
            valId = "number" + id.toString();
            value = parseInt(document.getElementById(valId).value, 10);
            value = isNaN(value) ? 0 : value;
            if (value < 1) {
                value < 1 ? value = 1 : '';
            } else {
                value++;
            }
            valueInitial = 1;
            document.getElementById(valId).value = value;
            actualizar(id, value);
        }

        function decreaseValue(id) {
            if (valueInitial >= 1) {
                valId = "number" + id.toString();
                value = parseInt(document.getElementById(valId).value, 10);
                value = isNaN(value) ? valueInitial : value;
                value < valueInitial ? value = valueInitial : '';
                value--;
                document.getElementById(valId).value = value;
            }
            actualizar(id, value);
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
</body>

</html>