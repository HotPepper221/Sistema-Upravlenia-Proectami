<title>Авторизация</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.indigo-pink.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
        <link rel="stylesheet" href="./assets/css/main.css">

<div class="auth-form">
            <div class="mdl-grid">
                <form class="mdl-grid mdl-cell--8-col mdl-shadow--2dp" method="post" action="./assets/php_proccess/admin_auth_pr.php">
                    <h3>Вход</h3>
                    <div class="mdl-textfield mdl-js-textfield mdl-cell-12-col">
                        <input class="mdl-textfield__input" type="text" id="username" name="username" required />
                        <label class="mdl-textfield__label" for="username">Логин</label>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-cell-12-col">
                        <input class="mdl-textfield__input" type="password" id="password" name="password" required />
                        <label class="mdl-textfield__label" for="password">Пароль</label>
                    </div>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--primary">
                        Войти
                    </button>
                </form>
            </div>
        </div>
</html>