<?php
try {
	$pdo = new PDO('mysql:host=localhost;dbname=opus', 'phelpstech', 'Sw0rd0ftruth@');
} catch (PDOException $e) {
	exit('Database error: ' . $e);
}
?>
