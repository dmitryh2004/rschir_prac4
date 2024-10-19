<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Информация об услуге</title>
</head>
<body>
<?php require_once 'helper.php'; $id = $_GET["id"];
if (!isset($id) || !is_numeric($id)) throw new Exception();

$mysqli = openMysqli();
$stmt = $mysqli->prepare('SELECT * FROM services WHERE id=?');
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$service = $result->fetch_assoc();
echo "<h1>Описание услуги</h1>";
echo "<table border='1'>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Описание</th>
        <th>Стоимость</th>
    </tr>
    <tr>
        <td>" . $service['ID'] . "</td>
        <td>" . $service['title'] . "</td>
        <td>" . $service['description'] . "</td>
        <td>" . $service['cost'] . "</td>
    </tr>
</table>";
$mysqli->close();
?>
<button onclick="window.location.replace('/services.php')">Назад</button>
<button onclick="window.location.replace('/index.html')">На главную</button>
</body>
</html>