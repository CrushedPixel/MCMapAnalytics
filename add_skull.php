<?php
REQUIRE_ONCE "database_connection.php";

function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        // 32 bits for "time_low"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),

        // 16 bits for "time_mid"
        mt_rand( 0, 0xffff ),

        // 16 bits for "time_hi_and_version",
        // four most significant bits holds version number 3
        mt_rand( 0, 0x0fff ) | 0x3000,

        // 16 bits, 8 bits for "clk_seq_hi_res",
        // 8 bits for "clk_seq_low",
        // two most significant bits holds zero and one for variant DCE1.1
        mt_rand( 0, 0x3fff ) | 0x8000,

        // 48 bits for "node"
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}

$player = null;

if(isset($_GET["player"])) {
    $player = $_GET["player"];
} elseif(isset($_POST["player"])) {
    $player = $_POST["player"];
}

if($player == null or strlen($player) == 0) {
    header("Location: http://crushedpixel.eu/analytics/index.php?empty=true");
    exit;
}

global $con;

$sql = 'INSERT INTO projects (player) VALUES(?)';
$stmt = $con->prepare($sql);
$stmt->bindValue(1, $player);
$stmt->execute();

//the auto-increment
$id = $con->lastInsertId();

$command = "/give @p minecraft:skull 1 3 {SkullOwner:{Id:".gen_uuid().",Properties:{textures:[{Value:"
    .base64_encode('{textures:{SKIN:{url:"http://crushedpixel.eu/analytics/get_skull/MCAnalytics_'.$id.'"}}}')."}]}}}";

$sql = 'UPDATE projects SET command=? WHERE id=?';
$stmt = $con->prepare($sql);
$stmt->bindValue(1, $command);
$stmt->bindValue(2, $id);
$stmt->execute();

header("Location: http://crushedpixel.eu/analytics/view/".$id);
?>