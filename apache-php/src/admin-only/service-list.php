<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>[admin] Список услуг</title>
    <style>span { margin: 10px; }</style>
</head>
<style>
    table {
        text-align: center;
    }
</style>
<body>
<h1>Список услуг</h1>
<?php
require_once '../helper.php';
require_once 'api.php';
$result = read_service(false, 0);
?>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Описание</th>
        <th>Стоимость</th>
        <th>Действия</th>
    </tr>
    <?php foreach ($result as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['ID']); ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td><?php echo htmlspecialchars($row['cost']); ?></td>
            <td>
                <?php 
                    echo "<a href='/admin-only/service-update.php?id=" . $row['ID'] . "'>Редактировать</a><br>";
                    echo "<a href='/admin-only/service-delete.php?id=" . $row['ID'] . "'>Удалить</a>";
                ?>
            </td>
        </tr>
    <?php endforeach; ?>
    <tr>
        <td colspan="5">
            <button onclick="window.location.replace('service-create.php');">Добавить услугу</button>
        </td>
    </tr>
</table>
<button onclick="window.location.replace('/admin-only/user-list.php')">К редактированию пользователей</button>
<button onclick="window.location.replace('/index.html')">На главную</button>
</body>
</html>