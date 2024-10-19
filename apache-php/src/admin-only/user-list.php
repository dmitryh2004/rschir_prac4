<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>[admin] Список пользователей</title>
    <style>span { margin: 10px; }</style>
</head>
<style>
    table {
        text-align: center;
    }
</style>
<body>
<h1>Список пользователей</h1>
<?php
require_once '../helper.php';
require_once 'api.php';
$result = read_user(false, 0);
?>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Имя пользователя</th>
        <th>Хэш пароля</th>
        <th>Действия</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['ID']); ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td><?php echo htmlspecialchars($row['password']); ?></td>
            <td>
                <?php 
                    $current_user = $_SERVER['REMOTE_USER'];
                    if ($current_user != $row['name']) {
                        echo "<a href='/admin-only/user-update.php?id=" . $row['ID'] . "'>Редактировать</a><br>";
                        echo "<a href='/admin-only/user-delete.php?id=" . $row['ID'] . "'>Удалить</a>";
                    }
                    else {
                        echo "<b>(Это вы)</b>";
                    }
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="4">
            <button onclick="window.location.replace('user-create.php');">Добавить пользователя</button>
        </td>
    </tr>
</table>
<button onclick="window.location.replace('/admin-only/service-list.php')">К редактированию услуг</button>
<button onclick="window.location.replace('/index.html')">На главную</button>
</body>
</html>