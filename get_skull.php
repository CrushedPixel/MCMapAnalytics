<?php
REQUIRE_ONCE "database_connection.php";

function get_http_response_code($url) {
    $headers = get_headers($url);
    return substr($headers[0], 9, 3);
}

$id = -1;

if(isset($_GET["id"])) {
    $id = $_GET["id"];
} elseif(isset($_POST["id"])) {
    $id = $_POST["id"];
}

if(!is_numeric($id) or $id == -1) {
    echo "nonum";
    exit;
}

global $con;

$sql = 'SELECT * FROM projects WHERE id=?';
$stmt = $con->prepare($sql);
$stmt->bindParam(1, $id);
$stmt->execute();

while($row = $stmt->fetch()) {
    $player = $row["player"];
    break;
}

if(!isset($player)) {
    echo "noplayer";
    exit;
}

//should be Java/[java version]
$u_agent = $_SERVER['HTTP_USER_AGENT'];

$split = explode("/",$u_agent);

//only track the call if it comes from Minecraft (i.e. a Java application)
if($split[0] == "Java") {

    //first track the player's click
    $ip = $_SERVER['REMOTE_ADDR'];
    $details = json_decode(file_get_contents("http://ipinfo.io/".$ip."/json"), true);

    //if IP already tracked, remove old info
    $sql = 'DELETE FROM tracked WHERE ip=? AND project=?';
    $stmt = $con->prepare($sql);
    $stmt->bindValue(1, $details["ip"]);
    $stmt->bindParam(2, $id);
    $stmt->execute();

    //insert new values
    $sql2 = 'INSERT INTO tracked VALUES (?,?,?,?,?,?,?,?)';

    $stmt2 = $con->prepare($sql2);
    //storing the IP address to avoid duplicates - won't be publicly accessible
    $stmt2->bindValue(1, $details["ip"]);
    $stmt2->bindValue(2, $details["hostname"]);
    $stmt2->bindParam(3, $details["city"]);
    $stmt2->bindValue(4, $details["country"]);
    $stmt2->bindValue(5, $details["loc"]);
    $stmt2->bindValue(6, $details["org"]);
    $stmt2->bindValue(7, $split[1]); //The Java version
    $stmt2->bindParam(8, $id);

    $stmt2->execute();
}

//finally, return the skin
header('Content-Type:image/png');
header("Content-Disposition: inline; filename=cp_analytics_".$id);

$default_skin = "http://minotar.net/skin/char";

if(!is_null($player)) {
    $url = "http://minotar.net/skin/".$player;
    if(get_http_response_code($url) == 404) {
        echo file_get_contents($default_skin);
        exit;
    }
    echo file_get_contents($url);
} else {
    echo file_get_contents($default_skin);
}

?>