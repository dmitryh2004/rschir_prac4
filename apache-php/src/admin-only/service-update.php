<?php 
require_once "../helper.php";
require_once "api.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_title = $_POST["title"];
    $new_description = $_POST["description"];
    $new_cost = $_POST["cost"];
    update_service(false, $_GET["id"], $new_title, $new_description, $new_cost);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>[admin] Обновление услуги</title>
    <style>span { margin: 10px; }</style>
</head>
<body>
<h1>Редактирование услуги</h1>
<?php 
$db = openMysqli();
$serviceID = $_GET["id"];

$result = read_service(false, $serviceID)[0];

if ($result) {
    echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $serviceID . "'>
    Название: <input name='title' value='" . $result["title"] . "' required><br>
    Описание: <input name='description' value='" . $result["description"] . "' required><br>
    Цена: <input type='number' name='cost' value='" . $result["cost"] . "' required><br>
    <button type='submit'>Сохранить</button>
    </form>";
    echo "<button onclick='window.location.replace(\"/admin-only/service-list.php\")'>Назад</button>";
}
else {
    echo "<p style='color: #ff0000'>Ошибка: услуга с id=" . $serviceID . " не найдена.</p>";
}
$db->close();
?>
</body>
</html>