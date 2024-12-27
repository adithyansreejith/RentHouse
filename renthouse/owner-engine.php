<?php 
$owner_id = '';
$full_name = '';
$email = '';
$password = '';
$phone_no = '';
$address = '';
$id_type = '';
$id_photo = '';

$errors = array();

$db = new mysqli('localhost', 'root', '', 'renthouse');
if ($db->connect_error) {
    die("Error connecting database");
}

if (isset($_POST['owner_register'])) {
    owner_register();
}

if (isset($_POST['owner_login'])) {
    owner_login();
}

function owner_register() {
    global $owner_id, $full_name, $email, $password, $phone_no, $address, $id_type, $id_photo, $errors, $db;

    // Check if the file is uploaded
    if (isset($_FILES['id_photo']) && $_FILES['id_photo']['error'] == 0) {
        $id_photo = 'owner-photo/' . $_FILES['id_photo']['name'];

        // Move the uploaded file to the target directory
        $path = "owner-photo/" . basename($_FILES['id_photo']['name']);
        if (!move_uploaded_file($_FILES['id_photo']['tmp_name'], $path)) {
            $errors[] = "There was an error uploading the photo. Please try again!";
        }
    }

    // Validate input fields (ensure they are set before using them)
    $owner_id = isset($_POST['owner_id']) ? validate($_POST['owner_id']) : '';
    $full_name = isset($_POST['full_name']) ? validate($_POST['full_name']) : '';
    $email = isset($_POST['email']) ? validate($_POST['email']) : '';
    $password = isset($_POST['password']) ? validate($_POST['password']) : '';
    $phone_no = isset($_POST['phone_no']) ? validate($_POST['phone_no']) : '';
    $address = isset($_POST['address']) ? validate($_POST['address']) : '';
    $id_type = isset($_POST['id_type']) ? validate($_POST['id_type']) : '';

    // Encrypt password
    $password = md5($password); 

    // Insert the data into the database
    if (empty($errors)) {
        $sql = "INSERT INTO owner (owner_id, full_name, email, password, phone_no, address, id_type, id_photo) 
                VALUES ('$owner_id', '$full_name', '$email', '$password', '$phone_no', '$address', '$id_type', '$path')";
        if ($db->query($sql) === TRUE) {
            header("Location: owner-login.php");
            exit(); // Ensure script stops after redirect
        } else {
            $errors[] = "Error registering the owner: " . $db->error;
        }
    }
}

function owner_login() {
    global $email, $db;

    $email = isset($_POST['email']) ? validate($_POST['email']) : '';
    $password = isset($_POST['password']) ? validate($_POST['password']) : '';

    // Encrypt password
    $password = md5($password);

    $sql = "SELECT * FROM owner WHERE email='$email' AND password='$password' LIMIT 1";
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        session_start();
        $_SESSION['email'] = $email;
        header('Location: owner/owner-index.php');
        exit(); // Ensure script stops after redirect
    } else {
        $errors[] = "Incorrect Email/Password or not registered. Click here to <a href='owner-register.php' style='color: lightblue;'>Register</a>.";
    }
}

function validate($data) {
    // Ensure the input is a string and trim
    $data = is_string($data) ? trim($data) : '';
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
