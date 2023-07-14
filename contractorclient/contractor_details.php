<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
  integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<h3>Contractor Details</h3>
<div class="container" style="width:90%">

  <?php

  $arr = array();
  global $wpdb;

  //delete contractor
  $contractors = $wpdb->prefix . "contractors";
  if (isset($_REQUEST['delete']) && $_REQUEST['delete'] == '1') {
    $delete_user_id = $_REQUEST['deleteid'];
    // $delete = "DELETE from $contractors where ID='" . $delete_user_id . "'";

    $update_contractor_status = "UPDATE $contractors SET contractor_status='1' where ID='" . $delete_user_id . "'";


    $deleter_wp_user_id = $_REQUEST['userid'];
    // && wp_delete_user($deleter_wp_user_id)
    if($wpdb->query($update_contractor_status))
    {
      echo "<font>Data delete successfully.</font>";
      echo "<script>";
      echo "location.replace('admin.php?page=contractor_details');";
      echo "</script>";
    }
    else
    {
      echo "<font>User Not delete, please try again.</font>";
    }

  }

  $authors = $wpdb->get_results("SELECT ID, display_name from $wpdb->users 
                                ORDER BY display_name");

  foreach ($authors as $auth) {
    $user_id = $auth->ID;
    $user_name = $auth->display_name;
    $options .= '<option value="' . $user_id . '">' . $user_name . '</option>';
  }


  ?>
  <!-- Trigger the modal with a button -->
  <a href="admin.php?page=contractor_details&add=1"><button type="button" class="btn btn-primary" style="float:right;"
      data-toggle="modal">Add Contractor</button></a>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Contractor Details</h4>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="inputState">Select Users</label>
              <select id="inputState" class="form-control">
                <option selected>Select User</option>
                <?php echo $options; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Phone Number</label>
              <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Phone Number">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Contractor ID</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Email Address</th>
      <th scope="col">Created By</th>
      <th scope="col">Created</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>

    <?php
    global $wpdb;
    $contractors = $wpdb->prefix . "contractors where contractor_status='0'";
    $select = "select * from $contractors order by ID desc";
    $results = $wpdb->get_results($select);




    $i = 1;
    foreach ($results as $value) {
      $id = $value->ID;
      $userid = $value->better_contractor_id;
      $userdata = get_userdata($userid);

      $full_name = '';
      if($value->contractor_created_by > 0)
      {
      $created_bt_yser_id = $value->contractor_created_by;
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
        <td>
          <?php echo $i;
          $i++; ?>
        </td>
        <td>
          <?php echo $userdata->display_name; ?>
        </td>
        <td>
          <?php echo $value->phonenumber; ?>
        </td>
        <td>
          <?php echo $value->emailaddress; ?>
        </td>
        <td>
          <?php echo $full_name; ?>
        </td>
        <td>
          <?php echo $value->created_date; ?>
        </td>
        <td>
          <a href="admin.php?page=contractor_details&delete=1&deleteid=<?php echo $id; ?>&userid=<?php echo $userid; ?>"><i class="bi-trash"
              style="color:red;font-size: 20px;"></i></a>
          <a href="admin.php?page=contractor_details&add=1&edit=<?php echo $id; ?>"><i class="fas fa-edit text-primary"
              style="font-size: 20px;"></i></a>
        </td>
      </tr>

    <?php } ?>





  </tbody>
</table>