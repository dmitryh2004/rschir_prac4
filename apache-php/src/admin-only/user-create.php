<?php 
require_once "../helper.php";
require_once "api.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_name = $_POST["name"];
    $new_password = $_POST["password"];

    create_user(false, 0, $new_name, $new_password);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>[admin] Добавление пользователя</title>
    <style>span { margin: 10px; }</style>
</head>
<body>
<h1>Добавление пользователя</h1>
<?php 
echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>
Имя: <input name='name' required><br>
Пароль: <input type='password' name='password' required><br>
<button type='submit'>Сохранить</button>
</form>";
echo "<button onclick='window.location.replace(\"/admin-only/user-list.php\")'>Назад</button>";
?>
</body>
</html>