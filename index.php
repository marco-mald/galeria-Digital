<?php include("p1.php"); ?>
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--2-col"></div>
    <div class="mdl-cell mdl-cell--8-col">
        <div class="demo-card-wide mdl-card mdl-shadow--2dp">
            <div style="background-color: #46B6AC" class="mdl-card__title">
                <h2 class="mdl-card__title-text">Eventos activos</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <div id="lista" class="mdl-grid center-items">

                </div>
            </div>
        </div>
    </div>
    <div class="mdl-cell mdl-cell--2-col"></div>
    <!--- dialog code --->
    <dialog id="dlgCont" class="mdl-dialog">
        <div class="mdl-dialog__title">Advertencia</div>
        <div class="mdl-dialog__content">
            <p>
                Una vez eliminado el evento, no se puede recuperar.Desea continuar?
            </p>
        </div>
        <div class="mdl-dialog__actions mdl-dialog__actions--full-width">
            <button type="button" class="mdl-button borramela">Borrar</button>
            <button type="button" class="mdl-button close">Cancelar</button>
        </div>
    </dialog>
</div>


<script>
    function traer() {
        $.ajax({
            type: "GET",
            url: "obtenerGalerias.php",
            success: function(data) {
                eventos = JSON.parse(data);
                if (eventos.length === 0) {
                    $("#lista").empty();
                    $("#lista").append(`No hay eventos &nbsp; <a href="nueva.php">Crear evento</a>`);
                } else {
                    $("#lista").empty();
                    eventos.map((x, idx) => {
                        let p = JSON.parse(x);
                        $("#lista").append(`
                        <div id="card` + p.id + `" class="mdl-cell mdl-cell--6-col">
                        <div style="width:100%;" class="mdl-card mdl-shadow--2dp">
                            <div class="mdl-card__title">
                                <h2 class="mdl-card__title-text">` + p.nombre + `</h2>
                            </div>
                            <div class="mdl-card__media">
                                <img src="https://i.blogs.es/9c1e0d/fotografo-sorprendid-al-descubrir-que-objetivo-funciona-con-apertura-distinta-f14/450_1000.jpg" width="100%" height="100%" >
                            </div>
                            <div class="mdl-card__supporting-text">
                            <b>Descripción : </b>` + p.descripcion + `
                            <br/>
                            <br/>
                            <b>Invitación : </b>` + p.codigo + `
                            </div>
                            <div class="mdl-card__actions mdl-card--border">
                                    <button id="` + p.id + `" onClick="eliminar(this.id);" style="float: right;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent">
                                        Eliminar
                                    </button>
                            </div>
                            </div>
                        </div>
                    `);
                    })
                }
            }
        });
    }
    document.addEventListener("DOMContentLoaded", function() {
        /// cuando el documento esta listo
        traer();
    });

    function eliminar(id) {
        var dialog = document.querySelector('dialog');
        if (!dialog.showModal) {
            dialogPolyfill.registerDialog(dialog);
        }
        dialog.querySelector('.close').addEventListener('click', function() {
            dialog.close();
        });
        dialog.querySelector('.borramela').addEventListener('click', function() {
            $("#dlgCont").empty();
            $("#dlgCont").append('<p class="mdl-spinner mdl-js-spinner mdl-spinner--single-color is-active"></p>');
            var card = $("#card" + id);
            card.animate({
                height: '0%',
                width: '0%',
                opacity: '0.4'
            }, "slow");
            setTimeout(() => {
                $.ajax({
                    type: "POST",
                    url: "eliminar.php",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        if (response === 'ok') {
                            dialog.close();
                            $("#dlgCont").empty();
                            $("#dlgCont").append('<div class="mdl-dialog__title">Advertencia</div><div class="mdl-dialog__content"><p>Una vez eliminado el evento, no se puede recuperar.Desea continuar?</p></div><div class="mdl-dialog__actions mdl-dialog__actions--full-width"><button type="button" class="mdl-button borramela">Borrar</button><button type="button" class="mdl-button close">Cancelar</button></div>');
                            traer();
                        } else {
                            alert("Error:" + response);
                        }
                    }
                });
            }, 1000);
            /// ajax delete request
        });
        dialog.showModal();
    }
</script>
<?php include("p2.php"); ?>