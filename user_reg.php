<!DOCTYPE html>
<html>
    <head>
        <title>Авторизация | Регистрация</title>
        
        <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.indigo-pink.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
        <link rel="stylesheet" href="./assets/css/main.css">
        
        <link rel="shortcut icon" href="/assets/img/favicon.png" type="image/png">
    </head>
    <body>
        <div class="auth-form">
            <div class="mdl-grid">
                <form class="mdl-grid mdl-cell--6-col new-user-form mdl-shadow--2dp" method="post" action="./assets/php_proccess/reg.php">
                                    <h4>Регистрация</h4>
                                    <div class="mdl-textfield mdl-js-textfield mdl-cell-12-col">
                                        <input class="mdl-textfield__input" type="text" id="username" name="username" required />
                                        <label class="mdl-textfield__label" for="username">Логин</label>
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield mdl-cell-12-col">
                                        <input class="mdl-textfield__input" type="password" id="password" name="password" required />
                                        <label class="mdl-textfield__label" for="password">Пароль</label>
                                    </div>
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--primary">
                                        Создать
                                    </button>
                                </form>
            </div>
        </div>
    
        <!-- SCRIPTS -->
        <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
    </body>
</html>