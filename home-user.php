<?php
    session_start();
    require_once "config/db.php";
    
    if(!isset($_SESSION['user_login'])){
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบก่อน'; 
        header('location: signin.php ');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Styles/custom.css">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Employee Information</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-end pt-3">
                <a href="logout.php" class="btn btn-danger ms-3">Logout</a>
            </div>
        </div>
        <hr>
        <?php if(isset($_SESSION['success']))  { ?>
            <div class="alert alert-success">
                <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </div>
        <?php } ?>

        <?php if(isset($_SESSION['error']))  { ?>
            <div class="alert alert-danger">
                <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php } ?>

        <!-- User Data -->
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Position</th>
                <th scope="col">Img</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stmt = $conn -> query("SELECT * FROM employee");
                    $stmt -> execute();
                    $users = $stmt -> fetchAll();

                    if(!$users) {
                        echo "<tr><td colspan='6' class='text-center'>No users found</td></tr>";
                    }else{
                        foreach($users as $user){
                            
                 ?>
                <tr>
                    <th scope="row"><?= $user['id']; ?></th>
                    <td><?= $user['firstname']; ?></td>
                    <td><?= $user['lastname']; ?></td>
                    <td><?= $user['position']; ?></td>
                    <td width="250px"><img width="100%" src="uploads/<?= $user['img']; ?>" class="rounded" alt=""></td>    
                    <td>
                       <p>-</p>
                    </td>         
                </tr>
                <?php   }
                    } ?>  
            </tbody>
        </table>
        
    </div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>