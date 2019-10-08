<?php
try {
	$pdo = new PDO('mysql:host=localhost;dbname=project', 'root', '');
} catch (PDOException $e) {
	exit('Database error.');
}
?>
