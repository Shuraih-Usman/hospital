<?php
require_once("../config/config.php");

if (isset($_GET['id'])) {
    
    $id = $_GET['id'];
    $stmt = $db->prepare('SELECT * FROM record WHERE id =?');
    $stmt->bind_param('s',$id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows > 0) {
        $stmt = $db->prepare('DELETE FROM record WHERE id =?');
        $stmt->bind_param('s',$id);
        $stmt->execute();
    
        if ($stmt->execute() === true ) {
            header('Location:records.php?suc=1');
        } 
    } else {
        header('Location:records.php?suc=2');
    }
} else {
    header('Location:records.php?suc=3');
}


?>