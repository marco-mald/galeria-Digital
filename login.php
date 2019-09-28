<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>

<body>
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
        <header class="mdl-layout__header mdl-layout__header--scroll mdl-color--primary">
            <div class="mdl-layout--large-screen-only mdl-layout__header-row">
                <h3>Galeria digital</h3>
            </div>
        </header>
        <br />
        <br />
        <br />
        <br />
        <div class="mdl-grid center-items">
            <div class="mdl-cell mdl-cell--3-col">
                <div class="demo-card-wide mdl-card mdl-shadow--8dp card-me">
                    <h4 align="center">Administrador</h4>
                    <div align="center">
                        <form action="index.php">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="text" id="email">
                                <label class="mdl-textfield__label" for="email">Email</label>
                            </div>
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input class="mdl-textfield__input" type="password" id="password">
                                <label class="mdl-textfield__label" for="password">Password</label>
                            </div>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                                Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--3-col">

            </div>

            <div class="mdl-cell mdl-cell--3-col">
                <div class="demo-card-wide mdl-card mdl-shadow--8dp card-me">
                    <h4 align="center">Visitar evento</h4>
                    <div align="center">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                            <input class="mdl-textfield__input" type="text" id="code">
                            <label class="mdl-textfield__label" for="email">Invitacion</label>
                        </div>
                        <button onclick="visitar();" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            Entrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <div class="mdl-grid center-items">
            <div class="mdl-cell mdl-cell--6-col">
                <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Bienvenido</h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        Galeria digital, concepto revolucionario en fotografia,
                        crea experiencias unicas para tus clientes, descubre mas de esta herramienta aqui.
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            Descargar manual
                        </a>
                    </div>
                    <div class="mdl-card__menu">
                        <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                            <i class="material-icons">share</i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="mdl-grid center-items">
            <div class="mdl-cell mdl-cell--8-col">
                <div class="demo-card-wide mdl-card mdl-shadow--2dp card-me">
                    <h4 style="text-align: center;">Nuestros clientes nos respaldan</h4>
                    <ul class="demo-list-three mdl-list">
                        <li class="mdl-list__item mdl-list__item--three-line">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-avatar">person</i>
                                <span>Bryan Cranston</span>
                                <span class="mdl-list__item-text-body">
                                    Bryan Cranston played the role of Walter in Breaking Bad. He is also known
                                    for playing Hal in Malcom in the Middle.
                                </span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons">star</i></a>
                            </span>
                        </li>
                        <li class="mdl-list__item mdl-list__item--three-line">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons  mdl-list__item-avatar">person</i>
                                <span>Aaron Paul</span>
                                <span class="mdl-list__item-text-body">
                                    Aaron Paul played the role of Jesse in Breaking Bad. He also featured in
                                    the "Need For Speed" Movie.
                                </span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons">star</i></a>
                            </span>
                        </li>
                        <li class="mdl-list__item mdl-list__item--three-line">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons  mdl-list__item-avatar">person</i>
                                <span>Bob Odenkirk</span>
                                <span class="mdl-list__item-text-body">
                                    Bob Odinkrik played the role of Saul in Breaking Bad. Due to public fondness for the
                                    character, Bob stars in his own show now, called "Better Call Saul".
                                </span>
                            </span>
                            <span class="mdl-list__item-secondary-content">
                                <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons">star</i></a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <script>
            function visitar() {
                var code = $("#code").val();
                if (code === "") {
                    alert("llene todos los campos");
                } else {
                    $.ajax({
                        type: "POST",
                        url: "visitar.php",
                        data: {code: code},
                        success: function(response){
                            if(response ==="error"){
                                alert("verifique su codigo");
                            }else{
                                window.location.replace("events/"+response)
                            }
                        },
                    });
                }
            }
        </script>
        <style>
            .card-me {
                padding-left: 25px;
                padding-right: 25px;
                padding-bottom: 25px;
            }

            .mdl-grid.center-items {
                justify-content: center;
            }

            .demo-card-wide.mdl-card {
                width: 100%;
            }

            .demo-card-wide>.mdl-card__title {
                color: #fff;
                height: 176px;
                background: url("https://www.dzoom.org.es/wp-content/uploads/2007/02/canon-mejorar-fotografo-consejos-principiantes-novatos-810x540.jpg") center / cover;
            }

            .demo-card-wide>.mdl-card__menu {
                color: #fff;
            }

            body {
                background-image: url("https://picsum.photos/1200/900");
                /* Full height */
                height: 100%;
                /* Center and scale the image nicely */
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }
        </style>
</body>

</html>