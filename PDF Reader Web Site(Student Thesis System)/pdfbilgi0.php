
<?php
session_start();
include "baglan.php";

if(isset($_GET['sil'])){
    $sqlsil="DELETE FROM `pdf_bilgi` WHERE `pdf_bilgi`.`id` = ?";
    $sorgusil=$baglan->prepare($sqlsil);
    $sorgusil->execute([
        $_GET['sil']
    ]);

    header('Location:pdfbilgi.php');

}

$sql ="SELECT * FROM pdf_bilgi WHERE `pdf_bilgi`.`kullanici` = '".$_SESSION['username']."'" ;
$sorgu = $baglan->prepare($sql);
$sorgu->execute();

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF - PDF Bilgi 0 Panel</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    
    <header>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-1 text-center">PDF DATABASE PANEL</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="btn-group">
                        <a href="welcome.php" class="btn btn-outline-primary">Home</a>
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
                                <th>Kullanici Ismi</th>
                                <th>Yil</th>
                                <th>Yazar Ad Soyad</th>
                                <th>Ogrenci No</th>
                                <th>Ogretim Turu</th>
                                <th>Ders Adi</th>
                                <th>Ozet</th>
                                <th>Teslim Donemi</th>
                                <th>Proje Adi</th>
                                <th>Anahtar Kelimeler</th>
                                <th>Danisma Bilgi</th>
                                <th>Juri Bilgi</th>
                                <th>Juri Bilgi 2</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($satir = $sorgu->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?=$satir['id']?></td>
                                <td><?=$satir['kullanici']?></td>
                                <td><?=$satir['yil']?></td>
                                <td><?=$satir['yazar_ad_soyad']?></td>
                                <td><?=$satir['yazar_ogrno']?></td>
                                <td><?=$satir['yazar_ogrturu']?></td>
                                <td><?=$satir['ders_adi']?></td>
                                <td><?=$satir['ozet']?></td>
                                <td><?=$satir['teslim_donem']?></td>
                                <td><?=$satir['proje_adi']?></td>
                                <td><?=$satir['anahtarkelimeler']?></td>
                                <td><?=$satir['danisman_bilgi']?></td>
                                <td><?=$satir['juri_bilgi']?></td>
                                <td><?=$satir['juri_bilgi2']?></td>
                                
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
