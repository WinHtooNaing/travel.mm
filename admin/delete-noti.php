<?php 
require '../config/config.php';
$stmt = $pdo->prepare("DELETE FROM reports WHERE id=".$_GET['id']);
$stmt->execute();

header("Location: notification.php");