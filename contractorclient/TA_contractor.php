<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
  integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<h3>TA Contractor Link</h3>
<div class="container" style="width:90%">
  <?php


  $arr = array();
  global $wpdb;

  //delete contractor
  $contractors = $wpdb->prefix . "TA_contractor_link";
  if (isset($_REQUEST['delete']) && $_REQUEST['delete'] == '1') {
    $delete_user_id = $_REQUEST['deleteid'];
    $delete = "DELETE from $contractors where ID='" . $delete_user_id . "'";
    $wpdb->query($delete);
    echo "<font>Data delete successfully.</font>";
    echo "<script>";
    echo "location.replace('admin.php?page=TA_contractor_link');";
    echo "</script>";
  }

  ?>
  <!-- Trigger the modal with a button -->

  

  <form method="post">
    <!-- <a style="margin-left: 72%;" , class="btn btn-primary" href="admin.php?page=TA_contractor_link&send_mail=1">Send
      Mail</a> -->
    <button style="margin-left: 72%;" type="submit" class="btn btn-primary" name="send_mail">Send
      Mail</button>
    <a href="admin.php?page=TA_contractor_link&add=1"><button type="button" class="btn btn-primary" style="float:right;"
        data-toggle="modal">Add Contractor TA Rate</button></a>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Send Mail</th>
          <th scope="col">Contractor ID</th>
          <th scope="col">TA ID</th>
          <!-- <th scope="col">xero</th> -->
          <th scope="col">Max Hours</th>
          <th scope="col">TA Rate</th>
          <th scope="col">Option</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $contractors = $wpdb->prefix . "TA_contractor_link";
        $select = "select * from $contractors order by ID desc";
        $results = $wpdb->get_results($select);

        $i = 1;
        foreach ($results as $value) {

          $tick_for_send_mail_contractor=0;

          $id = $value->ID;

          $contractor_id_hwe = $value->Better_contractor_id;
          $client_id_hwe = $value->better_ta_id;
          // $client_representative_email_hwe = $value->xero;
          $client_department_name_hwe = $value->max_hours;
          $contractor_hourly_rate_hwe = $value->client_ta_rate;
          $timesheet_status = $value->timesheet_status;

         // $tick_for_send_mail_contractor = $value->tick_for_send_mail_contractor;

          


          if ($timesheet_status == 0) {
            $status_message = '--';
          } else if ($timesheet_status == 1) {
            $status_message = 'Approved';
          } else if ($timesheet_status == 2) {
            $status_message = 'Not Approved';
          }

          $send_mail_button = '';
          if ($timesheet_status != 1) {
            // $send_mail_button = '<a style="margin-left: 2%;", class="btn btn-primary" href="admin.php?page=TA_contractor_link&send_mail=1">Send Mail</a>';
          }


          $contractors = $wpdb->prefix . "contractors where ID='$contractor_id_hwe'";
          $select1 = "select * from $contractors order by ID desc";
          $results1 = $wpdb->get_results($select1);

          $selected_hwe = '';
          foreach ($results1 as $value1) {
            $contractor_name = $value1->ID;
            $contracot_id = $value1->better_contractor_id;

            $authors = $wpdb->get_results("SELECT ID, display_name from $wpdb->users 
        where ID='" . $contracot_id . "' ORDER BY display_name DESC");

            //$selected_hwe='';
            foreach ($authors as $auth) {
              $user_id = $auth->ID;
              $better_contractor_id = $auth->display_name;
            }


          }

          $client_table = $wpdb->prefix . "contract_rates where ID='$client_id_hwe'";
          $select2 = "select * from $client_table order by ID desc";
          $results2 = $wpdb->get_results($select2);

          foreach ($results2 as $value2) {
            $client_id = $value2->ID;
            $better_ta_id = $value2->contract_id;
          }

          
          // $checked_mail_send_tick='';
          // if($tick_for_send_mail_contractor == 1)
          // {
          //   $checked_mail_send_tick = 'checked';
          // }

         
          ?>
          <tr>
            <td>
              <?php echo $i;
              $i++; ?>
            </td>
            <td>
              <input style="transform: scale(2.3)" type="checkbox" value="1" name="send_mail_to_contractors[<?php echo $id; ?>]"/>
            </td>
            <td>
              <?php echo $better_contractor_id; ?>
            </td>
            <td>
              <?php echo $better_ta_id; ?>
            </td>

            <!-- <td>
              <?php //echo $client_representative_email_hwe; ?>
            </td> -->
            <td>
              <?php echo $client_department_name_hwe; ?>
            </td>
            <td>
              <?php echo $contractor_hourly_rate_hwe; ?>
            </td>
            <td style="display:flex">
              <a style="margin-left: 2%;" href="admin.php?page=TA_contractor_link&delete=1&deleteid=<?php echo $id; ?>"><i
                  class="bi-trash" style="color:red;font-size: 20px;"></i></a>
              <a style="margin-left: 2%;" href="admin.php?page=TA_contractor_link&add=1&edit=<?php echo $id; ?>"><i
                  class="fas fa-edit text-primary" style="font-size: 20px;"></i></a>
              <?php echo $send_mail_button; ?>


            </td>
          </tr>

        <?php } ?>
      </tbody>
    </table>
  </form>




  <?php
  if(isset($_POST['send_mail'])) {


    if(isset($_POST['send_mail_to_contractors']) && count($_POST['send_mail_to_contractors']) > 0)
    {
      $tick_box_array =array();
      foreach($_POST['send_mail_to_contractors'] as $key => $val)
      {
        $tick_box_array[] = $key;

      }
      $implode = implode(",",$tick_box_array);
   
      $implode_query = " && ID IN(".$implode.")";

      $ta_table = $wpdb->prefix . "TA_contractor_link where 1='1'".$implode_query;
      $select = "select * from $ta_table order by ID desc";
      $results = $wpdb->get_results($select);

    
      $mail_send_date=date("Y-m-d");
      foreach ($results as $value) {
        $better_ta_id = $value->better_ta_id;
        $better_contractor_id = $value->Better_contractor_id;
        $ta_contractor_link_id = $value->ID;


        $client_table = $wpdb->prefix . "contract_rates";
        $select3 = "select * from $client_table where ID='$better_ta_id'";
        $results3 = $wpdb->get_results($select3);
        $ta_start_date = '';
        $ta_end_date = '';
        $ta_end_date = date("Y-m-d H:i:s",current_time( 'timestamp' ));
        foreach ($results3 as $value3) {
          $ta_start_date = $value3->TA_start_date;
          $ta_start_date_timestamp = strtotime($ta_start_date);
          $ta_end_date = $value3->TA_end_date;

          $ta_last_date = $value3->TA_end_date;

          $ta_end_date_timestamp = strtotime($ta_end_date);

          // $ta_end_date = date("Y-m-d H:i:s");
          $ta_end_date = date("Y-m-d H:i:s",current_time( 'timestamp' ));

          $contract_id=$value3->contract_id;

          $days_to_add = $value3->deadline_date; // Number of days to add

          $deadline_date_strtotime = strtotime("+" . $days_to_add . " days", $ta_end_date_timestamp);

          $timesheet_submit_deadline_date = date("Y-m-$days_to_add");
          $reminder_date = $value3->reminder_date;

          $reminder_date_hwe = date("Y-m-$reminder_date");
          $reminder_date_hwe_timestamp = strtotime($reminder_date_hwe);
          $client_id = $value3->client_id;
          $id = $value3->ID;



          $current_timestamp = current_time('timestamp');
          $current_date = date('Y-m-d', $current_timestamp);


          if (empty($value3->random_mail_token) || $value3->random_mail_token == '') {
            $bytes = random_bytes(20);
            $randow_token_for_timesheet = bin2hex($bytes);
          } else {
            $randow_token_for_timesheet = $value3->random_mail_token;
          }

          $update = "UPDATE " . $wpdb->prefix . "contract_rates SET 
          random_mail_token='" . $randow_token_for_timesheet . "' where ID='" . $id . "'";
          $wpdb->query($update);


          $client_name = '';
          $clients = $wpdb->prefix . "clients";
          $select_client = "select * from $clients where ID='$client_id'";
          $results_client = $wpdb->get_results($select_client, ARRAY_A);
          foreach ($results_client as $value4) {
            $client_name = $value4['client_name'];
            $client_email=$value4['client_email'];
          }



          $contractor_table = $wpdb->prefix . "contractors";
          $select2 = "select * from $contractor_table where ID='$better_contractor_id'";
          $results2 = $wpdb->get_results($select2);

          $contractor_name = '';
          $emailaddress = '';
          foreach ($results2 as $value2) {
            $emailaddress = $value2->emailaddress;
            $contractor_name = $value2->contractor_name;


          }
       
          if (strtotime($current_date) == strtotime($reminder_date_hwe)) {


            if (($ta_start_date_timestamp <= $reminder_date_hwe_timestamp) && ($ta_end_date_timestamp >= $reminder_date_hwe_timestamp)) {


              $template_id = get_option('emailtemplate');
              $blog_name = 'John';

              $select_template = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id . "'", ARRAY_A);

              foreach ($select_template as $template_date) {
                $email_html_data = $template_date['message'];
                $subject = $template_date['subject'];
              }

              $email_html_data = str_replace('[CONTRACTOR_NAME]', $contractor_name, $email_html_data);
              $email_html_data = str_replace('[CLIENT_NAME]', $client_name, $email_html_data);
              $email_html_data = str_replace('[TA_NUMBER]', $contract_id, $email_html_data);
              $email_html_data = str_replace('[TIMESHEET_DATE]', $reminder_date_hwe, $email_html_data);
              $email_html_data = str_replace('[DEADLINE_DATE]',$timesheet_submit_deadline_date, $email_html_data);
              $email_html_data = str_replace('[TIMESHEET_LINK]', '<a href="' . get_site_url() . '/submit-timesheet?randow_string_hwe=' . $randow_token_for_timesheet . '&ta_link_id=' . $ta_contractor_link_id . '" class="btn btn-primary" style="color:#fff;">Submit Timesheet</a>', $email_html_data);
              $email_html_data = str_replace('[SITE_BLOG]', $better_contractor_id, $email_html_data);



              $to_email_send = get_option('to_reminer_mail_send_option');
              if($to_email_send == 0)
              {
                $client_email_to = $client_email;
              }
              elseif($to_email_send == 1)
              {
                $client_email_to = $emailaddress;
              }
              elseif($to_email_send == 2)
              {
                $client_email_to = "admin@datasymphony.com";
              }
              else
              {
                $client_email_to = "";
              }

              $cc_email_send = get_option('cc_reminer_mail_send_option');
              if($cc_email_send == 0)
              {
                $client_email_cc = $client_email;
              }
              elseif($cc_email_send == 1)
              {
                $client_email_cc = $emailaddress;
              }
              elseif($cc_email_send == 2)
              {
                $client_email_cc = "admin@datasymphony.com";
              }
              else
              {
                $client_email_cc = "";
              }

              if($client_email_to != '')
              {

                $to = $client_email_to;

                $from = "tjohannvr@datasymphony.com";


                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <' . $from . '>' . '\r\n';
                // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
                $message = $email_html_data;

                // Send email
                if (mail($to, $subject, $message, $headers)) {

                  echo "<br>";
                  echo "Contractor Email :".$client_email_to."<br>";
                  echo $message;
                } 
                else
                {
                  echo "Email sending failed.";
                }

              }
              if($client_email_cc != "")
              {

                $to = $client_email_cc;

                $from = "tjohannvr@datasymphony.com";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <' . $from . '>' . '\r\n';
                // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
                $message = $email_html_data;

                // Send email
                if (mail($to, $subject, $message, $headers)) {

                  echo "<br>";
                  echo "Admin Email Email :".$client_email_cc."<br>";
                  echo $message;
                } 
                else
                {
                  echo "Email sending failed.";
                }

              }
              $timesheet_tracking_table = $wpdb->prefix."timesheet_tracking";
              $select_timesheet_tracking="select * from $timesheet_tracking_table where better_contractor_id='$better_contractor_id' && better_ta_id='$contract_id'";
              $results_timesheet= $wpdb->get_results($select_timesheet_tracking);


              if (count($results_timesheet) > 0) {
                $insert = "UPDATE $timesheet_tracking_table set
              better_ta_id='$contract_id',
              better_contractor_id='$better_contractor_id',
              `mail_send_date`='$current_date',
              last_update_date='$ta_end_date',
              ts_status='#Reminder sent',
              invoice_status='Open',
              hours_approved='',
              ta_approval_contact_email='$client_email'
                where better_contractor_id='$better_contractor_id' && better_ta_id='$contract_id'";
                  $wpdb->query($insert);
                  
            } else {

        
              $insert = "insert into $timesheet_tracking_table set
              better_ta_id='$contract_id',
              better_contractor_id='$better_contractor_id',
              `mail_send_date`='$current_date',
              last_update_date='$ta_end_date',
              ts_status='#Reminder sent',
              invoice_status='Open',
              hours_approved='',
              ta_approval_contact_email='$client_email'";

                $wpdb->query($insert);

              

              }
        
              


            }
          }


        }


      }

    }
  }
  ?>