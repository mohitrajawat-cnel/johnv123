<?php
/*
Plugin Name: Contractor to client
Plugin URI: https://hirewordpressexterts.com
Description: Contractor to client
Version:1.0
Author: Lucky
Author URI: https://hirewordpressexterts.com

*/

add_action('admin_menu', 'xero_function');

function xero_function()
{


  add_menu_page(
    'Xero Setting',
    'Xero Setting',
    'manage_options',
    'xero_setting',
    '',
    '',
    2
  );

  add_submenu_page(
    'xero_setting',
    esc_html__('Xero Setting Contract', 'woocommerce-b2b-sales-agents'),
    esc_html__('Xero Setting Contract', 'woocommerce-b2b-sales-agents'),
    'manage_options',
    'xero_setting',
    'xero_setting'

  );

}
add_action('admin_menu', 'contractorsettinghwe');

function contractorsettinghwe()
{

  add_menu_page(
    'Contractor Settings',
    'Contractor Settings',
    'manage_options',
    'settinghwe',
    'Contractorsetting',
    '',
    2
  );

  add_submenu_page(
    'settinghwe',
    esc_html__('Contractor Details', 'woocommerce-b2b-sales-agents'),
    esc_html__('Contractor Details', 'woocommerce-b2b-sales-agents'),
    'manage_options',
    'contractor_details',
    'contractor_details'
  );

  add_submenu_page(
    'settinghwe',
    esc_html__('Client Details', 'woocommerce-b2b-sales-agents'),
    esc_html__('Client Details', 'woocommerce-b2b-sales-agents'),
    'manage_options',
    'client_details',
    'client_details'
  );

  add_submenu_page(
    'settinghwe',
    esc_html__('Contracts', 'woocommerce-b2b-sales-agents'),
    esc_html__('Contracts', 'woocommerce-b2b-sales-agents'),
    'manage_options',
    'contract_rates',
    'contract_rates'
  );

  add_submenu_page(
    'settinghwe',
    esc_html__('Contractor TA Rates', 'woocommerce-b2b-sales-agents'),
    esc_html__('Contractor TA Rates', 'woocommerce-b2b-sales-agents'),
    'manage_options',
    'TA_contractor_link',
    'TA_contractor_link'
  );

  add_submenu_page(
    'settinghwe',
    esc_html__('Timesheet Tracking', 'woocommerce-b2b-sales-agents'),
    esc_html__('Timesheet Tracking', 'woocommerce-b2b-sales-agents'),
    'manage_options',
    'timesheet_tracking',
    'timesheet_tracking'
  );
}


function Contractorsetting()
{
 
  include ("settings.php");


}
function settinghwe()
{
  include("settings.php");

}
function contractor_details()
{

  if (isset($_REQUEST['add'])) {
    include("addcontractor.php");
  } else {
    include("contractor_details.php");
  }



}
function client_details()
{
  if (isset($_REQUEST['add'])) {
    include("addclient.php");
  } else {
    include("client_details.php");
  }


}
function contract_rates()
{
  if (isset($_REQUEST['add'])) {
    include("addcontractrates.php");
  } else {
    include("contract_rates.php");
  }


}



function TA_contractor_link()
{
  // echo "hello";
  //  die("heyy");
  if (isset($_REQUEST['add'])) {
    include("addTAcontractorlink.php");
  } else {
    include("TA_contractor.php");
  }


}


function timesheet_tracking()
{

  include "timesheet_tracking.php";

}



add_shortcode("clientapprovedisapprove", "clientapprovedishwe");
function clientapprovedishwe()
{

  include("contractorclient.php");



}


function xero_setting()
{
  if (isset($_REQUEST['authorization']) && $_REQUEST['authorization'] != '') {
    include 'authorization.php';
  } else {
    include 'xero_setting.php';
  }

}

add_shortcode('XERO_API', 'callback_url');
function callback_url()
{
  include 'callback.php';
}


add_shortcode("testing_email_hwe", "testing_email_hwe");
function testing_email_hwe()
{

  global $wpdb;

  echo get_option('refresh_token_hwe');
  echo "rohit<br>";
  echo get_option('tenanat_id_hwe');

  die();
}

add_action("init", "fun_createtablehwe");
function fun_createtablehwe()
{

  global $wpdb;
  $contractors = $wpdb->prefix . "contractors";

  $tablecontrot = "CREATE TABLE IF NOT EXISTS $contractors (
    ID bigint(255) NOT NULL,
    emailaddress varchar(255) NOT NULL,
    phonenumber varchar(255), 
    userid varchar(255), 
    address_type TEXT NULL
    address_line1 TEXT NULL,
    city TEXT NULL,
    postal_code TEXT NULL,
    country TEXT NULL, 	
    PRIMARY KEY (ID)
        );";
  $wpdb->query($tablecontrot);


  $timesheet_form_table = $wpdb->prefix . "timesheet_form_table";

  $tabletimesheet = "CREATE TABLE IF NOT EXISTS $timesheet_form_table (
  ID bigint(255) NOT NULL AUTO_INCREMENT,
  contarct_id varchar(255) NOT NULL,
  rate_per_hour varchar(255),
  form_id int(11) NOT NULL,
  number_of_hours varchar(255), 
  total_amount_excluding int(11) DEFAULT 0, 
  userid varchar(255),
  client_id varchar(255),
  timesheet_upload varchar(255),
  `status` int(11) DEFAULT 0,
  PRIMARY KEY (ID)
      );";
  $wpdb->query($tabletimesheet);

  $contract_rates_table = $wpdb->prefix . "contract_rates";

  $contractratestable = "CREATE TABLE IF NOT EXISTS $contract_rates_table (
  ID bigint(255) NOT NULL AUTO_INCREMENT,
  contractid varchar(255) NOT NULL,
  ta_number varchar(255),
  contract_start_date varchar(255) NOT NULL,
  contract_end_date varchar(255),
  contractor_id varchar(255) NOT NULL,
  client_id varchar(255),
  client_representative_name varchar(255) NOT NULL,
  client_representative_email varchar(255),
  client_department_name varchar(255) NOT NULL,
  client_department_email varchar(255),
  contractor_hourly_rate varchar(255) NOT NULL,
  timesheet_status int(11) NOT NULL DEFAULT 0,
  random_mail_token varchar(255),
  `status` int(11) NOT NULL DEFAULT 1,
  `mail_send_status` int(11) DEFAULT 0,
  `reviews` int(11) NULL,
  `comments` TEXT(256) NULL,
  PRIMARY KEY (ID)
      );";
  $wpdb->query($contractratestable);

  $clients_table = $wpdb->prefix . "clients";

  $tableclient = "CREATE TABLE IF NOT EXISTS $clients_table (
    ID bigint(255) NOT NULL,
    account_number varchar(255) NOT NULL,
    client_name varchar(255), 
    client_email varchar(255),   	
    PRIMARY KEY (ID)
        );";
  $wpdb->query($tableclient);


  $TA_contractor_link_table = $wpdb->prefix . "TA_contractor_link";

  $TAcontractorlink = "CREATE TABLE IF NOT EXISTS $TA_contractor_link_table (
    ID bigint(255) NOT NULL AUTO_INCREMENT,
    Better_contractor_id varchar(255) NOT NULL,
    max_hours varchar(255) NOT NULL,
    xero varchar(255) NOT NULL,
    client_ta_rate varchar(255) NOT NULL,
    PRIMARY KEY (ID))";
  $wpdb->query($TAcontractorlink);

  $timesheet_tracking_table = $wpdb->prefix . "timesheet_tracking";

  $timesheet_tracking = "CREATE TABLE IF NOT EXISTS $timesheet_tracking_table (
    ID bigint(255) NOT NULL AUTO_INCREMENT,
    better_ta_id varchar(255) NULL,
    better_contractor_id varchar(255) NULL,
    `mail_send_date` Date NULL,
    ts_status varchar(255) NULL,
    last_update_date Varchar(256)  NULL,
    invoice_status varchar(255)  NULL,
    hours_approved Int(11) Default 0,
    ta_approval_contact_email varchar(255) NULL,
    PRIMARY KEY (ID))";
  $wpdb->query($timesheet_tracking);

  
  $alter_query = "ALTER TABLE $clients_table
                ADD COLUMN IF NOT EXISTS client_address VARCHAR(255),
                ADD COLUMN IF NOT EXISTS client_city VARCHAR(255),
                ADD COLUMN IF NOT EXISTS postal_code INT(11),
                ADD COLUMN IF NOT EXISTS client_country VARCHAR(255)";

$wpdb->query($alter_query);



}



function timesheetsubmit()
{
  global $wpdb;

  if (isset($_REQUEST['randow_string_hwe']) && $_REQUEST['randow_string_hwe'] != '') {

    $randow_string_for_contract_id = $_REQUEST['randow_string_hwe'];
    $current_login_id = get_current_user_id();
    $cueent_monthdate = date("Y-m");
    $current_time = current_time('timestamp');
    $current_time_datehwe= date("Y-m-d", $current_time);

    $current_time_date = strtotime($current_time_datehwe);

   // $current_time_date = date("Y-m-d", $current_time_date_timestamp);

 

    $datetime_submit_date = get_option('datetimesheet');
    $timesheet_date = $cueent_monthdate . '-' . $datetime_submit_date;
    $deadline_timesheet_date = get_option('dayshwe');

    $timesheed_dead_line_date = date('Y-m-d', strtotime($timesheet_date . ' + ' . $deadline_timesheet_date . ' day'));
    $select_data = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "contract_rates where random_mail_token='" . $randow_string_for_contract_id . "'", ARRAY_A);

    $ta_id = $_REQUEST['ta_link_id'];




    $contractors = $wpdb->prefix . "TA_contractor_link";
    $select = "select * from $contractors where ID='$ta_id' order by ID desc";
    $results = $wpdb->get_results($select);

    $i = 1;
    foreach ($results as $value) {

      $id = $value->ID;

      $contractor_id_hwe = $value->Better_contractor_id;

      $better_ta_id = $value->better_ta_id;


        $select3 = "select * from ".$wpdb->prefix . "contract_rates where ID='$better_ta_id'";
        $results3 = $wpdb->get_results($select3);
        foreach ($results3 as $value3) {

          $deadline_day = $value3->deadline_date; // Number of days to add

          $timesheet_deadline_date = date("Y-m-$deadline_day");
          $timesheet_deadline_date_timestamp = strtotime($timesheet_deadline_date);

        }


      $contractors = $wpdb->prefix . "contractors where ID='$contractor_id_hwe'";
      $select1 = "select * from $contractors order by ID desc";
      $results1 = $wpdb->get_results($select1);

      foreach ($results1 as $value1) {
        $better_contractor_id = $value1->better_contractor_id;

        

      }



      if ($better_contractor_id == $current_login_id) {

        if ($current_time_date <= $timesheet_deadline_date_timestamp) 
        {
          
          ?>
          <script>
            jQuery(document).ready(function () {

              jQuery("#input_4_9").attr("readonly", "readonly");


              jQuery("#input_4_7").on("keyup", function () {
                var number_of_hours = 0;
                var rate_per_hours = 0;
                number_of_hours = jQuery(this).val();
                rate_per_hours = jQuery("#input_4_8").attr("value");

                if (rate_per_hours == 'NaN' || rate_per_hours == '') {
                  rate_per_hours = 0;
                }
                var total_amount = parseInt(number_of_hours) * parseInt(rate_per_hours);
                jQuery("#input_4_9").attr('value', total_amount);
                jQuery("#input_4_9").val(total_amount);
              });


              var contract_id = '<?php echo $id; ?>';

              jQuery.ajax({
                type: "post",
                url: "<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php",
                dataType: "json",
                data: {
                  action: "get_timesheet_data",
                  contract_id: contract_id
                },
                success: function (result) {

                  jQuery("#input_4_4").html("");
                  jQuery("#input_4_4").html(result.contractor_name);
                  jQuery("#input_4_5").html("");
                  jQuery("#input_4_5").html(result.client_name);
                  jQuery("#input_4_6").html("");
                  jQuery("#input_4_6").html(result.contractid);
                  jQuery("#input_4_13").val("");
                  jQuery("#input_4_13").attr("value", result.contractor_email);
                  jQuery("#input_4_16").val("");
                  jQuery("#input_4_16").attr("value", result.ta_number);
                  jQuery("#input_4_8").val("");
                  jQuery("#input_4_8").attr("value", result.rate_per_hour);



                }

              });


            });
          </script>
          <?php
        }
        else
        {
          echo "Timesheet submit date has been expired.";
          die();
        }

      } else if ($better_contractor_id != $current_login_id) {
        echo "Please login with related contract contractor.";
        die();
      } 

    }
  }
}



function get_timesheet_data()
{


  global $wpdb;
  $contract_id = $_POST['contract_id'];



  $ta_table = $wpdb->prefix . "TA_contractor_link";
  $select = "select * from $ta_table where ID='$contract_id' order by ID desc";
  $results = $wpdb->get_results($select);



  foreach ($results as $value) {
    $better_ta_id = $value->better_ta_id;
    $better_contractor_id = $value->Better_contractor_id;
    $ta_contractor_id = $value->ID;
    $client_ta_rate = $value->client_ta_rate;


    $select_data = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "contract_rates where ID='$better_ta_id' limit 0,1", ARRAY_A);
    $contract_deatisl_array = array();

    foreach ($select_data as $contract_data) {
      $contractor_id = $contract_data['contractor_id'];
      $contractid = $contract_data['contractid'];
      $ta_number = $contract_data['ta_number'];
      $rate_per_hour = $contract_data['contractor_hourly_rate'];
      $client_id = $contract_data['client_id'];
      $contract_rates_id = $contract_data['ID'];
    }

    $contractors = $wpdb->prefix . "contractors";
    $select1 = "select * from $contractors where ID='" . $better_contractor_id . "' order by ID desc";
    $results1 = $wpdb->get_results($select1);
    if ($results1 > 0) {

      foreach ($results1 as $value1) {

        $contractor_id = $value1->ID;
        $contractor_email = $value1->emailaddress;
        $contractor_name = $value1->contractor_name;


      }
    }

    $client_table = $wpdb->prefix . "clients";
    $select2 = "select * from $client_table where ID='" . $client_id . "' order by ID desc";
    $results2 = $wpdb->get_results($select2);



    foreach ($results2 as $value2) {

      $client_id = $value2->ID;
      $client_name = $value2->client_name;
      $client_email = $value2->client_email;
    }


    $contract_deatisl_array['client_name'] = '<option value="' . $client_id . '">' . $client_name . '</option>';
    $contract_deatisl_array['client_email'] = $client_email;
    $contract_deatisl_array['contractor_name'] = '<option value="' . $contractor_id . '">' . $contractor_name . '</option>';
    $contract_deatisl_array['contractor_email'] = $contractor_email;
    $contract_deatisl_array['contractid'] = '<option value="' . $better_ta_id . '">' . $better_ta_id . '</option>';
    $contract_deatisl_array['ta_number'] = $contract_rates_id;
    $contract_deatisl_array['rate_per_hour'] = $client_ta_rate;






    echo json_encode($contract_deatisl_array);
    die();

  }

}
add_action('wp_ajax_nopriv_get_timesheet_data', 'get_timesheet_data');
add_action('wp_ajax_get_timesheet_data', 'get_timesheet_data');

function after_submission($entry, $form)
{

  global $wpdb;
  //getting post
  //$post = get_post( $entry['post_id'] ); 

  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);

  $gtf_id = $entry['id'];
  $csv_url = $entry['3'];
  $last_update_datehwe = current_time( 'timestamp' );
  $last_update_date = date("Y-m-d H:i:s",$last_update_datehwe);

  $GET_SITE_URL = get_site_url();
  $current_site_url = str_replace('https', 'http', $GET_SITE_URL);

  $get_csv_url = $select_data_client_hwe2['timesheet_upload'];

  $get_csv_url = str_replace($current_site_url, '', $csv_url);



  $contractor_id = $_POST['input_4'];

  $client_id = $_POST['input_5'];
  $contract_id = $_POST['input_6'];

  $number_of_hours = (int)$_POST['input_7'];
  $rate_per_hour = $_POST['input_8'];
  $total_amount = $_POST['input_9'];
  $status = $_POST['input_10'];

  $contractor_ta_link_id = $_REQUEST['ta_link_id'];

  $ta_contractors_table = $wpdb->prefix . "TA_contractor_link";
  $select_ta = "select * from $ta_contractors_table where ID='" . $contractor_ta_link_id . "' order by ID desc";
  $results_ta = $wpdb->get_results($select_ta);


  foreach ($results_ta as $value_ta) {

    $better_contractor_id = $value_ta->Better_contractor_id;
    $ta_contractor_link_id = $value_ta->ID;

    $better_ta_id = $value_ta->better_ta_id;
    

    $contract_table = $wpdb->prefix . "contract_rates";
    $select_contract = "select * from $contract_table where ID='" . $better_ta_id . "' order by ID desc";
    $results_contract = $wpdb->get_results($select_contract);
    foreach ($results_contract as $value_contract) {
      $contract_id = $value_contract->contract_id;

    }
  }



  $timesheet_gft = $wpdb->prefix . "timesheet_form_table";

  $select_data8 = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "timesheet_form_table where contarct_id='$contractor_ta_link_id'", ARRAY_A);
        
  if(count($select_data8) > 0)
  {
    $insert_data = "UPDATE " . $timesheet_gft . " SET contarct_id='" . $contractor_ta_link_id . "',
    form_id='" . $gtf_id . "',
    rate_per_hour='" . $rate_per_hour . "',
    number_of_hours='" . $number_of_hours . "',
    total_amount_excluding='" . $total_amount . "',
    userid='" . $contractor_id . "',
    client_id='" . $client_id . "',
    timesheet_upload='" . $csv_url . "',
    status='" . $status . "' where contarct_id='" . $contractor_ta_link_id . "'";
  }
  else
  {
    $insert_data = "INSERT into " . $timesheet_gft . " SET contarct_id='" . $contractor_ta_link_id . "',
    form_id='" . $gtf_id . "',
    rate_per_hour='" . $rate_per_hour . "',
    number_of_hours='" . $number_of_hours . "',
    total_amount_excluding='" . $total_amount . "',
    userid='" . $contractor_id . "',
    client_id='" . $client_id . "',
    timesheet_upload='" . $csv_url . "',
    status='" . $status . "'";
  }


  if ($wpdb->query($insert_data)) {
    $randow_string_for_contract_id = $_REQUEST['randow_string_hwe'];


    $select_data = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "contract_rates where contract_id='$contract_id'", ARRAY_A);
// echo "SELECT * from " . $wpdb->prefix . "contract_rates where ID='$contract_id'";
// print_r($select_data);
// die("dfgdf");

    foreach ($select_data as $contract_data) {

      $client_representative_email = $contract_data['client_representative_email'];
      $deadline_date = $contract_data['TA_end_date'];

      $deadline_date_hwe = $contract_data['deadline_date'];
      
      $timesheet_submit_deadline_date = date("Y-m-$deadline_date_hwe");

      // $deadline_date_strtotime = strtotime($deadline_date . ' +'.$deadline_date_hwe.' days');

      $deadline_date_strtotime = strtotime($timesheet_submit_deadline_date);

      $current_day_date = date("Y-m-d",current_time('timestamp'));

      $current_day_strtotime = strtotime($current_day_date);

      $timesheet_download_or_not = '';
      if ($current_day_strtotime <= $deadline_date_strtotime) {
        $timesheet_download_or_not = '<a href="' . $GET_SITE_URL.$get_csv_url . '" class="btn btn-primary">Download Timesheet</a>
            ';
      } else {
        $timesheet_download_or_not = 'Time sheet download date has been expired.';
      }


      // $contractor_id = $contract_data['contractor_id'];

      $ta_number = $contract_data['ta_number'];

    }



    $contractors = $wpdb->prefix . "contractors";
    $select1 = "select * from $contractors where ID='" . $contractor_id . "' order by ID desc";
    $results1 = $wpdb->get_results($select1);

    if ($results1 > 0) {

      foreach ($results1 as $value1) {
        $contractor_email = $value1->emailaddress;
        $contractor_name = $value1->contractor_name;
        $contractor_auto_id = $value1->ID;


      }

    }

    $select_data_client = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "clients where ID='$client_id'", ARRAY_A);

    foreach ($select_data_client as $select_data_client_hwe) {
      $client_email = $select_data_client_hwe['client_email'];
      $client_name = $select_data_client_hwe['client_name'];
      $reprentative_email_cc_1 = $select_data_client_hwe['reprentative_email_cc_1'];
      $reprentative_email_cc_2 = $select_data_client_hwe['reprentative_email_cc_2'];
      $reprentative_email_cc_3 = $select_data_client_hwe['reprentative_email_cc_3'];
    }

    $template_id = get_option('approved_client_template');
    $select_template = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id . "'", ARRAY_A);
    foreach ($select_template as $template_date) {


      $email_html_data = $template_date['message'];
      $subject_hwe = $template_date['subject'];
    }



    $email_html_data = str_replace('[CLIENT_NAME]', $client_name, $email_html_data);
    $email_html_data = str_replace('[TIMESHEET_DOWNLOAD]', $timesheet_download_or_not, $email_html_data);
    $email_html_data = str_replace('[APPROVED_BUTTON]', '<a href="' . get_site_url() . '/client-review/?randow_string_hwe_client_review=' . $randow_string_for_contract_id . '&ta_link_id=' . $ta_contractor_link_id . '" class="btn btn-primary">Approve</a>', $email_html_data);


    $representative_cc_email = " CC: ";
    $cc_email_check = 0;
    if($reprentative_email_cc_1 != '')
    {
      $representative_cc_email = $representative_cc_email.$reprentative_email_cc_1;
      $cc_email_check++;
    }
    if($reprentative_email_cc_2 != '')
    {
      if($cc_email_check == 1)
      {
        $representative_cc_email = $representative_cc_email.",".$reprentative_email_cc_2;
      }
      else
      {
        $representative_cc_email = $representative_cc_email.$reprentative_email_cc_2;
        $cc_email_check++;
      }
      
    }
    if($reprentative_email_cc_3 != '')
    {
      if($cc_email_check == 1)
      {
        $representative_cc_email = $representative_cc_email.",".$reprentative_email_cc_3;
      }
      else
      {
        $representative_cc_email = $representative_cc_email.$reprentative_email_cc_3;
        $cc_email_check++;
      }
    }
    if($reprentative_email_cc_1 == '' && $reprentative_email_cc_2 == '' && $reprentative_email_cc_3 == '')
    {
      $representative_cc_email = "";
    }
    
    $only_cc_mail_send_when_client_have = '';
    
    $to_email_send = get_option('to_client_approved_send_option');
    if($to_email_send == 0)
    {
      $client_email_to = $client_email;
      $only_cc_mail_send_when_client_have = $representative_cc_email;
    }
    elseif($to_email_send == 1)
    {
      $client_email_to = $contractor_email;
    }
    elseif($to_email_send == 2)
    {
      $client_email_to = "admin@datasymphony.com";
    }
    else
    {
      $client_email_to = "";
    }

    if($client_email_to != "")
    {
      $to = $client_email_to;
      //$from = "admin@readyforyourreview.com";
      $from = "tjohannvr@datasymphony.com";
      // $from = "noreply@taxon.be";
      $subject = $subject_hwe;
  
  
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      $headers .= 'From: <' . $from . '>' . '\r\n'.$only_cc_mail_send_when_client_have;
      // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
      // $headers .= 'From: <' . $from . '>' . '\r\n';
  
  
      $message = $email_html_data;
  
  
      if (mail($to, $subject, $message, $headers)) {
        echo "Mail Send to Client ".$client_email_to;
        echo "<br>";
        echo $message;
  
      } else {
        // echo "unsend";
      }
    }

    $only_cc_mail_send_when_client_have = '';
    $cc_email_send = get_option('cc_client_approved_send_option');
    if($cc_email_send == 0)
    {
      $client_email_cc = $client_email;
      $only_cc_mail_send_when_client_have = $representative_cc_email;
    }
    elseif($cc_email_send == 1)
    {
      $client_email_cc = $contractor_email;
    }
    elseif($cc_email_send == 2)
    {
      $client_email_cc = "admin@datasymphony.com";
    }
    else
    {
      $client_email_cc = "";
    }


    if($client_email_cc != "")
    {
      $to = $client_email_cc;
      //$from = "admin@readyforyourreview.com";
      $from = "tjohannvr@datasymphony.com";
      // $from = "noreply@taxon.be";
      $subject = $subject_hwe;
  
  
      $headers = "MIME-Version: 1.0" . "\r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com,' . $client_representative_email;
      // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
      // $headers .= 'From: <' . $from . '>' . '\r\n';
      $headers .= 'From: <' . $from . '>' . '\r\n'.$only_cc_mail_send_when_client_have;
  
  
      $message = $email_html_data;
  
  
      if (mail($to, $subject, $message, $headers)) {
        echo "Mail Send to Admin ".$client_email_cc;
        echo "<br>";
        echo $message;
  
      } else {
        // echo "unsend";
      }
    }

    

    $template_id_contractor = get_option('timesheet_sucess_mail_contractor');

    $select_template_contractor = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id_contractor . "'", ARRAY_A);
    

    foreach ($select_template_contractor as $template_date_contractor) {


      $email_html_data_contractor = $template_date_contractor['message'];
      $subject_hwe_contractor = $template_date_contractor['subject'];




    }


    $email_html_data_contractor = str_replace('[CONTRACTOR_NAME]', $contractor_name, $email_html_data_contractor);
    $email_html_data_contractor = str_replace('[CLIENT_NAME]', $client_name, $email_html_data_contractor);
    $email_html_data_contractor = str_replace('[TA_NUMBER]', $ta_number, $email_html_data_contractor);


    $only_cc_mail_send_when_client_have = "";
    $to_email_send1 = get_option('to_timesheet_success_mail_send_option');
    if($to_email_send1 == 0)
    {
      $client_email_to1 = $client_email;
      $only_cc_mail_send_when_client_have = $representative_cc_email;
    }
    elseif($to_email_send1 == 1)
    {
      $client_email_to1 = $contractor_email;
    }
    elseif($to_email_send1 == 2)
    {
      $client_email_to1 = "admin@datasymphony.com";
    }
    else
    {
      $client_email_to1 = "";
    }

    if($client_email_to1 != "")
    {
      $to_contractor = $client_email_to1;


      $subject_contractor = $subject_hwe_contractor;
  
  
      $message_contractor = $email_html_data_contractor;
  
      $fromcontractor = "tjohannvr@datasymphony.com";
  
      $headers_contractor = "MIME-Version: 1.0" . "\r\n";
      $headers_contractor .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      // $headers_contractor .= 'From: <' . $fromcontractor . '>' . '\r\n' . 'CC: admin@datasymphony.com';
      $headers_contractor .= 'From: <' . $fromcontractor . '>' . '\r\n'.$only_cc_mail_send_when_client_have;
  
  
      if (mail($to_contractor, $subject_contractor, $message_contractor, $headers_contractor)) {
        echo "Mail Send to Contractor ".$client_email_to1;
        echo "<br>";
        echo $message_contractor;
  
      } else {
        // echo "unsend";
      }
    }

    $only_cc_mail_send_when_client_have = "";
    $cc_email_send1 = get_option('cc_timesheet_success_mail_send_option');
    if($cc_email_send1 == 0)
    {
      $client_email_cc1 = $client_email;
      $only_cc_mail_send_when_client_have = $representative_cc_email;
    }
    elseif($cc_email_send1 == 1)
    {
      $client_email_cc1 = $contractor_email;
    }
    elseif($cc_email_send1 == 2)
    {
      $client_email_cc1 = "admin@datasymphony.com";
    }
    else
    {
      $client_email_cc1 = "";
    }


    if($client_email_cc1 != "")
    {
      $to_contractor = $client_email_cc1;


      $subject_contractor = $subject_hwe_contractor;
  
  
      $message_contractor = $email_html_data_contractor;
  
      $fromcontractor = "tjohannvr@datasymphony.com";
  
      $headers_contractor = "MIME-Version: 1.0" . "\r\n";
      $headers_contractor .= "Content-type:text/html;charset=UTF-8" . "\r\n";
      // $headers_contractor .= 'From: <' . $fromcontractor . '>' . '\r\n' . 'CC: admin@datasymphony.com';
      $headers_contractor .= 'From: <' . $fromcontractor . '>' . '\r\n'.$only_cc_mail_send_when_client_have;
  
  
      if (mail($to_contractor, $subject_contractor, $message_contractor, $headers_contractor)) {
        echo "Mail Send to Admin ".$client_email_cc1;
        echo "<br>";
        echo $message_contractor;
  
      } else {
        // echo "unsend";
      }
    }

  }


  $timesheet_tracking_table = $wpdb->prefix . "timesheet_tracking";
  $select_timesheet_tracking = "select * from $timesheet_tracking_table where better_contractor_id='$better_contractor_id' && better_ta_id='$contract_id'";
  $results_timesheet = $wpdb->get_results($select_timesheet_tracking);
 
  if (count($results_timesheet) > 0) {

    $insert = "UPDATE $timesheet_tracking_table set
      last_update_date='$last_update_date',
      invoice_status='Open',
      ts_status='#TS Submitted'
      where better_contractor_id='$better_contractor_id' && better_ta_id='$contract_id'";
    $wpdb->query($insert);

  } else {

    $insert = "insert into $timesheet_tracking_table set
    better_contractor_id='$better_contractor_id',
    better_ta_id='$contract_id',
    ts_status='#TS Submitted',
    invoice_status='Open',
            last_update_date='$last_update_date'";

    $wpdb->query($insert);



  }


}
add_action('gform_after_submission_4', 'after_submission', 10, 2);



add_action('wp_head', 'timesheetsubmit');

function send_mail_to_contractor_cron()
{
  global $wpdb;


  if (isset($_REQUEST['contract_email']) && $_REQUEST['contract_email'] == '1') {

    $ta_table = $wpdb->prefix . "TA_contractor_link";
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
add_shortcode('reminder_main_cron_script', 'send_mail_to_contractor_cron');

function timesheetreview()
{
  global $wpdb;

  if ((isset($_REQUEST['randow_string_hwe_client_review']) && $_REQUEST['randow_string_hwe_client_review'] != '') && (!isset($_REQUEST['type']))) {


    $randow_string_contract = $_REQUEST['randow_string_hwe_client_review'];
    $select_data = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "contract_rates where random_mail_token='$randow_string_contract'", ARRAY_A);


    $ta_link_id = $_REQUEST['ta_link_id'];
    foreach ($select_data as $contract_data) {


      $contract_id = $contract_data['contract_id'];
      $ta_end_date = $contract_data['TA_end_date'];
      $ta_end_date_timestamp = strtotime($ta_end_date);

      $days_to_add = $contract_data['deadline_date'];

      $current_day = date("Y-m-d",current_time( 'timestamp' ));

      $current_day_strtotime = strtotime($current_day);

      $timesheet_deadline_date = date("Y-m-$days_to_add");

      $timesheet_deadline_date_timestamp = strtotime($timesheet_deadline_date);

      //checked issue
      
      $deadline_date_strtotime = strtotime("+" . $days_to_add . " days", $ta_end_date_timestamp);

      $timesheet_status = $contract_data['invoice_method'];
      $disabled_check = '';
      if ($timesheet_status == '1') {
        $disabled_check = 'disabled="disabled"';
      }

      $contractid_ID = $contract_data['ID'];


      if ($current_day_strtotime <= $timesheet_deadline_date_timestamp) {

        $timesheet_gft = $wpdb->prefix . "timesheet_form_table";
        $select_data_client2 = $wpdb->get_results("SELECT * from " . $timesheet_gft . " where contarct_id='$ta_link_id'", ARRAY_A);
       
   
        foreach ($select_data_client2 as $select_data_client_hwe2) {


          $total_amount = '0 /-';
          $total_hours = 0;
          $GET_SITE_URL = get_site_url();

          $current_site_url = str_replace('https', 'http', $GET_SITE_URL);

          $get_csv_url = $select_data_client_hwe2['timesheet_upload'];

          $get_csv_url = str_replace($current_site_url, '', $get_csv_url);

          $csv_url = '<a href="' . $GET_SITE_URL.$get_csv_url . '" class="btn btn-primary">Download Timesheet</a>';
          $total_hours = $select_data_client_hwe2['number_of_hours'];

          $total_amount = $select_data_client_hwe2['total_amount_excluding'] . ' /-';

          // print_r($csv_url);

          // die("dfgdfg");
        }

        $ta_contractor_link_id_hwe = $_REQUEST['ta_link_id'];
        $ta_contractors = $wpdb->prefix . "TA_contractor_link";
        $select_ta = "select * from $ta_contractors where ID='" . $ta_contractor_link_id_hwe . "' order by ID desc";

        $results_ta = $wpdb->get_results($select_ta);

        foreach ($results_ta as $value_ta) {

          $better_contractor_id = $value_ta->Better_contractor_id;



          $contractors = $wpdb->prefix . "contractors";
          $select1 = "select * from $contractors where ID='" . $better_contractor_id . "' order by ID desc";

          $results1 = $wpdb->get_results($select1);


          if (count($results1) > 0) {

            foreach ($results1 as $value1) {


              $contractor_email = $value1->emailaddress;
              $contractor_name = $value1->contractor_name;



            }

            $client_id = $contract_data['client_id'];

            $client_table = $wpdb->prefix . "clients";
            $select2 = "select * from $client_table where ID='" . $client_id . "' order by ID desc";
            $results2 = $wpdb->get_results($select2);
            foreach ($results2 as $value2) {
              $client_name = $value2->client_name;
              $client_email = $value2->client_email;

            }
          }

        }



      } else {

        echo "<center>You can not approved timesheet.TImesheet approve date has been expired.</center>";
        die();
      }



    }
    ?>
  <script>
    jQuery(document).ready(function () {

      jQuery("#input_6_5").attr('value', '<?php echo $client_name; ?>');
      jQuery("#input_6_6").attr('value', '<?php echo $client_email; ?>');
      jQuery("#input_6_7").attr('value', '<?php echo $contractor_name; ?>');
      jQuery("#input_6_8").attr('value', '<?php echo $contractor_email; ?>');
      jQuery("#input_6_15").attr('value', '<?php echo $total_hours; ?>');


      var csv_url = '<?php echo $get_csv_url; ?>';
      jQuery("a.download_timesheet").attr("href",csv_url)

      jQuery("#input_6_5").prop('readonly', true);
      jQuery("#input_6_6").prop('readonly', true);
      jQuery("#input_6_7").prop('readonly', true);
      jQuery("#input_6_8").prop('readonly', true);
      jQuery("#input_6_15").prop('readonly', true);

      jQuery("#field_6_22").attr('style', 'display:none');
      jQuery("#field_6_23").attr('style', 'display:none');
      jQuery("#field_6_20").attr('style', 'display:none');
      jQuery("#field_6_21").attr('style', 'display:none');
      jQuery("#field_6_29").attr('style', 'display:none');
      jQuery("#field_6_26").attr('style', 'display:none');
      jQuery("#field_6_27").attr('style', 'display:none');
      jQuery("#field_6_28").attr('style', 'display:none');

      // jQuery("#gform_submit_button_6").attr('style', 'display:none;');

      jQuery("#input_6_30").on("change",function (event) {

        event.preventDefault();

        var approve_disapprove_value = jQuery(this).val();
      
        if(parseInt(approve_disapprove_value) == 1)
        {
          jQuery("#field_6_20").attr("style","display:none;");

          jQuery("#field_6_22").attr('style', 'display:block');

          var get_review_name = jQuery("#input_6_22").val();

          if (get_review_name == '2') {

              jQuery("#field_6_23").attr('style', 'display:block');
              jQuery("#field_6_29").attr('style', 'display:block');
              jQuery("#field_6_26").attr('style', 'display:block');
              jQuery("#field_6_27").attr('style', 'display:block');
              jQuery("#field_6_28").attr('style', 'display:block');
              jQuery("#field_6_21").attr('style', 'display:block');

          }
          
        }
        else if(parseInt(approve_disapprove_value) == 0)
        {
           

            jQuery("#field_6_22").attr('style', 'display:none');
            jQuery("#field_6_23").attr('style', 'display:none');
            jQuery("#field_6_29").attr('style', 'display:none');
            jQuery("#field_6_26").attr('style', 'display:none');
            jQuery("#field_6_27").attr('style', 'display:none');
            jQuery("#field_6_28").attr('style', 'display:none');
            jQuery("#field_6_21").attr('style', 'display:none');

            jQuery("#field_6_20").attr("style","display:block;");
        }
       

      });


      // jQuery(".approvehwe").click(function () {

      //   event.preventDefault();

      //   jQuery("#field_6_22").attr('style', 'display:block');

      //   jQuery("#gform_submit_button_6").attr('style', 'display:block;');

        jQuery("#input_6_22").on("change", function () {

        var get_review_name = jQuery(this).val();

        if (get_review_name == '2') {

            jQuery("#field_6_23").attr('style', 'display:block');
            jQuery("#field_6_29").attr('style', 'display:block');
            jQuery("#field_6_26").attr('style', 'display:block');
            jQuery("#field_6_27").attr('style', 'display:block');
            jQuery("#field_6_28").attr('style', 'display:block');
            jQuery("#field_6_21").attr('style', 'display:block');

        }
        else
        {
            jQuery("#field_6_23").attr('style', 'display:none;');
            jQuery("#field_6_29").attr('style', 'display:none;');
            jQuery("#field_6_26").attr('style', 'display:none;');
            jQuery("#field_6_27").attr('style', 'display:none;');
            jQuery("#field_6_28").attr('style', 'display:none;');
            jQuery("#field_6_21").attr('style', 'display:none;');
        }


       

    });

      // });

      jQuery(".disapprovehwe").click(function () {

        event.preventDefault();

        var ta_link_id = '<?php echo $_REQUEST['ta_link_id']; ?>';
        var client_name='<?php echo $client_name; ?>';
        var client_email= '<?php echo $client_email; ?>';
        var randow_string_hwe_client_review = '<?php echo $_REQUEST['randow_string_hwe_client_review']; ?>';

        jQuery.ajax({
              type: "post",
              url: "<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php",
              dataType: "json",
              data: {
                action: "get_timesheet_datareview_disapprove",
                "ta_link_id":ta_link_id,
                "randow_string_hwe_client_review":randow_string_hwe_client_review,
                "client_name":client_name,
                "client_email":client_email
                
               
              },
              success: function (result) {

                //alert("Please check your email for confirmation.");

              }

            });
       


      });


    jQuery('#gform_submit_button_6').on("click",function(e) {

        e.preventDefault(); // Prevent the default form submission

        var approve_disapprove_value = jQuery("#input_6_30").val();


        if(approve_disapprove_value == '')
        {

          alert("Please Select Status");

        }
        else
        {
         
          var get_approve_comment ="";
          if(parseInt(approve_disapprove_value) == 1)
          {
              get_approve_comment =jQuery("#input_6_21").val();
              var get_review_name1 = jQuery("#input_6_29").val();
                
              var get_review_name2 = jQuery("#input_6_23").val();

              var get_review_name3 = jQuery("#input_6_26").val();


              var get_review_name4 = jQuery("#input_6_27").val();

              var get_review_name5 = jQuery("#input_6_28").val();



              var randow_string_hwe_client_review = '<?php echo $_REQUEST['randow_string_hwe_client_review']; ?>';

              var ta_link_id = '<?php echo $_REQUEST['ta_link_id']; ?>';



              var reviews = jQuery("#input_6_22").val();
              // dataType: "json",
              // Perform AJAX request
              jQuery.ajax({
                    type: "post",
                    url: "<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php",
                    data: {
                      action: "get_timesheet_datareview",
                      "randow_string_hwe_client_review":randow_string_hwe_client_review,
                      "ta_link_id":ta_link_id,
                      "get_review_name1":get_review_name1,
                      "get_review_name2":get_review_name2,
                      "get_review_name3":get_review_name3,
                      "get_review_name4":get_review_name4,
                      "get_review_name5":get_review_name5,
                      "comment_approved":get_approve_comment,
                      "reviews":reviews,
                      "approve_disapprove_status":approve_disapprove_value
                    
                    },
                    success: function (result) {
                          // alert("Invoive Created Successfully");
                          alert(result);
                          if(result == "Invoice created successfully")
                          {
                            window.location.href = '<?php echo get_site_url(); ?>';
                          }
                    }

                  });
          }
          else if(parseInt(approve_disapprove_value) == 0)
          {
            get_approve_comment =jQuery("#input_6_20").val();

            var checkattrdisapproval = jQuery("#input_6_20").attr("aria-required");
            if(get_approve_comment == '' && checkattrdisapproval == "true")
            {
              alert("Please enter reason for disapproval");
            }
            else
            {
              if(confirm('Are you sure you want to disapprove!'))
              {
                var ta_link_id = '<?php echo $_REQUEST['ta_link_id']; ?>';
                var client_name='<?php echo $client_name; ?>';
                var client_email= '<?php echo $client_email; ?>';
                var contractor_name= '<?php echo $contractor_name; ?>';
                var contractor_email= '<?php echo $contractor_email; ?>';
                var randow_string_hwe_client_review = '<?php echo $_REQUEST['randow_string_hwe_client_review']; ?>';

                jQuery.ajax({
                      type: "post",
                      url: "<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php",
                      data: {
                        action: "get_timesheet_datareview_disapprove",
                        "ta_link_id":ta_link_id,
                        "randow_string_hwe_client_review":randow_string_hwe_client_review,
                        "client_name":client_name,
                        "client_email":client_email,
                        "contractor_name":contractor_name,
                        "contractor_email":contractor_email,
                        "comment_approved":get_approve_comment,
                        "approve_disapprove_status":approve_disapprove_value
                        
                      
                      },
                      success: function (response) {

                        alert(response);
                        if(response == 'Successfully disapproved')
                        {
                          window.location.href = '<?php echo get_site_url(); ?>';
                        }
                        
                        // alert("Please check your email for confirmation.");

                      }

                    });
                }
            }
              
          }
        }
       
    });

  });

  </script>
  <?php


  }


}
add_action('wp_head', 'timesheetreview');



function get_timesheet_datareview(){


  include ("contractorclient.php");

  die();
}
add_action('wp_ajax_nopriv_get_timesheet_datareview', 'get_timesheet_datareview');
add_action('wp_ajax_get_timesheet_datareview', 'get_timesheet_datareview');


function get_timesheet_datareview_disapprove(){

  global $wpdb;


  $client_name=$_POST['client_name'];
  $client_email=$_POST['client_email'];
  $contractor_name=$_POST['contractor_name'];
  $contractor_email=$_POST['contractor_email'];

  $approve_disapprove_status=$_POST['approve_disapprove_status'];
  $comment_approved=$_POST['comment_approved'];
 
  $ta_contractor_link_id=$_POST['ta_link_id'];
  $randow_string_for_contract_id =$_POST['randow_string_hwe_client_review'];

  $TA_contractor_table = $wpdb->prefix . "TA_contractor_link";
  $select2 = "SELECT * FROM $TA_contractor_table WHERE ID='" . $ta_contractor_link_id . "'";

    
  $results2 = $wpdb->get_results($select2);

    // echo'<pre>';
    // print_r($results2);
    // echo '</pre>';
    // die("---------");
    $message_hwe =  "Error in disapprove.please try again";
    foreach ($results2 as $value2) {

      $better_ta_id = $value2->better_ta_id;
      $better_contractor_idhwe = $value2->Better_contractor_id;


      $update_disapproved = "UPDATE ".$wpdb->prefix."contract_rates SET 
      comments='$comment_approved',
      approve_disapprove_status='$approve_disapprove_status' where ID='" . $better_ta_id . "'";

      if($wpdb->query($update_disapproved))
      { 

        $client_tablehwe = $wpdb->prefix . "contract_rates";
        $select3 = "select * from $client_tablehwe where ID='$better_ta_id'";
        $results3 = $wpdb->get_results($select3);
     
        foreach ($results3 as $value3) {
          $contract_id=$value3->contract_id;
        }

        $approve_datehwe = current_time( 'timestamp' );
        $approve_date = date("Y-m-d H:i:s",$approve_datehwe);

        $timesheet_tracking_table = $wpdb->prefix . "timesheet_tracking";
        $select_timesheet_tracking = "select * from $timesheet_tracking_table where better_contractor_id='$better_contractor_idhwe' && better_ta_id='$contract_id'";
        $results_timesheet = $wpdb->get_results($select_timesheet_tracking);
        if (count($results_timesheet) > 0) {
            $insert = "UPDATE ".$timesheet_tracking_table." SET
            ts_status='#Disapproved',
            hours_approved='',
            last_update_date='$approve_date',
            invoice_status='Open',
            invoice_approve_disapprove_status='2',
            ta_approval_contact_email='$client_email'
            where better_contractor_id='$better_contractor_idhwe' && better_ta_id='$contract_id'";
            $wpdb->query($insert);
      
        } else {

          $insert = "insert into $timesheet_tracking_table SET
                  ts_status='#Disapproved',
                  last_update_date='$approve_date',
                  invoice_status='Open',
                  invoice_approve_disapprove_status='2',
                  hours_approved='',
                  ta_approval_contact_email='$client_email'";

            $wpdb->query($insert);
        }

          $template_id = get_option('disapproval_timesheet_client_to_contractor');
          $select_template = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id . "'", ARRAY_A);
        
          foreach ($select_template as $template_date) {

            $email_html_data = $template_date['message'];
            $subject_hwe = $template_date['subject'];


          }

          $email_html_data = str_replace('[CONTRACTOR_NAME]', $contractor_name, $email_html_data);
          $email_html_data = str_replace('[CLIENT_NAME]', $client_name, $email_html_data);

          $to_email_send = get_option('to_disapproval_timesheet_client_to_contractor_send_option');
          if($to_email_send == 0)
          {
            $client_email_to = $client_email;
          }
          elseif($to_email_send == 1)
          {
            $client_email_to = $contractor_email;
          }
          elseif($to_email_send == 2)
          {
            $client_email_to = "admin@datasymphony.com";
          }
          else
          {
            $client_email_to = "";
          }

          $cc_email_send = get_option('cc_disapproval_timesheet_client_to_contractor_send_option');
          if($cc_email_send == 0)
          {
            $client_email_cc = $client_email;
          }
          elseif($cc_email_send == 1)
          {
            $client_email_cc = $contractor_email;
          }
          elseif($cc_email_send == 2)
          {
            $client_email_cc = "admin@datasymphony.com";
          }
          else
          {
            $client_email_cc = "";
          }
         
         if($client_email_to != "")
         {
            $to = $client_email_to;
            //$from = "admin@readyforyourreview.com";
            $from = "tjohannvr@datasymphony.com";
            // $from = "noreply@taxon.be";
            $subject = $subject_hwe;


            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <' . $from . '>' . '\r\n';


            $message = $email_html_data;


            if (mail($to, $subject, $message, $headers)) {
              
              $message_hwe = "Successfully disapproved";
              // echo "to mail send client to contractor ".$client_email_to;
              // echo "<br>";
              // echo $message;

            } 
            else 
            {
              // echo "unsend";
              $message_hwe = "Error in disapprove.please try again";
            }
         }

         if($client_email_cc != "")
         {
            $to = $client_email_cc;
            //$from = "admin@readyforyourreview.com";
            $from = "tjohannvr@datasymphony.com";
            // $from = "noreply@taxon.be";
            $subject = $subject_hwe;


            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
            $headers .= 'From: <' . $from . '>' . '\r\n';


            $message = $email_html_data;


            if (mail($to, $subject, $message, $headers)) {
              
              $message_hwe = "Successfully disapproved";
              // echo "cc mail send client to contractor ".$client_email_cc;
              // echo "<br>";
              // echo $message;

            } 
            else 
            {
              // echo "unsend";
              $message_hwe = "Error in disapprove.please try again";
            }
         }
          

            $template_id1 = get_option('disapproval_timesheet_client_to_client');
            $select_template = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id1 . "'", ARRAY_A);
          
            $email_html_data1='';
            foreach ($select_template as $template_date) {

              $email_html_data1 = $template_date['message'];
              $subject_hwe = $template_date['subject'];

              

             }

            $email_html_data1 = str_replace('[CLIENT_NAME]', $client_name, $email_html_data1);
           


            $to_email_send1 = get_option('to_disapproval_timesheet_client_to_client_send_option');
            if($to_email_send1 == 0)
            {
              $client_email_to1 = $client_email;
            }
            elseif($to_email_send1 == 1)
            {
              $client_email_to1 = $contractor_email;
            }
            elseif($to_email_send1 == 2)
            {
              $client_email_to1 = "admin@datasymphony.com";
            }
            else
            {
              $client_email_to1 = "";
            }

            $cc_email_send1 = get_option('cc_disapproval_timesheet_client_to_client_send_option');
            if($cc_email_send1 == 0)
            {
              $client_email_cc1 = $client_email;
            }
            elseif($cc_email_send1 == 1)
            {
              $client_email_cc1 = $contractor_email;
            }
            elseif($cc_email_send1 == 2)
            {
              $client_email_cc1 = "admin@datasymphony.com";
            }
            else
            {
              $client_email_cc1 = "";
            }

            if($client_email_to1 != "")
            {
              $to = $client_email_to1;
              //$from = "admin@readyforyourreview.com";
              $from = "tjohannvr@datasymphony.com";
              // $from = "noreply@taxon.be";
              $subject = $subject_hwe;
  
  
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
              $headers .= 'From: <' . $from . '>' . '\r\n';
  
  
              $message1 = $email_html_data1;
  
  
              if (mail($to, $subject, $message1, $headers)) {
                
                $message_hwe = "Successfully disapproved";
                // echo "to mail send client to client ".$client_email_to1;
                // echo "<br>";
                // echo $message1;
  
              } 
              else 
              {
                $message_hwe = "Error in disapprove.please try again";
              }
            }

            if($client_email_cc1 != "")
            {
              $to = $client_email_cc1;
              //$from = "admin@readyforyourreview.com";
              $from = "tjohannvr@datasymphony.com";
              // $from = "noreply@taxon.be";
              $subject = $subject_hwe;
  
  
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
              $headers .= 'From: <' . $from . '>' . '\r\n';
  
  
              $message1 = $email_html_data1;
  
  
              if (mail($to, $subject, $message1, $headers)) {
                
                $message_hwe = "Successfully disapproved";
                // echo "cc mail send client to client ".$client_email_cc1;
                // echo "<br>";
                // echo $message1;
  
              } 
              else 
              {
                $message_hwe = "Error in disapprove.please try again";
              }
            }
          
      }
      else
      {
        $message_hwe =  "Error in disapprove.please try again";
      }

      //   $contract_rates_table = $wpdb->prefix . "contract_rates";
      //   $select3 = "SELECT * FROM $contract_rates_table WHERE ID='" . $better_ta_id . "'";

      
      // $results3 = $wpdb->get_results($select3);

      // foreach ($results3 as $value3) {

      //   $client_representative_email = $value3->client_invoice_representative_email;

        
      // }


    }

    echo $message_hwe;
  
die();

}

add_action('wp_ajax_nopriv_get_timesheet_datareview_disapprove', 'get_timesheet_datareview_disapprove');
add_action('wp_ajax_get_timesheet_datareview_disapprove', 'get_timesheet_datareview_disapprove');


add_action('wp_head', 'reminder_mail_send_on_site_visitor_function');

function reminder_mail_send_on_site_visitor_function()
{
  global $wpdb;
 
  if (is_home() || is_front_page()) {

    $ta_table = $wpdb->prefix . "TA_contractor_link";
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

                // echo "<br>";
                // echo "Contractor Email :".$client_email_to."<br>";
                // echo $message;
              } 
              else
              {
                // echo "Email sending failed.";
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

                // echo "<br>";
                // echo "Admin Email Email :".$client_email_cc."<br>";
                // echo $message;
              } 
              else
              {
                // echo "Email sending failed.";
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

add_action('wp_ajax_nopriv_get_client_xero_info', 'get_client_xero_info');
add_action('wp_ajax_get_client_xero_info', 'get_client_xero_info');

function get_client_xero_info()
{

  global $wpdb;

  $access_token = get_option('access_token_hwe_hwe');
  $refresh_token_hwe = get_option('refresh_token_hwe');
  $client_id_xero = get_option('client_id_xero');
  $client_secret_xero = get_option('client_secret_xero');

  $curl_hwe2 = curl_init();

  curl_setopt_array(
    $curl_hwe2,
    array(
      CURLOPT_URL => 'https://api.xero.com/connections',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $access_token
      ),
    )
  );

  $response_conn = curl_exec($curl_hwe2);

  curl_close($curl_hwe2);
  $response_conn_data = json_decode($response_conn, true);





  if (isset($response_conn_data['Status']) && $response_conn_data['Status'] == 401 && $response_conn_data['Title'] == 'Unauthorized') {


    $curl1 = curl_init();

    curl_setopt_array(
      $curl1,
      array(
        CURLOPT_URL => 'https://identity.xero.com/connect/token?=',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
          'grant_type' => 'refresh_token',
          'refresh_token' => $refresh_token_hwe,
          'client_id' => $client_id_xero,
          'client_secret' => $client_secret_xero
        ),
        CURLOPT_HTTPHEADER => array(
          'Cookie: _abck=40B736C24D6E1F8B70F8DFCA4C04D102~-1~YAAQfGPUF9PsoCaCAQAAf016WQgBWCzuf2/YQwAM2dtQ3WuLhn1w/xkzbKOjP2AZ1XHbxLynk/AChuZmWig5r57pTWGPq5KprKR3OeORNh4AixqIPBngqFK1basAqcQFrra9D9BPLMPi5Pw1b4nLwGxRt93tHy7BvDmMQT07Pe29XsJSHvekFChwl+orvHZJsHzXgkEV6HRzf9y2nXnNFtc9ac2M3wfM3f/33TPfdCFE6eMiXaXT7GGT+uTyCcKzXEwSPDGLHU1ue73sz+hV5M6Ce7+rh3IUh/xGxY1yxDzYwwFu83/d3wT/5auORKUOf13QdzdPFs0/XAyGipywXXKThetxewi2d2nnC3Gxb7ha418jG+D1VIisRrSGXMMhGJpMKbM=~-1~-1~-1; ak_bmsc=BA2F71643D7151595BD82A81CB2148A9~000000000000000000000000000000~YAAQfGPUF9TsoCaCAQAAf016WRA10OcqMyawV/2sfg2p/WJAo57xVHldOqWN+5Qaztt6+ByCVXZ8Sa+Z60HF3DFE90p2TwxXSdb5H8I4RZ7SsLUi4wzUY6kdg6NBe9jn9be3kpzVGRYkscsWF3Ehez0dLWPT+3xF6gWWsNEM+yTTttje6Q3MbXGRkTqFw9mCMOvoFwkTElQg7VkMXfhjz2ZVfeKeVF3vvcd2ad/wMkWIY9VywTiryNTRbB449ANQhKf4lYerUif4hNHKQcymsYKA1kCY7dNrlM7JdnjrLfTwCkxe5sua/IvfKEVsgY4OAxzPJbr86lmUoy33zGH6oPp3vjJuw0Txjjt5HdaUznZ5Ey6dML43xg==; bm_sz=D2AE4FE7E5BA6CB7F774BBF0DECA79E0~YAAQfGPUF9XsoCaCAQAAf016WRCGsgPEUhJfmQa+nUXEdx6DumAvlzIcocyVbdlbcp/1POObXeeSdvVD9i66fLtb8+qeUbGwYX5BfGcQI4MIS00VMAWMfBdsUdAIUjtm2iZaAjDsGMNJEvIf1TrmcrCSuBLJujsM1eTUfmRPmiV2WHNaPZqtpJiDFX59ANaaWtwINgINnSJkEyUtvNwxiA2bYAxc4QZoso+IRMv+jTwC0Gyz1vp78IrfIhzhkJlIjobWoyYvKgapY38+HV7yuYxjUuVtmH4cvJ9XQe/edMzY~4605233~3420738; Device=cbf749ade2564d8897f8d15ebbe9e830'
        ),
      )
    );

    $response_new_access_token = curl_exec($curl1);

    curl_close($curl1);
    $response_new_access_token_hwe = json_decode($response_new_access_token, true);

    $access_token_hwe_new = $response_new_access_token_hwe['access_token'];
    $refresh_token_get_new = $response_new_access_token_hwe['refresh_token'];

    update_option('access_token_hwe_hwe', $access_token_hwe_new);
    update_option('refresh_token_hwe', $refresh_token_get_new);


  }

  $tenanat_id = get_option('tenanat_id_hwe');
  $access_token = get_option('access_token_hwe_hwe');
  $refresh_token_hwe = get_option('refresh_token_hwe');

  $account_number = $_POST['account_number'];

  $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Contacts/?where=AccountNumber="'.$account_number.'"',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'xero-tenant-id: '.$tenanat_id,
    'Authorization: Bearer '.$access_token,
    'Accept: application/json',
    'Content-Type: application/json',
    'Cookie: _abck=40B736C24D6E1F8B70F8DFCA4C04D102~-1~YAAQqNxVuC/aCi+JAQAAdYWGPwoqPF6BjIRCPIpF7UmWmFSerjV5VMBBGynsMem7nGcrFrrNrF4ZMZ4u/r+1B0tH7K6342WRAdR/8/hwxjhlbxGL1V3mLAXhMON3tj4RKZRKXyq8XdsIl5zFuEuvikhJSn7AGnsyMeS9BeRiOeSLziF5l2kufhYjkTYifHKcO24nO0L8NgPz60uo9YTnoRwZljQ4ypiKHDQzu1yAxGoG+IFHcod6unxCo3BRgJfDS5+zSixwx9rqLAPnglLAtsqtE0VpkBUes4EKHCg9VJYFXAkoD8Mhm5zoQbcaWXAxhdj+yQ+8uE5gi3eOri0u5d2R+NZoiPIfucGo~-1~-1~-1; ak_bmsc=BA2F71643D7151595BD82A81CB2148A9~000000000000000000000000000000~YAAQqNxVuDDaCi+JAQAAdYWGPxRNhv7lNqpnGfCIbUPDejORIJsHboAftTMJ4+hnagStvOwL3ghHEOSF/1JRo0ot84bPscEbEIE5l0ipa4/l0BN1CRwxZ0apWnArWgmTQkhbrg3FjTwzfOJ8/Iewae5Ak1bPYjNZJwdOr6R9TJTUFbbH/4PpCMZZeI2PuItj1rA3k2ua4L4vocOF/9kzEpFce3lMooDBIV/iod8twE7ZEWfOs5St87G5HTqp0XPebtiXrg/8poaMpsj+HRogquE/9wiJPUpHqH/L8KRRWvNiQX0eAF0YowzqxKcD61oyhsF78M/DOcpZOiJWxikj5jjD2lDT/DbQn/i/RumQsMhYef289hU96FqsvQ==; bm_sv=33666B66B23791824A9139AC82D00856~YAAQ1o0sMQx2OAWJAQAAX+6IPxTirNENUVbbfe/JCeJM7JFz9GymwElSel8LliYNIXSLBEa/mhXmh/MsjzJr1UQdj03SnWm1sm6OjCVBzzqucxdssluO6j+w13uljRE44eqYutrtxpGKuNA+HVRyCGq6vKuwEMtFg7AXZwmHanteZeyY7CN7Rx+YGsbXHt1WrVrPPgybPePkAIrxWq05RRC2Oolw8hx2kaNsSO4/w2MgyENXYPsljQJHhZPL7+8=~1; bm_sz=6160E89D13DE2DC136364D3FE7E440C9~YAAQpHMsMQARXAiJAQAAVA1RPxS7xHxUkpyZZ3CsNzGidpKQaw7OZVFTS5795duU9Zu8CNTW+55oYgDXLnmm8kNQl85vemKprX7n5HBzLeXyFIqMuZSIhqSt/q6C9TpDdTSiFfZumS3JkpisrRgyUeZOZ698cI5yU3CLj5CtYYQnEx9DGoH1e8u97HILvg6QIZ/kLN6ToxZP2HnQnKKGpaZfWJgBEZXX7IEJelsgP7USl5stRD/ktDolFfZv6kbSn1rC2I/3dSPWkUr7cbf23B7JeVo7e5oE05Ab5qNRuGkY~3359541~3225909'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$result = json_decode($response,true);

$output = array();
$data = array();
if(isset($result['Status']) && $result['Status'] == "OK" && count($result['Contacts']) > 0)
{
  $data['client_status'] = 1;
  $data['client_data'] = $result['Contacts'][0];

  $output = $data;
}
else
{
  $data['client_status'] = 0;
  $data['client_data'] = '';

  $output = $data;
}
echo json_encode($output);

die();
}


add_shortcode("invoiccreaetesthwe","invoicecreatefun");
function invoicecreatefun()
{
  include "create_invoice.php";
}