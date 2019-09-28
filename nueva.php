<?php include("p1.php"); ?>
<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--1-col "></div>
    <div class="mdl-cell mdl-cell--6-col ">
        <form id="form_new" action="javascript:evento();">
            <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <h2 class="mdl-card__title-text">Datos del evento</h2>
                </div>
                <div class="mdl-card__supporting-text">
                    por favor llene los siguientes campos.
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input id="event" class="mdl-textfield__input" pattern="[a-zA-Z]+" required name="event" type="text" autofocus>
                        <label class="mdl-textfield__label" for="sample2">Nombre del evento</label>
                        <span class="mdl-textfield__error">Utilize solo letras Ej: quinceañosMary</span>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input id="descripEv" class="mdl-textfield__input" name="descripEv" required />
                        <label class="mdl-textfield__label" for="sample2">Descripcion del evento</label>
                    </div>
                    <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--6-col">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input type="file" id="portada" class="mdl-textfield__input" placeholder="var " />
                                <label class="mdl-textfield__label" for="sample2">Portada del evento</label>
                            </div>
                        </div>
                        <div class="mdl-cell mdl-cell--6-col">
                            <center>
                                <img id="prev" src="#" alt="Portada del evento" style="border: 1px solid #ddd; border-radius: 4px; padding: 5px; width: 250px;"  />
                            </center>
                        </div>
                        <div class="mdl-cell mdl-cell--6-col">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input id="cantidad" class="mdl-textfield__input" type="number" required min="1" max="10000">
                                <label class="mdl-textfield__label" for="sample2">Cantidad de fotografias</label>
                                <span class="mdl-textfield__error">Min: 1 , Max: 10,000 fotografias.</span>
                            </div>
                        </div>
                        <div class="mdl-cell mdl-cell--6-col">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input id="xpagina" class="mdl-textfield__input" type="number" value="5" required min="1" max="50">
                                <label class="mdl-textfield__label" for="sample2">Fotografias por pagina: </label>
                                <span class="mdl-textfield__error">Min: 1 , Max: 50 fotografias.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mdl-card__actions">
                    <button type="submit" style="float: right; width: 20%;" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                        Enviar
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="mdl-cell mdl-cell--4-col ">
        <div id="resumen" style=" align-self: center ; float:right; display: none " class="mdl-card mdl-shadow--2dp">
            <h3 style="text-align: center; margin-bottom: -30px; ">Resumen</h3>
            <div class="mdl-card__supporting-text">
                <ul class="demo-list-two mdl-list">
                    <li class="mdl-list__item mdl-list__item--two-line">
                        <span class="mdl-list__item-primary-content">
                            <i class="  material-icons mdl-list__item-icon">beach_access</i>
                            <span>Evento</span>
                            <span id="evento" class="mdl-list__item-sub-title">text</span>
                        </span>
                    </li>
                    <li class="mdl-list__item mdl-list__item--two-line">
                        <span class="mdl-list__item-primary-content">
                            <i class="  material-icons mdl-list__item-icon">insert_photo</i>
                            <span>Cantidad</span>
                            <span id="cantidads" class="mdl-list__item-sub-title">text</span>
                        </span>
                    </li>
                    <li class="mdl-list__item mdl-list__item--two-line">
                        <span class="mdl-list__item-primary-content">
                            <i class="  material-icons mdl-list__item-icon">store</i>
                            <span>Url</span>
                            <span class="mdl-list__item-sub-title"> <a id="direccion" href="events/pez">URL de evento</a> </span>
                        </span>
                    </li>
                    <li class="mdl-list__item mdl-list__item--two-line">
                        <span class="mdl-list__item-primary-content">
                            <i class="  material-icons mdl-list__item-icon">attach_file</i>
                            <span>Invitacion</span>
                            <span class="mdl-list__item-sub-title"> <a id="code"> </a> </span>
                        </span>
                    </li>
                    <li class="mdl-list__item mdl-list__item--two-line">
                        <span class="mdl-list__item-primary-content">
                            <i class="  material-icons mdl-list__item-icon">attach_file</i>
                            <span>Invitacion</span>
                            <span class="mdl-list__item-sub-title"> <a id="invitacion" href="#">Descargar PDF</a> </span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--- modal code --->
    <dialog class="mdl-dialog">
        <div class="mdl-dialog__content">
            <p>
                Cargando...
            </p>
        </div>
    </dialog>
    <div class="mdl-cell mdl-cell--1-col ">
    </div>

</div>

<script>
    function imageload(input){
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#prev').attr('src', e.target.result);
            console.log(e.target.result);

            }
            reader.readAsDataURL(input.files[0]);
            sessionStorage.setItem('img',input.files[0]);
        }
    }
    $("#portada").change(function(){
        imageload(this);
    });
    ///block submit on key press enter
    $(window).keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    function evento() {
        $("#resumen").hide();
        var dialog = document.querySelector('dialog');
        if (!dialog.showModal) {
            dialogPolyfill.registerDialog(dialog);
        }
        dialog.showModal();

        /// creando evento
        cantidad = $("#cantidad").val();
        xpagina = $("#xpagina").val();
        nombre = $("#event").val();
        descrip = $("#descripEv").val();
        portada = sessionStorage.getItem('img');
        $.ajax({
            type: "POST",
            url: "crearEvento.php",
            data: {
                nombre: nombre,
                cantidad: cantidad,
                xpagina: xpagina,
                descrip: descrip,
                portada : portada
            },
            success: function(respuesta) {
                try {
                    x = JSON.parse(respuesta);
                    $("#evento").text(nombre);
                    $("#cantidads").text(cantidad);
                    $("#code").text(x.Realizado);
                    $("#direccion").attr("href", "events/" + nombre)
                    $("#resumen").show();
                    $("#resumen").animate({left: '50px'}, "slow");
                    $("#form_new")[0].reset();
                    $("#prev").attr('src', "#");
                    setTimeout(() => {
                        dialog.close();
                        $("#resumen").animate({left: '-50px'}, "slow");
                    }, 1000);
                } catch (error) {
                    alert("Ya existe un evento con ese nombre");
                    dialog.close();
                }
            }
        });
    };
</script>
<?php include("p2.php"); ?>