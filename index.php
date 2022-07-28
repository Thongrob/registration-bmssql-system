<?php 
    session_start();
    require_once 'config/db.php';
    // header('location: signin.php ');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System PDO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200&family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Styles/custom.css">
</head>
<body>
    <div class="container">
        <h3 class="mt-4">สมัครสมาชิก</h3>
        <hr>
        <div class="row justify-content-md-center">
            <form action="signup_db.php" method="post" class="col-lg-6 col-sm">
                <?php if(isset($_SESSION['error'])) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        ?>
                    </div>
                <?php } ?>  

                <?php if(isset($_SESSION['success'])) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']);
                        ?>
                    </div>
                <?php } ?>  

                <?php if(isset($_SESSION['warning'])) { ?>
                    <div class="alert alert-warning" role="alert">
                        <?php 
                            echo $_SESSION['warning'];
                            unset($_SESSION['warning']);
                        ?>
                    </div>
                <?php } ?>   
            
                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="firstname" aria-describedby="firstname">
                </div>
                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="lastname" aria-describedby="lastname">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="email" aria-describedby="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <div class="mb-3">
                    <label for="confirm password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="c_password">
                </div>
                <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
            </form>
        </div>
    <hr>
    <p>เป็นสมาชิกหรือยัง? คลิ๊กที่นี่เพื่อ <a href="signin.php">เข้าสู่ระบบ</a></p>
    </div>
</body>
</html>