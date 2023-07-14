<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  .texthwe {
    width: 70%;
}
  </style>
  <div class="container">
  <h2>Setting</h2>
  <?php 
  if(isset($_POST['save_templates']))
  {
	  // $dateemail=$_REQUEST['dateemail'];
    // $datetimesheet=$_REQUEST['datetimesheet'];
    // $days=$_REQUEST['days'];
    $emailtemplate=$_REQUEST['emailtemplate'];
    // update_option("dateemailhwe",$dateemail);
    // update_option("datetimesheet",$datetimesheet);
    // update_option("dayshwe",$days);
    update_option("emailtemplate",$emailtemplate);
    update_option("timesheet_sucess_mail_contractor",$_REQUEST['timesheet_sucess_mail_contractor']);

    

    update_option('approved_client_template',$_REQUEST['approved_client_template']);

    update_option("client_invoice_created_template",$_REQUEST['client_invoice_created_template']);

    update_option("approval_timesheet_client_to_contractor",$_REQUEST['approval_timesheet_client_to_contractor']);

    update_option("approval_timesheet_client_to_client",$_REQUEST['approval_timesheet_client_to_client']);
    
    update_option("disapproval_timesheet_client_to_client",$_REQUEST['disapproval_timesheet_client_to_client']);

    update_option("disapproval_timesheet_client_to_contractor",$_REQUEST['disapproval_timesheet_client_to_contractor']);

    update_option("to_reminer_mail_send_option",$_REQUEST['to_reminer_mail_send_option']);
    update_option("cc_reminer_mail_send_option",$_REQUEST['cc_reminer_mail_send_option']);

    update_option("to_client_approved_send_option",$_REQUEST['to_client_approved_send_option']);
    update_option("cc_client_approved_send_option",$_REQUEST['cc_client_approved_send_option']);

    update_option("to_timesheet_success_mail_send_option",$_REQUEST['to_timesheet_success_mail_send_option']);
    update_option("cc_timesheet_success_mail_send_option",$_REQUEST['cc_timesheet_success_mail_send_option']);

    update_option("to_invoice_created_mail_send_option",$_REQUEST['to_invoice_created_mail_send_option']);
    update_option("cc_invoice_created_mail_send_option",$_REQUEST['cc_invoice_created_mail_send_option']);
    
    update_option("to_approval_timesheet_client_contractor_send_option",$_REQUEST['to_approval_timesheet_client_contractor_send_option']);
    update_option("cc_approval_timesheet_client_contractor_send_option",$_REQUEST['cc_approval_timesheet_client_contractor_send_option']);

    update_option("to_approval_timesheet_client_to_client_send_option",$_REQUEST['to_approval_timesheet_client_to_client_send_option']);
    update_option("cc_approval_timesheet_client_to_client_send_option",$_REQUEST['cc_approval_timesheet_client_to_client_send_option']);

    update_option("to_disapproval_timesheet_client_to_client_send_option",$_REQUEST['to_disapproval_timesheet_client_to_client_send_option']);
    update_option("cc_disapproval_timesheet_client_to_client_send_option",$_REQUEST['cc_disapproval_timesheet_client_to_client_send_option']);

    update_option("to_disapproval_timesheet_client_to_contractor_send_option",$_REQUEST['to_disapproval_timesheet_client_to_contractor_send_option']);
    update_option("cc_disapproval_timesheet_client_to_contractor_send_option",$_REQUEST['cc_disapproval_timesheet_client_to_contractor_send_option']);
      
    
    echo "<font color='green'>Settings saved successfully.</font>";
  }
  ?>
  <form action="" method="post">
    <!-- <div class="form-group">
      <label for="email">Select Date(When email sent to contractor):</label>
      <select  class="form-control texthwe"   name="dateemail" required>
	  <?php
    // for($i=1;$i<=28;$i++)
	  //{
		  ?>
	 <option <?php 
   //if(get_option('dateemailhwe')==$i) {echo "selected=selected"; } else { echo "";} ?>><?php echo $i; ?></option>
	  <?php
    // }
     ?>
	  </select>
    </div> -->
	
	<!-- <div class="form-group">
      <label for="email">Deadline for submitting timesheet:</label>
     <select  class="form-control texthwe"   name="datetimesheet" required>
	  <?php
     //for($i=1;$i<=28;$i++)
	 // {
		  ?>
	 <option
    <?php
    //if(get_option('datetimesheet')==$i) {echo "selected=selected"; } else { echo "";} ?> ><?php echo $i; ?></option>
	  <?php 
    //} ?>
	  </select>
	  Use [deadline] as placeholder.
    </div> -->
	
	<!-- <div class="form-group">
      <label for="email">Days for expiring timesheet link:</label>
      <input type="numbre" value="<?php 
      //echo get_option('dayshwe'); 
      ?>"
       class="form-control texthwe"  placeholder="Enter days" name="days" required>
    </div> -->
    <!-- <div class="form-group">
      <label for="email">Admin Email For Mail:</label>
      <input type="text" value="<?php //echo get_option('admin_email_for_mail_send'); 
      ?>"
       class="form-control texthwe"  placeholder="Enter Admin Email For Mail Send" name="admin_email_for_mail_send" required>
    </div> -->
    <div class="form-group">
      <div class="row">
        <div class="col-md-6">
          <label for="pwd">Select Timesheet Reminder Email Template:</label>
          <select class="form-control" name="emailtemplate" required>
            <option value="">Please select</option>
            <?php 
            global $wpdb;
            $newsemails=$wpdb->prefix."newsletter_emails"; 
            $select="select * from $newsemails where subject!='' order by id desc";
            $results=$wpdb->get_results($select);
            foreach($results as $value)
            {
            ?>
                <option value="<?php echo $value->id; ?>" <?php if(get_option("emailtemplate")==$value->id) { echo "selected=selected"; } else { echo " ";} ?>><?php echo $value->subject;?></option>
            <?php 
            }
            ?> 
          </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">To Email:</label>
          <select class="form-control" name="to_reminer_mail_send_option" required>
            <option value="0" <?php if(get_option("to_reminer_mail_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("to_reminer_mail_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("to_reminer_mail_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("to_reminer_mail_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">CC Email:</label>
          <select class="form-control" name="cc_reminer_mail_send_option" required>
            <option value="0" <?php if(get_option("cc_reminer_mail_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("cc_reminer_mail_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("cc_reminer_mail_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("cc_reminer_mail_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
      </div>
    </div>



    <div class="form-group">
      <div class="row">
        <div class="col-md-6">
          <label for="pwd">Select Timesheet Approve Template:</label>
          <select class="form-control" name="approved_client_template" required>
          <option value="">Please select</option>
            <?php 
            global $wpdb;
            $newsemails=$wpdb->prefix."newsletter_emails"; 
              $select="select * from $newsemails where subject!='' order by id desc";
            $results=$wpdb->get_results($select);
            foreach($results as $value)
            {

              ?>
            
              <option value="<?php echo $value->id; ?>" <?php if(get_option("approved_client_template")==$value->id) { echo "selected=selected"; } else { echo " ";} ?>><?php echo $value->subject;?></option>
            <?php 
            } 
            ?> 
        </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">To Email:</label>
          <select class="form-control" name="to_client_approved_send_option" required>
            <option value="0" <?php if(get_option("to_client_approved_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("to_client_approved_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("to_client_approved_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("to_client_approved_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">CC Email:</label>
          <select class="form-control" name="cc_client_approved_send_option" required>
            <option value="0" <?php if(get_option("cc_client_approved_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("cc_client_approved_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("cc_client_approved_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("cc_client_approved_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-md-6">
          <label for="pwd">Select Template For Succesfully Timesheet Submit for Contractor :</label>
          <select class="form-control" name="timesheet_sucess_mail_contractor" required>
            <option value="">Please select</option>
              <?php 
              global $wpdb;
              $newsemails=$wpdb->prefix."newsletter_emails"; 
                $select="select * from $newsemails where subject!='' order by id desc";
              $results=$wpdb->get_results($select);
              foreach($results as $value)
              {

                ?>
              
                <option value="<?php echo $value->id; ?>" <?php if(get_option("timesheet_sucess_mail_contractor")==$value->id) { echo "selected=selected"; } else { echo " ";} ?>><?php echo $value->subject;?></option>
              <?php 
              } 
              ?> 
        </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">To Email:</label>
          <select class="form-control" name="to_timesheet_success_mail_send_option" required>
            <option value="0" <?php if(get_option("to_timesheet_success_mail_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("to_timesheet_success_mail_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("to_timesheet_success_mail_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("to_timesheet_success_mail_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">CC Email:</label>
          <select class="form-control" name="cc_timesheet_success_mail_send_option" required>
            <option value="0" <?php if(get_option("cc_timesheet_success_mail_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("cc_timesheet_success_mail_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("cc_timesheet_success_mail_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("cc_timesheet_success_mail_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-md-6">
          <label for="pwd">Select Template For Invoice Created For Client Mail :</label>
          <select class="form-control" name="client_invoice_created_template" required>
            <option value="">Please select</option>
              <?php 
              global $wpdb;
              $newsemails=$wpdb->prefix."newsletter_emails"; 
                $select="select * from $newsemails where subject!='' order by id desc";
              $results=$wpdb->get_results($select);
              foreach($results as $value)
              {

                ?>
              
                <option value="<?php echo $value->id; ?>" <?php if(get_option("client_invoice_created_template")==$value->id) { echo "selected=selected"; } else { echo " ";} ?>><?php echo $value->subject;?></option>
              <?php 
              } 
              ?> 
        </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">To Email:</label>
          <select class="form-control" name="to_invoice_created_mail_send_option" required>
            <option value="0" <?php if(get_option("to_invoice_created_mail_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("to_invoice_created_mail_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("to_invoice_created_mail_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("to_invoice_created_mail_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">CC Email:</label>
          <select class="form-control" name="cc_invoice_created_mail_send_option" required>
            <option value="0" <?php if(get_option("cc_invoice_created_mail_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("cc_invoice_created_mail_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("cc_invoice_created_mail_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("cc_invoice_created_mail_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-md-6">
          <label for="pwd">Select Template For Approval Timesheet Client To Contractor:</label>
          <select class="form-control" name="approval_timesheet_client_to_contractor" required>
          <option value="">Please select</option>
            <?php 
            global $wpdb;
            // print_r(get_option("approval_timesheet_client_to_contractor"));
            // die("=======");
              $newsemailssd=$wpdb->prefix."newsletter_emails"; 
              $selectfg="select * from $newsemailssd where subject!='' order by id desc";
              $resultsdd=$wpdb->get_results($selectfg);
              foreach($resultsdd as $value_hwe)
              {
                ?>
                <option value="<?php echo $value_hwe->id; ?>" <?php if(get_option("approval_timesheet_client_to_contractor")==$value_hwe->id) { echo "selected=selected"; } else { echo " ";} ?>><?php echo $value_hwe->subject;?></option>
              <?php 
              } 
              ?> 
        </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">To Email:</label>
          <select class="form-control" name="to_approval_timesheet_client_contractor_send_option" required>
            <option value="0" <?php if(get_option("to_approval_timesheet_client_contractor_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("to_approval_timesheet_client_contractor_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("to_approval_timesheet_client_contractor_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("to_approval_timesheet_client_contractor_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">CC Email:</label>
          <select class="form-control" name="cc_approval_timesheet_client_contractor_send_option" required>
            <option value="0" <?php if(get_option("cc_approval_timesheet_client_contractor_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("cc_approval_timesheet_client_contractor_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("cc_approval_timesheet_client_contractor_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("cc_approval_timesheet_client_contractor_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
      </div>
    </div>


    <div class="form-group">
      <div class="row">
        <div class="col-md-6">
          <label for="pwd">Select Template For Approval Timesheet Client To Client:</label>
          <select class="form-control" name="approval_timesheet_client_to_client" required>
          <option value="">Please select</option>
            <?php 
            global $wpdb;
            // print_r(get_option("approval_timesheet_client_to_contractor"));
            // die("=======");
              $newsemailssd=$wpdb->prefix."newsletter_emails"; 
              $selectfg="select * from $newsemailssd where subject!='' order by id desc";
              $resultsdd=$wpdb->get_results($selectfg);
              foreach($resultsdd as $value_hwe)
              {
                ?>
                <option value="<?php echo $value_hwe->id; ?>" <?php if(get_option("approval_timesheet_client_to_client")==$value_hwe->id) { echo "selected=selected"; } else { echo " ";} ?>><?php echo $value_hwe->subject;?></option>
              <?php 
              } 
              ?> 
        </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">To Email:</label>
          <select class="form-control" name="to_approval_timesheet_client_to_client_send_option" required>
            <option value="0" <?php if(get_option("to_approval_timesheet_client_to_client_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("to_approval_timesheet_client_to_client_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("to_approval_timesheet_client_to_client_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("to_approval_timesheet_client_to_client_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">CC Email:</label>
          <select class="form-control" name="cc_approval_timesheet_client_to_client_send_option" required>
            <option value="0" <?php if(get_option("cc_approval_timesheet_client_to_client_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("cc_approval_timesheet_client_to_client_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("cc_approval_timesheet_client_to_client_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("cc_approval_timesheet_client_to_client_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-md-6">
          <label for="pwd">Select Template For Disapproval Timesheet Client To Client:</label>
          <select class="form-control" name="disapproval_timesheet_client_to_client" required>
          <option value="">Please select</option>
            <?php 
            global $wpdb;
            // print_r(get_option("approval_timesheet_client_to_contractor"));
            // die("=======");
              $newsemailssd=$wpdb->prefix."newsletter_emails"; 
              $selectfg="select * from $newsemailssd where subject!='' order by id desc";
              $resultsdd=$wpdb->get_results($selectfg);
              foreach($resultsdd as $value_hwe)
              {
                ?>
                <option value="<?php echo $value_hwe->id; ?>" <?php if(get_option("disapproval_timesheet_client_to_client")==$value_hwe->id) { echo "selected=selected"; } else { echo " ";} ?>><?php echo $value_hwe->subject;?></option>
              <?php 
              } 
              ?> 
        </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">To Email:</label>
          <select class="form-control" name="to_disapproval_timesheet_client_to_client_send_option" required>
            <option value="0" <?php if(get_option("to_disapproval_timesheet_client_to_client_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("to_disapproval_timesheet_client_to_client_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("to_disapproval_timesheet_client_to_client_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("to_disapproval_timesheet_client_to_client_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">CC Email:</label>
          <select class="form-control" name="cc_disapproval_timesheet_client_to_client_send_option" required>
            <option value="0" <?php if(get_option("cc_disapproval_timesheet_client_to_client_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("cc_disapproval_timesheet_client_to_client_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("cc_disapproval_timesheet_client_to_client_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("cc_disapproval_timesheet_client_to_client_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="row">
        <div class="col-md-6">
          <label for="pwd">Select Template For Disapproval Timesheet Client To Contractor:</label>
          <select class="form-control" name="disapproval_timesheet_client_to_contractor" required>
          <option value="">Please select</option>
            <?php 
            global $wpdb;
            // print_r(get_option("approval_timesheet_client_to_contractor"));
            // die("=======");
              $newsemailssd=$wpdb->prefix."newsletter_emails"; 
              $selectfg="select * from $newsemailssd where subject!='' order by id desc";
              $resultsdd=$wpdb->get_results($selectfg);
              foreach($resultsdd as $value_hwe)
              {
                ?>
                <option value="<?php echo $value_hwe->id; ?>" <?php if(get_option("disapproval_timesheet_client_to_contractor")==$value_hwe->id) { echo "selected=selected"; } else { echo " ";} ?>><?php echo $value_hwe->subject;?></option>
              <?php 
              } 
              ?> 
        </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">To Email: Contractor</label>
          <select class="form-control" name="to_disapproval_timesheet_client_to_contractor_send_option" required>
            <option value="0" <?php if(get_option("to_disapproval_timesheet_client_to_contractor_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("to_disapproval_timesheet_client_to_contractor_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("to_disapproval_timesheet_client_to_contractor_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("to_disapproval_timesheet_client_to_contractor_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
        <div class="col-md-3">
          <label for="pwd">CC Email: Admin</label>
          <select class="form-control" name="cc_disapproval_timesheet_client_to_contractor_send_option" required>
            <option value="0" <?php if(get_option("cc_disapproval_timesheet_client_to_contractor_send_option")==0) { echo "selected=selected"; } else { echo " ";} ?>>Client</option>
            <option value="1" <?php if(get_option("cc_disapproval_timesheet_client_to_contractor_send_option")==1) { echo "selected=selected"; } else { echo " ";} ?>>Contractor</option>
            <option value="2" <?php if(get_option("cc_disapproval_timesheet_client_to_contractor_send_option")==2) { echo "selected=selected"; } else { echo " ";} ?>>Admin</option>
            <option value="3" <?php if(get_option("cc_disapproval_timesheet_client_to_contractor_send_option")==3) { echo "selected=selected"; } else { echo " ";} ?>>None</option>
          </select>
        </div>
      </div>
    </div>
    

    <button type="submit" class="btn btn-default" name="save_templates">Submit</button>
  </form>
</div>

