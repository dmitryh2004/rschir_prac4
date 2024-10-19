<?php 
require_once "../helper.php";
require_once "api.php";

$userID = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    delete_user(false, $userID, "", "");
}
else {
    $result = read_user(false, $userID)[0];

    if ($result) {
        echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $userID . "'>
        Вы действительно хотите удалить пользователя с именем " . $result["name"] . "?<br>
        <button type='submit'>Удалить</button>
        </form>";
        echo "<button onclick='window.location.replace(\"/admin-only/user-list.php\")'>Назад</button>";
    }
    else {
        echo "<p style='color: #ff0000'>Ошибка: пользователь с id=" . $userID . " не найден.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>[admin] Удаление пользователя</title>
    <style>span { margin: 10px; }</style>
</head>
</html>