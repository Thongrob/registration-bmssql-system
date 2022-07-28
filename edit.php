<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "config/db.php";

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $position = $_POST['position'];
        $img = $_FILES['img'];

        $img2 = $_POST['img2'];
        $upload = $_FILES['img']['name'];

        //ถ้ามีการ upload file จะให้แก้ไขเป็นไฟล์ล่าสุด
        if($upload != '') {
            $allow = array('jpg', 'jpeg', 'png');
            $extension = explode(".",$img['name']);
            $fileActExt = strtolower(end($extension));
            $fileNew = rand() . "." . $fileActExt;
            $filePath = "uploads/" . $fileNew;

            if(in_array($fileActExt, $allow)){
                if($img['size'] > 0 && $img['error'] == 0){
                    move_uploaded_file($img['tmp_name'], $filePath);
                }
            }
        }else{
           $fileNew = $img2; 
        }
        $sql = $conn -> prepare("UPDATE employee SET firstname = :firstname, lastname = :lastname, position = :position, img = :img WHERE id = :id");
        
        $sql -> bindParam(":id", $id);
        $sql -> bindParam(":firstname", $firstname);
        $sql -> bindParam(":lastname", $lastname);
        $sql -> bindParam(":position", $position);
        $sql -> bindParam(":img", $fileNew);
        $sql -> execute();

        if($sql) {
            $_SESSION['success'] = "Data has been updated succesfully";
            echo "<script>
                        $(document).ready(function(){
                            Swal.fire({
                                title: 'success',
                                text: 'Data has been inserted succesfully',
                                icon: 'success',
                                timer: 5000,
                                showConfirmButton: false
                              })
                        });
                    </script> ";
                header("refresh:2; url=home-admin.php");
            // header("location:home.php");
        }else{
            $_SESSION['error'] = "Data has not been updated succesfully";
            header("location:home-admin.php");
        }
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
    <style>
        .container{
            max-width: 550px;
        }
    </style>
</head>
<body>


    <div class="container">
       <h1>Edit Data</h1>
        <hr>
        <form action="edit.php" method="post" enctype="multipart/form-data">
            <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $stmt = $conn -> query("SELECT * FROM employee WHERE id = $id");
                    $stmt  -> execute();
                    $data = $stmt -> fetch();
                }
            ?>
             <div class="mb-3">
                 <input type="text" readonly value="<?= $data['id']; ?>" required class="form-control" name="id">
                 <label for="firstname" class="col-form-label">First Name:</label>
                 <input type="text" value="<?= $data['firstname']; ?>" required class="form-control" name="firstname">
                 <input type="hidden" value="<?= $data['img']; ?>" required class="form-control" name="img2">
             </div>
             <div class="mb-3">
                 <label for="lastname" class="col-form-label">Last Name:</label>
                 <input type="text" value="<?= $data['lastname']; ?>" required class="form-control" name="lastname">
             </div>
             <div class="mb-3">
                 <label for="position" class="col-form-label">Position:</label>
                 <input type="text" value="<?= $data['position']; ?>" required class="form-control" name="position">
             </div>
             <div class="mb-3">
                 <label for="img" class="col-form-label">Image:</label>
                 <input type="file" class="form-control" id="imgInput" name="img">
                 <img width="100%" src="uploads/<?= $data['img']; ?>" id="previewImg" alt="">
             </div>
             <div class="modal-footer">
                 <a class="btn btn-secondary" href="home-admin.php">Go Back</a>
                 <button type="submit" name="update" class="btn btn-primary">Update</button>
             </div>
        </form>
        
        
        
    </div> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>