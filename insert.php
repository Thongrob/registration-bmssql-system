<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
    session_start();
    require_once "config/db.php";

    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $position = $_POST['position'];
        $img = $_FILES['img'];

        //filename .jpg, .jpeg, .png
        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode(".",$img['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;
        $filePath = "uploads/" . $fileNew;

        if(in_array($fileActExt, $allow)){
            if($img['size'] > 0 && $img['error'] == 0 ){
                move_uploaded_file($img['tmp_name'], $filePath);
            }
        }

                   $sql = $conn -> prepare("INSERT INTO employee(firstname, lastname, position, img) VALUES(:firstname, :lastname, :position, :img)");
                   $sql -> bindParam(":firstname", $firstname);
                   $sql -> bindParam(":lastname", $lastname);
                   $sql -> bindParam(":position", $position);
                   $sql -> bindParam(":img", $fileNew);
                   $sql -> execute();

                   if($sql) {
                    $_SESSION['success'] = "Data has been inserted succesfully";
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
                   }else{
                    $_SESSION['error'] = "Data has not been inserted succesfully";
                   }
                

    }
?>