<?php 
require_once "../helper.php";

function read_user($debug = false, $id = 0) {
    $mysqli = openMysqli();
    $query_template = "SELECT * FROM users";
    if ($id != 0) {
        $query_template = $query_template . " WHERE id = ?";
    }
    $stmt = $mysqli->prepare($query_template);
    if ($id != 0) {
        $stmt->bind_param("i", $id);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    if ($debug) {
        echo json_encode($data);
    }
    else {
        return $data;
    }
}

function read_service($debug = false, $id = 0) {
    $mysqli = openMysqli();
    $query_template = "SELECT * FROM services";
    if ($id != 0) {
        $query_template = $query_template . " WHERE id = ?";
    }
    $stmt = $mysqli->prepare($query_template);
    if ($id != 0) {
        $stmt->bind_param("i", $id);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    if ($debug) {
        echo json_encode($data);
    }
    else {
        return $data;
    }
}

function create_user($debug = false, $id = 0, $name = "", $password = "") {
    $db = openMysqli();
    $stmt = $db->prepare("INSERT INTO users (name, password) VALUES (?, ?)");

    $hash_password = hash_password($password);

    $stmt->bind_param("ss", $name, $hash_password);
    $stmt->execute();

    echo "Новый пользователь добавлен.";
    $db->close();
}

function create_service($debug = false, $id = 0, $title = "", $description = "", $cost = 0) {
    $db = openMysqli();
    $stmt = $db->prepare("INSERT INTO services (title, description, cost) VALUES (?, ?, ?)");

    $stmt->bind_param("ssi", $title, $description, $cost);
    $stmt->execute();

    echo "Новая услуга добавлена.";
    $db->close();
}

function update_user($debug = false, $id = 0, $name = "", $password = "") {
    $db = openMysqli();
    $stmt = $db->prepare("UPDATE users SET name = ?, password = ? WHERE id = ?");

    $hash_password = hash_password($password);

    $stmt->bind_param("ssi", $name, $hash_password, $id);
    $stmt->execute();

    echo "Данные сохранены.";
    $db->close();
}

function update_service($debug = false, $id = 0, $title = "", $description = "", $cost = 0) {
    $db = openMysqli();
    $stmt = $db->prepare("UPDATE services SET title = ?, description = ?, cost = ? WHERE id = ?");

    $stmt->bind_param("ssii", $title, $description, $cost, $id);
    $stmt->execute();

    echo "Данные сохранены.";
    $db->close();
}

function delete_user($debug = false, $id = 0, $name = "", $password = "") {
    $db = openMysqli();
    $stmt = $db->prepare("DELETE FROM users WHERE id = ?");

    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "Данные о пользователе удалены.<br>";
    echo "<button onclick='window.location.replace(\"/admin-only/user-list.php\")'>Назад</button>";

    $stmt2 = $db->prepare("ALTER TABLE users AUTO_INCREMENT = 1");
    $stmt2->execute();
    $db->close();
}

function delete_service($debug = false, $id = 0, $title = "", $description = "", $cost = 0) {
    $db = openMysqli();
    $stmt = $db->prepare("DELETE FROM services WHERE id = ?");

    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "Данные об услуге удалены.<br>";
    echo "<button onclick='window.location.replace(\"/admin-only/service-list.php\")'>Назад</button>";

    $stmt2 = $db->prepare("ALTER TABLE services AUTO_INCREMENT = 1");
    $stmt2->execute();
    $db->close();
}

// для тестирования с постманом
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["postman"])) {
        $operation = $_GET["op"];
        $table = $_GET["table"];

        $id = isset($_GET["id"]) ? $_GET["id"] : 0;

        $func_name = $operation . "_" . $table;
        $func_name(true, $id);
    }
}
else if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if (isset($_POST["postman"])) {
        $operation = $_POST["op"];
        $table = $_POST["table"];

        $id = isset($_POST["id"]) ? $_POST["id"] : 0;
        $name = isset($_POST["name"]) ? $_POST["name"] : "";
        $password = isset($_POST["password"]) ? $_POST["password"] : "";

        $title = isset($_POST["title"]) ? $_POST["title"] : "";
        $description = isset($_POST["description"]) ? $_POST["description"] : "";
        $cost = isset($_POST["cost"]) ? $_POST["cost"] : "";

        $func_name = $operation . "_" . $table;
        if ($table == "user") {
            $func_name(true, $id, $name, $password);
        }
        else if ($table == "service") {
            $func_name(true, $id, $title, $description, $cost);
        }
    }
}
?>