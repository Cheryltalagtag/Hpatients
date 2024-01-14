<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Patient </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
     <center><h2>List of Patient</h2></center>
     <hr>
     <a class="btn btn-outline-success" href="/hpatient/create.php" role="button">New Patient</a>
    <br>
    <table class="table"> 
         <thead> 
           <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Admit</th>
           
           </tr>
         </thead>
         <tbody>
            <?php
           

            $connection = new mysqli ($servername, $username, $password,$database);
            if($connection->connect_error){
                die("Connection failed:" . $connection->connect_error);
            }

            $sql = "SELECT * FROM patients";
            $result = $connection->query($sql);

            if (!$result){
                die("Invalid query: " . $connection->error);
            }
            while($row = $result-> fetch_assoc()) {
                echo " <tr>
                <td>$row[id]</td>
                <td>$row[name]</td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[address]</td>
                <td>$row[created_at]</td>
                <td>
                <a class='btn btn-outline-info btn-sm' href='/hpatient/edit.php?update&id=$row[id]'>Edit</a>
                <a class='btn btn-outline-danger btn-sm' href='/hpatient/delete.php?delete&id=$row[id]'> Delete</a>
                </td>
             </tr>
             ";
            }
            ?>
            
         </tbody>
    </table>
    </div>
</body>
</html>