
<?php

include "baglan.php";

if(isset($_GET['sil'])){
    $sqlsil="DELETE FROM `users` WHERE `users`.`id` = ?";
    $sorgusil=$baglan->prepare($sqlsil);
    $sorgusil->execute([
        $_GET['sil']
    ]);

    header('Location:indexadmin.php');

}

$sql ="SELECT * FROM users";
$sorgu = $baglan->prepare($sql);
$sorgu->execute();

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Database Panel</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    
    <header>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-1 text-center">ADMIN DATABASE PANEL</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="btn-group">
                        <a href="indexadmin.php" class="btn btn-outline-primary">Home</a>
                        <a href="ekle.php" class="btn btn-outline-primary">Add User</a>
                        <a href="pdfbilgi.php" class="btn btn-outline-primary">PDF Database</a>
                        <a href="logout.php" class="btn btn-outline-primary">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    
    </header>
    <main>
        <div class="container">
            <div class="row mt-4">
                <div class="col">
                    <table class="table table-hover table-dark table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User Name</th>
                                <th>E-Mail</th>
                                <th>Password</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?=$satir['id']?></td>
                                <td><?=$satir['username']?></td>
                                <td><?=$satir['email']?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="guncelle.php?id=<?=$satir['id']?>" class="btn btn-secondary">Güncelle</a>
                                        <a href="?sil=<?=$satir['id']?>" onclick="return confirm('Silinsin mi?')" class="btn btn-danger">Kaldır</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    
    </main>
    <footer></footer>
</body>
</html>
