<?php
include 'db.php';
if(isset($_POST['resource'])){
    $stmt = $mysqli->prepare("select * from zakazivanje where resource_id=? AND date=? AND timeslot=?");
    $stmt->bind_param('sss', $_POST['resource'], $_POST['date'], $_POST['timeslot']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    echo json_encode($row);
    die();
}