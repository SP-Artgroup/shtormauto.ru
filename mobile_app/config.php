<?php
header("Content-Type: application/x-javascript");
$hash = "bx_random_hash";
$config = array(
    "appmap" => array(
        "main" => "/mobile_app/index.php",
        "left" => "/mobile_app/left.php",
        "settings" => "/mobile_app/settings.php",
        "hash" => substr($hash, rand(1, strlen($hash)))
    )
);
echo json_encode($config);
?>