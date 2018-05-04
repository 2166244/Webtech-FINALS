<?php
    $connection = mysqli_connect("localhost", "root", "", "");
    if ($connection){
        echo "connected";
    }
    if(isset($_POST['fileuploadsubmit'])){
        $fileupload = $_FILES['fileupload']['name'];    
        $fileuploadTMP = $_FILES;
        $folder
    }
    $sql= ""
?>

<!DOCTYPE html>

<html>
    <body>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="file" name="fileupload">
            <input type="submit" name="fileuploadsubmit">

        </form>
    </body>
</html>