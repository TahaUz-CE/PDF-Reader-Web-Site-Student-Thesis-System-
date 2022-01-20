
<?php

include "baglan.php";

if(isset($_GET['sil'])){
    $sqlsil="DELETE FROM `pdf_bilgi` WHERE `pdf_bilgi`.`id` = ?";
    $sorgusil=$baglan->prepare($sqlsil);
    $sorgusil->execute([
        $_GET['sil']
    ]);

    header('Location:pdfbilgi.php');

}

if(isset($_GET['sec'])){
    echo $_GET['ders'];
    echo $_GET['search'];
    echo $_GET['donem'];
    echo $_GET['dersadi'];
    $sql="SELECT * FROM `pdf_bilgi` WHERE `pdf_bilgi`.`yazar_ad_soyad` = '".$_GET['search']."' AND `pdf_bilgi`.`teslim_donem` = '".$_GET['donem']."' AND 
    `pdf_bilgi`.`ders_adi` = '".$_GET['dersadi']."' AND (`pdf_bilgi`.`yil` = '".$_GET['ders']."' OR `pdf_bilgi`.`yil` = '".($_GET['ders']+1)."')";
    $sorgu = $baglan->prepare($sql);
    $sorgu->execute();
}

if(!isset($_GET['sec'])){
    $sql ="SELECT * FROM pdf_bilgi";
    $sorgu = $baglan->prepare($sql);
    $sorgu->execute();
}



?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF - PDF Bilgi 2 Panel</title>
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
                        <a href="indexadmin.php" class="btn btn-outline-primary">Home</a>
                        <a href="pdfbilgi.php" class="btn btn-outline-primary">Sorgu 1</a>
                        <a href="pdfbilgi2.php" class="btn btn-outline-primary">Sorgu 2</a>
                    </div>
                </div>
            </div>
        </div>
    
    </header>
    <main>
        <div class="container">
            <div class="row mt-4">
                <div class="col-6">
                    <form action="pdfbilgi2.php" method="get">
                    <p>
                        <input type="radio" name="ders" value="2011"/>2011-2012<br/>
                        <input type="radio" name="ders" value="2012"/>2012-2013<br/>
                        <input type="radio" name="ders" value="2013"/>2013-2014<br/>
                        <input type="radio" name="ders" value="2014"/>2014-2015<br/>
                        <input type="radio" name="ders" value="2015"/>2015-2016<br/>
                        <input type="radio" name="ders" value="2016"/>2016-2017<br/>
                        <input type="radio" name="ders" value="2017"/>2017-2018<br/>
                        <input type="radio" name="ders" value="2018"/>2018-2019<br/>
                        <input type="radio" name="ders" value="2019"/>2019-2020<br/>
                        <input type="radio" name="ders" value="2020"/>2020-2021<br/>
                        <input type="radio" name="ders" value="2021"/>2021-2022<br/>
                        <input type="radio" name="donem" value="GUZ"/>GUZ<br/>
                        <input type="radio" name="donem" value="BAHAR"/>BAHAR<br/>
                        <label for="search" class="form-label">YAZAR ADI SOYADI</label>
                        <input type="text" class="form-control" name="search">
                        <label for="dersadi" class="form-label">DERS ADI</label>
                        <input type="text" class="form-control" name="dersadi">
                    </p>
                    <p><input type="submit" name="sec" value="ARA"/><br/>
                    </form>
                </div>
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
                                <td>
                                    <div class="btn-group">
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
