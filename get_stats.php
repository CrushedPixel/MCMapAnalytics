<?php
REQUIRE_ONCE "database_connection.php";

global $con;

if(isset($_GET["id"])) {
    $id = $_GET["id"];
} elseif(isset($_POST["id"])) {
    $id = $_POST["id"];
}

header('Content-Type: application/json');

if(!is_numeric($id) or $id == -1) {
    echo json_encode(array("error" => "This project does not exist!"));
    exit;
}

$sql = 'SELECT * FROM projects WHERE id=?';
$stmt = $con->prepare($sql);
$stmt->bindParam(1, $id);
$stmt->execute();

while($row = $stmt->fetch()) {
    $command = $row["command"];
    break;
}

if(!isset($command)) {
    echo json_encode(array("error" => "This project does not exist!"));
    exit;
}

$sql = "SELECT COUNT(*) as count FROM tracked WHERE project=?";
$stmt = $con->prepare($sql);
$stmt->bindParam(1, $id);
$stmt->execute();

$total = 0;
while($row = $stmt->fetch()) {
    $total = $row["count"];
    break;
}

$sql = "SELECT country,COUNT(*) as count FROM tracked WHERE project=? GROUP BY country ORDER BY count DESC, country ASC";
$stmt = $con->prepare($sql);
$stmt->bindParam(1, $id);
$stmt->execute();

$pairs = array();
while($row = $stmt->fetch()) {
    $pairs[] = array("country" => $row["country"], "count" => $row["count"], "percentage" => (int)(100*($row["count"]/$total)));
}

$sql = "SELECT org,COUNT(*) as count FROM tracked WHERE project=? GROUP BY org ORDER BY count DESC";
$stmt = $con->prepare($sql);
$stmt->bindParam(1, $id);
$stmt->execute();

$providers = array();
while($row = $stmt->fetch()) {
    $providers[] = array("provider" => $row["org"], "count" => $row["count"], "percentage" => (int)(100*($row["count"]/$total)));
}

$sql = "SELECT java,COUNT(*) as count FROM tracked WHERE project=? GROUP BY java ORDER BY count DESC";
$stmt = $con->prepare($sql);
$stmt->bindParam(1, $id);
$stmt->execute();

$java = array();
while($row = $stmt->fetch()) {
    $java[] = array("version" => $row["java"], "count" => $row["count"], "percentage" => (int)(100*($row["count"]/$total)));
}

echo json_encode(array("command" => $command, "total" => $total, "countries" => $pairs, "providers" => $providers, "java_versions" => $java));
?>