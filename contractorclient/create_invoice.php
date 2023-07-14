<?php




  global $wpdb;

  //   $alert_table = "ALTER TABLE ".$wpdb->prefix."clients ADD state VARCHAR( 256 ) NULL";
  // $wpdb->query($alert_table);

//   $clients = $wpdb->prefix . "clients";


//   $accuracy_of_work_rating = "ALTER TABLE ".$clients."
//   ADD client_represantative_name VARCHAR(256) NULL,
//   ADD client_mobile_number VARCHAR(256) NULL,
//   ADD website_url VARCHAR(256) NULL,
//   ADD street_address_line1 VARCHAR(256) NULL,
//   ADD street_city VARCHAR(256) NULL,
//   ADD street_state VARCHAR(256) NULL,
//   ADD street_postal_code VARCHAR(256) NULL,
//   ADD street_country VARCHAR(256) NULL,
//   ADD business_registration_number VARCHAR(256) NULL,
//   ADD vat_id_number VARCHAR(256) NULL,
//   ADD default_vat_for_sales VARCHAR(256) NULL,
//   ADD sales_vat VARCHAR(256) NULL,
//   ADD purchases_vat VARCHAR(256) NULL,
//   ADD sales_account VARCHAR(256) NULL,
//   ADD purchases_account VARCHAR(256) NULL;";
// if($wpdb->query($accuracy_of_work_rating))
// {
//   echo "yes";
// }
// else
// {
//   echo "no";
// }

// $select = "select * from $clients";
// $results = $wpdb->get_results($select);

// print_r($results);

//   die();
  $client_id_xero = get_option('client_id_xero');
  $client_secret_xero = get_option('client_secret_xero');
  $refresh_token_hwe = get_option('refresh_token_hwe');

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
        'refresh_token' => "NjY198I9KvKPQM4R11wy_jeuRCqTR2DUupVqNh6xOe4",
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
  $tenanat_id = get_option('tenanat_id_hwe');



  echo "Refresh Token:".$refresh_token_get_new;
  echo "<br>line_brewak";
  echo "client_id_xero:".$client_id_xero;
  echo "<br>line_brewak";
  echo "client_secret_xero:".$client_secret_xero;
  echo "<br>line_brewak";
  echo "access_token_hwe_new:".$access_token_hwe_new;
  echo "<br>line_brewak";
  echo "tenanat_id".$tenanat_id;


//   $alert_table = "ALTER TABLE ".$wpdb->prefix."contract_rates ADD communication_rating INT( 11 ) DEFAULT 0";
//   $wpdb->query($alert_table);

// $accuracy_of_work_rating = "ALTER TABLE ".$wpdb->prefix."contract_rates ADD approve_disapprove_status INT( 11 ) DEFAULT 0";
// $wpdb->query($accuracy_of_work_rating);

//   $timeliness = "ALTER TABLE ".$wpdb->prefix."contract_rates ADD timeliness_rating INT( 11 ) DEFAULT 0";
//   $wpdb->query($timeliness);

//   $cooperation = "ALTER TABLE ".$wpdb->prefix."contract_rates ADD cooperation_rating INT( 11 ) DEFAULT 0";
//   $wpdb->query($cooperation);

//   $quality_of_work = "ALTER TABLE ".$wpdb->prefix."contract_rates ADD quality_of_work_rating INT( 11 ) DEFAULT 0";
//   $wpdb->query($quality_of_work);

die("hfghfgh");

  $select_data = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "contract_rates ", ARRAY_A);

print_r($select_data);

die("hfghfgh");
if (isset($_REQUEST['randow_string_hwe_client_review'])) {
  $review = 2;
  $comment_approved = "2";
  $approve_date = date("Y-m-d");

  $randow_string_contract = $_REQUEST['randow_string_hwe_client_review'];
  $select_data = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "contract_rates where random_mail_token='$randow_string_contract'", ARRAY_A);

  foreach ($select_data as $contract_data) {


    $contractid_ID = $contract_data['ID'];
    $contractor_id = $contract_data['contractor_id'];
    $ta_number = $contract_data['contract_id'];
    $invoice_method = $contract_data['invoice_method'];


    $client_representative_email = $contract_data['client_invoice_representative_email'];

    $select_data8 = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "timesheet_form_table where contarct_id='$contractid_ID'", ARRAY_A);

    foreach ($select_data8 as $time_sheet_data) {

      $number_of_hours = $time_sheet_data['number_of_hours'];

      $total_amount_excluding = $time_sheet_data['total_amount_excluding'];

    }



    $client_id = $contract_data['client_id'];

    $client_table = $wpdb->prefix . "clients";
    $select2 = "select * from $client_table where ID='" . $client_id . "' order by ID desc";
    $results2 = $wpdb->get_results($select2);
    foreach ($results2 as $value2) {
      $client_name = $value2->client_name;
      $client_email = $value2->client_email;
      $account_number = $value2->account_number;
    }

    $ta_id = $_REQUEST['ta_link_id'];

    $ta_contractors2 = $wpdb->prefix . "TA_contractor_link";
    $select3 = "select * from $ta_contractors2 where better_ta_id='" . $contractid_ID . "' && ID='$ta_id' order by ID desc";
    $results3 = $wpdb->get_results($select3);

    $rate_per_hour = '';
    foreach ($results3 as $ta_value) {

      $better_contractor_id = $ta_value->Better_contractor_id;
      $better_ta_id = $ta_value->better_ta_id;
      $xero_contact_id = $ta_value->xero_contact_id;

      $contractors = $wpdb->prefix . "contractors";
      $select1 = "select * from $contractors where ID='" . $better_contractor_id . "' order by ID desc";
      $results1 = $wpdb->get_results($select1);

      $selected_hwe = '';


      foreach ($results1 as $value1) {

        $contractor_email = $value1->emailaddress;
        $phonenumber = $value1->phonenumber;
        $contractor_name = $value1->contractor_name;

        $address_line1 = '';
        $address_line1 = $value1->address_line1;
        $city = '';
        $city = $value1->city;
        $postal_code = '';
        $postal_code = $value1->postal_code;
        $country = '';
        $country = $value1->country;
      }


      if ($invoice_method == 0) {

        $timesheet_tracking_table1 = $wpdb->prefix . "timesheet_tracking";
        $select_timesheet_tracking1 = "select * from $timesheet_tracking_table1 where better_contractor_id!='$better_contractor_id' && better_ta_id='$ta_number' && ts_status!='Approved'";
        $results_timesheet1 = $wpdb->get_results($select_timesheet_tracking1);

      

        if (count($results_timesheet1) > 0) {

          $insert = "UPDATE $timesheet_tracking_table1 set
        ts_status='Approved'
        where better_contractor_id='$better_contractor_id' && better_ta_id='$ta_number'";
          $wpdb->query($insert);

        } else {

          $select = "select * from $timesheet_tracking_table1 where better_contractor_id!='$better_contractor_id' && better_ta_id='$ta_number'";
          $results = $wpdb->get_results($select);



//testmohit
          if (count($results) <= 0) {
            
            $update_approved = "UPDATE " . $wpdb->prefix . "contract_rates SET invoice_method='1',reviews='$review',comments='$comment_approved' where ID='" . $contractid_ID . "'";

            if ($wpdb->query($update_approved)) {

                
        //   print_r($results);

        //   die("4234dfgdf123");

              $select = "select * from  $timesheet_tracking_table1  where better_ta_id='$ta_number' && better_contractor_id='$better_contractor_id'";
              $results = $wpdb->get_results($select);

              $contractors = '';
              foreach ($results as $value) {

                $better_contractor_id = $value->better_contractor_id;

                $select_contractor_name = "select * from $contractors where ID='$better_contractor_id'";
                $results_contractor_name = $wpdb->get_results($select_contractor_name);

                foreach ($results_contractor_name as $value_contractor_name) {
                  $contractor_name = $value_contractor_name->contractor_name;
                  $contractors = $contractors . "," . $contractor_name;
                }



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


        //                 print_r($response_conn_data);

        //   die("4234dfgdf123");

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

                  $curl_contact = curl_init();

                  curl_setopt_array(
                    $curl_contact,
                    array(
                      CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Contacts/' . $xero_contact_id,
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'GET',
                      CURLOPT_HTTPHEADER => array(
                        'xero-tenant-id: ' . $tenanat_id,
                        'Authorization: Bearer ' . $access_token,
                        'Accept: application/json',
                        'Content-Type: application/json',
                        'Cookie: _abck=40B736C24D6E1F8B70F8DFCA4C04D102~-1~YAAQqNxVuAqfqEaCAQAA0wGhcghnDRrySCFAhHYmQ9KTZ8eQkasNegnPWORrHRBYlSFQ/zzMW/JI0FQsjAvnMpLjHO10MesFnHrM8xLGrOSfIko91zzpLHGTN0xDUFPM0rFOqdAz6b10AEdY9gj/hUZfioWVCdcCEBvai2vXeQYGNr/YT/K6fPm7CB52WbO86wR1jWbz3rA0Jp7fc5cfiAA2vLO0XoYJRZztzWIqzkq5w/CQEWwbkA3iFKD1X784wNE5WRcuIucdkGhVR0fXPnxIfsbVsjb3BAU/VUGsF8UAlYL4i1rjk7siFab02n3zsnBHj+YDTDIoqkDTGFbUAoUkLU8/8ygp2RXhX5LSpTBj0e04QCj/CatAjgNFcxJwm1Y1LHg=~-1~-1~-1; ak_bmsc=8A04B65950B43A2C415F68D3B9BA014D~000000000000000000000000000000~YAAQqNxVuAufqEaCAQAA0wGhchCcJqTj63m5JIY9lH/34AsBKp1F5ubbHQb+AMpwIHH+1FxcczOxEc1YrquD519ku/wqaqYWT/7kDHOo3VsIG2AsMYCpsoe1O0Y7UfkM+3As+gD6/Llfr0OrasLrU7X7+qdqX5t5yWJ2vJxXZLrquZjkeCZPeV2SA3OpoUpxe0P/JJ2ktXrElJvWUA8yQlLGuXQO/U3DNcQD9X+rLy6Pfk747mZq5ETUjl9EAT6lO86BX1q7GLRf5aaHiN7zUrV+WI8EFkeuHor/w3Wmww/w4J8APR7F+hNu21lUwxqVDXFg4rNzQbiqqSEuu7Bnpgp/bTCq571ZLoMNwEp+WeVF3G+rF9WPUQkrNyw=; bm_sz=14763D346389C7C1227712739B17F144~YAAQqNxVuAyfqEaCAQAA0wGhchBSZUWylj13X6cfNdY1KjWlQ82P48dr3ySqaE9OWMJLlwvaw4gVgu84B719QX/XcxhV3ZAwJelrtLwgPw2fKl2LMlVTprCYXIikYLpeDTxKoRD2+t+MEaAaVAnm0bj1R4qOoleTwi2jV59uHL/EYaZOKduTs5X9OupppIpF5HYzyFQtvgZNy70O7tw351+l5ckHemKOJ7W/uKTasiIoXslUg4H79Xz7ZMsh7sNp7+4slGY77S4VomHLZi8zryKOQATb/+pEJOhPmmRoWV1T~3552054~4539462'
                      ),
                    )
                  );

                  $response_get_contact = curl_exec($curl_contact);

                  curl_close($curl_contact);

                  $get_contact_data = json_decode($response_get_contact, true);
                }


                if (isset($get_contact_data['Status']) && $get_contact_data['Status'] == 'OK') {

                  $contractor_id5 = $xero_contact_id;

                } else {
                  $curl = curl_init();

                  curl_setopt_array(
                    $curl,
                    array(
                      CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Contacts',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => '{
                        "Name": "' . $contractor_name . '",
                        "EmailAddress": "' . $contractor_email . '",
                        "TaxNumber": "122-030-2428",
                        "Addresses": [
                          {
                            "AddressType": "POBOX",
                            "AddressLine1": "' . $address_line1 . '",
                            "City": "' . $city . '",
                            "PostalCode": "' . $postal_code . '",
                            "Country":"' . $country . '"
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

                  $response = curl_exec($curl);

                  curl_close($curl);



                  $contractor_data_hwe4 = json_decode($response, true);

                  $contractor_id5_hwe = $contractor_data_hwe4['Contacts'];

                  $contractor_id5 = $contractor_id5_hwe[0]['ContactID'];


                  $update_xero_contact_id = "UPDATE " . $wpdb->prefix . "contract_rates SET `xero_contact_id`='$contractor_id5' where ID='" . $contractid_ID . "'";

                  $wpdb->query($update_xero_contact_id);

                }
              }


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
                    "Description": "' . $contractor_name . ' Billed Hours
                    TA Number: ' . $ta_number . '
                    Contract ID: ' . $contractid . '
                    Quantity: ' . $number_of_hours . '
                    ",
                    "PurchaseDescription": "' . $contractor_name . ' Billed Hours
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
                          "Description": "' . $contractor_name . ' Billed Hours
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

                echo $response2 = curl_exec($curl);

                curl_close($curl);

                $invoice_response = json_decode($response2, true);

                if (isset($invoice_response['Status']) && $invoice_response['Status'] == 'OK') {


                  $invoice_id = $invoice_response['Id'];

                  $all_invoice_data = $invoice_response['Invoices'];

                  $all_invoice_data = $all_invoice_data[0];

                  $invoice_number = $all_invoice_data['InvoiceNumber'];

                  curl_close($curl_invoice_update);

                  $template_id = get_option('client_invoice_created_template');

                  $select_template = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id . "'", ARRAY_A);

                  foreach ($select_template as $template_date) {
                    $email_html_data = $template_date['message'];
                    $subject = $template_date['subject'];
                  }



                  $email_html_data = str_replace('[Contractor_Name]', $contractor_name, $email_html_data);
                  $email_html_data = str_replace('[INVOICE_NUMBER]', $invoice_number, $email_html_data);
                  $email_html_data = str_replace('[CLIENT_EMAIL]', $client_email, $email_html_data);
                  $email_html_data = str_replace('[TIMESHEET_LINK]', $csv_url, $email_html_data);



                  echo $to2 = $contractor_email;
                  //$from = "admin@readyforyourreview.com";
                  $from = "tjohannvr@datasymphony.com";
                  //$from = "noreply@taxon.be";
                  $subject = $subject;


                  $headers = "MIME-Version: 1.0" . "\r\n";
                  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                  $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com,' . $client_representative_email;


                  $message = $email_html_data;


                  if (mail($to2, $subject, $message, $headers)) {
                    echo "send";
                    echo "<br>";
                    echo $message;

                  } else {
                    echo "unsend";

                  }

                }

              }


            }
          }

        }

      } else {

       $update_approved = "UPDATE " . $wpdb->prefix . "contract_rates SET invoice_method='1',reviews='$review',comments='$comment_approved' where ID='" . $contractid_ID . "'";

     
 
        if (!$wpdb->query($update_approved)) {

   

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

//           echo "mohits";
// print_r($response_conn_data);
//           die("dfgdfgdf");
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

            $curl_contact = curl_init();

            curl_setopt_array(
              $curl_contact,
              array(
                CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Contacts/' . $xero_contact_id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                  'xero-tenant-id: ' . $tenanat_id,
                  'Authorization: Bearer ' . $access_token,
                  'Accept: application/json',
                  'Content-Type: application/json',
                  'Cookie: _abck=40B736C24D6E1F8B70F8DFCA4C04D102~-1~YAAQqNxVuAqfqEaCAQAA0wGhcghnDRrySCFAhHYmQ9KTZ8eQkasNegnPWORrHRBYlSFQ/zzMW/JI0FQsjAvnMpLjHO10MesFnHrM8xLGrOSfIko91zzpLHGTN0xDUFPM0rFOqdAz6b10AEdY9gj/hUZfioWVCdcCEBvai2vXeQYGNr/YT/K6fPm7CB52WbO86wR1jWbz3rA0Jp7fc5cfiAA2vLO0XoYJRZztzWIqzkq5w/CQEWwbkA3iFKD1X784wNE5WRcuIucdkGhVR0fXPnxIfsbVsjb3BAU/VUGsF8UAlYL4i1rjk7siFab02n3zsnBHj+YDTDIoqkDTGFbUAoUkLU8/8ygp2RXhX5LSpTBj0e04QCj/CatAjgNFcxJwm1Y1LHg=~-1~-1~-1; ak_bmsc=8A04B65950B43A2C415F68D3B9BA014D~000000000000000000000000000000~YAAQqNxVuAufqEaCAQAA0wGhchCcJqTj63m5JIY9lH/34AsBKp1F5ubbHQb+AMpwIHH+1FxcczOxEc1YrquD519ku/wqaqYWT/7kDHOo3VsIG2AsMYCpsoe1O0Y7UfkM+3As+gD6/Llfr0OrasLrU7X7+qdqX5t5yWJ2vJxXZLrquZjkeCZPeV2SA3OpoUpxe0P/JJ2ktXrElJvWUA8yQlLGuXQO/U3DNcQD9X+rLy6Pfk747mZq5ETUjl9EAT6lO86BX1q7GLRf5aaHiN7zUrV+WI8EFkeuHor/w3Wmww/w4J8APR7F+hNu21lUwxqVDXFg4rNzQbiqqSEuu7Bnpgp/bTCq571ZLoMNwEp+WeVF3G+rF9WPUQkrNyw=; bm_sz=14763D346389C7C1227712739B17F144~YAAQqNxVuAyfqEaCAQAA0wGhchBSZUWylj13X6cfNdY1KjWlQ82P48dr3ySqaE9OWMJLlwvaw4gVgu84B719QX/XcxhV3ZAwJelrtLwgPw2fKl2LMlVTprCYXIikYLpeDTxKoRD2+t+MEaAaVAnm0bj1R4qOoleTwi2jV59uHL/EYaZOKduTs5X9OupppIpF5HYzyFQtvgZNy70O7tw351+l5ckHemKOJ7W/uKTasiIoXslUg4H79Xz7ZMsh7sNp7+4slGY77S4VomHLZi8zryKOQATb/+pEJOhPmmRoWV1T~3552054~4539462'
                ),
              )
            );

            $response_get_contact = curl_exec($curl_contact);

            curl_close($curl_contact);

            $get_contact_data = json_decode($response_get_contact, true);
          }


          if (isset($get_contact_data['Status']) && $get_contact_data['Status'] == 'OK') {

            $contractor_id5 = $xero_contact_id;

          } else {
            $curl = curl_init();

            curl_setopt_array(
              $curl,
              array(
                CURLOPT_URL => 'https://api.xero.com/api.xro/2.0/Contacts',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
                    "Name": "' . $contractor_name . '",
                    "EmailAddress": "' . $contractor_email . '",
                    "TaxNumber": "122-030-2428",
                    "Addresses": [
                      {
                        "AddressType": "POBOX",
                        "AddressLine1": "' . $address_line1 . '",
                        "City": "' . $city . '",
                        "PostalCode": "' . $postal_code . '",
                        "Country":"' . $country . '"
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

            $response = curl_exec($curl);

            curl_close($curl);



            $contractor_data_hwe4 = json_decode($response, true);

            $contractor_id5_hwe = $contractor_data_hwe4['Contacts'];

            $contractor_id5 = $contractor_id5_hwe[0]['ContactID'];


            $update_xero_contact_id = "UPDATE " . $wpdb->prefix . "contract_rates SET `xero_contact_id`='$contractor_id5' where ID='" . $contractid_ID . "'";

            $wpdb->query($update_xero_contact_id);

          }

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
                "Description": "' . $contractor_name . ' Billed Hours
                TA Number: ' . $ta_number . '
                Contract ID: ' . $contractid . '
                Quantity: ' . $number_of_hours . '
                ",
                "PurchaseDescription": "' . $contractor_name . ' Billed Hours
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
                      "Description": "' . $contractor_name . ' Billed Hours
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

            echo $response2 = curl_exec($curl);

            curl_close($curl);

            $invoice_response = json_decode($response2, true);

            if (isset($invoice_response['Status']) && $invoice_response['Status'] == 'OK') {


              $invoice_id = $invoice_response['Id'];

              $all_invoice_data = $invoice_response['Invoices'];

              $all_invoice_data = $all_invoice_data[0];

              $invoice_number = $all_invoice_data['InvoiceNumber'];

              curl_close($curl_invoice_update);

              $template_id = get_option('client_invoice_created_template');

              $select_template = $wpdb->get_results("SELECT * from " . $wpdb->prefix . "newsletter_emails where id='" . $template_id . "'", ARRAY_A);

              foreach ($select_template as $template_date) {
                $email_html_data = $template_date['message'];
                $subject = $template_date['subject'];
              }



              $email_html_data = str_replace('[Contractor_Name]', $contractor_name, $email_html_data);
              $email_html_data = str_replace('[INVOICE_NUMBER]', $invoice_number, $email_html_data);
              $email_html_data = str_replace('[CLIENT_EMAIL]', $client_email, $email_html_data);
              $email_html_data = str_replace('[TIMESHEET_LINK]', $csv_url, $email_html_data);



              echo $to2 = $contractor_email;
              //$from = "admin@readyforyourreview.com";
              $from = "tjohannvr@datasymphony.com";
              //$from = "noreply@taxon.be";
              $subject = $subject;


              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              $headers .= 'From: <' . $from . '>' . '\r\n' . 'CC: admin@datasymphony.com,' . $client_representative_email;


              $message = $email_html_data;


              if (mail($to2, $subject, $message, $headers)) {
                echo "send";
                echo "<br>";
                echo $message;

              } else {
                echo "unsend";

              }

            }

          }
        }

      }
    }


  }

//   $timesheet_tracking_table = $wpdb->prefix . "timesheet_tracking";
//   $select_timesheet_tracking = "select * from $timesheet_tracking_table where better_contractor_id='$better_contractor_id' && better_ta_id='$contract_id'";
//   $results_timesheet = $wpdb->get_results($select_timesheet_tracking);



//   if (count($results_timesheet) > 0) {
//     $insert = "UPDATE $timesheet_tracking_table set
//       ts_status='Approved',
//       hours_approved='$number_of_hours',
//       last_update_date='$approve_date',
//       invoice_status='Generated'
//       where better_contractor_id='$better_contractor_id' && better_ta_id='$contract_id'";
//     $wpdb->query($insert);
//   } else {

//     $insert = "insert into $timesheet_tracking_table set
//             ts_status='Approved',
//             last_update_date='$approve_date',
//             invoice_status='Generated',
//             hours_approved='$number_of_hours'";

//     $wpdb->query($insert);



//   }


}

?>