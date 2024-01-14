<?php
include("config.php");
    // connection sang database pra ma read.
    
    if (isset($_GET['delete'])) {
        $id = $_GET['id'];
    
        $delete = $conn->prepare("DELETE FROM patients WHERE id=?");
        $delete->execute([$id]);
    
        // header pang redirect balik sa index.
        header("location:/hpatient/index.php");
        exit; 
    }

?>