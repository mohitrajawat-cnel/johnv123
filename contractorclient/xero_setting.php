<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
  .texthwe {
    width: 70%;
}
  </style>
  <div class="container">
  <h2>Xero Setting</h2>
  <?php 
  if(isset($_POST['save_xero_setting']))
  {
	  $client_id=$_REQUEST['client_id'];
    $client_secret=$_REQUEST['client_secret'];
    $redirect_url=$_REQUEST['redirect_url'];
  
    update_option("client_id_xero",$client_id);
    update_option("client_secret_xero",$client_secret);
    update_option("client_redirecturl_xero",$redirect_url);

	  echo "<font color='green'>Settings saved successfully.</font>";

 
      ?>

<script>
window.location.href='?page=xero_setting&authorization=1';
    </script>
<?php
  }
  ?>
  <form action="" method="post">
    
    <div class="form-group">
      <label for="email">Client Id:</label>
      <input type="text" value="<?php echo get_option('client_id_xero'); ?>" class="form-control texthwe"  placeholder="Enter days" name="client_id" required>
    </div>
    <div class="form-group">
      <label for="email">Client Secret:</label>
      <input type="text" value="<?php echo get_option('client_secret_xero'); ?>" class="form-control texthwe"  placeholder="Enter days" name="client_secret" required>
    </div>
	<div class="form-group">
      <label for="email">Redirect URL:</label>
      <input type="text" value="<?php echo get_option('client_redirecturl_xero'); ?>" class="form-control texthwe"  placeholder="Enter days" name="redirect_url" required>
      Use [XERO_API] as redirect url
    </div>
    

    <button type="submit" name="save_xero_setting" class="btn btn-default" >Submit</button>
  </form>
</div>
