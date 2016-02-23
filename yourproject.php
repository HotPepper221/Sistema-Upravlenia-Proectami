<?php 
    function files() {
        include('./assets/php_proccess/db.php');
        $con = mysql_connect($server, $db_user, $db_pwd) or die (mysql_error());
        mysql_select_db($db_name) or die (mysql_error());
        mysql_query("SET NAMES utf8") or die(mysql_error());
        $query = "SELECT * FROM ".$files_table_name." WHERE project_id='".$_GET['id']."' AND status='' OR status='2' AND project_id='".$_GET['id']."' ORDER BY id"; 
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
                        <th class="mdl-data-table__cell--non-numeric">Статус</th>
                        <th class="mdl-data-table__cell--non-numeric">Скачать</th>
                        <th class="mdl-data-table__cell--non-numeric">Удаление</th>
                    </tr>
                </thead>
                <tbody>';
            while ($db_field = mysql_fetch_assoc($result)) { 
                $i++;
                echo '<tr><td class="mdl-data-table__cell--non-numeric">'.$db_field['username'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$db_field['file'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$db_field['descrip'].'</td>
                    <td class="mdl-data-table__cell--non-numeric">'.$db_field['date'].'</td>';                
                    echo '<td class="mdl-data-table__cell--non-numeric">';if ($db_field['status'] == '1'):echo'Обновлено. ';else:echo'Это последняя версия файла. <a href="#all'.$i.'">Все версии</a>';endif;echo'</td>';
                     echo '<td class="mdl-data-table__cell--non-numeric"><a href="/files/'.$db_field['file'].'">Скачать</a></td><td class="mdl-data-table__cell--non-numeric"><a href="/assets/php_proccess/delete_file.php?id='.$db_field['id'].'&name='.$db_field['file'].'">Удалить</a></td></tr>';
                echo '<a href="#x" class="overlay" id="all'.$i.'"></a>
   <div class="popup">';
                $query1 = "SELECT * FROM ".$files_table_name." WHERE file_with='".$db_field['file_with']."' AND project_id='".$_GET['id']."' ORDER BY id"; 
        $result1 = mysql_query($query1, $con) or die(mysql_error());
                 while ($db_field1 = mysql_fetch_assoc($result1)) { 
                     echo ''.$db_field1['file'].' <a href="/files/'.$db_field1['file'].'">Скачать</a><br>';
                 }
    echo '<a class="close" title="Закрыть" href="#"></a>
    </div>';
            
            }
            echo '</tbody></table>';
        }
        else {
            echo '<center><h4>Нету ни одного файла</h4></center>';
        }
    }

    function users() {
        include('./assets/php_proccess/db.php');
        $con = mysql_connect($server, $db_user, $db_pwd) or die (mysql_error());
        mysql_select_db($db_name) or die (mysql_error());
        mysql_query("SET NAMES utf8") or die(mysql_error());
        $query = "SELECT * FROM ".$projects_table_name." WHERE id='".$_GET['id']."' ORDER BY id"; 
        $result = mysql_query($query, $con) or die(mysql_error());
        $db_field = mysql_fetch_array($result);
        $users = explode(";", $db_field["party"]);
        echo '<table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" style="width:100%">
                <thead>
                    <tr>
                        <th class="mdl-data-table__cell--non-numeric">Пользователь</th>
                    </tr>
                </thead>
                <tbody><tr><td class="mdl-data-table__cell--non-numeric">'.$db_field['username'].'</td></tr>';
        for ($i = 0; $i < count($users) - 1; $i++) {
            echo '<tr><td class="mdl-data-table__cell--non-numeric">'.$users[$i].'</td></tr>';   
        }
        echo '</tbody></table>';
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
                        <a class="mdl-navigation__link" href="javascript:void(0)">Название проекта: "<?=$row['name']?>"</a>
                        <a class="mdl-navigation__link" href="javascript:void(0)">Здравствуйте, <?=$_SESSION['username']?>!</a>
                        <a class="mdl-navigation__link" href="./assets/php_proccess/logout.php">Выйти</a>
                    </nav>
                </div>
                <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
                    <a href="#fixed-tab-1" class="mdl-layout__tab is-active">Файлы</a>
                    <a href="#fixed-tab-2" class="mdl-layout__tab">Участники проекта</a>
                    <a href="#fixed-tab-3" class="mdl-layout__tab">Настройки</a>
                </div>
            </header>
            <div class="mdl-layout__drawer">
                <nav class="mdl-navigation">
                    <a class="mdl-navigation__link" href="/">Главная</a>
                    <a class="mdl-navigation__link" href="./assets/php_proccess/logout.php">Выйти из аккаунта</a>
                </nav>
            </div>
            <main class="mdl-layout__content">
                <section class="mdl-layout__tab-panel is-active" id="fixed-tab-1">
                    <div class="page-content">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <?php files(); ?>
                                <form enctype="multipart/form-data" class="mdl-grid mdl-cell--3-col mdl-shadow--2dp" method="post" action="./assets/php_proccess/add_file.php?id=<?=$row['id']?>">
                    <h5>Загрузить файл</h5>
                    <input name="filename" type="file" required />
                                    <div class="mdl-textfield mdl-js-textfield mdl-cell-12-col">
                                        <textarea class="mdl-textfield__input" type="text" id="descrip" rows="5" name="descrip" required></textarea>
                                        <label class="mdl-textfield__label" for="descrip">Описание файла</label>
                                    </div>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--primary">
                        Загрузить
                    </button>
                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="mdl-layout__tab-panel" id="fixed-tab-2">
                    <div class="page-content">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <?php users(); ?>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="mdl-layout__tab-panel" id="fixed-tab-3">
                    <div class="page-content">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col">
                                <a href="/assets/php_proccess/close.php?id=<?=$row['id']?>">Перевести в статус "Завершено"</a>
                            </div>
            <div class="mdl-grid">
                <form class="mdl-grid mdl-cell--3-col mdl-shadow--2dp" method="post" action="./assets/php_proccess/change_name_desc.php?id=<?=$row['id']?>">
                    <h5>Изменение имени и описания</h5>
                    <div class="mdl-textfield mdl-js-textfield mdl-cell-12-col">
                                        <input class="mdl-textfield__input" type="text" id="name" name="name" value="<?=$row['name']?>" required />
                                        <label class="mdl-textfield__label" for="name">Имя проекта</label>
                                    </div>
                                    <div class="mdl-textfield mdl-js-textfield mdl-cell-12-col">
                                        <textarea class="mdl-textfield__input" type="text" id="descrip" rows="5" name="descrip" required><?=$row['descrip']?></textarea>
                                        <label class="mdl-textfield__label" for="descrip">Описание проекта</label>
                                    </div>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--primary">
                        Сохранить
                    </button>
                </form>
            </div>
                        </div>
                    </div>
                </section>
            </main>
        </div>
    
        <!-- SCRIPTS -->
        <script src="https://storage.googleapis.com/code.getmdl.io/1.0.6/material.min.js"></script>
    </body>
</html>