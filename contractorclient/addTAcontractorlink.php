<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<h3>Add TA Contractor Link</h3>
<div class="container" style="width:90%">

    <?php


    if (isset($_POST['dateemail'])) {
        $dateemail = $_REQUEST['dateemail'];
        $datetimesheet = $_REQUEST['datetimesheet'];
        $days = $_REQUEST['days'];
        $emailtemplate = $_REQUEST['emailtemplate'];
        update_option("dateemailhwe", $dateemail);
        update_option("datetimesheet", $datetimesheet);
        update_option("dayshwe", $days);
        update_option("emailtemplate", $emailtemplate);
        update_option("timesheet_sucess_mail_contractor", $_REQUEST['timesheet_sucess_mail_contractor']);



        update_option('approved_client_template', $_REQUEST['approved_client_template']);

        update_option("client_invoice_created_template", $_REQUEST['client_invoice_created_template']);

        echo "<font color='green'>Settings saved successfully.</font>";
    }
    ?>



    <?php
    global $wpdb;
    $contractors = $wpdb->prefix . "TA_contractor_link";
    if (isset($_REQUEST['insertuserset'])) {

        $contractor_id = $_REQUEST['contractor_id'];
        $client_id = $_REQUEST['client_id'];
        $client_representative_name = $_REQUEST['client_representative_name'];
        // $client_representative_email = $_REQUEST['client_representative_email'];
        $client_department_name = $_REQUEST['client_department_name'];
        $client_department_email = $_REQUEST['client_department_email'];
        $contractor_hourly_rate = $_REQUEST['contractor_hourly_rate'];
        $contractid = $_REQUEST['contractid'];
        $status = $_REQUEST['status'];

        
        $select_talink_data = $wpdb->get_results("SELECT * from $contractors where better_ta_id='$client_id' && Better_contractor_id='$contractor_id'",ARRAY_A);
      
        
        if(count($select_talink_data) > 0)
        {
     
            echo "<script>";
            echo 'alert("Contractor ID and TA ID already Exist.");';
            echo "</script>";
        }
        else
        {
            //  xero='$client_representative_email',
            $insert = "INSERT into $contractors set 
            better_ta_id='$client_id',
            Better_contractor_id='$contractor_id',
            max_hours='$client_department_name',
            client_ta_rate='$contractor_hourly_rate'";
            $wpdb->query($insert);
    
    
            echo "<font>Data saved successfully.</font>";
            echo "<script>";
            echo "location.replace('admin.php?page=TA_contractor_link');";
            echo "</script>";
        }
      
    }
    //}
    
    $usersavebutton_name = 'insertuserset';
    $account_number = '';
    $emailaddress = '';
    $client_name = '';
    if (isset($_REQUEST['edit']) && $_REQUEST['edit'] != '') {
        $edit_user_id = $_REQUEST['edit'];
        $usersavebutton_name = 'updateuserset';


        if (isset($_REQUEST['updateuserset'])) {

            $ta_number = $_REQUEST['ta_number'];
            $contract_start_date = $_REQUEST['contract_start_date'];
            $contract_end_date = $_REQUEST['contract_end_date'];
            $contractor_id = $_REQUEST['contractor_id'];
            $client_id = $_REQUEST['client_id'];
            $client_representative_name = $_REQUEST['client_representative_name'];
            // $client_representative_email = $_REQUEST['client_representative_email'];
            $client_department_name = $_REQUEST['client_department_name'];
            $client_department_email = $_REQUEST['client_department_email'];
            $contractor_hourly_rate = $_REQUEST['contractor_hourly_rate'];
            $contractid = $_REQUEST['contractid'];
            $status = $_REQUEST['status'];
            // xero='$client_representative_email',
            $insert = "UPDATE $contractors set
        better_ta_id='$client_id',
        Better_contractor_id='$contractor_id',
        max_hours='$client_department_name',
        client_ta_rate='$contractor_hourly_rate' where ID='$edit_user_id'";
            $wpdb->query($insert);

            echo "<font>Data updated successfully.</font>";
            echo "<script>";
            echo "location.replace('admin.php?page=TA_contractor_link');";
            echo "</script>";
        }

        $contractors = $wpdb->prefix . "TA_contractor_link";
        $id = $_REQUEST['edit'];
        $select = "select * from $contractors where ID='$id'";
        $results = $wpdb->get_results($select);

        $i = 1;
        foreach ($results as $value) {

            $id = $value->ID;
            $contractid = $value->contractid;
            $ta_number_hwe = $value->ta_number;
            $contract_start_date_hwe = $value->contract_start_date;
            $contract_end_date_hwe = $value->contract_end_date;
            $contractor_id_hwe = $value->Better_contractor_id;
            $client_id_hwe = $value->better_ta_id;
            $client_representative_name_hwe = $value->client_representative_name;
            // $client_representative_email_hwe = $value->xero;
            $client_department_name_hwe = $value->max_hours;
            $client_department_email_hwe = $value->client_department_email;
            $contractor_hourly_rate_hwe = $value->client_ta_rate;
            $status = $value->status;

        }

    }

    $options = '';

    $contractors = $wpdb->prefix . "contractors";
    $select1 = "select * from $contractors order by ID desc";
    $results1 = $wpdb->get_results($select1);

    $selected_hwe = '';
    foreach ($results1 as $value1) {
        $contractor_name = $value1->ID;
        $contracot_id = $value1->better_contractor_id;

        $contractor_id_ai = $value1->ID;



        $authors = $wpdb->get_results("SELECT ID, display_name from $wpdb->users 
    where ID='" . $contracot_id . "' ORDER BY display_name DESC");

        //$selected_hwe='';
        foreach ($authors as $auth) {
            $user_id = $auth->ID;

            $user_name = $auth->display_name;
            $selected_hwe = '';
            if ($contractor_id_hwe == $contractor_id_ai) {
                $selected_hwe = 'selected';
            }
            $options .= '<option value="' . $contractor_id_ai . '" ' . $selected_hwe . '>' . $user_name . '</option>';
        }


    }

    $options_client_name = '';
    $client_table = $wpdb->prefix . "contract_rates";
    $select2 = "select * from $client_table order by ID desc";
    $results2 = $wpdb->get_results($select2);

    foreach ($results2 as $value2) {
        $client_id = $value2->ID;

        $client_name = $value2->contract_id;

        $selected_client = '';
        if ($client_id_hwe == $client_id) {
            $selected_client = 'selected';
        }
        $options_client_name .= '<option value="' . $client_id . '" ' . $selected_client . '>' . $client_name . '</option>';
    }



    ?>
    <form method="post">
        <div class="form-group">
            <label for="inputState">Contractor ID</label>
            <select id="inputState" name="contractor_id" class="form-control" required>
                <option value="">Select Contractor</option>

                <?php echo $options; ?>
            </select>

        </div>

        <div class="form-group">
            <label for="inputState">TA ID</label>
            <select id="inputState" name="client_id" class="form-control" required>
                <option value="">Select contract</option>
                <?php echo $options_client_name; ?>
            </select>
        </div>

        <!-- <div class="form-group">
            <label for="exampleInputEmail1">Xero</label>
            <input type="varchar" name="client_representative_email" class="form-control"
                value="<?php //echo $client_representative_email_hwe; ?>" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Xero" required>

        </div> -->
        <div class="form-group">
            <label for="exampleInputEmail1">Max Hours</label>
            <input type="number" name="client_department_name" class="form-control"
                value="<?php echo $client_department_name_hwe; ?>" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Max Hours" required>

        </div>




        <div class="form-group">
            <label for="exampleInputEmail1">Client TA Rate</label>
            <input type="number" name="contractor_hourly_rate" class="form-control"
                value="<?php echo $contractor_hourly_rate_hwe; ?>" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Client TA Rate" required>
        </div>

        <button type="submit" name="<?php echo $usersavebutton_name; ?>" class="btn btn-primary ">Submit</button>

    </form>
</div>