<?php 
require_once "../helper.php";
require_once "api.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = $_POST["name"];
    $new_password = $_POST["password"];

    update_user(false, $_GET["id"], $new_name, $new_password);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>[admin] Обновление пользователя</title>
    <style>span { margin: 10px; }</style>
</head>
<body>
<h1>Редактирование пользователя</h1>
<?php 
$db = openMysqli();
$userID = $_GET["id"];

$result = read_user(false, $userID)[0];

if ($result) {
    echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $userID . "'>
    Имя: <input name='name' value='" . $result["name"] . "' required><br>
    Новый пароль: <input type='password' name='password' value='' required><br>
    <button type='submit'>Сохранить</button>
    </form>";
    echo "<button onclick='window.location.replace(\"/admin-only/user-list.php\")'>Назад</button>";
}
else {
    echo "<p style='color: #ff0000'>Ошибка: пользователь с id=" . $userID . " не найден.</p>";
}
$db->close();
?>
</body>
</html>