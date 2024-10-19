<?php 
require_once "../helper.php";
require_once "api.php";

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    delete_service(false, $id, "", "", 0);
}
else {
    $result = read_service(false, $id)[0];

    if ($result) {
        echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id . "'>
        Вы действительно хотите удалить услугу " . $result["title"] . "?<br>
        <button type='submit'>Удалить</button>
        </form>";
        echo "<button onclick='window.location.replace(\"/admin-only/service-list.php\")'>Назад</button>";
    }
    else {
        echo "<p style='color: #ff0000'>Ошибка: услуга с id=" . $id . " не найдена.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>[admin] Удаление услуги</title>
    <style>span { margin: 10px; }</style>
</head>
</html>