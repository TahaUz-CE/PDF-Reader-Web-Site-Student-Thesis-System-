<?php
 
if(isset($_POST["kaydet"]))
{
    include "baglan.php";
    $sql = "INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES (?, ?, ?, ?);";
    $dizi =[
        $_POST["id"],
        $_POST["username"],
        $_POST["email"],
        $_POST["password"]
    ];
 
   $sth = $baglan->prepare($sql);
   $sonuc = $sth->execute($dizi);
   header("Location:indexadmin.php");
}
 
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Add Panel</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    
    <header>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="display-1 text-center">ADD PANEL</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="btn-group">
                        <a href="indexadmin.php" class="btn btn-outline-primary">Home</a>
                        <a href="ekle.php" class="btn btn-outline-primary">User Add</a>
                    </div>
                </div>
            </div>
        </div>
    
    </header>
    <main>
    <div class="container">
        <form action="" method="post" class="row mt-4 g-3">
            <div class="col-6">
                <label for="id" class="form-label">ID</label>
                <input type="text" class="form-control" name="id">
            </div>
            <div class="col-6">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control" name="username">
            </div>
            <div class="col-6">
                <label for="email" class="form-label">E-Mail</label>
                <input type="text" class="form-control" name="email">
            </div>
            <div class="col-6">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" name="password">
            </div>
            
            <button type="submit" name="kaydet" class="btn btn-primary">Kaydet</button>
        </form>
    </div>
    </main>
    <footer></footer>
</body>
</html>