<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<h3>Add Contract</h3>
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
    $usersavebutton_name = '';
    $account_number = '';
    $emailaddress = '';
    $client_name = '';
    $contractors = $wpdb->prefix . "contract_rates";


    if (isset($_REQUEST['add']) && $_REQUEST['add'] != '') {

        $usersavebutton_name = 'insertuserset';

        if (isset($_REQUEST['insertuserset'])) {

            $ta_number = $_REQUEST['ta_number'];
            $contract_start_date = $_REQUEST['contract_start_date'];
            $contract_end_date = $_REQUEST['contract_end_date'];
            $client_id = $_REQUEST['client_id'];
            $client_representative_name = $_REQUEST['client_representative_name'];
            $client_representative_email = $_REQUEST['client_representative_email'];
            $client_department_name = $_REQUEST['client_department_name'];
            $client_department_email = $_REQUEST['client_department_email'];
            $contractor_hourly_rate = $_REQUEST['contractor_hourly_rate'];
            $contractid = $_REQUEST['contractid'];
            $date = $_REQUEST['date'];
            $invoice = $_REQUEST['invoice'];
            $deadline_date = $_REQUEST['deadline_date'];

            $current_user_id = get_current_user_id();
            $get_currenttime = current_time( 'timestamp' );
            $get_current_date = date("Y-m-d",$get_currenttime);


            $client_table = $wpdb->prefix . "clients";
            $select2_hwe = "select * from $client_table where ID='$client_id' order by ID desc";
            $results2_hwe = $wpdb->get_results($select2_hwe);
            foreach ($results2_hwe as $value2_hwe) {

                $xero_contractid = $value2_hwe->xero_contractid;
               
            }


            $select_contract = "select * from $contractors where contract_id='$contractid'";
            $results_contract = $wpdb->get_results($select_contract, ARRAY_A);


            if (count($results_contract) > 0) {
                echo "<script>";
                echo 'alert("TA ID alreay exists");';
                echo "</script>";
            } else {

                $insert = "insert into $contractors set
            TA_start_date='$contract_start_date',
            TA_end_date='$contract_end_date',
            contract_id='$contractid',
            client_id='$client_id',
            client_invoice_representative='$client_representative_name',
            client_invoice_representative_email='$client_representative_email',
            client_department_name='$client_department_name',
            TA_approval_contact_email='$client_department_email',
            TA_approval_representative='$contractor_hourly_rate',
            reminder_date='$date',
            invoice_method='$invoice',
            contract_created_by='$current_user_id',
            created='$get_current_date',
            xero_contact_id='$xero_contractid',
            deadline_date='$deadline_date'";

                $wpdb->query($insert);

             

                echo "<font>Contract created successfully.</font>";
                echo "<script>";
                echo "location.replace('admin.php?page=contract_rates');";
                echo "</script>";
            }
        }

    }


    if (isset($_REQUEST['edit']) && $_REQUEST['edit'] != '') {
        $edit_user_id = $_REQUEST['edit'];
        $usersavebutton_name = 'updateuserset';


        if (isset($_REQUEST['updateuserset'])) {
            $ta_number = $_REQUEST['ta_number'];
            $contract_start_date = $_REQUEST['contract_start_date'];
            $contract_end_date = $_REQUEST['contract_end_date'];
            $client_id = $_REQUEST['client_id'];
            $client_representative_name = $_REQUEST['client_representative_name'];
            $client_representative_email = $_REQUEST['client_representative_email'];
            $client_department_name = $_REQUEST['client_department_name'];
            $client_department_email = $_REQUEST['client_department_email'];
            $contractor_hourly_rate = $_REQUEST['contractor_hourly_rate'];
            $contractid = $_REQUEST['contractid'];
            $date = $_REQUEST['date'];
            $deadline_date = $_REQUEST['deadline_date'];

            $invoice = $_REQUEST['invoice'];

            $client_table = $wpdb->prefix . "clients";
            $select2_hwe = "select * from $client_table where ID='$client_id' order by ID desc";
            $results2_hwe = $wpdb->get_results($select2_hwe);
            foreach ($results2_hwe as $value2_hwe) {

                $xero_contractid = $value2_hwe->xero_contractid;
               
            }


            $insert = "UPDATE $contractors set
        TA_start_date='$contract_start_date',
        TA_end_date='$contract_end_date',
        contract_id='$contractid',
        client_id='$client_id',
        client_invoice_representative='$client_representative_name',
        client_invoice_representative_email='$client_representative_email',
        client_department_name='$client_department_name',
        TA_approval_contact_email='$client_department_email',
        TA_approval_representative='$contractor_hourly_rate',
        reminder_date='$date',
        deadline_date='$deadline_date',
        xero_contact_id='$xero_contractid',
        invoice_method='$invoice' where ID='$edit_user_id'";
            $wpdb->query($insert);


            echo "<font>Contract edit successfully.</font>";
            echo "<script>";
            echo "location.replace('admin.php?page=contract_rates');";
            echo "</script>";
        }


        $contractors = $wpdb->prefix . "contract_rates";
        $id = $_REQUEST['edit'];
        $select = "select * from $contractors where ID='$id'";
        $results = $wpdb->get_results($select);


        $i = 1;
        foreach ($results as $value) {

            $id = $value->ID;
            $contractid = $value->contract_id;
            $ta_number_hwe = $value->ta_number;
            $contract_start_date_hwe = $value->TA_start_date;
            $contract_end_date_hwe = $value->TA_end_date;
            $contractor_id_hwe = $value->contract_id;

            $client_id_hwe = $value->client_id;
            $deadline_date_hwe = $value->deadline_date;
            $client_representative_name_hwe = $value->client_invoice_representative;
            $client_representative_email_hwe = $value->client_invoice_representative_email;
            $client_department_name_hwe = $value->client_department_name;
            $client_department_email_hwe = $value->TA_approval_contact_email;
            $contractor_hourly_rate_hwe = $value->TA_approval_representative;
            $date_hwe = $value->reminder_date;
            $invoice_hwe = $value->invoice_method;

        }

    }

    $options = '';
    $contractors = $wpdb->prefix . "contractors";
    $select1 = "select * from $contractors order by ID desc";
    $results1 = $wpdb->get_results($select1);

    $selected_hwe = '';
    foreach ($results1 as $value1) {
        $contractor_name = $value1->ID;
        $contracot_id = $value1->userid;

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
    $client_table = $wpdb->prefix . "clients";
    $select2 = "select * from $client_table order by ID desc";
    $results2 = $wpdb->get_results($select2);
    foreach ($results2 as $value2) {
        $client_id = $value2->ID;
        $client_name = $value2->client_name;

        $selected_client = '';
        if ($client_id_hwe == $client_id) {
            $selected_client = 'selected';
        }
        $options_client_name .= '<option value="' . $client_id . '" ' . $selected_client . '>' . $client_name . '</option>';

    }






    ?>
    <form method="post">

        <div class="form-group">
            <label for="exampleInputEmail1">TA ID</label>
            <input type="text" name="contractid" value="<?php echo $contractor_id_hwe; ?>" class="form-control"
                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Unique ID">
        </div>
        
        <div class="form-group">
            <label for="exampleInputPassword1">TA Start Date</label>
            <input type="date" name="contract_start_date" value="<?php echo $contract_start_date_hwe; ?>"
                class="form-control" id="exampleInputPassword1" placeholder="">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">TA End Date</label>
            <input type="date" name="contract_end_date" class="form-control"
                value="<?php echo $contract_end_date_hwe; ?>" id="exampleInputPassword1" placeholder="">
        </div>

        <div class="form-group">
            <label for="inputState">Client Name</label>
            <select id="inputState" name="client_id" class="form-control">
                <option value="">Select Client</option>
                <?php echo $options_client_name; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Client Invoice Representative</label>
            <input type="text" name="client_representative_name" class="form-control"
                value="<?php echo $client_representative_name_hwe; ?>" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter Client Invoice Representative">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Client Invoice Representative Email</label>
            <input type="email" name="client_representative_email" class="form-control"
                value="<?php echo $client_representative_email_hwe; ?>" id="exampleInputEmail1"
                aria-describedby="emailHelp" placeholder="Enter Client Invoice Representative Email">

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Client Department Name</label>
            <input type="text" name="client_department_name" class="form-control"
                value="<?php echo $client_department_name_hwe; ?>" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter Client Department Name">

        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">TA Approval Contact Email</label>
            <input type="email" name="client_department_email" class="form-control"
                value="<?php echo $client_department_email_hwe; ?>" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter TA Approval Contact Email">

        </div>


        <div class="form-group">
            <label for="exampleInputEmail1">TA Approval Representative</label>
            <input type="text" name="contractor_hourly_rate" class="form-control"
                value="<?php echo $contractor_hourly_rate_hwe; ?>" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter TA Approval Representative">
        </div>


        <!-- <div class="form-group">
            <label for="email">Reminder Date:</label>
            <input type="number" value="<?php //echo $date_hwe; ?>" class="form-control texthwe"
                placeholder="Enter number" name="date" required>

        </div> -->

        <div class="form-group">
    <label for="date">Reminder Date:</label>
    <select class="form-control" name="date" required>
        <?php
        $month = date('n'); // July
        $year = date('Y');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        for ($day = 1; $day <= $daysInMonth; $day++) {
            $selected = ($day == $date_hwe) ? 'selected' : '';
            echo "<option value=\"$day\" $selected>$day</option>";
        }
        ?>
    </select>
</div>



        <div class="form-group">
            <label for="email">Deadline Date:</label>
            <select class="form-control texthwe" name="deadline_date" required>
                <?php
                $month1 = date('n'); // July
                $year1 = date('Y');
                $daysInMonth1 = cal_days_in_month(CAL_GREGORIAN, $month1, $year1);
                for ($i = 1; $i <= $daysInMonth1; $i++) {
                    $selected_date = '';
                    if ($i == $deadline_date_hwe) {

                        $selected_date = 'selected';
                    }
                    echo "<option value='$i' $selected_date>$i</option>";
                }
                ?>
            </select>

        </div>


        <div class="form-group">
            <label for="pwd">Invoice Method</label>
            <select class="form-control" name="invoice" required>
                <option>please Select</option>
                <option <?php if ($invoice_hwe == 0) {
                    echo 'selected';
                } ?> value="0">Individual</option>
                <option <?php if ($invoice_hwe == 1) {
                    echo 'selected';
                } ?> value="1">Grouped</option>

            </select>
        </div>

        <button type="submit" name="<?php echo $usersavebutton_name; ?>" class="btn btn-primary ">Submit</button>
    </form>
</div>