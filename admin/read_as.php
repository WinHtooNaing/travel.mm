<?php 
require '../config/config.php';
$stmt = $pdo->prepare("UPDATE reports SET read_as=1 WHERE id=".$_GET['id']);
$stmt->execute();

header("Location: notification.php");