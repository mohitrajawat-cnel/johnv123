<?php
 global $wpdb;

 $get_review_name1=0;
  $get_review_name2=0;
  $get_review_name3=0;
  $get_review_name4=0;
  $get_review_name5=0;
  $comment_approved="";

//   ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
  
  $review=0;

    if(isset($_POST['get_review_name1']))
    {
      $get_review_name1=$_POST['get_review_name1'];
    }
    if(isset($_POST['get_review_name2']))
    {
      $get_review_name2=$_POST['get_review_name2'];
    }
    if(isset($_POST['get_review_name3']))
    {
      $get_review_name3=$_POST['get_review_name3'];
    }
    if(isset($_POST['get_review_name4']))
    {
      $get_review_name4=$_POST['get_review_name4'];
    }
    if(isset($_POST['get_review_name5']))
    {
      $get_review_name5=$_POST['get_review_name5'];
    }

    $comment_data='';
    if(isset($_POST['comment_approved']) && $_POST['comment_approved'] !='')
    {
      $comment_approved=$_POST['comment_approved'];
      // $comment_data = "comments='$comment_approved',";
    }

    $approve_disapprove_status = 0;
    if(isset($_POST['approve_disapprove_status']))
    {
      $approve_disapprove_status=$_POST['approve_disapprove_status'];
    }

    if($approve_disapprove_status == 0)
    {
      $approve_disapprove_status =2;
    }

    if(isset($_POST['reviews']))
    {
      $review = $_POST['reviews'];
    }


    

    $ta_id = $_REQUEST['ta_link_id'];

 
    $approve_datehwe = current_time( 'timestamp' );
    $approve_date = date("Y-m-d H:i:s",$approve_datehwe);

    $rate_per_hour = 0;

    $ta_contractors2 = $wpdb->prefix . "TA_contractor_link";
    $select3 = "select * from $ta_contractors2 where ID='$ta_id' order by ID desc";
    $results3 = $wpdb->get_results($select3);

    
    foreach ($results3 as $ta_value) 
    {

     

      $better_contractor_id = $ta_value->Better_contractor_id;
      $better_ta_id = $ta_value->better_ta_id;
      // $xero_contact_id = $ta_value->xero_contact_id;

      $contractid = $better_contractor_id;
      $rate_per_hour = $ta_value->client_ta_rate;


      $contractors = $wpdb->prefix . "contractors";
      $select1 = "select * from $contractors where ID='" . $better_contractor_id . "' order by ID desc";
      $results1 = $wpdb->get_results($select1);
      $selected_hwe = '';
      foreach ($results1 as $value1) 
      {

        $contractor_email = $value1->emailaddress;
        $phonenumber = $value1->phonenumber;
        $contractor_name = $value1->contractor_name.' '.$value1->contractor_surname;

        $address_line1 = '';
        $address_line1 = $value1->address_line1;
        $city = '';
        $city = $value1->city;
        $postal_code = '';
        $postal_code = $value1->postal_code;
        $country = '';
        $country = $value1->country;
      }

      $randow_string_contract = $_REQUEST['randow_string_hwe_client_review'];
      $select_data = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "contract_rates where random_mail_token='$randow_string_contract' && ID='$better_ta_id'", ARRAY_A);
    //  print_r($select_data);

    //  die("234dfgdf");
  
      foreach ($select_data as $contract_data) {

        $contractid_ID = $contract_data['ID'];
        $ta_number = $contract_data['contract_id'];
        $invoice_method = $contract_data['invoice_method'];
        $client_id = $contract_data['client_id'];

        $client_representative_email =  $contract_data['client_invoice_representative_email'];

        $xero_contact_id = $contract_data['xero_contact_id'];


      }

      $select_data8 = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "timesheet_form_table where contarct_id='$ta_id'", ARRAY_A);
      //$select_data8 = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "timesheet_form_table", ARRAY_A);
      
 
      foreach ($select_data8 as $time_sheet_data) {

        $number_of_hours = (int)$time_sheet_data['number_of_hours'];

        $total_amount_excluding = $time_sheet_data['total_amount_excluding'];
        $GET_SITE_URL = get_site_url();

          $current_site_url = str_replace('https', 'http', $GET_SITE_URL);

          $get_csv_url = $time_sheet_data['timesheet_upload'];

          $get_csv_url = str_replace($current_site_url, '', $get_csv_url);


          $csv_url = '<a href="' .$GET_SITE_URL.$get_csv_url . '" class="btn btn-primary">Download Timesheet</a>';

      }

      // echo "test".$GET_SITE_URL.$get_csv_url;
      // echo $csv_url;
      // die("dfgsdg");
 

      $client_table = $wpdb->prefix . "clients";
      $select2 = "select * from $client_table where ID='" . $client_id . "' order by ID desc";
      $results2 = $wpdb->get_results($select2);
      foreach ($results2 as $value2) {
        $client_name = $value2->client_name;
        $client_email = $value2->client_email;
        $account_number = $value2->account_number;

        $reprentative_email_cc_1 = $value2->reprentative_email_cc_1;
        $reprentative_email_cc_2 = $value2->reprentative_email_cc_2;
        $reprentative_email_cc_3 = $value2->reprentative_email_cc_3;

        $address_line1 = '';
        $address_line1 = $value2->client_address;
        $city = '';
        $city = $value2->client_city;
        $postal_code = '';
        $postal_code = $value2->postal_code;
        $country = '';
        $country = $value2->client_country;
      }

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

      $message='Not created invoive ,please submit correct details';

      if($invoice_method == 0)
      {

   
       
             $update_approved1 = "UPDATE ".$wpdb->prefix."contract_rates SET invoice_method='0',reviews='$review',
            comments='$comment_approved',
            communication_rating='$get_review_name1',
            timeliness_rating='$get_review_name2', 
            cooperation_rating='$get_review_name3',
            quality_of_work_rating='$get_review_name4',
            accuracy_of_work_rating='$get_review_name5' where ID='" . $contractid_ID . "'";
            // 
            // echo "dsfasdf".$comment_data;
            // echo "<br>";
    
     
            if ($wpdb->query($update_approved1)) {
     
              // $select_data = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "contract_rates where random_mail_token='$randow_string_contract' && ID='$better_ta_id'", ARRAY_A);
              // print_r($select_data);
         
              // die("test234234");
              
  
              //$contractors = '';
              // $contractors_tasb = $wpdb->prefix . "contractors";

              // $select_contractor_name = "select * from $contractors_tasb where ID='$better_contractor_id'";
              // $results_contractor_name = $wpdb->get_results($select_contractor_name);

              // foreach ($results_contractor_name as $value_contractor_name) {

              //   $contractor_name = $value_contractor_name->contractor_name;
              //   $contractors = $contractors . "," . $contractor_name;
              // }



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

                $get_contact_data = array();

                if ($xero_contact_id != '') {

                  // $curl_contact = curl_init();

                  // curl_setopt_array(
                  //   $curl_contact,
                  //   array(
                  //     CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Contacts/' . $xero_contact_id,
                  //     CURLOPT_RETURNTRANSFER => true,
                  //     CURLOPT_ENCODING => '',
                  //     CURLOPT_MAXREDIRS => 10,
                  //     CURLOPT_TIMEOUT => 0,
                  //     CURLOPT_FOLLOWLOCATION => true,
                  //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  //     CURLOPT_CUSTOMREQUEST => 'GET',
                  //     CURLOPT_HTTPHEADER => array(
                  //       'xero-tenant-id: ' . $tenanat_id,
                  //       'Authorization: Bearer ' . $access_token,
                  //       'Accept: application/json',
                  //       'Content-Type: application/json',
                  //       'Cookie: _abck=40B736C24D6E1F8B70F8DFCA4C04D102~-1~YAAQqNxVuAqfqEaCAQAA0wGhcghnDRrySCFAhHYmQ9KTZ8eQkasNegnPWORrHRBYlSFQ/zzMW/JI0FQsjAvnMpLjHO10MesFnHrM8xLGrOSfIko91zzpLHGTN0xDUFPM0rFOqdAz6b10AEdY9gj/hUZfioWVCdcCEBvai2vXeQYGNr/YT/K6fPm7CB52WbO86wR1jWbz3rA0Jp7fc5cfiAA2vLO0XoYJRZztzWIqzkq5w/CQEWwbkA3iFKD1X784wNE5WRcuIucdkGhVR0fXPnxIfsbVsjb3BAU/VUGsF8UAlYL4i1rjk7siFab02n3zsnBHj+YDTDIoqkDTGFbUAoUkLU8/8ygp2RXhX5LSpTBj0e04QCj/CatAjgNFcxJwm1Y1LHg=~-1~-1~-1; ak_bmsc=8A04B65950B43A2C415F68D3B9BA014D~000000000000000000000000000000~YAAQqNxVuAufqEaCAQAA0wGhchCcJqTj63m5JIY9lH/34AsBKp1F5ubbHQb+AMpwIHH+1FxcczOxEc1YrquD519ku/wqaqYWT/7kDHOo3VsIG2AsMYCpsoe1O0Y7UfkM+3As+gD6/Llfr0OrasLrU7X7+qdqX5t5yWJ2vJxXZLrquZjkeCZPeV2SA3OpoUpxe0P/JJ2ktXrElJvWUA8yQlLGuXQO/U3DNcQD9X+rLy6Pfk747mZq5ETUjl9EAT6lO86BX1q7GLRf5aaHiN7zUrV+WI8EFkeuHor/w3Wmww/w4J8APR7F+hNu21lUwxqVDXFg4rNzQbiqqSEuu7Bnpgp/bTCq571ZLoMNwEp+WeVF3G+rF9WPUQkrNyw=; bm_sz=14763D346389C7C1227712739B17F144~YAAQqNxVuAyfqEaCAQAA0wGhchBSZUWylj13X6cfNdY1KjWlQ82P48dr3ySqaE9OWMJLlwvaw4gVgu84B719QX/XcxhV3ZAwJelrtLwgPw2fKl2LMlVTprCYXIikYLpeDTxKoRD2+t+MEaAaVAnm0bj1R4qOoleTwi2jV59uHL/EYaZOKduTs5X9OupppIpF5HYzyFQtvgZNy70O7tw351+l5ckHemKOJ7W/uKTasiIoXslUg4H79Xz7ZMsh7sNp7+4slGY77S4VomHLZi8zryKOQATb/+pEJOhPmmRoWV1T~3552054~4539462'
                  //     ),
                  //   )
                  // );

                  // $response_get_contact = curl_exec($curl_contact);

                  // curl_close($curl_contact);

                  // $get_contact_data = json_decode($response_get_contact, true);
                }


                // if (isset($get_contact_data['Status']) && $get_contact_data['Status'] == 'OK') {

                //   $contractor_id5 = $xero_contact_id;

                // } else {
                //   $curl = curl_init();

                //   curl_setopt_array(
                //     $curl,
                //     array(
                //       CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Contacts',
                //       CURLOPT_RETURNTRANSFER => true,
                //       CURLOPT_ENCODING => '',
                //       CURLOPT_MAXREDIRS => 10,
                //       CURLOPT_TIMEOUT => 0,
                //       CURLOPT_FOLLOWLOCATION => true,
                //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                //       CURLOPT_CUSTOMREQUEST => 'POST',
                //       CURLOPT_POSTFIELDS => '{
                //         "Name": "' . $client_name . '",
                //         "EmailAddress": "' . $client_email . '",
                //         "TaxNumber": "122-030-2428",
                //         "Addresses": [
                //           {
                //             "AddressType": "POBOX",
                //             "AddressLine1": "' . $address_line1 . '",
                //             "City": "' . $city . '",
                //             "PostalCode": "' . $postal_code . '",
                //             "Country":"' . $country . '"
                //           }
                //         ]
                //       }',

                //       CURLOPT_HTTPHEADER => array(
                //         'xero-tenant-id: ' . $tenanat_id,
                //         'Authorization: Bearer ' . $access_token,
                //         'Accept: application/json',
                //         'Content-Type: application/json'
                //       ),
                //     )
                //   );

                //   $response = curl_exec($curl);

                //   curl_close($curl);



                //   $contractor_data_hwe4 = json_decode($response, true);

                //   $contractor_id5_hwe = $contractor_data_hwe4['Contacts'];

                //   $contractor_id5 = $contractor_id5_hwe[0]['ContactID'];


                //   $update_xero_contact_id = "UPDATE " . $wpdb->prefix . "contract_rates SET `xero_contact_id`='$contractor_id5' where ID='" . $contractid_ID . "'";

                //   $wpdb->query($update_xero_contact_id);

                // }
              //}

              $contractor_id5 = $xero_contact_id;
              if ($contractor_id5) {

                $cueent_monthdate = date("Y-m");

                $datetime_submit_date = get_option('datetimesheet');
                $timesheet_date = $cueent_monthdate . '-' . $datetime_submit_date;

                $contract_start_date = strtotime($timesheet_date);

                $invoice_create_date = current_time('timestamp');

                $invoice_in_date_format = date("Y-m-d", $invoice_create_date);

                $inoice_end_date_format = date('Y-m-d', strtotime($invoice_in_date_format . ' +30 day'));

                $inoice_end_date_timstamp = strtotime($inoice_end_date_format);



                $deadline_timesheet_date = get_option('dayshwe');

                $timesheed_dead_line_date = date('Y-m-d', strtotime($timesheet_date . ' + ' . $deadline_timesheet_date . ' day'));

                $timesheet_end_date = strtotime($timesheed_dead_line_date);

                $curl_item = curl_init();

                // echo $ta_number;
                // echo "1ta_number<br>";
                // echo $contractor_name;
                // echo "contractor_name<br>";
                // echo $contractid;
                // echo "contractid<br>";
                // echo $number_of_hours;
                // echo "number_of_hours<br>";
                // echo $rate_per_hour;
                // echo "rate_per_hour<br>";

                curl_setopt_array(
                  $curl_item,
                  array(
                    CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Items',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
                    "Code": "' . $ta_number . '",
                    "Name": "' . $ta_number . '",
                    "Description": "' . $client_name . ' Billed Hours
                    TA Number: ' . $ta_number . '
                    Contract ID: ' . $contractid . '
                    Quantity: ' . $number_of_hours . '
                    ",
                    "PurchaseDescription": "' . $client_name . ' Billed Hours
                    TA Number: ' . $ta_number . '
                    Contract ID: ' . $contractid . '
                    Quantity: ' . $number_of_hours . '
                    ",
                    "PurchaseDetails": {
                      "UnitPrice": ' . $rate_per_hour . ',
                      "AccountCode": "200"
                    },
                    "SalesDetails": {
                      "UnitPrice": ' . $rate_per_hour . ',
                      "AccountCode": "200"
                    }
                  }',
                    CURLOPT_HTTPHEADER => array(
                      'xero-tenant-id: ' . $tenanat_id,
                      'Authorization: Bearer ' . $access_token,
                      'Accept: application/json',
                      'Content-Type: application/json'
                    ),
                  )
                );

                $response_item = curl_exec($curl_item);

                // print_r($response_item);

                // echo "<br>mohit";
                // print_r($access_token);

                // die();

                curl_close($curl_item);
                $curl = curl_init();

                curl_setopt_array(
                  $curl,
                  array(
                    CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Invoices',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => '{
                      "Type": "ACCREC",
                      "Contact": {
                        "ContactID": "' . $contractor_id5 . '"
                      },
                      "Date": "\\/Date(' . $invoice_create_date . '+0000)\\/",
                      "DueDate": "\\/Date(' . $inoice_end_date_timstamp . '+0000)\\/",
                      "DateString": "' . $invoice_in_date_format . 'T00:00:00",
                      "DueDateString": "' . $inoice_end_date_format . 'T00:00:00",
                      "TaxNumber": "122-030-2428",
                      "Reference": "INV-' . $ta_number . 'OMCS",
                      "LineAmountTypes": "Exclusive",
                      "LineItems": [
                        {
                          "ItemCode": "' . $ta_number . '",
                          "Description": "' . $client_name . ' Billed Hours
                          TA Number: ' . $ta_number . '
                          Contract ID: ' . $contractid . '
                          Quantity: ' . $number_of_hours . '
                          ",
                          "Quantity": "' . $number_of_hours . '",
                          "UnitAmount": "' . $rate_per_hour . '",
                          "AccountCode": "200",
                          "DiscountRate": "0"
                        }
                      ]
                    }',
                    CURLOPT_HTTPHEADER => array(
                      'xero-tenant-id: ' . $tenanat_id,
                      'Authorization: Bearer ' . $access_token,
                      'Accept: application/json',
                      'Content-Type: application/json'
                    ),
                  )
                );

                $response2 = curl_exec($curl);

                curl_close($curl);

                $invoice_response = json_decode($response2, true);

                // print_r($response2);

                // echo "<br>mohit";
                // print_r($access_token);

                // die();

                if (isset($invoice_response['Status']) && $invoice_response['Status'] == 'OK') {


                  // $update_approved = "UPDATE ".$wpdb->prefix."contract_rates SET invoice_method='1' where ID='" . $contractid_ID . "'";
                  // $wpdb->query($update_approved);

                  $timesheet_tracking_table = $wpdb->prefix . "timesheet_tracking";
                  $select_timesheet_tracking = "select * from $timesheet_tracking_table where better_contractor_id='$better_contractor_id' && better_ta_id='$ta_number'";
                  $results_timesheet = $wpdb->get_results($select_timesheet_tracking);



                 

                  if (count($results_timesheet) > 0) {
                    $insert = "UPDATE ".$timesheet_tracking_table." SET
                    ts_status='#Approved',
                    hours_approved='$number_of_hours',
                    last_update_date='$approve_date',
                    invoice_status='Generated',
                    invoice_approve_disapprove_status='$approve_disapprove_status',
                    ta_approval_contact_email='$client_email'
                    where better_contractor_id='$better_contractor_id' && better_ta_id='$ta_number'";
                    $wpdb->query($insert);
              
                } else {

                   $insert = "insert into $timesheet_tracking_table SET
                          ts_status='#Approved',
                          last_update_date='$approve_date',
                          invoice_approve_disapprove_status='$approve_disapprove_status',
                          invoice_status='Generated',
                          hours_approved='$number_of_hours',
                          ta_approval_contact_email='$client_email'";

                    $wpdb->query($insert);



                }
                //   print_r($better_contractor_id);
                //   echo "<br>";
                //   print_r($ta_number);
                //   echo "<br>";
                //   print_r($results_timesheet);

                // die("dfgdf");


                  $invoice_id = $invoice_response['Id'];

                  $all_invoice_data = $invoice_response['Invoices'];

                  $all_invoice_data = $all_invoice_data[0];

                  $invoice_number = $all_invoice_data['InvoiceNumber'];

                  // curl_close($curl_invoice_update);

                  $template_id = get_option('client_invoice_created_template');

                  $select_template = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id . "'", ARRAY_A);

                  foreach ($select_template as $template_date) {
                    $email_html_data = $template_date['message'];
                    $subject = $template_date['subject'];
                  }



                  $email_html_data = str_replace('[CONTRACTOR_NAME][TIMESHEET_LINK]',$contractor_name.' '.$csv_url, $email_html_data);
                  $email_html_data = str_replace('[INVOICE_NUMBER]', $invoice_number, $email_html_data);
                  $email_html_data = str_replace('[CLIENT_NAME]', $client_name, $email_html_data);
                  // $email_html_data = str_replace('[TIMESHEET_LINK]',$csv_url, $email_html_data);


                  
                  $only_cc_mail_send_when_client_have = '';

                  $to_email_send_invoice = get_option('to_invoice_created_mail_send_option');
                  if($to_email_send_invoice == 0)
                  {
                    $client_email_to_invoice = $client_email;
                    $only_cc_mail_send_when_client_have = $representative_cc_email;
                  }
                  elseif($to_email_send_invoice == 1)
                  {
                    $client_email_to_invoice = $contractor_email;
                  }
                  elseif($to_email_send_invoice == 2)
                  {
                    $client_email_to_invoice = "admin@datasymphony.com";
                  }
                  else
                  {
                    $client_email_to_invoice = "";
                  }

                  if($client_email_to_invoice != "")
                  {
                    $to2 = $client_email_to_invoice;
                    //$from = "admin@readyforyourreview.com";
                    $from = "tjohannvr@datasymphony.com";
                    //$from = "noreply@taxon.be";
                    $subject = $subject;
  
  
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com,' . $client_representative_email;
                    $headers .= 'From: <' . $from . '>' . '\r\n'.$only_cc_mail_send_when_client_have;
  
                    $message = $email_html_data;
  
  
                    if (mail($to2, $subject, $message, $headers)) {
                      // echo "Mail send to admin ".$client_email_to_invoice;
                      // echo "<br>";
                      // echo $message;
  
                    } else {
                      // echo "unsend";
  
                    }
                  }

                  $only_cc_mail_send_when_client_have ='';
                  $cc_email_send_invoice = get_option('cc_invoice_created_mail_send_option');
                  if($cc_email_send_invoice == 0)
                  {
                    $client_email_cc_invoice = $client_email;
                    $only_cc_mail_send_when_client_have = $representative_cc_email;
                  }
                  elseif($cc_email_send_invoice == 1)
                  {
                    $client_email_cc_invoice = $contractor_email;
                  }
                  elseif($cc_email_send_invoice == 2)
                  {
                    $client_email_cc_invoice = "admin@datasymphony.com";
                  }
                  else
                  {
                    $client_email_cc_invoice = "";
                  }

                  if($client_email_cc_invoice != "")
                  {
                    $to2_hwe = $client_email_cc_invoice;
                    //$from = "admin@readyforyourreview.com";
                    $from = "tjohannvr@datasymphony.com";
                    //$from = "noreply@taxon.be";
                    $subject = $subject;
  
  
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com,' . $client_representative_email;
                    $headers .= 'From: <' . $from . '>' . '\r\n'.$only_cc_mail_send_when_client_have;
  
                    $message = $email_html_data;
  
  
                    if (mail($to2_hwe, $subject, $message, $headers)) {
                      // echo "Mail send to admin ".$client_email_cc_invoice;
                      // echo "<br>";
                      // echo $message;
  
                    } else {
                      // echo "unsend";
  
                    }
                  }

               


                  ///////////////////////////mail sebnd client to contractor//////
                  $template_id = get_option('approval_timesheet_client_to_contractor');

                  $select_template = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id . "'", ARRAY_A);

                  foreach ($select_template as $template_date) {
                    $email_html_data_contractor = $template_date['message'];
                    $subject = $template_date['subject'];
                  }



                  $email_html_data_contractor = str_replace('[CONTRACTOR_NAME]', $contractor_name, $email_html_data_contractor);
                  $email_html_data_contractor = str_replace('[CLIENT_NAME]', $client_name, $email_html_data_contractor);

                  $only_cc_mail_send_when_client_have = "";
                  $to_email_send = get_option('to_approval_timesheet_client_contractor_send_option');
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
                    $to3 = $client_email_to;
                    //$from = "admin@readyforyourreview.com";
                    $from = "tjohannvr@datasymphony.com";
                    //$from = "noreply@taxon.be";
                    $subject = $subject;
  
  
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: <' . $from . '>' . '\r\n'.$only_cc_mail_send_when_client_have;
                    // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
  
  
                    $message_contractor = $email_html_data_contractor;
  
  
                    if (mail($to3, $subject, $message_contractor, $headers)) {
                      // echo "To mail send to client to contractor ".$client_email_to;
                      // echo "<br>";
                      // echo $message_contractor;
  
                    } else {
                      // echo "unsend";
  
                    }
                  }

                  $only_cc_mail_send_when_client_have = "";
                  $cc_email_send = get_option('cc_approval_timesheet_client_contractor_send_option');
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
                    $to3 = $client_email_cc;
                    //$from = "admin@readyforyourreview.com";
                    $from = "tjohannvr@datasymphony.com";
                    //$from = "noreply@taxon.be";
                    $subject = $subject;
  
  
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: <' . $from . '>' . '\r\n'.$only_cc_mail_send_when_client_have;
                    // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
  
  
                    $message_contractor = $email_html_data_contractor;
  
  
                    if (mail($to3, $subject, $message_contractor, $headers)) {
                      // echo "CC mail send to client to admin ".$client_email_cc;
                      // echo "<br>";
                      // echo $message_contractor;
  
                    } else {
                      // echo "unsend";
  
                    }
                  }


                  

                  /////////////////////end mail send client to contracotor/////////////

                   ///////////////////////////mail sebnd client to client//////
                   $template_id = get_option('approval_timesheet_client_to_client');

                   $select_template = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id . "'", ARRAY_A);
 
                   foreach ($select_template as $template_date) {
                     $email_html_data_client = $template_date['message'];
                     $subject = $template_date['subject'];
                   }
 
 
 
                   $email_html_data_client = str_replace('[CLIENT_NAME]', $client_name, $email_html_data_client);
 
 
                   $only_cc_mail_send_when_client_have = "";
                   $to_email_send1 = get_option('to_approval_timesheet_client_to_client_send_option');
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
                        $to4 = $client_email_to1;
                        //$from = "admin@readyforyourreview.com";
                        $from = "tjohannvr@datasymphony.com";
                        //$from = "noreply@taxon.be";
                        $subject = $subject;
      
      
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: <' . $from . '>' . '\r\n'.$only_cc_mail_send_when_client_have;
                        // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
      
      
                        $message_clienthwe = $email_html_data_client;
      
      
                        if (mail($to4, $subject, $message_clienthwe, $headers)) {
                        //  echo "To mail send to client to client ".$client_email_to1;
                        //  echo "<br>";
                        //  echo $message_clienthwe;
      
                        } else {
                        //  echo "unsend";
      
                        }
                    }

                    $only_cc_mail_send_when_client_have="";
                    $cc_email_send1 = get_option('cc_approval_timesheet_client_to_client_send_option');
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
                      $to4 = $client_email_cc1;
                      //$from = "admin@readyforyourreview.com";
                      $from = "tjohannvr@datasymphony.com";
                      //$from = "noreply@taxon.be";
                      $subject = $subject;
    
    
                      $headers = "MIME-Version: 1.0" . "\r\n";
                      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                      $headers .= 'From: <' . $from . '>' . '\r\n'.$only_cc_mail_send_when_client_have;
                      // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
    
    
                      $message_clienthwe = $email_html_data_client;
    
    
                      if (mail($to4, $subject, $message_clienthwe, $headers)) {
                      //  echo "cc mail send to client to admin ".$client_email_cc1;
                      //  echo "<br>";
                      //  echo $message_clienthwe;
    
                      } else {
                      //  echo "unsend";
    
                      }
                   }
 
                  
 
                   /////////////////////end mail send client to client/////////////

                   $message = "Invoice created successfully";

                }
                else
                {
                  $message = "Error in invoice create";
                }

              }


            }
            else
            {
              $message = "Please check approve/disapprove status or change review";
            }
          //}

       // }

      

      } 
      else 
      {
        $ta_contractors2 = $wpdb->prefix . "TA_contractor_link";
        $select3 = "select * from $ta_contractors2 where better_ta_id='$better_ta_id' && Better_contractor_id != '$better_contractor_id' order by ID desc";
        $results3 = $wpdb->get_results($select3);
      
        // print_r($better_contractor_id);
        // echo "<br>";
        // print_r($results3);

        //     die();

        $client_name_array =array();
        $array_cotract_email = array();
        $array_client_email = array();
        $client_representative_email_array = array();
        $contractor_name_array = array();
        $csv_url_array=array();
        $ta_id_array = array();
        $better_contractor_id_array=array();
        $invoice_status_check=0;
        if(count($results3) > 0)
        {
          foreach ($results3 as $ta_value) 
          {
          
            $better_contractor_idhwe =0;
            $better_contractor_idhwe = $ta_value->Better_contractor_id;
            $better_ta_id = $ta_value->better_ta_id;

            if($better_contractor_idhwe > 0)
            {
              $better_contractor_id_array[] = $better_contractor_idhwe;
            }

            $ta_contractor_client_link_id = $ta_value->ID;

            $timesheet_tracking_table1 = $wpdb->prefix . "timesheet_tracking";
            $select = "select * from  $timesheet_tracking_table1  where better_ta_id='$ta_number' && better_contractor_id ='$better_contractor_idhwe'";
            $results = $wpdb->get_results($select);
            

            $client_name_array =array();
            $array_cotract_email = array();
            $array_client_email = array();
            $client_representative_email_array = array();
            $contractor_name_array = array();
            $csv_url_array=array();
            $ta_id_array = array();

            // echo "mohit".$ta_value->Better_contractor_id;
            //   print_r($results);

            // die();
//             ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
            if(count($results) > 0)
            {

              foreach ($results as $value) {

                $client_name_array =array();
                $array_cotract_email = array();
                $array_client_email = array();
                $client_representative_email_array = array();
                $contractor_name_array = array();
                $csv_url_array=array();
                $ta_id_array = array();

                $invoive_status = $value->ts_status;
    
                if($invoive_status != "#Approved")
                {
                  $invoice_status_check = 1;
                }

           
              
                  // $better_contractor_id = $value->better_contractor_id;
                  $better_ta_idhwe = $value->better_ta_id;



                  $select_data = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "contract_rates where contract_id='$better_ta_idhwe'", ARRAY_A);
              
    
                  foreach ($select_data as $contract_data) {
              
                      $contractid_ID = $contract_data['ID'];
                      $ta_number = $contract_data['contract_id'];
                      $invoice_method = $contract_data['invoice_method'];
                      $client_id = $contract_data['client_id'];

                      $ta_id_array[] = $ta_number;
              
                      // $client_representative_email_array[] =  $contract_data['client_invoice_representative_email'];
              
                  }

                 
                  

                
                  $select_data8 = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "timesheet_form_table where contarct_id='$ta_contractor_client_link_id'", ARRAY_A);
                  
                  foreach ($select_data8 as $time_sheet_data) {

                    // $number_of_hours = $time_sheet_data['number_of_hours'];

                    // $total_amount_excluding = $time_sheet_data['total_amount_excluding'];
                    $GET_SITE_URL = get_site_url();

                      $current_site_url1 = str_replace('https', 'http', $GET_SITE_URL);

                      $get_csv_url1 = $time_sheet_data['timesheet_upload'];

                      $get_csv_url1 = str_replace($current_site_url1, '', $get_csv_url1);


                      $csv_url_array[] = '<a href="' .$GET_SITE_URL.$get_csv_url1 . '" class="btn btn-primary">Download Timesheet</a>';

                  }

                  $client_table = $wpdb->prefix . "clients";
                  $select2 = "select * from $client_table where ID='" . $client_id . "' order by ID desc";
                  $results2 = $wpdb->get_results($select2);
                  foreach ($results2 as $value2) {

                    $client_name_array[] = $value2->client_name;
                    $array_client_email[] = $value2->client_email;

                  }

              
                  $contractors = $wpdb->prefix . "contractors";
                  $select1 = "select * from $contractors where ID='" . $better_contractor_idhwe . "' order by ID desc";
                  $results1 = $wpdb->get_results($select1);

                  foreach ($results1 as $value1) 
                  {
                    $contractor_name_array[] = $value1->contractor_name.' '.$value1->contractor_surname;
                    $array_cotract_email[] = $value1->emailaddress;
          
                  }

                // }

              }
            }
          }

        }
        

        //   print_r($csv_url_array);
        //   echo "<br>";
        //   print_r($client_name_array);
        //   echo "<br>";
        //   print_r($array_client_email);
        //   echo "<br>";
          // print_r($contractor_name_array);
        //   echo "<br>";
        //   print_r($array_cotract_email);
          //  print_r($ta_id_array);
          // echo "<br>";
          // print_r($better_contractor_id_array);

        //  die("dfghdf");

        
          if($invoice_status_check == 0)
          {

              $update_approved = "UPDATE ".$wpdb->prefix."contract_rates SET invoice_method='1',reviews='$review',
              comments='$comment_approved',
              communication_rating='$get_review_name1',
              timeliness_rating='$get_review_name2', 
              cooperation_rating='$get_review_name3',
              quality_of_work_rating='$get_review_name4',
              accuracy_of_work_rating='$get_review_name5' where ID='" . $contractid_ID . "'";

    
              if ($wpdb->query($update_approved)) {
               // $contractors = '';


                // $select_contractor_name = "select * from $contractors where ID='$better_contractor_id'";
                // $results_contractor_name = $wpdb->get_results($select_contractor_name);

                // foreach ($results_contractor_name as $value_contractor_name) {

                //   $contractor_name = $value_contractor_name->contractor_name;
                //   $contractors = $contractors . "," . $contractor_name;
                // }



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

                  $get_contact_data = array();

                  if ($xero_contact_id != '') {

                    // $curl_contact = curl_init();

                    // curl_setopt_array(
                    //   $curl_contact,
                    //   array(
                    //     CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Contacts/' . $xero_contact_id,
                    //     CURLOPT_RETURNTRANSFER => true,
                    //     CURLOPT_ENCODING => '',
                    //     CURLOPT_MAXREDIRS => 10,
                    //     CURLOPT_TIMEOUT => 0,
                    //     CURLOPT_FOLLOWLOCATION => true,
                    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    //     CURLOPT_CUSTOMREQUEST => 'GET',
                    //     CURLOPT_HTTPHEADER => array(
                    //       'xero-tenant-id: ' . $tenanat_id,
                    //       'Authorization: Bearer ' . $access_token,
                    //       'Accept: application/json',
                    //       'Content-Type: application/json',
                    //       'Cookie: _abck=40B736C24D6E1F8B70F8DFCA4C04D102~-1~YAAQqNxVuAqfqEaCAQAA0wGhcghnDRrySCFAhHYmQ9KTZ8eQkasNegnPWORrHRBYlSFQ/zzMW/JI0FQsjAvnMpLjHO10MesFnHrM8xLGrOSfIko91zzpLHGTN0xDUFPM0rFOqdAz6b10AEdY9gj/hUZfioWVCdcCEBvai2vXeQYGNr/YT/K6fPm7CB52WbO86wR1jWbz3rA0Jp7fc5cfiAA2vLO0XoYJRZztzWIqzkq5w/CQEWwbkA3iFKD1X784wNE5WRcuIucdkGhVR0fXPnxIfsbVsjb3BAU/VUGsF8UAlYL4i1rjk7siFab02n3zsnBHj+YDTDIoqkDTGFbUAoUkLU8/8ygp2RXhX5LSpTBj0e04QCj/CatAjgNFcxJwm1Y1LHg=~-1~-1~-1; ak_bmsc=8A04B65950B43A2C415F68D3B9BA014D~000000000000000000000000000000~YAAQqNxVuAufqEaCAQAA0wGhchCcJqTj63m5JIY9lH/34AsBKp1F5ubbHQb+AMpwIHH+1FxcczOxEc1YrquD519ku/wqaqYWT/7kDHOo3VsIG2AsMYCpsoe1O0Y7UfkM+3As+gD6/Llfr0OrasLrU7X7+qdqX5t5yWJ2vJxXZLrquZjkeCZPeV2SA3OpoUpxe0P/JJ2ktXrElJvWUA8yQlLGuXQO/U3DNcQD9X+rLy6Pfk747mZq5ETUjl9EAT6lO86BX1q7GLRf5aaHiN7zUrV+WI8EFkeuHor/w3Wmww/w4J8APR7F+hNu21lUwxqVDXFg4rNzQbiqqSEuu7Bnpgp/bTCq571ZLoMNwEp+WeVF3G+rF9WPUQkrNyw=; bm_sz=14763D346389C7C1227712739B17F144~YAAQqNxVuAyfqEaCAQAA0wGhchBSZUWylj13X6cfNdY1KjWlQ82P48dr3ySqaE9OWMJLlwvaw4gVgu84B719QX/XcxhV3ZAwJelrtLwgPw2fKl2LMlVTprCYXIikYLpeDTxKoRD2+t+MEaAaVAnm0bj1R4qOoleTwi2jV59uHL/EYaZOKduTs5X9OupppIpF5HYzyFQtvgZNy70O7tw351+l5ckHemKOJ7W/uKTasiIoXslUg4H79Xz7ZMsh7sNp7+4slGY77S4VomHLZi8zryKOQATb/+pEJOhPmmRoWV1T~3552054~4539462'
                    //     ),
                    //   )
                    // );

                    // $response_get_contact = curl_exec($curl_contact);

                    // curl_close($curl_contact);

                    // $get_contact_data = json_decode($response_get_contact, true);
                  }


                  // if (isset($get_contact_data['Status']) && $get_contact_data['Status'] == 'OK') {

                  //   $contractor_id5 = $xero_contact_id;

                  // } else {
                  //   $curl = curl_init();

                  //   curl_setopt_array(
                  //     $curl,
                  //     array(
                  //       CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Contacts',
                  //       CURLOPT_RETURNTRANSFER => true,
                  //       CURLOPT_ENCODING => '',
                  //       CURLOPT_MAXREDIRS => 10,
                  //       CURLOPT_TIMEOUT => 0,
                  //       CURLOPT_FOLLOWLOCATION => true,
                  //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  //       CURLOPT_CUSTOMREQUEST => 'POST',
                  //       CURLOPT_POSTFIELDS => '{
                  //         "Name": "' . $client_name . '",
                  //         "EmailAddress": "' . $client_email . '",
                  //         "TaxNumber": "122-030-2428",
                  //         "Addresses": [
                  //           {
                  //             "AddressType": "POBOX",
                  //             "AddressLine1": "' . $address_line1 . '",
                  //             "City": "' . $city . '",
                  //             "PostalCode": "' . $postal_code . '",
                  //             "Country":"' . $country . '"
                  //           }
                  //         ]
                  //       }',

                  //       CURLOPT_HTTPHEADER => array(
                  //         'xero-tenant-id: ' . $tenanat_id,
                  //         'Authorization: Bearer ' . $access_token,
                  //         'Accept: application/json',
                  //         'Content-Type: application/json'
                  //       ),
                  //     )
                  //   );

                  //   $response = curl_exec($curl);

                  //   curl_close($curl);



                  //   $contractor_data_hwe4 = json_decode($response, true);

                  //   $contractor_id5_hwe = $contractor_data_hwe4['Contacts'];

                  //   $contractor_id5 = $contractor_id5_hwe[0]['ContactID'];


                  //   $update_xero_contact_id = "UPDATE " . $wpdb->prefix . "contract_rates SET `xero_contact_id`='$contractor_id5' where ID='" . $contractid_ID . "'";

                  //   $wpdb->query($update_xero_contact_id);

                  // }
                //}

                $contractor_id5 = $xero_contact_id;
                if ($contractor_id5) {

                  $cueent_monthdate = date("Y-m");

                  $datetime_submit_date = get_option('datetimesheet');
                  $timesheet_date = $cueent_monthdate . '-' . $datetime_submit_date;

                  $contract_start_date = strtotime($timesheet_date);

                  $invoice_create_date = current_time('timestamp');

                  $invoice_in_date_format = date("Y-m-d", $invoice_create_date);

                  $inoice_end_date_format = date('Y-m-d', strtotime($invoice_in_date_format . ' +30 day'));

                  $inoice_end_date_timstamp = strtotime($inoice_end_date_format);



                  $deadline_timesheet_date = get_option('dayshwe');

                  $timesheed_dead_line_date = date('Y-m-d', strtotime($timesheet_date . ' + ' . $deadline_timesheet_date . ' day'));

                  $timesheet_end_date = strtotime($timesheed_dead_line_date);

                  $curl_item = curl_init();

                
                  curl_setopt_array(
                    $curl_item,
                    array(
                      CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Items',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => '{
                      "Code": "' . $ta_number . '",
                      "Name": "' . $ta_number . '",
                      "Description": "' . $client_name . ' Billed Hours
                      TA Number: ' . $ta_number . '
                      Contract ID: ' . $contractid . '
                      Quantity: ' . $number_of_hours . '
                      ",
                      "PurchaseDescription": "' . $client_name . ' Billed Hours
                      TA Number: ' . $ta_number . '
                      Contract ID: ' . $contractid . '
                      Quantity: ' . $number_of_hours . '
                      ",
                      "PurchaseDetails": {
                        "UnitPrice": ' . $rate_per_hour . ',
                        "AccountCode": "200"
                      },
                      "SalesDetails": {
                        "UnitPrice": ' . $rate_per_hour . ',
                        "AccountCode": "200"
                      }
                    }',
                      CURLOPT_HTTPHEADER => array(
                        'xero-tenant-id: ' . $tenanat_id,
                        'Authorization: Bearer ' . $access_token,
                        'Accept: application/json',
                        'Content-Type: application/json'
                      ),
                    )
                  );

                  // $response_item = curl_exec($curl_item);

                  // print_r($response_item);

                  // echo "<br>mohit";
                  // print_r($access_token);

                  // die();

                  curl_close($curl_item);
                  $curl = curl_init();

                  curl_setopt_array(
                    $curl,
                    array(
                      CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Invoices',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => '{
                        "Type": "ACCREC",
                        "Contact": {
                          "ContactID": "' . $contractor_id5 . '"
                        },
                        "Date": "\\/Date(' . $invoice_create_date . '+0000)\\/",
                        "DueDate": "\\/Date(' . $inoice_end_date_timstamp . '+0000)\\/",
                        "DateString": "' . $invoice_in_date_format . 'T00:00:00",
                        "DueDateString": "' . $inoice_end_date_format . 'T00:00:00",
                        "TaxNumber": "122-030-2428",
                        "Reference": "INV-' . $ta_number . 'OMCS",
                        "LineAmountTypes": "Exclusive",
                        "LineItems": [
                          {
                            "ItemCode": "' . $ta_number . '",
                            "Description": "' . $client_name . ' Billed Hours
                            TA Number: ' . $ta_number . '
                            Contract ID: ' . $contractid . '
                            Quantity: ' . $number_of_hours . '
                            ",
                            "Quantity": "' . $number_of_hours . '",
                            "UnitAmount": "' . $rate_per_hour . '",
                            "AccountCode": "200",
                            "DiscountRate": "0"
                          }
                        ]
                      }',
                      CURLOPT_HTTPHEADER => array(
                        'xero-tenant-id: ' . $tenanat_id,
                        'Authorization: Bearer ' . $access_token,
                        'Accept: application/json',
                        'Content-Type: application/json'
                      ),
                    )
                  );

                  $response2 = curl_exec($curl);

                  curl_close($curl);

                  $invoice_response = json_decode($response2, true);

                  if (isset($invoice_response['Status']) && $invoice_response['Status'] == 'OK') {


                    $update_approved = "UPDATE ".$wpdb->prefix."contract_rates SET invoice_method='1' where ID='" . $contractid_ID . "'";
                    $wpdb->query($update_approved);

              

                    $timesheet_tracking_table = $wpdb->prefix . "timesheet_tracking";
                    $select_timesheet_tracking = "select * from $timesheet_tracking_table where better_contractor_id='$better_contractor_id' && better_ta_id='$ta_number'";
                    $results_timesheet = $wpdb->get_results($select_timesheet_tracking);

                    // $accuracy_of_work_rating = "ALTER TABLE ".$timesheet_tracking_table."
                    // MODIFY COLUMN last_update_date VARCHAR(256) NULL";
                    // $wpdb->query($accuracy_of_work_rating);

                    // $accuracy_of_work_rating = "ALTER TABLE ".$timesheet_tracking_table."
                    // MODIFY COLUMN ta_approval_contact_email VARCHAR(256) NULL";
                    // $wpdb->query($accuracy_of_work_rating);


              

                    if (count($results_timesheet) > 0) {
                        $insert = "UPDATE ".$timesheet_tracking_table." SET
                        ts_status='#Approved',
                        hours_approved='$number_of_hours',
                        last_update_date='$approve_date',
                        invoice_approve_disapprove_status='$approve_disapprove_status',
                        invoice_status='Generated',
                        ta_approval_contact_email='$client_email'
                        where better_contractor_id='$better_contractor_id' && better_ta_id='$ta_number'";
                        $wpdb->query($insert);
                  
                    } else {

                       $insert = "insert into $timesheet_tracking_table SET
                              ts_status='#Approved',
                              last_update_date='$approve_date',
                              invoice_approve_disapprove_status='$approve_disapprove_status',
                              invoice_status='Generated',
                              hours_approved='$number_of_hours',
                              ta_approval_contact_email='$client_email'";

                        $wpdb->query($insert);



                    }
            
      

                    $invoice_id = $invoice_response['Id'];

                    $all_invoice_data = $invoice_response['Invoices'];

                    $all_invoice_data = $all_invoice_data[0];

                    $invoice_number = $all_invoice_data['InvoiceNumber'];

                    // curl_close($curl_invoice_update);

                    $template_id = get_option('client_invoice_created_template');

                    $select_template = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id . "'", ARRAY_A);

                    foreach ($select_template as $template_date) {
                      $email_html_data = $template_date['message'];
                      $subject = $template_date['subject'];
                    }

                    $send_multiple_contracotor_name = $contractor_name.' '.$csv_url."<br>";

                    if(count($contractor_name_array) > 0)
                    {
                      foreach($contractor_name_array as $keyhwe => $value)
                      {
                        $contractor_name_grouped = $value;
                        $client_name_grouped = $client_name_array[$keyhwe];
                        $client_email_grouped = $array_client_email[$keyhwe];
                        $contractor_email_grouped = $array_cotract_email[$keyhwe];
                        $csv_url_grouped = $csv_url_array[$keyhwe];

                        $better_contractor_id_group_value = $better_contractor_id_array[$keyhwe];
                        $ta_id_group_value = $ta_id_array[$keyhwe];

                        $select_timesheet_tracking1 = "select * from $timesheet_tracking_table where better_contractor_id='$better_contractor_id' && better_ta_id='$ta_number' && invoice_approve_disapprove_status !='2'";
                        $results_timesheet1 = $wpdb->get_results($select_timesheet_tracking1);
                        if(count($results_timesheet1) > 0)
                        {
                          $update_timesheet_status_ta = "UPDATE ".$timesheet_tracking_table." SET
                          last_update_date='$approve_date',
                          invoice_status='Generated'
                          where better_contractor_id='$better_contractor_id_group_value' && better_ta_id='$ta_id_group_value'";
                          $wpdb->query($update_timesheet_status_ta);
                        }

                        $send_multiple_contracotor_name .= $contractor_name_grouped.' '.$csv_url_grouped."<br>";

                      }
                    }



                    $email_html_data = str_replace('[CONTRACTOR_NAME][TIMESHEET_LINK]', $send_multiple_contracotor_name, $email_html_data);
                    $email_html_data = str_replace('[INVOICE_NUMBER]', $invoice_number, $email_html_data);
                    $email_html_data = str_replace('[CLIENT_NAME]', $client_name, $email_html_data);
                    // $email_html_data = str_replace('[TIMESHEET_LINK]', $csv_url, $email_html_data);


                    $to_email_send_invoice = get_option('to_invoice_created_mail_send_option');
                    if($to_email_send_invoice == 0)
                    {
                      $client_email_to_invoice = $client_email;
                    }
                    elseif($to_email_send_invoice == 1)
                    {
                      $client_email_to_invoice = $contractor_email;
                    }
                    elseif($to_email_send_invoice == 2)
                    {
                      $client_email_to_invoice = "admin@datasymphony.com";
                    }
                    else
                    {
                      $client_email_to_invoice = "";
                    }
                    if($client_email_to_invoice != "")
                    {
                      $to2 = $client_email_to_invoice;
                      //$from = "admin@readyforyourreview.com";
                      $from = "tjohannvr@datasymphony.com";
                      //$from = "noreply@taxon.be";
                      $subject = $subject;
  
  
                      $headers = "MIME-Version: 1.0" . "\r\n";
                      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                      // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
                      $headers .= 'From: <' . $from . '>' . '\r\n';
  
  
                      $message = $email_html_data;
  
  
                      if (mail($to2, $subject, $message, $headers)) {
                        // echo "send";
                        // echo "<br>";
                        // echo $message;
  
                      } else {
                        // echo "unsend";
  
                      }
                    }

                    $cc_email_send_invoice = get_option('cc_invoice_created_mail_send_option');
                  if($cc_email_send_invoice == 0)
                  {
                    $client_email_cc_invoice = $client_email;
                  }
                  elseif($cc_email_send_invoice == 1)
                  {
                    $client_email_cc_invoice = $contractor_email;
                  }
                  elseif($cc_email_send_invoice == 2)
                  {
                    $client_email_cc_invoice = "admin@datasymphony.com";
                  }
                  else
                  {
                    $client_email_cc_invoice = "";
                  }

                  if($client_email_cc_invoice != "")
                  {
                      $to2_hwe = $client_email_cc_invoice;
                      //$from = "admin@readyforyourreview.com";
                      $from = "tjohannvr@datasymphony.com";
                      //$from = "noreply@taxon.be";
                      $subject = $subject;
    
    
                      $headers = "MIME-Version: 1.0" . "\r\n";
                      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                      // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com,' . $client_representative_email;
                      $headers .= 'From: <' . $from . '>' . '\r\n';
    
                      $message = $email_html_data;
    
    
                      if (mail($to2_hwe, $subject, $message, $headers)) {
                        // echo "Mail send to admin ".$client_email_to_invoice;
                        // echo "<br>";
                        // echo $message;
    
                      } else {
                        // echo "unsend";
    
                      }
                    }

                   

                      ///////////////////////////mail sebnd client to contractor//////
                      $template_id = get_option('approval_timesheet_client_to_contractor');

                      $select_template = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id . "'", ARRAY_A);

                      foreach ($select_template as $template_date) {
                        $email_html_data_contractor = $template_date['message'];
                        $subject = $template_date['subject'];
                      }



                      $email_html_data_contractor = str_replace('[CONTRACTOR_NAME]', $contractor_name, $email_html_data_contractor);
                      $email_html_data_contractor = str_replace('[CLIENT_NAME]', $client_name, $email_html_data_contractor);


                      $to_email_send = get_option('to_approval_timesheet_client_contractor_send_option');
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

                      $cc_email_send = get_option('cc_approval_timesheet_client_contractor_send_option');
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
                        $to3 = $client_email_to;
                        //$from = "admin@readyforyourreview.com";
                        $from = "tjohannvr@datasymphony.com";
                        //$from = "noreply@taxon.be";
                        $subject = $subject;
  
  
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: <' . $from . '>' . '\r\n' ;
                        // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
  
  
                        $message_contractor = $email_html_data_contractor;
  
  
                        if (mail($to3, $subject, $message_contractor, $headers)) {
                          // echo "send";
                          // echo "<br>";
                          // echo $message_contractor;
  
                        } else {
                          // echo "unsend";
  
                        }
                      }

                      if($client_email_cc != "")
                      {
                        $to3 = $client_email_cc;
                        //$from = "admin@readyforyourreview.com";
                        $from = "tjohannvr@datasymphony.com";
                        //$from = "noreply@taxon.be";
                        $subject = $subject;
  
  
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: <' . $from . '>' . '\r\n' ;
                        // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
  
  
                        $message_contractor = $email_html_data_contractor;
  
  
                        if (mail($to3, $subject, $message_contractor, $headers)) {
                          // echo "send";
                          // echo "<br>";
                          // echo $message_contractor;
  
                        } else {
                          // echo "unsend";
  
                        }
                      }
                    

                      /////////////////////end mail send client to contracotor/////////////

                      ///////////////////////////mail sebnd client to client//////
                      $template_id = get_option('approval_timesheet_client_to_client');

                      $select_template = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id . "'", ARRAY_A);

                      foreach ($select_template as $template_date) {
                        $email_html_data_client = $template_date['message'];
                        $subject = $template_date['subject'];
                      }



                      $email_html_data_client = str_replace('[CLIENT_NAME]', $client_name, $email_html_data_client);


                      $to_email_send1 = get_option('to_approval_timesheet_client_to_client_send_option');
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
  
                      $cc_email_send1 = get_option('cc_approval_timesheet_client_to_client_send_option');
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
                         $to4 = $client_email_to1;
                         //$from = "admin@readyforyourreview.com";
                         $from = "tjohannvr@datasymphony.com";
                         //$from = "noreply@taxon.be";
                         $subject = $subject;
       
       
                         $headers = "MIME-Version: 1.0" . "\r\n";
                         $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                         $headers .= 'From: <' . $from . '>' . '\r\n';
                         // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
       
       
                         $message_clienthwe = $email_html_data_client;
       
       
                         if (mail($to4, $subject, $message_clienthwe, $headers)) {
                          // echo "send";
                          // echo "<br>";
                          // echo $message_clienthwe;
       
                         } else {
                         //  echo "unsend";
       
                         }
                      }
   
                      if($client_email_cc1 != "")
                      {
                         $to4 = $client_email_cc1;
                         //$from = "admin@readyforyourreview.com";
                         $from = "tjohannvr@datasymphony.com";
                         //$from = "noreply@taxon.be";
                         $subject = $subject;
       
       
                         $headers = "MIME-Version: 1.0" . "\r\n";
                         $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                         $headers .= 'From: <' . $from . '>' . '\r\n';
                         // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
       
       
                         $message_clienthwe = $email_html_data_client;
       
       
                         if (mail($to4, $subject, $message_clienthwe, $headers)) {
                          // echo "send";
                          // echo "<br>";
                          // echo $message_clienthwe;
       
                         } else {
                         //  echo "unsend";
       
                         }
                      }

                      /////////////////////end mail send client to client/////////////

                      $message = "Invoice created successfully";

                  }
                  else
                  {
                    $message = "Error in invoice create";
                  }

                }


              }
              else
              {
                  $message = "Please check approve/disapprove status or change review";
              }
            }
            elseif($invoice_status_check == 1)
            {

             
              $update_approved = "UPDATE ".$wpdb->prefix."contract_rates SET invoice_method='1',reviews='$review',
              comments='$comment_approved',
              communication_rating='$get_review_name1',
              timeliness_rating='$get_review_name2', 
              cooperation_rating='$get_review_name3',
              quality_of_work_rating='$get_review_name4',
              accuracy_of_work_rating='$get_review_name5' where ID='" . $contractid_ID . "'";

    
              if ($wpdb->query($update_approved)) {

                      $timesheet_tracking_table = $wpdb->prefix . "timesheet_tracking";
                      $select_timesheet_tracking = "select * from $timesheet_tracking_table where better_contractor_id='$better_contractor_id' && better_ta_id='$ta_number'";
                      $results_timesheet = $wpdb->get_results($select_timesheet_tracking);

                      // $accuracy_of_work_rating = "ALTER TABLE ".$timesheet_tracking_table."
                      // MODIFY COLUMN last_update_date VARCHAR(256) NULL";
                      // $wpdb->query($accuracy_of_work_rating);

                      // $accuracy_of_work_rating = "ALTER TABLE ".$timesheet_tracking_table."
                      // MODIFY COLUMN ta_approval_contact_email VARCHAR(256) NULL";
                      // $wpdb->query($accuracy_of_work_rating);

// print_r($results_timesheet);
// die("fdgsdg");


                      if (count($results_timesheet) > 0) {
                          $insert = "UPDATE ".$timesheet_tracking_table." SET
                          ts_status='#Approved',
                          hours_approved='$number_of_hours',
                          last_update_date='$approve_date',
                          invoice_status='Open',
                          invoice_approve_disapprove_status='$approve_disapprove_status',
                          ta_approval_contact_email='$client_email'
                          where better_contractor_id='$better_contractor_id' && better_ta_id='$ta_number'";
                          $wpdb->query($insert);
                    
                      } else {

                        $insert = "insert into $timesheet_tracking_table SET
                                ts_status='#Approved',
                                last_update_date='$approve_date',
                                invoice_status='Open',
                                invoice_approve_disapprove_status='$approve_disapprove_status',
                                hours_approved='$number_of_hours',
                                ta_approval_contact_email='$client_email'";

                          $wpdb->query($insert);



                      }
                  
                
                      ///////////////////////////mail sebnd client to contractor//////
                      $template_id = get_option('approval_timesheet_client_to_contractor');

                      $select_template = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id . "'", ARRAY_A);

                      foreach ($select_template as $template_date) {
                        $email_html_data = $template_date['message'];
                        $subject = $template_date['subject'];
                      }



                      $email_html_data = str_replace('[CONTRACTOR_NAME]', $contractor_name, $email_html_data);
                      $email_html_data = str_replace('[CLIENT_NAME]', $client_name, $email_html_data);


                      $to_email_send = get_option('to_approval_timesheet_client_contractor_send_option');
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

                      $cc_email_send = get_option('cc_approval_timesheet_client_contractor_send_option');
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
                        $to2 = $client_email_to;
                        //$from = "admin@readyforyourreview.com";
                        $from = "tjohannvr@datasymphony.com";
                        //$from = "noreply@taxon.be";
                        $subject = $subject;
  
  
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: <' . $from . '>' . '\r\n' ;
                        // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
  
  
                        $message = $email_html_data;
  
  
                        if (mail($to2, $subject, $message, $headers)) {
                          // echo "to mail send client to contractor";
                          // echo "<br>";
                          // echo $message;
                          $message = "Invoice created successfully";
  
                        } else {
                          // echo "unsend";
                          $message = "Error in invoice create";
  
                        }
  
                      }

                      if($client_email_cc != "")
                      {
                        $to2 = $client_email_cc;
                        //$from = "admin@readyforyourreview.com";
                        $from = "tjohannvr@datasymphony.com";
                        //$from = "noreply@taxon.be";
                        $subject = $subject;
  
  
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: <' . $from . '>' . '\r\n' ;
                        // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';
  
  
                        $message = $email_html_data;
  
  
                        if (mail($to2, $subject, $message, $headers)) {
                          // echo "cc mail send client to contractor";
                          // echo "<br>";
                          // echo $message;
                          $message = "Invoice created successfully";
  
                        } else {
                          // echo "unsend";
                          $message = "Error in invoice create";
  
                        }
  
                      }

                    
                      /////////////////////end mail send client to contracotor/////////////

                      ///////////////////////////mail sebnd client to client//////
                      $template_id = get_option('approval_timesheet_client_to_client');

                      $select_template = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id . "'", ARRAY_A);

                      foreach ($select_template as $template_date) {
                        $email_html_data_client = $template_date['message'];
                        $subject = $template_date['subject'];
                      }

                      $email_html_data_client = str_replace('[CLIENT_NAME]', $client_name, $email_html_data_client);


                      $to_email_send1 = get_option('to_approval_timesheet_client_to_client_send_option');
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
  
                      $cc_email_send1 = get_option('cc_approval_timesheet_client_to_client_send_option');
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

                        $to3 = $client_email_to1;
                        //$from = "admin@readyforyourreview.com";
                        $from = "tjohannvr@datasymphony.com";
                        //$from = "noreply@taxon.be";
                        $subject = $subject;


                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: <' . $from . '>' . '\r\n';
                        // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';

                        $message_client = $email_html_data_client;
                        if (mail($to3, $subject, $message_client, $headers)) {
                          // echo "to mail send client to client";
                          // echo "<br>";
                          // echo $message_client;
                          $message = "Invoice created successfully";

                        } else {
                          $message = "Error in invoice create";

                        }
                      }

                      if($client_email_cc1 != "")
                      {

                        $to3 = $client_email_cc1;
                        //$from = "admin@readyforyourreview.com";
                        $from = "tjohannvr@datasymphony.com";
                        //$from = "noreply@taxon.be";
                        $subject = $subject;


                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: <' . $from . '>' . '\r\n';
                        // $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com';

                        $message_client = $email_html_data_client;
                        if (mail($to3, $subject, $message_client, $headers)) {
                          // echo "cc mail send client to client";
                          // echo "<br>";
                          // echo $message_client;
                          $message = "Invoice created successfully";

                        } else {
                          $message = "Error in invoice create";

                        }
                      }

              }
            }

        // }



         // }




       // }

       
      }

      echo $message;
      
    }

?>