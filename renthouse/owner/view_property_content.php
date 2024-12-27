<!-- Tab Navigation -->
<ul class="nav nav-tabs">
    <li><a href="#addProperty" aria-controls="addProperty" role="tab" data-toggle="tab">Add Property</a></li>
    <li><a href="#viewProperty" aria-controls="viewProperty" role="tab" data-toggle="tab">View Property</a></li>
</ul>

<!-- Tab Content -->
<div class="tab-content">
    <!-- Add Property Tab Content -->
    <div id="addProperty" class="tab-pane fade">
        <!-- Your Add Property form code here -->
    </div>

    <!-- View Property Tab Content -->
    <div id="viewProperty" class="tab-pane fade">
        <center><h3>View Property</h3></center>
        <div class="container-fluid">
            <input type="text" id="myInput" onkeyup="viewProperty()" placeholder="Search..." title="Type in a name">
            <div style="overflow-x:auto;">
                <table id="myTable" class="table table-bordered">
                    <thead>
                        <tr class="header">
                            <th>Id.</th>
                            <th>Country</th>
                            <th>Province/State</th>
                            <th>Zone</th>
                            <th>District</th>
                            <th>City</th>
                            <th>VDC/Municipality</th>
                            <th>Ward No.</th>
                            <th>Tole</th>
                            <th>Contact No.</th>
                            <th>Property Type</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Estimated Price</th>
                            <th>Total Rooms</th>
                            <th>Bedroom</th>
                            <th>Living Room</th>
                            <th>Kitchen</th>
                            <th>Bathroom</th>
                            <th>Description</th>
                            <th>Photos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $u_email = $_SESSION['email'];
                        $sql1 = "SELECT * FROM owner WHERE email='$u_email'";
                        $result1 = mysqli_query($db, $sql1);

                        if (mysqli_num_rows($result1) > 0) {
                            while ($rowss = mysqli_fetch_assoc($result1)) {
                                $owner_id = $rowss['owner_id'];

                                $sql = "SELECT * FROM add_property WHERE owner_id='$owner_id'";
                                $result = mysqli_query($db, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($rows = mysqli_fetch_assoc($result)) {
                                        $property_id = $rows['property_id'];
                        ?>
                                        <tr>
                                            <td><?php echo $rows['property_id']; ?></td>
                                            <td><?php echo $rows['country']; ?></td>
                                            <td><?php echo $rows['province']; ?></td>
                                            <td><?php echo $rows['zone']; ?></td>
                                            <td><?php echo $rows['district']; ?></td>
                                            <td><?php echo $rows['city']; ?></td>
                                            <td><?php echo $rows['vdc_municipality']; ?></td>
                                            <td><?php echo $rows['ward_no']; ?></td>
                                            <td><?php echo $rows['tole']; ?></td>
                                            <td><?php echo $rows['contact_no']; ?></td>
                                            <td><?php echo $rows['property_type']; ?></td>
                                            <td><?php echo $rows['latitude']; ?></td>
                                            <td><?php echo $rows['longitude']; ?></td>
                                            <td>Rs. <?php echo $rows['estimated_price']; ?></td>
                                            <td><?php echo $rows['total_rooms']; ?></td>
                                            <td><?php echo $rows['bedroom']; ?></td>
                                            <td><?php echo $rows['living_room']; ?></td>
                                            <td><?php echo $rows['kitchen']; ?></td>
                                            <td><?php echo $rows['bathroom']; ?></td>
                                            <td><?php echo $rows['description']; ?></td>
                                            <td>
                                                <?php 
                                                $sql2 = "SELECT * FROM property_photo WHERE property_id='$property_id'";
                                                $query = mysqli_query($db, $sql2);
                                                
                                                if (mysqli_num_rows($query) > 0) {
                                                    while ($row = mysqli_fetch_assoc($query)) {
                                                ?>
                                                        <img src="<?php echo $row['p_photo']; ?>" width="50px">
                                                <?php 
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                        <?php 
                                    }
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality
function viewProperty() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) { // Start from 1 to skip header row
        td = tr[i].getElementsByTagName("td");
        if (td) {
            for (var j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }
}
</script>
