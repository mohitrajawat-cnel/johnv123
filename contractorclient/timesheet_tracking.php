<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
  integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<h3>Timesheet Tracking</h3>
<div class="container" style="width:90%">
  <?php


  $arr = array();
  global $wpdb;

  


  ?>
  <!-- Trigger the modal with a button -->

 
  <?php
if (isset($_POST['search'])) {


    $limit = $_POST['limit'];
    $last_update_data_result = $_POST['last_update_data_result'];

    ?>

    <script>
        window.location.href = "<?php echo get_site_url(); ?>/wp-admin/admin.php?page=timesheet_tracking&limit=<?php echo $limit; ?>&last_update_data_result=<?php echo $last_update_data_result; ?>";
    </script>

    <?php

   }

   $select_date=' Order by ID desc';
   $select_limit='';
   $limit='';
   if((isset($_REQUEST['limit'])) && $_REQUEST['limit']!='' ){

     $limit = $_REQUEST['limit'];
     $select_limit = " LIMIT 0,".$limit;

     if($_REQUEST['limit']=="all")
     {
        $select_limit='';
     }


    }

   $last_update_data_result ='';
   if((isset($_REQUEST['last_update_data_result'])) && $_REQUEST['last_update_data_result']!=''){

    $last_update_data_result = $_REQUEST['last_update_data_result'];
     $select_date = " Order by last_update_date desc";

   }


   $timesheet_tracking = $wpdb->prefix . "timesheet_tracking";
   if (isset($_REQUEST['delete']) && $_REQUEST['delete'] == '1')
   {
      $delete_user_id = $_REQUEST['deleteid'];
 
      $delete = "DELETE from $timesheet_tracking where ID='" . $delete_user_id . "'";
      $wpdb->query($delete);
      echo "<font>Data delete successfully.</font>";
      ?>
      <script>
       window.location.href = '<?php echo get_site_url(); ?>/wp-admin/admin.php?page=timesheet_tracking&limit=<?php echo $limit; ?>&last_update_data_result=<?php echo $last_update_data_result; ?>';
     </script>
      <?php
    
   }
?>





<form method="post">

  <div class="row">
    <div class="col-md-5">
    </div> 
    <div class="col-md-7">
        <select name="limit">
          <option value="">Please Select Result Limit</option>
          <option value="all"<?php if ($limit == 'all') echo 'selected'; ?>>All</option>
          <option value="100"<?php if ($limit == '100') echo 'selected'; ?>>100</option>
          <option value="200"<?php if ($limit == '200') echo 'selected'; ?>>200</option>
          <option value="1000"<?php if ($limit == '1000') echo 'selected'; ?>>1000</option>
        </select>


        <select name="last_update_data_result">
          <option value="">Please Select Last Updated Date Result</option>
          <option value="desc"<?php if ($last_update_data_result == 'desc') echo ' selected'; ?>>Last Updated Date</option>
        </select>

        <button type="submit" class="btn btn-primary" name="search" >Search</button>
    </div>
  <div>
<br>

 
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
        <th scope="col">Contract Id</th>
          <th scope="col">TA ID</th>

          <th scope="col">Year Month</th>
          <th scope="col">Ts Status</th>
          <th scope="col">Last Update Date</th>
          <th scope="col">Invoice Status</th>
          <th scope="col">Hours Approved</th>
          <th scope="col">TA Approval Contact Email</th>
          <th scope="col">Contract Status</th>
          <th scope="col">Option</th>
        </tr>
      </thead>
      <tbody>

        <?php
        $timesheet_tracking = $wpdb->prefix . "timesheet_tracking";
        $select = "select * from ".$timesheet_tracking." where 1='1'".$select_date.$select_limit;


        $results = $wpdb->get_results($select);

    

        $i = 1;
        foreach ($results as $value) {

          
          $id = $value->ID; 

          $better_ta_id = $value->better_ta_id;
          $better_contractor_id = $value->better_contractor_id;
          $mail_send_date = $value->mail_send_date;
          $ts_status = $value->ts_status;
          $last_update_date = $value->last_update_date;
          $invoice_status = $value->invoice_status;
          $hours_approved = $value->hours_approved;
          $ta_approval_contact_email = $value->ta_approval_contact_email;

          $invoice_approve_disapprove_status = $value->invoice_approve_disapprove_status;

          if($invoice_approve_disapprove_status == 1)
          {
            $invoice_approve_disapprove_status_value = "Approved";
          }
          elseif($invoice_approve_disapprove_status == 2)
          {
            $invoice_approve_disapprove_status_value = "Disapproved";
          }
          else
          {
            $invoice_approve_disapprove_status_value = "--";
          }


          $contractors = $wpdb->prefix . "contractors where ID='$better_contractor_id'";
          $select1 = "select * from $contractors order by ID desc";
          $results1 = $wpdb->get_results($select1);

          $full_name='';
          if(count($results1) > 0)
          {
      
            foreach ($results1 as $value1) {
            
              $contractor_name = $value1->contractor_name;
              $contractor_surname = $value1->contractor_surname;

              $full_name = $contractor_name.' '.$contractor_surname;

              $contracot_id = $value1->better_contractor_id;

            $authors = $wpdb->get_results("SELECT ID, display_name from $wpdb->users 
            where ID='" . $contracot_id . "' ORDER BY display_name DESC");

                //$selected_hwe='';
                foreach ($authors as $auth) {
                  $user_id = $auth->ID;
                  $display_name = $auth->display_name;
                }


            }
          }
      
         

          ?>
          <tr>
            <td>
              <?php echo $i;
              $i++; ?>
            </td>
            <td>
              <?php echo $display_name; ?>
            </td>
            <td>
              <?php echo $better_ta_id; ?>
            </td>

            <td>
              <?php echo $mail_send_date; ?>
            </td>
            <td>
              <?php echo $ts_status; ?>
            </td>
            <td>
              <?php echo $last_update_date; ?>
            </td>
            <td>
              <?php echo $invoice_status; ?>
            </td>
            <td>
              <?php echo $hours_approved; ?>
            </td>
            <td>
              <?php echo $ta_approval_contact_email; ?>
            </td>
            <td>
                <?php echo $invoice_approve_disapprove_status_value; ?>
            </td>
            <td>
              <a style="margin-left: 2%;" href="admin.php?page=timesheet_tracking&limit=<?php echo $limit; ?>&last_update_data_result=<?php echo $last_update_data_result;?>&delete=1&deleteid=<?php echo $id; ?>"><i
                  class="bi-trash" style="color:red;font-size: 20px;"></i></a>
            </td>
          </tr>

        <?php } ?>
      </tbody>
    </table>
  </form>