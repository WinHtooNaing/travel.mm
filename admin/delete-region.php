<?php 
require '../config/config.php';
$stmt = $pdo->prepare("DELETE FROM region WHERE id=".$_GET['id']);
$stmt->execute();

header("Location: region-category.php");
