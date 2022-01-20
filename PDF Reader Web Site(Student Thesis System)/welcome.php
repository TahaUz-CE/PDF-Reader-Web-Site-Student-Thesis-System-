<?php 

session_start();

if (!isset($_SESSION['username'])) {
    $admin = "admin";
		$username = $_SESSION['username'];

		if($admin == $username){
			header("Location: indexadmin.php");
		}else{
            header("Location: index.php");
        }
}

require('class.pdf2text.php');
extract($_POST);

if(isset($readpdf)){
      
    if($_FILES['file']['type']=="application/pdf") {
        
        $a = new PDF2Text();
        $a->setFilename($_FILES['file']['tmp_name']); 
        $a->decodePDF();
        
        $samanlık = $a->output();
        $iğne0   = 'BOLU';
        $konum0 = strpos($samanlık, $iğne0);
        
        $iğne   = 'BOLU';
        $konum = strpos($samanlık, $iğne,$konum0);
        
        $iğne2   = 'Tarih:';
        $konum2 = strpos($samanlık, $iğne2);

        $iğne3   = 'OZET';
        $konum3 = strpos($samanlık, $iğne3);

        $iğne6   = 'Keywords:';
        $konum6 = strpos($samanlık, $iğne6);

        $iğne4   = 'GIRIS';
        $konum4 = strpos($samanlık, $iğne4);

        $konum5 = strpos($samanlık, $iğne4,$konum4+5);

        $iğne7   = 'No';
        $konum7 = strpos($samanlık, $iğne7);

        $iğne8   = 'Adi Soyadi';
        $konum8 = strpos($samanlık, $iğne8);

        $iğne9   = 'I';
        $konum9 = strpos($samanlık, $iğne9,$konum8);

        $iğne10   = 'TEZI';
        $konum10 = strpos($samanlık, $iğne10);

        $ozet_database = '';
        // Ozet
        for ($j = $konum3; $j < $konum6; $j++) {
            $ozet_database[$j-$konum3] =  $samanlık[$j];
        }

        // echo $ozet_database;

        $keywords_database = '';
        // Keywords
        for ($k = $konum6+10; $k < $konum5; $k++) {
            $keywords_database[$k - ($konum6+10)] =  $samanlık[$k];
        }

        // echo $keywords_database;

        $ogrno_database = '';
        // Ogrenci No
        for ($z = $konum7+3; $z < $konum8; $z++) {
            if($samanlık[$z] <= 9 && $samanlık[$z] >= 0 && $samanlık[$z] != ' '){
                $ogrno_database[$z - ($konum7+3)] = $samanlık[$z];
            }
        }
        
        // echo $ogrno_database;

        $ögrenim_turu_database = '';
        // Öğretim Türü
        if($ogrno_database[8] == 1){
            $ögrenim_turu_database =  "1";
        }else{
            $ögrenim_turu_database =  "2";
        }

        // echo $ögrenim_turu_database;

        $ad_soyad_database = '';
        $uzunluk = 0;
        // Adi Soyadi
        for ($z = $konum8+14; $z < $konum9; $z++) {
            $ad_soyad_database[$z - ($konum8+14)] = $samanlık[$z];
            $uzunluk++;
        }

        // echo $ad_soyad_database;

        $iğne11   = '20';
        $konum11 = strpos($samanlık, $iğne11);

        $proje_adi_database = '';
        // Ders Adı
        for ($z = $konum10+15; $z < $konum11-25-$uzunluk; $z++) {
            
            $proje_adi_database[$z - $konum10+15] = $samanlık[$z]; 
        }
        
        
        // echo $proje_adi_database;

        $iğne12   = 'BOLU';
        $konum12 = strpos($samanlık, $iğne12,$konum11);

        $ders_adi_database = '';
        // Ders Adı
        for ($z = $konum12+10; $z < $konum12+30 ; $z++) {
            $ders_adi_database[$z - $konum12+10] = $samanlık[$z];
        }
        
        // echo $ders_adi_database;

        $uyeler_adi_database = '';
        
        for ($z = (($konum12-5)+strlen($proje_adi_database)+strlen($ad_soyad_database)); $z < $konum2-20 ; $z++) {
            if(($samanlık[$z]>= 'a' && $samanlık[$z]<= 'z') || ($samanlık[$z]>= 'A' && $samanlık[$z]<= 'Z')){
                $uyeler_adi_database[$z - (($konum12-5)+strlen($proje_adi_database)+strlen($ad_soyad_database))] = $samanlık[$z];
            }
            
        }

        //echo $uyeler_adi_database;

        $danisman_adi_database = '';
        $juri_adi_database = '';
        $juri_adi1_database = '';
        
        // Danisman Adi
        $iğne13   = 'Dani';
        $konum13 = strpos($uyeler_adi_database, $iğne13);

        // Juri Adi
        $iğne14   = 'Juri';
        $konum14 = strpos($uyeler_adi_database, $iğne14);

        // Juri1 Adi
        $iğne15   = 'Juri';
        $konum15 = strpos($uyeler_adi_database, $iğne15,$konum14+5);

        for ($z = 0; $z < $konum13 ; $z++) {
            $danisman_adi_database[$z] = $uyeler_adi_database[$z];
        }

        for ($z = $konum13+25; $z < $konum14 ; $z++) {
            $juri_adi_database[$z - ($konum13+25)] = $uyeler_adi_database[$z];
        }

        for ($z = $konum14+27; $z < $konum15 ; $z++) {
            $juri_adi1_database[$z - ($konum14+27)] = $uyeler_adi_database[$z];
        }

        // echo $danisman_adi_database;
        // echo $juri_adi_database;
        // echo $juri_adi1_database;

        $tez_tarih_database = '';

        for ($z = $konum2+5; $z < $konum2+25 ; $z++) {
            if(($samanlık[$z] >= 0 && $samanlık[$z] <= 9) || $samanlık[$z] === '.'){
                $tez_tarih_database[$z - $konum2+5] = $samanlık[$z];
            }
        }

        // echo $tez_tarih_database;
        
        //$iğne16   = '6';
        //$konum16 = strpos($tez_tarih_database, $iğne16);

        //echo $konum16;

        // Tez Donemi
        $tez_donem_database = '';
        if(($tez_tarih_database[17] >= 9 && $tez_tarih_database[17] <= 12) || $tez_tarih_database[17] <= 2){
            $tez_donem_database = "GUZ";
        }else{
            $tez_donem_database = "BAHAR";
        }

        // echo $tez_donem_database ;

        // Yil
        $iğne16   = 'KOCAELI';
        $konum16 = strpos($samanlık, $iğne16,$konum11);

        $yil_database = '';
        for ($z = $konum11; $z < $konum16 ; $z++) {
            if($samanlık[$z] <= 9 && $samanlık[$z] >= 0 && $samanlık[$z] != ' '){
                $yil_database[$z - ($konum11)] = $samanlık[$z];
            }
        }

        // Temizle
        $yukleyen_kullanici_ad = $_SESSION['username'];
        $yil_database = trim($yil_database);
        $ad_soyad_database = trim($ad_soyad_database);
        $ogrno_database = trim($ogrno_database);
        $ögrenim_turu_database = trim($ögrenim_turu_database);
        $ders_adi_database = trim($ders_adi_database);
        $ozet_database = trim($ozet_database);
        $tez_donem_database = trim($tez_donem_database);
        $proje_adi_database = trim($proje_adi_database);
        $keywords_database = trim($keywords_database);
        $danisman_adi_database = trim($danisman_adi_database);
        $juri_adi_database = trim($juri_adi_database);
        $juri_adi1_database = trim($juri_adi1_database);

        // MYSQL DATABASE CONNECTION

        include "baglan.php";
        $sql = "INSERT INTO `pdf_bilgi` (`kullanici`, `yil`,`yazar_ad_soyad`, `yazar_ogrno`, `yazar_ogrturu`, `ders_adi`, `ozet`, `teslim_donem`, `proje_adi`, `anahtarkelimeler`, `danisman_bilgi`, `juri_bilgi`, `juri_bilgi2`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $dizi =[
            $yukleyen_kullanici_ad,
            $yil_database,
            $ad_soyad_database,
            $ogrno_database,
            $ögrenim_turu_database,
            $ders_adi_database,
            $ozet_database,
            $tez_donem_database,
            $proje_adi_database,
            $keywords_database,
            $danisman_adi_database,
            $juri_adi_database,
            $juri_adi1_database
        ];
 
        $sth = $baglan->prepare($sql);
        $sonuc = $sth->execute($dizi);

    }
    else {
        echo "<p style='color:red;text-align:center'>
            Wrong file format</p>";
    }
    
} 

if (isset($readpdf)) {
     // name of the uploaded file
     $filename = $_FILES['file']['name'];

     // destination of the file on the server
     $destination = 'C:/xampp/htdocs/Complete Login Form With Session Variable Using Only PHP & MySQL/' . $filename;
 
     // get the file extension
     $extension = pathinfo($filename, PATHINFO_EXTENSION);
 
     // the physical file on a temporary uploads directory on the server
     $file = $_FILES['file']['tmp_name'];
     $size = $_FILES['file']['size'];
 
     if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
         echo "You file extension must be .zip, .pdf or .docx";
     } elseif ($_FILES['file']['size'] > 100000000) { // file shouldn't be larger than 1Megabyte
         echo "File too large!";
     } else {
        if(move_uploaded_file($file, $destination)){
            
            echo "<script>alert('Yes, you did it.')</script>";    
        }
        
     }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home5.css">
    <script src="https://kit.fontawesome.com/c20485228a.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="owl/owl.carousel.min.css">
    <link rel="stylesheet" href="owl/owl.theme.default.min.css">
    <title>Home - Welcome</title>
</head>
<body>
    

    <section id = "menu">
        <div id = "logo">Ludens Bridges</div>
        <nav>
            
            <a href = ""></i><i class="fas fa-user-circle icon"></i><?php echo "Welcome " . $_SESSION['username'] . ""; ?></a>
            <a href = "#home"><i class="fas fa-home icon"></i>Home</a>
            <a href = "#aboutUs"><i class="fas fa-info icon"></i>About Us</a>
            <a href = "#team"><i class="fas fa-users icon"></i>Team</a>
            <a href = "#contact"><i class="fas fa-map-signs icon"></i>Contact</a>
            <a href = "pdfbilgi0.php"><i class="fas fa-book-open icon"></i></i>PDF Sorgu</a>
            <a href = "logout.php"><i class="fas fa-sign-out-alt icon"></i>Logout</a>
            
        </nav>
    </section>

    <section id="home">
       <div id="black">
       </div>
       <div id = "contents"> 
           <h2>Death Stranding</h2>
           <hr width=300 align=left>
           <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio quis vero velit! Maxime possimus nemo consectetur beatae ullam iste animi dolor cumque modi blanditiis! Totam nulla delectus hic itaque sint.
           sint! Corrupti nisi perferendis voluptatibus. Amet dignissimos quo, obcaecati provident tempora voluptas alias consectetur tenetur optio, ut totam porro distinctio sit quaerat odio quidem molestias, qui iste eum ullam!</p>
       </div>
   </section>
   <section id="aboutUs">
       <h3>About Us</h3>
       <div class="container">
           <div id="sol">
               <h5 id="h5sol">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nulla sequi saepe ipsam corporis dolorum veritatis, voluptas asperiores deserunt magnam facere 
               </h5>
           </div>
           <div id="sag">
               <span>L</span>
               <p id="psag">orem ipsum dolor sit amet consectetur, adipisicing elit. A voluptas fugiat dolores expedita recusandae. Aliquid maiores vitae numquam eius. Voluptatem, nihil consequatur vitae quod saepe harum suscipit recusandae officia sit.
               nisi culpa nihil? At vel sed obcaecati repellendus modi dolorum, quia, quibusdam odio reiciendis perferendis optio, labore nemo!</p>
           </div>
           <img src="aboutus4.jpg" alt="About Us"
           class="img-fluid mt100">
           <p id="pson">Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis hic ullam assumenda earum nemo neque, delectus aperiam perferendis, tempore quam repellat obcaecati molestiae cumque tenetur dolores est asperiores necessitatibus debitis.
           Ipsum nulla et explicabo blanditiis odio, expedita atque repudiandae, sed quam at totam hic asperiores corrupti. Ipsam, ducimus. Quo amet perferendis incidunt voluptas debitis. Cupiditate ea iusto excepturi ullam maiores.</p>
       </div>
   </section>
   <section id="egitimler">
      <div class="container">
           <h3> Bridges Cargo Guide </h3>
           <div>
               <div class="owl-carousel owl-theme">
               <div class="card item" data-merge=1.2>
                 <img src="https://images7.alphacoders.com/883/thumb-1920-883475.jpg" alt="" class="img-fluid">
                 <h5 class="baslikcard">Desert Trips 1</h5>
                 <p class="cardp">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime cum eum itaque optio atque eveniet est enim, 
                 </p>
               </div>
               <div class="card item" data-merge=1.2>
                 <img src="https://images6.alphacoders.com/111/thumb-1920-1116021.jpg" alt="" class="img-fluid">
                 <h5 class="baslikcard">Desert Trips 1</h5>
                 <p class="cardp">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime cum eum itaque optio atque eveniet est enim, 
                 </p>
               </div>
               <div class="card item" data-merge=1.2>
                 <img src="https://images5.alphacoders.com/106/thumb-1920-1067871.png" alt="" class="img-fluid">
                 <h5 class="baslikcard">Desert Trips 1</h5>
                 <p class="cardp">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime cum eum itaque optio atque eveniet est enim, 
                 </p>
               </div>
               <div class="card item" data-merge=1.2>
                 <img src="https://images6.alphacoders.com/106/thumb-1920-1067873.png" alt="" class="img-fluid">
                 <h5 class="baslikcard">Desert Trips 1</h5>
                 <p class="cardp">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime cum eum itaque optio atque eveniet est enim, 
                 </p>
               </div>
               <div class="card item" data-merge=1.2>
                 <img src="https://images6.alphacoders.com/883/thumb-1920-883476.jpg" alt="" class="img-fluid">
                 <h5 class="baslikcard">Desert Trips 1</h5>
                 <p class="cardp">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime cum eum itaque optio atque eveniet est enim, 
                 </p>
               </div>
               <div class="card item" data-merge=1.2>
                 <img src="https://images5.alphacoders.com/718/thumb-1920-718681.png" alt="" class="img-fluid">
                 <h5 class="baslikcard">Desert Trips 1</h5>
                 <p class="cardp">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime cum eum itaque optio atque eveniet est enim, 
                 </p>
               </div>
               <div class="card item" data-merge=1.2>
                 <img src="https://images6.alphacoders.com/102/thumb-1920-1023287.jpg" alt="" class="img-fluid">
                 <h5 class="baslikcard">Desert Trips 1</h5>
                 <p class="cardp">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime cum eum itaque optio atque eveniet est enim, 
                 </p>
               </div>
               </div>
           </div>
      </div>
   </section>

   <section id="team">
       <div class="container">
           <h3 id="teamh3">Team</h3>

            <div class="colmn-left-right">
                <img src="https://images.alphacoders.com/883/thumb-1920-883477.jpg" alt="" class="img-fluid oval">
                <h4 class="teamname">Mads Mikkelsen</h4>
                <p class="teamm">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda, facere?
                </p>

                <div class="team-social-ikon">
                    <a href="#"><i class="fab fa-github social"></i></a>
                    <a href="#"><i class="fab fa-google social"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in social"></i></a>
                </div>

            </div>

            <div class="colmn">
                <img src="https://images5.alphacoders.com/106/thumb-1920-1067871.png" alt="" class="img-fluid oval">
                <h4 class="teamname">Lindsay Wagner</h4>
                <p class="teamm">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda, facere?
                </p>

                <div class="team-social-icon">
                    <a href="#"><i class="fab fa-github social"></i></a>
                    <a href="#"><i class="fab fa-google social"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in social"></i></a>
                </div>

            </div>

            <div class="colmn-left-right">
                <img src="https://images2.alphacoders.com/883/thumb-1920-883479.jpg" alt="" class="img-fluid oval">
                <h4 class="teamname">Guillermo Del Toro</h4>
                <p class="teamm">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda, facere?
                </p>

                <div class="team-social-ikon">
                    <a href="#"><i class="fab fa-github social"></i></a>
                    <a href="#"><i class="fab fa-google social"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in social"></i></a>
                </div>

            </div>

       </div>
   </section>
    
    <section id="contact">
        <div class="container">
            <h3 id="h3contact">Contact</h3>
            <div class="row">
                <form method="post" enctype="multipart/form-data">
                    Choose Your File
                    <input type="file" name="file" charset="UTF-8"/>
                    <br>
                    <input type="submit" value="Read PDF" name="readpdf" />
                </form>
                </div>
            <div id="contactopak">
                <div id="formgroup">
                    <div id="leftform">
                        <input type="text" name="name" placeholder="Name Lastname" required class="form-control">
                        <input type="text" name="phone" placeholder="Phone Number" required class="form-control">
                    </div>
                    <div id="rightform">
                        <input type="email" name="mail" placeholder="Email Address" required class="form-control">
                        <input type="text" name="subject" placeholder="Subject" required class="form-control">
                    </div>

                    <textarea name="message" id="" cols="30" placeholder="Enter Message" rows="10" required class="form-control"></textarea>
                    <input type="submit" value="Send">
                </div>

                <div id ="address">
                    <h4 id="addressheader">Address : </h4>
                    <p class="addressp">Lake Relay City</p>
                    <p class="addressp">Peter Englert</p>
                    <p class="addressp">Peter Englert's house west of the Lake Relay City No:123</p>
                    <p class="addressp">Phone : 0506 105 16 63</p>
                    <p class="addressp">E-mail : samporterbridges.gmail.com</p>
                </div>

                
            </div>

            <footer>

                <div id="copyright">2021 | All Rights Reserved </div>

                <div id="socialfooter">
                    <a href="#"><i class="fab fa-github social"></i></a>
                    <a href="#"><i class="fab fa-google social"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in social"></i></a>
                </div>

                <a href="#menu"><i class="fas fa-chevron-up" id="up"></i></a>

            </footer>

        </div>
    </section>

    <script
    src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
    integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="
    crossorigin="anonymous"></script>
    <script src="owl/owl.carousel.min.js"></script>
    <script src="owl/sc.js"></script>
</body>
</html>