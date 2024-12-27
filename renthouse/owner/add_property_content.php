<!-- Tab Navigation -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="#addProperty" aria-controls="addProperty" role="tab" data-toggle="tab">Add Property</a></li>
</ul>

<!-- Tab Content -->
<div class="tab-content">
    <div id="addProperty" class="tab-pane fade in active">
        
        <div class="container">
            <div id="map_canvas"></div>
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="country">Country:</label>
                            <select class="form-control" name="country" required="required">
                                <option value="">--Select Country--</option>
                                <option value="India">India</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state">State:</label>
                            <select class="form-control" name="state" required="required">
                                <option value="">--Select State--</option>
                                <option value="Kerala">Kerala</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="district">District:</label>
                            <select class="form-control" name="district" required="required">
                                <option value="">--Select District--</option>
                                <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                                <option value="Kollam">Kollam</option>
                                <option value="Pathanamthitta">Pathanamthitta</option>
                                <option value="Alappuzha">Alappuzha</option>
                                <option value="Kottayam">Kottayam</option>
                                <option value="Idukki">Idukki</option>
                                <option value="Ernakulam">Ernakulam</option>
                                <option value="Thrissur">Thrissur</option>
                                <option value="Palakkad">Palakkad</option>
                                <option value="Malappuram">Malappuram</option>
                                <option value="Kozhikode">Kozhikode</option>
                                <option value="Wayanad">Wayanad</option>
                                <option value="Kannur">Kannur</option>
                                <option value="Kasargod">Kasargod</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" class="form-control" id="city" placeholder="Enter City" name="city">
                        </div>
                        <div class="form-group">
                            <label for="pincode">Pincode:</label>
                            <input type="text" class="form-control" id="pincode" placeholder="Enter Pincode" name="pincode">
                        </div>
                        <div class="form-group">
                            <label for="contact_no">Contact No.:</label>
                            <input type="text" class="form-control" id="contact_no" placeholder="Enter Contact No." name="contact_no">
                        </div>
                        <div class="form-group">
                            <label for="property_type">Property Type:</label>
                            <select class="form-control" name="property_type">
                                <option value="">--Select Property Type--</option>
                                <option value="Full House Rent">Full House Rent</option>
                                <option value="Flat Rent">Flat Rent</option>
                                <option value="Room Rent">Room Rent</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="estimated_price">Estimated Price:</label>
                            <input type="number" class="form-control" id="estimated_price" placeholder="Enter Estimated Price" name="estimated_price">
                        </div>
                    </div>
                    <!-- Right Column -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total_rooms">Total No. of Rooms:</label>
                            <input type="number" class="form-control" id="total_rooms" placeholder="Enter Total No. of Rooms" name="total_rooms">
                        </div>
                        <div class="form-group">
                            <label for="bedroom">No. of Bedrooms:</label>
                            <input type="number" class="form-control" id="bedroom" placeholder="Enter No. of Bedrooms" name="bedroom">
                        </div>
                        <div class="form-group">
                            <label for="living_room">No. of Living Rooms:</label>
                            <input type="number" class="form-control" id="living_room" placeholder="Enter No. of Living Rooms" name="living_room">
                        </div>
                        <div class="form-group">
                            <label for="kitchen">No. of Kitchens:</label>
                            <input type="number" class="form-control" id="kitchen" placeholder="Enter No. of Kitchens" name="kitchen">
                        </div>
                        <div class="form-group">
                            <label for="bathroom">No. of Bathrooms/Washrooms:</label>
                            <input type="number" class="form-control" id="bathroom" placeholder="Enter No. of Bathrooms/Washrooms" name="bathroom">
                        </div>
                        <div class="form-group">
                            <label for="description">Full Description:</label>
                            <textarea class="form-control" id="description" placeholder="Enter Property Description" name="description"></textarea>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <div class="form-group">
                                    <label><b>Latitude/Longitude:</b><span style="color:red; font-size: 10px;"> *Click on Button</span></label>
                                    <td><input type="text" name="latitude" placeholder="Latitude" id="latitude" class="form-control name_list" readonly required /></td>
                                    <td><input type="text" name="longitude" placeholder="Longitude" id="longitude" class="form-control name_list" readonly required /></td>
                                    <td><input type="button" value="Get Latitude and Longitude" onclick="getLocation()" class="btn btn-success col-lg-12"></td>
                                </div>
                            </tr>
                        </table>
                        <table class="table" id="dynamic_field">
                            <tr>
                                <div class="form-group">
                                    <label><b>Photos:</b></label>
                                    <td><input type="file" name="p_photo[]" placeholder="Photos" class="form-control name_list" required accept="image/*" /></td>
                                    <td><button type="button" id="add" name="add" class="btn btn-success col-lg-12">Add More</button></td>
                                </div>
                            </tr>
                        </table>
                        <input name="lat" type="text" id="lat" hidden>
                        <input name="lng" type="text" id="lng" hidden>
                        <hr>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary btn-lg col-lg-12" value="Add Property" name="add_property">
                        </div>
                    </div>
                </div>
            </form>
            <br><br>
        </div>
    </div>
</div>
