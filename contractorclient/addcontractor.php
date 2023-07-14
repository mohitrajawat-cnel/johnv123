<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<h3>Add Contractor</h3>
<div class="container" style="width:90%">


    <?php
    global $wpdb;

    $contractors = $wpdb->prefix . "contractors";
    if (isset($_REQUEST['insertuserset'])) {

        $contractor_id_value = $_REQUEST['userset'];
        $emailaddress = $_REQUEST['emailaddress'];
        $phonenumber = $_REQUEST['phonenumber'];
        $contractor_name = $_REQUEST['contractor_name'];
        $contractor_surname = $_REQUEST['contractor_surname'];
        $address_line1 = $_REQUEST['address_line1'];
        $city = $_REQUEST['city'];
        $postal_code = $_REQUEST['postal_code'];
        $country = $_REQUEST['country'];

        $user_id = username_exists($contractor_id_value);

        if (!$user_id && false == email_exists($emailaddress)) {

            $user_id = wp_create_user($contractor_id_value, $contractor_id_value, $emailaddress);

            update_user_meta($user_id,"first_name",$contractor_name);
            update_user_meta($user_id,"last_name",$contractor_surname);

            $current_user_id = get_current_user_id();

            $get_currenttime = current_time( 'timestamp' );
            $get_current_date = date("Y-m-d",$get_currenttime);

            $insert = "insert into $contractors set contractor_name='$contractor_name',
            contractor_surname='$contractor_surname',
            emailaddress='$emailaddress',
            phonenumber='$phonenumber',
            better_contractor_id='$user_id',
            address_line1='$address_line1',
            contractor_created_by='$current_user_id',
            created_date='$get_current_date',
            city='$city',
            postal_code='$postal_code',
            country='$country' ";
                $wpdb->query($insert);

         
                echo "<font>Contractor created successfully.</font>";
                echo "<script>";
                echo "location.replace('admin.php?page=contractor_details');";
                echo "</script>";

        }
        else
        {
            echo "<script>";
            echo 'alert("Contractor alreay exists");';
            echo "</script>";
        }

  
        // $select_user = "select * from $contractors where better_contractor_id='$userid'";
        // $results_user = $wpdb->get_results($select_user, ARRAY_A);
        // if (count($results_user) > 0) {
        //     echo "<script>";
        //     echo 'alert("Better Contractor alreay exists");';
        //     echo "</script>";
        // } else {
        //     $insert = "insert into $contractors set contractor_name='$contractor_name',contractor_surname='$contractor_surname', emailaddress='$emailaddress',phonenumber='$phonenumber',better_contractor_id='$userid',
        // address_line1='$address_line1',
        // city='$city',
        // postal_code='$postal_code',
        // country='$country' ";
        //     $wpdb->query($insert);

        //     echo "<font>Contractor created successfully.</font>";
        //     echo "<script>";
        //     echo "location.replace('admin.php?page=contractor_details');";
        //     echo "</script>";
        // }

    }





    $usersavebutton_name = 'insertuserset';
    $username = '';
    $user_phone_number = '';
    $user_email = '';
    $better_id = '';

    if (isset($_REQUEST['edit']) && $_REQUEST['edit'] != '') {
        $edit_user_id = $_REQUEST['edit'];
        $usersavebutton_name = 'updateuserset';


        if (isset($_REQUEST['updateuserset'])) {

            $contractor_idhwe = $_REQUEST['userset'];
            $contractors = $wpdb->prefix . "contractors";
            $select3 = "select * from $contractors where ID='" . $edit_user_id . "'";
            $results3 = $wpdb->get_results($select3);
            $i = 1;
            foreach ($results3 as $value3) {
                $userid = $value3->better_contractor_id;
            }
            $emailaddress = $_REQUEST['emailaddress'];
            $contractor_name = $_REQUEST['contractor_name'];
            $contractor_surname = $_REQUEST['contractor_surname'];
            $phonenumber = $_REQUEST['phonenumber'];

            $address_line1 = $_REQUEST['address_line1'];
            $city = $_REQUEST['city'];
            $postal_code = $_REQUEST['postal_code'];
            $country = $_REQUEST['country'];
     
            

            // die();

            $update_usernamehwe = "UPDATE ".$wpdb->prefix."users SET user_login='$contractor_idhwe',
            display_name='$contractor_idhwe',user_email='$emailaddress' where ID='" . $userid . "'";
            if($wpdb->query($update_usernamehwe))
            {
                update_user_meta($userid,"first_name",$contractor_name);
               update_user_meta($userid,"last_name",$contractor_surname);

                $insert = "UPDATE $contractors set  contractor_name='$contractor_name',contractor_surname='$contractor_surname', emailaddress='$emailaddress',phonenumber='$phonenumber',better_contractor_id='$userid',address_line1='$address_line1',
                city='$city',
                postal_code='$postal_code',
                country='$country' where ID='" . $edit_user_id . "'";
                    $wpdb->query($insert);
        
        
                    echo "<font>Contractor edit successfully.</font>";
                    echo "<script>";
                    echo "location.replace('admin.php?page=contractor_details');";
                    echo "</script>";
            }
            else
            {
                echo "<script>";
                echo 'alert("Please enter correct data");';
                echo "</script>";
            }
            

          
        }
        // $authors = $wpdb->get_results("SELECT * from $wpdb->users 
        // where ID='25' ORDER BY display_name DESC");

        // print_r($authors);

        // die("dgsdg");
        $id = $_REQUEST['edit'];
        $contractors = $wpdb->prefix . "contractors";
        $select = "select * from $contractors where ID='$id'";
        $results = $wpdb->get_results($select);

        // print_r($results);

        // die("dgsdg");
        $i = 1;
        foreach ($results as $value) {
            $id = $value->ID;
            $userid = $value->better_contractor_id;
            $userdata = get_userdata($userid);
            $username = $userdata->display_name;
            $user_phone_number = $value->phonenumber;
            $user_email = $value->emailaddress;
            $contractor_name_hwe = $value->contractor_name;
            $contractor_surname_hwe = $value->contractor_surname;

            $address_line1 = $value->address_line1;
            $city = $value->city;
            $postal_code = $value->postal_code;
            $country = $value->country;


        }
    }

    if (isset($_POST['insertuserset'])) {

        $username_add = $_REQUEST['username_add'];
        $emailaddress_add = $_REQUEST['emailaddress_add'];
        $password_add = $_REQUEST['password_add'];

        $user_id = username_exists($username_add);

        if (!$user_id && false == email_exists($emailaddress_add)) {

            $user_id = wp_create_user($username_add, $password_add, $emailaddress_add);

        } else {
            ?>
            <script>
                alert("User already exist.");
            </script>
            <?php


        }


    }



    $arr = array();

    $authors = $wpdb->get_results("SELECT ID, display_name from $wpdb->users 
                                ORDER BY display_name");

    foreach ($authors as $auth) {
        $user_id = $auth->ID;
        $user_name = $auth->display_name;
        ///$selected_hwe = '';
        // if ($userid == $user_id) {
        //     $selected_hwe = 'selected';
        // }
       //$options .= '<option value="' . $user_id . '" ' . $selected_hwe . '>' . $user_name . '</option>';
    }
    ?>
    <form method="post">
        <!-- <div class="form-group" style="display:flex;">
            <label for="inputState">Better ContractorID</label>
            <select id="inputState" class="form-control" name="userset" required>
                <option selected>Better ContractorID </option>

                        <?php echo $options; ?>
            </select>
            &nbsp;&nbsp;
            or
            <div class="container">

                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add
                    Better ContractorID</button> -->

                <!-- Modal -->


            <!-- </div>
        </div> -->


        <div class="form-group">
            <label for="inputState">Contractor ID</label>

            <input type="text" name = "userset" placeholder="Enter Unique Contractor ID" value="<?php echo $username; ?>" class="form-control"/>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Contractor Name</label>
            <input required type="text" value="<?php echo $contractor_name_hwe; ?>" name="contractor_name" class="form-control"
                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Contractor Name">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Contractor Surname</label>
            <input required type="text" value="<?php echo $contractor_surname_hwe; ?>" name="contractor_surname"
                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Contractor Surname">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input required type="email" value="<?php echo $user_email; ?>" name="emailaddress" class="form-control"
                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Phone Number</label>
            <input required type="number" value="<?php echo $user_phone_number; ?>" name="phonenumber"
                class="form-control" id="exampleInputPassword1" placeholder="Enter Phone Number">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Enter Area</label>
            <input required type="text" value="<?php echo $address_line1; ?>" name="address_line1" class="form-control"
                id="exampleInputPassword1" placeholder="Enter Area">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">City</label>
            <input required type="text" value="<?php echo $city; ?>" name="city" class="form-control"
                id="exampleInputPassword1" placeholder="Enter City">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Postal Code</label>
            <input required type="text" value="<?php echo $postal_code; ?>" name="postal_code" class="form-control"
                id="exampleInputPassword1" placeholder="Enter Postal Code">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Country</label>
            <input required type="text" value="<?php echo $country; ?>" name="country" class="form-control"
                id="exampleInputPassword1" placeholder="Enter Country Name">
        </div>



        <button type="submit" name="<?php echo $usersavebutton_name; ?>" class="btn btn-primary">Submit</button>
    </form>

    <form method="post">
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add User</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleInputEmail3">User name</label>
                            <input required type="text" name="username_add" class="form-control" id="exampleInputEmail3"
                                aria-describedby="emailHelp" placeholder="Enter username">

                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input required type="email" name="emailaddress_add" class="form-control"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                                else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">User Password</label>
                            <input required type="number" name="password_add" class="form-control"
                                id="exampleInputPassword1" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-default" name="insertuserset2">Submit</button>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>