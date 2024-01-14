<?php
    include 'config.php';

    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
    
        $insertData = $conn->prepare("INSERT INTO patients(name, email, phone, address) VALUES(?, ?, ?, ?)");
        $insertData->execute([$name, $email, $phone, $address]);
    
        header("Location: index.php");
        exit();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Patient</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
       <center> <h2>New Patient</h2> </center>


        <?php
        if (!empty ($errorMessage)){
            echo"
            <div class = 'alert-warning alert-dismissible fade show' role='alert'>
            <strong> $errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
    <form method="post" action="create.php">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label> 
            <div class="col-sm-6">
               <input type="text" class="form-control" name="name">
           </div>
        </div>
        <div class="row mb-3">
           <label class="col-sm-3 col-form-label"> Email</label> 
           <div class="col-sm-6">
               <input type="text" class="form-control" name="email">
        </div>
        </div>
        <div class="row mb-3">
    <label class="col-sm-3 col-form-label"> Phone</label> 
        <div class="col-sm-6">
            <input type="text" class="form-control" name="phone">
        </div>
     </div>
     <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Address</label> 
        <div class="col-sm-6">
            <input type="text" class="form-control" name="address">
        </div>
        </div>

        <?php
        if (!empty ($successMessage)){
            echo "
            <div class='row mb-3'>
            <div class='offset-sm-3 col-sm-6'>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <button type='button' class='button-close' data-bs-dismiss='alert' aria-label>VIEW</button>
            </div>
            </div>
            </div>";
        }
        
        ?>

        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" name="create" class="btn btn-outline-info">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-danger" href="/hpatient/index.php" role="button">Cancel</a>
            </div>
    </form>
    </div>
</body>
</html>