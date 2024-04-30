<?php 
require '../config/config.php';
$stmt = $pdo->prepare("DELETE FROM photo WHERE id=".$_GET['id']);
$stmt->execute();

header("Location: image.php");