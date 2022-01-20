 
<?php
/* Sürücü isteğiyle bir ODBC veritabanına bağlanalım */
$dsn = 'mysql:dbname=login_register_pure_coding;host=localhost';
$user = 'root';
$password = '12345';
 
try {
    $baglan = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Bağlantı kurulamadı: ' . $e->getMessage();
}
 
?>