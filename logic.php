<?php
require_once(__DIR__ .'/connect.php');

$sql = "SELECT services.img_path, services.name, workers.name AS workers_name, services.description, services.cost
        FROM services
        INNER JOIN workers ON services.id_worker = workers.id";

$arBind = [];
$params = [];

if (!isset($_GET['clearFilter'])) {
    if (count($_GET) > 0) {
        if (!empty($_GET['name'])) {
            $arBind[] = "services.name LIKE :name";
            $params[':name'] = '%' . $_GET['name'] . '%';
        }
        if (!empty($_GET['description'])) {
            $arBind[] = "services.description LIKE :description";
            $params[':description'] = '%' . $_GET['description'] . '%';
        }
        if (!empty($_GET['priceFrom'])) {
            $arBind[] = "services.cost >= :priceFrom";
            $params[':priceFrom'] = $_GET['priceFrom'];
        }
        if (!empty($_GET['priceTo'])) {
            $arBind[] = "services.cost <= :priceTo";
            $params[':priceTo'] = $_GET['priceTo'];
        }
        if (!empty($_GET['id_worker'])) {
            $arBind[] = "workers.id  LIKE :id_worker";
            $params[':id_worker'] = '%' . $_GET['id_worker'] . '%';
        }

        if (count($arBind) > 0) {
            $where = 'WHERE ' . implode(' AND ', $arBind);
            $sql .= ' ' . $where;
        }
    }
}
else{
    // Перенаправить пользователя на страницу без параметров фильтрации
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

$stmt = $pdo->prepare($sql);

foreach ($params as $paramName => $paramValue) {
    if (is_numeric($paramValue)) {
        $stmt->bindValue($paramName, $paramValue, PDO::PARAM_INT);
    } else {
        $stmt->bindValue($paramName, $paramValue, PDO::PARAM_STR);
    }
}

$stmt->execute();

$fullList = [];

while ($row = $stmt->fetch()) {
    $fullList[] = $row;
}

$selectA = [];
$query = "SELECT * FROM workers";
$stmt = $pdo->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch()) {
    $selectA[] = $row;
}

if (isset($_GET['clearFilter'])) {
    // Перенаправляем пользователя обратно на страницу с очищенными полями
    header("Location: services.php");
    exit; // Останавливаем выполнение текущего скрипта
  }
?>
