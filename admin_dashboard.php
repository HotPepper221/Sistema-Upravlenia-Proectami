<?php 
    function users() {
        include('./assets/php_proccess/db.php');
        $con = mysql_connect($server, $db_user, $db_pwd) or die (mysql_error());
        mysql_select_db($db_name) or die (mysql_error());
        mysql_query("SET NAMES utf8") or die(mysql_error());
        $query = "SELECT * FROM ".$users_table_name." ORDER BY id"; 
        $result = mysql_query($query, $con) or die(mysql_error());
        $i = 0;
        if (mysql_num_rows($result)) {
            echo '
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:100%">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Номер</th>
                        <th class="mdl-data-table__cell--non-numeric">Логин</th>
                        <th class="mdl-data-table__cell--non-numeric">Последняя дата входа</th>
                    </tr>
                </thead>
                <tbody>';
            while ($db_field = mysql_fetch_assoc($result)) { 
                echo '
                <tr>
                    <td class="mdl-data-table__cell--non-numeric">'.++$i.'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$db_field['username'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$db_field['last_login_date'].'</td>
                </tr>';  
            
            }
            echo '</tbody></table>';
        }
        else {
            echo '<center><h4>Ещё ни одного пользователя не создано</h4></center>';
        }
    }
    function files() {
        include('./assets/php_proccess/db.php');
        $con = mysql_connect($server, $db_user, $db_pwd) or die (mysql_error());
        mysql_select_db($db_name) or die (mysql_error());
        mysql_query("SET NAMES utf8") or die(mysql_error());
        $query = "SELECT * FROM ".$files_table_name." ORDER BY id"; 
        $result = mysql_query($query, $con) or die(mysql_error());
        $i = 0;
        if (mysql_num_rows($result)) {
            echo '
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:100%">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Пользователь</th>
                        <th class="mdl-data-table__cell--non-numeric">Название</th>
                        <th class="mdl-data-table__cell--non-numeric">Описание</th>
                        <th class="mdl-data-table__cell--non-numeric">Дата</th>
                        <th class="mdl-data-table__cell--non-numeric">Проект</th>
                        <th class="mdl-data-table__cell--non-numeric">Скачать</th>
                        <th class="mdl-data-table__cell--non-numeric">Удаление</th>
                    </tr>
                </thead>
                <tbody>';
            while ($db_field = mysql_fetch_assoc($result)) { 
                $i++;
                $query1 = "SELECT * FROM ".$projects_table_name." WHERE id='".$db_field['project_id']."' ORDER BY id"; 
                $result1 = mysql_query($query1, $con) or die(mysql_error());
                $name = mysql_fetch_array($result1);
                echo '<tr><td class="mdl-data-table__cell--non-numeric">'.$db_field['username'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$db_field['file'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$db_field['descrip'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$db_field['date'].'</td>';                
                    echo '<td class="mdl-data-table__cell--non-numeric">'.$name['name'].'</td>';
                     echo '<td class="mdl-data-table__cell--non-numeric"><a href="/files/'.$db_field['file'].'">Скачать</a></td><td class="mdl-data-table__cell--non-numeric"><a href="/assets/php_proccess/delete_file.php?id='.$db_field['id'].'&name='.$db_field['file'].'">Удалить</a></td></tr>';            
            }
            echo '</tbody></table>';
        }
        else {
            echo '<center><h4>Нету ни одного файла</h4></center>';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Личный кабинет администратора</title>
        
        <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.pink-red.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
        <link rel="stylesheet" href="./assets/css/main.css">
        
        <link rel="shortcut icon" href="/assets/img/favicon.png" type="image/png">
    </head>
    <body>
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-tabs">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row">
                    <span class="mdl-layout-title">Личный кабинет администратора</span>
                    <div class="mdl-layout-spacer"></div>
                    <nav class="mdl-navigation mdl-layout--large-screen-only">
                        <a class="mdl-navigation__link" href="javascript:void(0)">Здравствуйте, <?=$_SESSION['admin']?>!</a>
                        <a class="mdl-navigation__link" href="./assets/php_proccess/logout.php">Выйти из аккаунта</a>
                    </nav>
                </div>
                <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
                    <a href="#fixed-tab-1" class="mdl-layout__tab is-active">Журнал</a>
                    <a href="#fixed-tab-2" class="mdl-layout__tab">Файлы</a>
                </div>
            </header>
            <div class="mdl-layout__drawer">
                <nav class="mdl-navigation">
                    <a class="mdl-navigation__link" href="/">Вход как обычный юзер</a>
                    <a class="mdl-navigation__link" href="./assets/php_proccess/logout.php">Выйти из аккаунта</a>
                </nav>
            </div>
            <main class="mdl-layout__content">
                <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
                    <div class="page-content">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <?php users(); ?>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="mdl-layout__tab-panel" id="fixed-tab-2">
                    <div class="page-content">
                        <div class="mdl-cell mdl-cell--12-col">
                            <?php files(); ?>
                        </div>
                    </div>
                </section>
            </main>

        <!-- SCRIPTS -->
        <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
    </body>
</html>