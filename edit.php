<?php include 'config.php'; 

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $updateList = $conn->prepare("UPDATE patients SET name=?, email=?, phone=?, address=? WHERE id=?");
        $updateList->execute([$name, $email, $phone, $address, $id]);

        $msg = 'Successfully Updated!';
        header("Location: index.php?msg=$msg");
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
        <h2>New Patient</h2>


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
        <?php
        $id = $_GET['id'];
        
        $getData = $conn->prepare("SELECT * FROM patients WHERE id = ?");
        $getData->execute([$id]);
        foreach ($getData as $selects) { ?>

    <form method="post">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label"> NAME</label> 
            <div class="col-sm-6">
                <input type="hidden" class="form-control" name="id" value="<?= $selects['id'] ?>">
               <input type="text" class="form-control" name="name" value="<?= $selects['name'] ?>">
           </div>
        </div>
        <div class="row mb-3">
           <label class="col-sm-3 col-form-label"> Email</label> 
           <div class="col-sm-6">
               <input type="text" class="form-control" name="email" value="<?= $selects['email'] ?>">
        </div>
        </div>
        <div class="row mb-3">
    <label class="col-sm-3 col-form-label"> Phone</label> 
        <div class="col-sm-6">
            <input type="text" class="form-control" name="phone" value="<?= $selects['phone'] ?>">
        </div>
     </div>
     <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Address</label> 
        <div class="col-sm-6">
            <input type="text" class="form-control" name="address" value="<?= $selects['address'] ?>">
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
            <button type="submit" name="update" class="btn btn-outline-primary">Update</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/hpatient/index.php" role="button">Cancel</a>
            </div>
    </form>
    <?php } ?>
    </div>
</body>
</html>