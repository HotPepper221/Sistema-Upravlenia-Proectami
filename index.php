<?php 
    function myprojects() {
        include('./assets/php_proccess/db.php');
        $con = mysql_connect($server, $db_user, $db_pwd) or die (mysql_error());
        mysql_select_db($db_name) or die (mysql_error());
        mysql_query("SET NAMES utf8") or die(mysql_error());
        $query = "SELECT * FROM ".$projects_table_name." WHERE username='".$_SESSION['username']."' ORDER BY id"; 
        $result = mysql_query($query, $con) or die(mysql_error());
        $i = 0;
        if (mysql_num_rows($result)) {
            echo '
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:100%">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Имя</th>
                        <th class="mdl-data-table__cell--non-numeric">Описание</th>
                        <th class="mdl-data-table__cell--non-numeric">Предполагаемая дата начала</th>
                        <th class="mdl-data-table__cell--non-numeric">Предполагаемая дата окончания</th>
                        <th class="mdl-data-table__cell--non-numeric">Статус</th>
                        <th class="mdl-data-table__cell--non-numeric">Рабочая область</th>
                    </tr>
                </thead>
                <tbody>';
            while ($db_field = mysql_fetch_assoc($result)) { 
                echo '<tr><td class="mdl-data-table__cell--non-numeric">'.$db_field['name'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$db_field['descrip'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$db_field['date_start'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$db_field['date_end'].'</td>';
                if ($db_field['status'] == 0) 
                echo '<td class="mdl-data-table__cell--non-numeric">В разработке</td>'; 
                else echo '<td class="mdl-data-table__cell--non-numeric">Завершено</td>'; 
                     echo '<td class="mdl-data-table__cell--non-numeric"><a href="project.php?id='.$db_field['id'].'">Перейти в рабочую область</a></td></tr>';
            
            }
            echo '</tbody></table>';
        }
        else {
            echo '<center><h4>Вы не создали ни одного проекта</h4></center>';
        }
    }


    function allprojects() {
        include('./assets/php_proccess/db.php');
        $con = mysql_connect($server, $db_user, $db_pwd) or die (mysql_error());
        mysql_select_db($db_name) or die (mysql_error());
        mysql_query("SET NAMES utf8") or die(mysql_error());
        $query = "SELECT * FROM ".$projects_table_name." WHERE status='0' ORDER BY id"; 
        $result = mysql_query($query, $con) or die(mysql_error());
        $i = 0;
        if (mysql_num_rows($result)) {
            echo '
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:100%">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Имя</th>
                        <th class="mdl-data-table__cell--non-numeric">Описание</th>
                        <th class="mdl-data-table__cell--non-numeric">Предполагаемая дата начала</th>
                        <th class="mdl-data-table__cell--non-numeric">Предполагаемая дата окончания</th>
                        <th class="mdl-data-table__cell--non-numeric">Рабочая область</th>
                    </tr>
                </thead>
                <tbody>';
            while ($db_field = mysql_fetch_assoc($result)) { 
                echo '<tr><td class="mdl-data-table__cell--non-numeric">'.$db_field['name'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$db_field['descrip'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$db_field['date_start'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$db_field['date_end'].'</td>';
                     echo '<td class="mdl-data-table__cell--non-numeric"><a href="project.php?id='.$db_field['id'].'">Перейти в рабочую область</a></td></tr>';
            
            }
            echo '</tbody></table>';
        }
        else {
            echo '<center><h4>Вы не создали ни одного проекта</h4></center>';
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Личный кабинет</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.indigo-pink.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">
        <link rel="stylesheet" href="./assets/css/main.css">
        
        <link rel="shortcut icon" href="/assets/img/favicon.png" type="image/png">
    </head>
    <body>
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-tabs">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row">
                    <span class="mdl-layout-title">Личный кабинет</span>
                    <div class="mdl-layout-spacer"></div>
                    <nav class="mdl-navigation mdl-layout--large-screen-only">
                        <a class="mdl-navigation__link" href="javascript:void(0)">Здравствуйте, <?=$_SESSION['username']?>!</a>
                        <a class="mdl-navigation__link" href="./assets/php_proccess/logout.php">Выйти</a>
                    </nav>
                </div>
                <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
                    <a href="#fixed-tab-1" class="mdl-layout__tab is-active">Ваши проекты</a>
                    <a href="#fixed-tab-2" class="mdl-layout__tab">Все проекты в стадии разработки</a>
                    <a href="#fixed-tab-3" class="mdl-layout__tab">Изменение пароля</a>
                </div>
            </header>
            <div class="mdl-layout__drawer">
                <nav class="mdl-navigation">
                    <a class="mdl-navigation__link" href="./assets/php_proccess/logout.php">Выйти из аккаунта</a>
                </nav>
            </div>
            <main class="mdl-layout__content">
                <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
                    <div class="page-content">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <?php myprojects(); ?>
                            </div>
                            <center><div class="mdl-cell mdl-cell--12-col">
                                <div class="mdl-cell mdl-cell--3-col">
                                <form class="mdl-grid mdl-cell--12-col new-user-form mdl-shadow--2dp" method="post" action="./assets/php_proccess/add_new_project.php">
                                    <h4>Создать проект</h4>
                                    <div class="mdl-textfield mdl-js-textfield mdl-cell-12-col">
                                        <input class="mdl-textfield__input" type="text" id="name" name="name" required />
                                        <label class="mdl-textfield__label" for="name">Имя проекта</label>
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield mdl-cell-12-col">
                                        <textarea class="mdl-textfield__input" type="text" id="descrip" rows="5" name="descrip" required></textarea>
                                        <label class="mdl-textfield__label" for="descrip">Описание проекта</label>
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield mdl-cell-12-col">
                                        <input class="mdl-textfield__input" type="text"  id="datepicker" placeholder="Дата начала" name="date_start" required />
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield mdl-cell-12-col">
                                        <input class="mdl-textfield__input" type="text"  id="datepicker2" placeholder="Дата окончания" name="date_end" required />
                                    </div>
                                    <button type="submit" class="mdl-button mdl-js-button mdl-button--primary">
                                        Создать
                                    </button>
                                </form>
                            </div>
                            </div></center>
                        </div>
                    </div>
                </section>
                <section class="mdl-layout__tab-panel" id="fixed-tab-2">
                    <div class="page-content">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <div class="mdl-cell mdl-cell--12-col">
                                    <?php allprojects(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="mdl-layout__tab-panel" id="fixed-tab-3">
                    <div class="page-content">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <div class="mdl-cell mdl-cell--12-col">
                                                <div class="mdl-grid">
                <form class="mdl-grid mdl-cell--3-col mdl-shadow--2dp" method="post" action="./assets/php_proccess/change_pass.php?username=<?=$_SESSION['username']?>">
                    <div class="mdl-textfield mdl-js-textfield mdl-cell-12-col">
                        <input class="mdl-textfield__input" type="text" id="password" name="password" required />
                        <label class="mdl-textfield__label" for="password">Новый пароль</label>
                    </div>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--primary">
                        Изменить
                    </button>
                </form>
            </div>
        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    
        <!-- SCRIPTS -->
        <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
        <script>
  $(function() {
    $("#datepicker").datepicker();
    $("#datepicker2").datepicker();
  });
  </script>
    </body>
</html>