<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<h3>Clients Detail</h3>
<div class="container" style="width:90%">
  <?php


  
  /*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/

 $arr=array();
 global $wpdb;

 //delete contractor
 $contractors=$wpdb->prefix."clients";
 if(isset($_REQUEST['delete']) && $_REQUEST['delete'] == '1')
 {
  $delete_user_id = $_REQUEST['deleteid'];
  // $update_client_status ="DELETE from $contractors where ID='".$delete_user_id."'";
  $update_client_status ="UPDATE $contractors SET client_status='1' where ID='".$delete_user_id."'";
  
  $wpdb->query($update_client_status);
  echo "<font>Data delete successfully.</font>";
  echo "<script>";
  echo "location.replace('admin.php?page=client_details');";
  echo "</script>";
 }

 $authors = $wpdb->get_results("SELECT ID, display_name from $wpdb->users 
                                ORDER BY display_name");

 foreach($authors as $auth)
 {
  $user_id = $auth->ID;
  $user_name = $auth->display_name;
   $options .= '<option value="'.$user_id.'">'.$user_name.'</option>';
 }


  ?>
  <!-- Trigger the modal with a button -->
  <a href="admin.php?page=client_details&add=1"><button type="button" class="btn btn-primary" style="float:right;" data-toggle="modal" >Add Client</button></a>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Client Details</h4>
        </div>
        <div class="modal-body">
            <form>
                 <!-- <div class="form-group">
                    <label for="inputState">Select Users</label>
                    <select id="inputState" class="form-control">
                        <option selected>Select User</option>
                        <?php //echo $options;  ?>
                    </select>
                </div> -->
                <div class="form-group">
                    <label for="exampleInputEmail1">Client Account Number</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Client Name</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Client Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
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
      <th scope="col">Account Number</th>
      <th scope="col">Client Name</th>
      <th scope="col">Email</th>
      <th scope="col">Created By</th>
      <th scope="col">Created</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
  
  <?php


 	$select="select * from $contractors where client_status='0' order by ID desc";
	$results=$wpdb->get_results($select);


	$i=1;
	foreach($results as $value)
	{
    $id=$value->ID;
       //$userid=$value->userid;
       $full_name = '';
       if($value->client_created_by > 0)
       {
        $created_bt_yser_id = $value->client_created_by;
        $userdata = get_userdata($created_bt_yser_id);
    
        $created_by_display_name  =$userdata->display_name;
        $created_by_display_email  =$userdata->user_email;
    
        $full_name = $created_by_display_name;
        if($created_by_display_email != '')
        {
          $full_name = $created_by_display_name.'('.$created_by_display_email.')';
        }
       }
   
    
  ?>
    <tr> 
	 <td><?php echo $i; $i++;?></td>
      <td><?php echo $value->account_number;?></td>
      <td><?php echo $value->client_name; ?></td>
      <td><?php echo $value->client_email; ?></td>
      <td><?php echo $full_name; ?></td>
      <td><?php echo $value->created; ?></td>
      <td>
      <a href="admin.php?page=client_details&delete=1&deleteid=<?php echo $id; ?>"><i class="bi-trash" style="color:red;font-size: 20px;"></i></a>
      <a href="admin.php?page=client_details&add=1&edit=<?php echo $id; ?>"><i class="fas fa-edit text-primary" style="font-size: 20px;"></i></a>
      </td>
    </tr>
  
    <?php } ?>
  </tbody>
</table>
