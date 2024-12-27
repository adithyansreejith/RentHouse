<?php 

$tenant_id = '';
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
    echo "Error connecting to the database";
    exit;
}

if (isset($_POST['tenant_register'])) {
    tenant_register();
}

if (isset($_POST['tenant_login'])) {
    tenant_login();
}

if (isset($_POST['tenant_update'])) {
    tenant_update();
}

function tenant_register() {
    global $tenant_id, $full_name, $email, $password, $phone_no, $address, $id_type, $id_photo, $errors, $db;

    // Check if `id_photo` is set
    if (isset($_FILES['id_photo']) && !empty($_FILES['id_photo']['name'])) {
        $id_photo = 'tenant-photo/' . basename($_FILES['id_photo']['name']);
        $path = "tenant-photo/" . basename($_FILES['id_photo']['name']);
        
        if (move_uploaded_file($_FILES['id_photo']['tmp_name'], $path)) {
            echo "The file " . basename($_FILES['id_photo']['name']) . " has been uploaded.";
        } else {
            echo "There was an error uploading the file, please try again!";
            $path = ''; // Ensure `$path` is set even if upload fails
        }
    } else {
        $path = ''; // Default value if `id_photo` is not uploaded
    }

    // Validate POST inputs safely
    $tenant_id = validate($_POST['tenant_id'] ?? '');
    $full_name = validate($_POST['full_name'] ?? '');
    $email = validate($_POST['email'] ?? '');
    $password = validate($_POST['password'] ?? '');
    $phone_no = validate($_POST['phone_no'] ?? '');
    $address = validate($_POST['address'] ?? '');
    $id_type = validate($_POST['id_type'] ?? '');
    $password = md5($password); // Encrypt password

    // Check required fields
    if (empty($tenant_id) || empty($full_name) || empty($email) || empty($password)) {
        echo "Profile Created Go back to Home";
        return;
    }

    // Insert into the database
    $sql = "INSERT INTO tenant (tenant_id, full_name, email, password, phone_no, address, id_type, id_photo) 
            VALUES ('$tenant_id', '$full_name', '$email', '$password', '$phone_no', '$address', '$id_type', '$path')";
    
    if ($db->query($sql) === TRUE) {
        header("Location: tenant-login.php");
        exit; // Ensure no further code is executed
    } else {
        echo "Error: " . $db->error;
    }
}

function tenant_login() {
    global $email, $db;
    
    $email = validate($_POST['email'] ?? '');
    $password = validate($_POST['password'] ?? '');
    $password = md5($password);

    $sql = "SELECT * FROM tenant WHERE email='$email' AND password='$password' LIMIT 1";
    $result = $db->query($sql);

    if ($result->num_rows == 1) {
        $data = $result->fetch_assoc();
        session_start();
        $_SESSION['email'] = $email;
        header('Location: index.php');
        exit; // Ensure no further code is executed
    } else {
        echo '<div class="container">
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
                    <strong>Incorrect Email/Password or not registered.</strong> Click here to <a href="tenant-register.php" style="color: lightblue;"><b>Register</b></a>.
                </div>
              </div>';
    }
}

function tenant_update() {
    global $db;
    
    $tenant_id = validate($_POST['tenant_id'] ?? '');
    $full_name = validate($_POST['full_name'] ?? '');
    $email = validate($_POST['email'] ?? '');
    $phone_no = validate($_POST['phone_no'] ?? '');
    $address = validate($_POST['address'] ?? '');
    $id_type = validate($_POST['id_type'] ?? '');

    if (empty($tenant_id)) {
        echo "Tenant ID is required for updating.";
        return;
    }

    $sql = "UPDATE tenant SET 
            full_name='$full_name', 
            email='$email', 
            phone_no='$phone_no', 
            address='$address', 
            id_type='$id_type' 
            WHERE tenant_id='$tenant_id'";

    if ($db->query($sql)) {
        echo '<div class="container">
                <div class="alert">
                    <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span> 
                    <center><strong>Your Information has been updated.</strong></center>
                </div>
              </div>';
    } else {
        echo "Error updating record: " . $db->error;
    }
}

function validate($data) {
    if (is_null($data)) {
        $data = ''; // Ensure non-null value
    }
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
