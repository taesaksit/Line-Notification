<?php
$input = json_decode(file_get_contents('php://input'));
$email = $input->email;
$user = $input->user;

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    header('location: index.php');
    exit();
} else {
    // $sToken = "FzJFxGZ31sEHxGN5n0Tcv2chDX5kxBviCihN6DumZVM";
    $sToken = "wQ0bE6jz4tOMKU44veDiPgHPip4dAxZLaB1dZi3tVIX";
    
 

    $sMessage = "รายละเอียดการลงทะเบียน \n";
    $sMessage .= "ยินดีต้อนรับคุณ: " . $user . "\n";
    $sMessage .= "email: " . $email . "\n";


    $chOne = curl_init();
    curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($chOne, CURLOPT_POST, 1);
    curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $sMessage);
    $headers = array('Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer ' . $sToken . '',);
    curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($chOne);
    // echo $result;
    //Result error 
    if (curl_error($chOne)) {
        echo 'error:' . curl_error($chOne);
    } else {
        $result_ = json_decode($result, true);
        echo json_encode($result_['status']);
        // echo "status : " . $result_['status'];
        // echo "message : " . $result_['message'];
    }
    curl_close($chOne);
}