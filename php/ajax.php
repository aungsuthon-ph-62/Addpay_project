<?php

if(isset($_POST['keyquono'])){
    $no = $_POST['keyquono'];
    include('conn.php');
    $sql = "SELECT * FROM quotation_appraisal WHERE quo_no ='$no'";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();
    if($row){
        $rd = $row['quo_date'];
        $rt = $row['quo_total'];
        echo json_encode(array('success' => 1,'quodate'=>$rd,'quototal'=>$rt));
        
    }else{
        echo json_encode(array('success' => 2));
    }
    
}else {
    echo json_encode(array('success' => 0));
}
?>