<?php 
session_start();
if(!isset($_SESSION["email"])){
  header("location:../index.php");
}
include("navbar.php");
include("engine.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Property Dashboard</title>
    
    <!-- Bootstrap 3.4.1 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap 3.4.1 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js"></script>

    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
            padding: 20px;
        }

        #myInput {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
        }

        #myTable {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
        }

        #myTable th, #myTable td {
            text-align: left;
            padding: 12px;
            border: 1px solid #ddd;
        }

        #myTable tr {
            border-bottom: 1px solid #ddd;
        }
        
        /* Add custom styles for active tab */
        .nav-tabs > li.active > a,
        .nav-tabs > li.active > a:hover,
        .nav-tabs > li.active > a:focus {
            background-color: #fff;
            border: 1px solid #ddd;
            border-bottom-color: transparent;
        }
        
        /* Add some padding to the content area */
        .tab-content {
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a>
            </li>
            <li role="presentation">
                <a href="#addProperty" aria-controls="addProperty" role="tab" data-toggle="tab">Add Property</a>
            </li>
            <li role="presentation">
                <a href="#viewProperty" aria-controls="viewProperty" role="tab" data-toggle="tab">View Property</a>
            </li>
            <li role="presentation">
                <a href="#updateProperty" aria-controls="updateProperty" role="tab" data-toggle="tab">Update Property</a>
            </li>
            <li role="presentation">
                <a href="#bookedProperty" aria-controls="bookedProperty" role="tab" data-toggle="tab">Booked Property</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Profile Tab -->
            <div role="tabpanel" class="tab-pane active" id="profile">
                <h3>Owner Profile</h3>
                <?php include('profile_content.php'); ?>
            </div>
            
            <!-- Add Property Tab -->
            <div role="tabpanel" class="tab-pane" id="addProperty">
                <h3>Add Property</h3>
                <?php include('add_property_content.php'); ?>
            </div>
            
            <!-- View Property Tab -->
            <div role="tabpanel" class="tab-pane" id="viewProperty">
                <h3>View Property</h3>
                <?php include('view_property_content.php'); ?>
            </div>
            
            <!-- Update Property Tab -->
            <div role="tabpanel" class="tab-pane" id="updateProperty">
                <h3>Update Property</h3>
                <?php include('update_property_content.php'); ?>
            </div>
            
            <!-- Booked Property Tab -->
            <div role="tabpanel" class="tab-pane" id="bookedProperty">
                <h3>Booked Property</h3>
                <?php include('booked_property_content.php'); ?>
            </div>
        </div>
    </div>

    <!-- Add this script at the bottom of the body -->
    <script>
        $(document).ready(function(){
            // Enable Bootstrap tabs
            $('a[data-toggle="tab"]').on('click', function (e) {
                e.preventDefault();
                $(this).tab('show');
            });
            
            // Initialize the first tab
            $('.nav-tabs a:first').tab('show');
            
            // Debug log to verify jQuery is working
            console.log('jQuery version:', $.fn.jquery);
            console.log('Bootstrap version:', $.fn.modal.Constructor.VERSION);
        });
    </script>
</body>
</html>