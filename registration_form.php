<?php
session_start();
include ('connectDBclaire.php');
// Attempt MYSQL server coonection 
$link = connect();

$user_name = mysqli_real_escape_string($link, $_REQUEST['user_name']);
$password = mysqli_real_escape_string($link, $_REQUEST['password']);
//hash the password with the password_default algorithm (bcrypt)
$password_hash = password_hash($password, PASSWORD_DEFAULT);
$business_name = mysqli_real_escape_string($link, $_REQUEST['business_name']);
$user_email = mysqli_real_escape_string($link, $_REQUEST['user_email']);
$user_phone = mysqli_real_escape_string($link, $_REQUEST['user_phone']);
$business_phone = mysqli_real_escape_string($link, $_REQUEST['business_phone']);
$business_address = mysqli_real_escape_string($link, $_REQUEST['business_address']);
$business_type = mysqli_real_escape_string($link, $_REQUEST['business_type']);

$address = rawurlencode($business_address);
$url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address={$address}";
$resp_json = file_get_contents($url);
$resp = json_decode($resp_json, true);
$lat = $resp['results'][0]['geometry']['location']['lat'];
$lng = $resp['results'][0]['geometry']['location']['lng'];


//if file well uploaded
if (isset($_FILES['file'])){

$allowed = array ('image/pjpeg', 'image/jpeg', 'image/JPG','image/X-PNG', 'image/PNG', 'image/png','image/x-png', 'image/gif');
if (in_array($_FILES['file']['type'], $allowed) && $_FILES['file']['size'] < 400000){

	if (move_uploaded_file($_FILES['file']['tmp_name'], "images/{$_FILES['file']['name']}")){

	$image = "{$_FILES['file']['name']}";
	}
}

else { //Invalid type
	echo '<p class="error">Please upload a JPEG, GIF, or PNG image whose size is inferior to 400 KB.</p>';}
}

if ($_FILES['file']['error'] > 0 ){
	echo '<p class="error">The file could not be uploaded.</p>';
}

if (file_exists($_FILES['file']['tmp_name']) && is_file($_FILES['upload']['tmp_name'])){
	unlink ($_FILES['file']['tmp_name']);
}

if ($image){

	$fileName = $_FILES['file']['name'];
	$fileSize = $_FILES['file']['size'];


//insert query execution into the database
$sql = "INSERT INTO Owner (user_name, password, business_name, user_email, user_phone, business_phone, business_address, lat, lng, business_type, filename, filesize, filepath) VALUES ('$user_name', '$password_hash', '$business_name', '$user_email', '$user_phone', '$business_phone','$business_address', '$lat', '$lng', '$business_type','$fileName', '$fileSize', '$image')";
if (mysqli_query($link, $sql)){
	$_SESSION['user_name'] = $user_name;
	header ('Location: account_page.php');
} else {
	header ('Location: registration.html');
	$_SESSION['error'] = 'An error has occured. Please try again';
}

}

//if the file not well uploaded
else
{
	$fileName = 'error';
	$fileSize = 'error';
	$image = 'error';


	$sql = "INSERT INTO Owner (user_name, password, business_name, user_email, user_phone, business_phone, business_address, lat, lng, business_type, filename, filesize, filepath) VALUES ('$user_name', '$password_hash', '$business_name', '$user_email', '$user_phone', '$business_phone','$business_address', '$lat', '$lng', '$business_type', '$fileName', '$fileSize', '$image')";
	
if (mysqli_query($link, $sql)){
	$_SESSION['user_name'] = $user_name;
	header ('Location: account_page.php');
} else {
	header ('Location: registration.html');
	$_SESSION['error'] = 'An error has occured. Please try again';
}

}




//close connection
mysqli_close($link);

?>