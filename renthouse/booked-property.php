<?php 
session_start();
isset($_SESSION["email"]);
include("navbar.php");

include("config/config.php");

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 100%;
  min-width: 100%;
  margin: auto;
  text-align: center;
  font-family: arial;
  display: inline;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
  opacity: 0.8;
}

.container {
  padding: 2px 16px;
}

.btn {
  width: 100%;
}

.image {
  min-width: 100%;
  min-height: 200px;
  max-width: 100%;
  max-height:200px;
}
</style>
</head>
<body>

<?php 
$u_email = $_SESSION['email'];

// Get tenant information
$sql3 = "SELECT * from tenant where email='$u_email'";
$result3 = mysqli_query($db, $sql3);

echo '<center><h1>Booked Properties</h1></center>';

if (mysqli_num_rows($result3) > 0) {
    while ($rowss = mysqli_fetch_assoc($result3)) {
        $tenant_id = $rowss['tenant_id'];

        // Get the booked properties for the tenant
        $sql1 = "SELECT * FROM booking WHERE tenant_id='$tenant_id'";
        $query1 = mysqli_query($db, $sql1);

        if (mysqli_num_rows($query1) > 0) {
            while ($ro = mysqli_fetch_assoc($query1)) {
                $prop_id = $ro['property_id'];

                // Fetch the property details
                $sql = "SELECT * FROM add_property WHERE property_id='$prop_id'";
                $query = mysqli_query($db, $sql);

                if (mysqli_num_rows($query) > 0) {
                    while ($rows = mysqli_fetch_assoc($query)) {
                        $property_id = $rows['property_id'];

                        // Fetch property image
                        $sql2 = "SELECT * FROM property_photo WHERE property_id='$property_id'";
                        $query2 = mysqli_query($db, $sql2);

                        if (mysqli_num_rows($query2) > 0) {
                            $row = mysqli_fetch_assoc($query2); 
                            $photo = $row['p_photo'];
                        }

                        // Display the property card
                        echo '<div class="col-sm-2">';
                        echo '<div class="card">';

                        if (isset($photo)) {
                            echo '<img class="image" src="owner/'.$photo.'">';
                        }

                        echo '<h4><b>' . $rows['property_type'] . '</b></h4>';
                        echo '<p>' . $rows['city'] . ', ' . $rows['district'] . '</p>';
                        echo '<p><a href="view-property.php?property_id=' . $rows['property_id'] . '" class="btn btn-lg btn-primary btn-block">View Property</a><br></p>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }
        } else {
            echo "<center><h3>No properties booked yet...</h3></center>";
        }
    }
}
?>

</body>
</html>
