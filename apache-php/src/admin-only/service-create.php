<?php 
require_once "../helper.php";
require_once "api.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_title = $_POST["title"];
    $new_description = $_POST["description"];
    $new_cost = $_POST["cost"];
    create_service(false, 0, $new_title, $new_description, $new_cost);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>[admin] Добавление услуги</title>
    <style>span { margin: 10px; }</style>
</head>
<body>
<h1>Добавление услуги</h1>
<?php 
echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
Название: <input name='title' required><br>
Описание: <input name='description' required><br>
Цена: <input type='number' name='cost' required><br>
<button type='submit'>Сохранить</button>
</form>";
echo "<button onclick='window.location.replace(\"/admin-only/service-list.php\")'>Назад</button>";
?>
</body>
</html>