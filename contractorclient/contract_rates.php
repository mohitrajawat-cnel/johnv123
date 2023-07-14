<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<h3>Contract Details</h3>
<div class="container" style="width:90%">
<?php


 $arr=array();
 global $wpdb;

 //delete contractor
 $contractors=$wpdb->prefix."contract_rates";
 if(isset($_REQUEST['delete']) && $_REQUEST['delete'] == '1')
 {
  $delete_user_id = $_REQUEST['deleteid'];
  // $delete ="DELETE from $contractors where ID='".$delete_user_id."'";
  $contract_update_status ="UPDATE $contractors SET contract_delete_status='1' where ID='".$delete_user_id."'";
  $wpdb->query($contract_update_status);
  echo "<font>Data delete successfully.</font>";
  echo "<script>";
  echo "location.replace('admin.php?page=contract_rates');";
  echo "</script>";
 }

  ?>
  <!-- Trigger the modal with a button -->
  <a href="admin.php?page=contract_rates&add=1"><button type="button" class="btn btn-primary" style="float:right;" data-toggle="modal" >Add Contract</button></a>
<form method="post">
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">TA ID</th>
        <th scope="col">Client Department Name</th>
        <th scope="col">TA End Date</th>
        <th scope="col">Invoice Method</th>
        <th scope="col">Created By</th>
        <th scope="col">Created</th>
        <th scope="col">Option</th>
      </tr>
    </thead>
    <tbody>
    
    <?php
  $contractors=$wpdb->prefix."contract_rates";
  $select="select * from $contractors where contract_delete_status='0' order by ID desc";
  $results=$wpdb->get_results($select);

  $i=1;
  foreach($results as $value)
  {
   
        $id=$value->ID;
        $contractid=$value->contract_id;
        $contract_start_date_hwe=$value->TA_start_date;
        $contract_end_date_hwe=$value->TA_end_date;
        $contractor_id_hwe=$value->contractor_id;
        $client_id_hwe=$value->client_id;
        $client_representative_name_hwe=$value->client_invoice_representative;
        $client_representative_email_hwe=$value->client_invoice_representative_email;
        $client_department_name_hwe=$value->client_department_name;
        $client_department_email_hwe=$value->TA_approval_contact_email;
        $contractor_hourly_rate_hwe=$value->TA_approval_representative;
        $timesheet_status=$value->timesheet_status;
        $reminder_date_hwe=$value->reminder_date;
        $invoice_hwe=$value->invoice_method;

        $approve_disapprove_status = $value->approve_disapprove_status;

        if($invoice_hwe == 1)
        {
          $status_message = 'Grouped';
        }
        else if($invoice_hwe == 0)
        {
          $status_message = 'Individual';
        }

        $send_mail_button='';
        if($timesheet_status != 1 )
        {
            $send_mail_button = '<a style="margin-left: 2%;" class="btn btn-primary" href="admin.php?page=contract_rates&send_mail='.$id.'">Send Mail</a>';
        }

        $full_name = '';
        if($value->contract_created_by > 0)
        {
        $created_bt_yser_id = $value->contract_created_by;
        $userdatahwe = get_userdata($created_bt_yser_id);
    
        $created_by_display_name  =$userdatahwe->display_name;
        $created_by_display_email  =$userdatahwe->user_email;
    
        $full_name = $created_by_display_name;
        if($created_by_display_email != '')
        {
          $full_name = $created_by_display_name.'('.$created_by_display_email.')';
        }
        }

    ?>
      <tr> 
      <td><?php echo $i; $i++; ?></td>
    <td><?php echo $contractid; ?></td>
    <td><?php echo $client_department_name_hwe;?></td>
    <td><?php echo $contract_end_date_hwe; ?></td>
    <td><?php echo $status_message; ?></td>
    <td><?php echo $full_name; ?></td>
    <td><?php echo $value->created; ?></td>
        <!-- <td><?php //echo $status_message; ?></td> -->
        <td style="display:flex" >
        <a style="margin-left: 2%;" href="admin.php?page=contract_rates&delete=1&deleteid=<?php echo $id; ?>"><i class="bi-trash" style="color:red;font-size: 20px;"></i></a>
        <a style="margin-left: 2%;" href="admin.php?page=contract_rates&add=1&edit=<?php echo $id; ?>"><i class="fas fa-edit text-primary" style="font-size: 20px;"></i></a>
        <!-- <a style="margin-left: 2%;" class="btn btn-primary" href="admin.php?page=contractor_details&add=1&edit=<?php echo $contractor_id_hwe;?>">contractor</a> -->
       <?php //echo $send_mail_button; ?>
 
        </td>
      </tr>
    
      <?php } ?>
    </tbody>
  </table>
 </form>
 <?php
if(isset($_REQUEST['send_mail']) && $_REQUEST['send_mail'] != '')
{
    $today_date = date("Y-m-d");
    $today_date_timestamp = strtotime($today_date);
    $contract_id = $_REQUEST['send_mail'];
    $select_data = $wpdb->get_results("SELECT * from ".$wpdb->prefix."contract_rates where timesheet_status !='1' && status='1' && ID='".$contract_id."'",ARRAY_A);

    foreach($select_data as $contract_data)
    {
        $cueent_monthdate = date("Y-m");
        $contractor_id = $contract_data['contractor_id'];
        $contract_id = $contract_data['ID'];

   

        $contractors=$wpdb->prefix."contractors";
        $select1="select * from $contractors where ID='".$contractor_id."' order by ID desc";
        $results1=$wpdb->get_results($select1);
        if(count($results1) > 0)
        {

          foreach($results1 as $value1)
          {
              $contractor_email = $value1->emailaddress;
              $userid_hwe = $value1->userid;

              $authors = $wpdb->get_results("SELECT ID, display_name from $wpdb->users 
              where ID='".$userid_hwe."' ORDER BY display_name");
          
              foreach($authors as $auth)
              {
                  $user_id = $auth->ID;
                  $contractor_name = $auth->display_name;
              }
            
          }    

          $client_id = $contract_data['client_id'];

          $client_table=$wpdb->prefix."clients";
          $select2="select * from $client_table where ID='".$client_id."' order by ID desc";
          $results2=$wpdb->get_results($select2);
          foreach($results2 as $value2)
          {
              $client_name = $value2->client_name;
          }

          $ta_number = $contract_data['ta_number'];

          $datetime_submit_date = get_option('datetimesheet');
          $timesheet_date = $cueent_monthdate.'-'.$datetime_submit_date;

          $deadline_timesheet_date = get_option('dayshwe');

          $timesheed_dead_line_date = date('Y-m-d', strtotime($timesheet_date. ' + '.$deadline_timesheet_date.' day'));

          if(empty($contract_data['random_mail_token']) || $contract_data['random_mail_token'] == '')
          {
            $bytes = random_bytes(20);
            $randow_token_for_timesheet = bin2hex($bytes);
          }
          else
          {
            $randow_token_for_timesheet = $contract_data['random_mail_token'];
          }
    


          $update="UPDATE ".$wpdb->prefix."contract_rates SET deadline_date = '".$timesheed_dead_line_date."',
          random_mail_token='".$randow_token_for_timesheet."' where ID='".$contract_id."'";
          $wpdb->query($update);

          $template_id = get_option('emailtemplate');
          $blog_name = 'John';

          $select_template = $wpdb->get_results("SELECT * from ".$wpdb->prefix."newsletter_emails where id='".$template_id."'",ARRAY_A);

          foreach($select_template as $template_date)
          {
              $email_html_data = $template_date['message'];
              $subject = $template_date['subject'];
          }


          
          $email_html_data = str_replace('[CONTRACTOR_NAME]',$contractor_name,$email_html_data);
          $email_html_data = str_replace('[CLIENT_NAME]',$client_name,$email_html_data);
          $email_html_data = str_replace('[TA_NUMBER]',$ta_number,$email_html_data);
          $email_html_data = str_replace('[TIMESHEET_DATE]',$timesheet_date,$email_html_data);
          $email_html_data = str_replace('[DEADLINE_DATE]',$timesheed_dead_line_date,$email_html_data);
          $email_html_data = str_replace('[TIMESHEET_LINK]','<a href="'.get_site_url().'/submit-timesheet?randow_string_hwe='.$randow_token_for_timesheet.'" class="btn btn-primary">Submit Timesheet</a>',$email_html_data);
         // $email_html_data = str_replace('[SITE_BLOG]',$blog_name,$email_html_data);
          

           echo $to = $contractor_email;
            //$from = "admin@readyforyourreview.com";
            $from = "tjohannvr@datasymphony.com";
           //$from = "noreply@taxon.be";
            $subject = $subject;

            
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <'.$from.'>' . '\r\n' . 'CC: admin@datasymphony.com';
            

            $message = $email_html_data;


            if(mail($to, $subject, $message, $headers))
            {
              echo "send";
              echo "<br>";
              echo $message;
              $update="UPDATE ".$wpdb->prefix."contract_rates SET mail_send_status = '1',mail_send_date='".$today_date_timestamp."' where ID='".$contract_id."'";
            
              $wpdb->query($update);

              ?>
                <script>
                    //window.location.href= '<?php echo get_site_url() ?>/wp-admin/admin.php?page=contract_rates';
                </script>
              <?php
            }
            else{
              echo "unsend";
              ?>
                <script>
                 
                    window.location.href=  '<?php echo get_site_url() ?>/wp-admin/admin.php?page=contract_rates';
                </script>
              <?php
            }

        }
        else
        {
          $update="UPDATE $contractors SET mail_send_status = '0'";
          $wpdb->query($update);
        }

            
    }
      
            
    
}
?>
