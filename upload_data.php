<?php
/***********************************************
 ** Feature Signature
 ** By: Muhamad Farhan Badrussalam
 ***********************************************/ 
header("Access-Control-Allow-Origin: *");
$status = $_POST['status'];
if($status == 0){
	$upload_dir = "upload/";
	$img = $_POST['data'];
	// die(var_dump($_SESSION));
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = $upload_dir . "file_sementara.png";
	$success = file_put_contents($file, $data);
	print $success ? $file : 'Unable to save the file.';
}else if($status == 1){
	// Process download
	$filepath = "./upload/file_sementara.png";
    if(file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        exit;
    }
	// force_download("./upload/file_sementara.png",NULL);
}else if($status == 2){
	if(file_exists("./upload/file_sementara.png")){
        unlink('./upload/file_sementara.png');
    }
}
?>
