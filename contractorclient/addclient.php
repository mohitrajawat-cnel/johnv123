<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<h3>Add Client</h3>
<div class="container" style="width:90%">


    <?php
    global $wpdb;

    $display_fields = "display:none;";
    $contractors = $wpdb->prefix . "clients";
 
    if (isset($_REQUEST['insertuserset'])) {
        $account_number = $_REQUEST['account_number'];
        $emailaddress = $_REQUEST['emailaddress'];
        $client_name = $_REQUEST['client_name'];
        $client_address=$_REQUEST['address_line1'];
        $client_city= $_REQUEST['city'];
        $postal_state= $_REQUEST['state'];
        
        $postal_code= $_REQUEST['postal_code'];
        $client_country= $_REQUEST['country'];

        $client_represantative_name = $_REQUEST['client_represantative_name'];
        $client_mobile_number = $_REQUEST['client_mobile_number'];
        $website_url=$_REQUEST['website_url'];

        $street_address_line1= $_REQUEST['street_address_line1'];
        $street_city= $_REQUEST['street_city'];
        $street_state= $_REQUEST['street_state'];
        $street_postal_code= $_REQUEST['street_postal_code'];
        $street_country= $_REQUEST['street_country'];
        
        $business_registration_number= $_REQUEST['business_registration_number'];
        $vat_id_number= $_REQUEST['vat_id_number'];
        $default_vat_for_sales= $_REQUEST['default_vat_for_sales'];

        $contract_id= $_REQUEST['contract_id'];

        $client_department= $_REQUEST['client_department'];
        $reprentative_email_cc_1= $_REQUEST['reprentative_email_cc_1'];
        $reprentative_email_cc_2= $_REQUEST['reprentative_email_cc_2'];
        $reprentative_email_cc_3= $_REQUEST['reprentative_email_cc_3'];
        

         $current_user_id = get_current_user_id();

         $get_currenttime = current_time( 'timestamp' );
         $get_current_date = date("Y-m-d",$get_currenttime);

        $select_client = "select * from $contractors where account_number='$account_number' && client_email='$client_department'";
        $results_client = $wpdb->get_results($select_client, ARRAY_A);
        if (count($results_client) > 0) {
            echo "<script>";
            echo 'alert("Client Account Already alreay exists");';
            echo "</script>";
        } else {
            $insert = "insert into $contractors set account_number='$account_number',
            client_name='$client_name',
            client_email='$emailaddress',
            client_address='$client_address',
            `state`='$postal_state',
            postal_code='$postal_code',
            client_country='$client_country',
            client_created_by='$current_user_id',
            created='$get_current_date',
            client_represantative_name='$client_represantative_name',
            client_mobile_number='$client_mobile_number',
            website_url='$website_url',
            street_address_line1='$street_address_line1',
            street_city='$street_city',
            street_state='$street_state',
            street_postal_code='$street_postal_code',
            street_country='$street_country',
            business_registration_number='$business_registration_number',
            vat_id_number='$vat_id_number',
            default_vat_for_sales='$default_vat_for_sales',
            client_department='$client_department',
            reprentative_email_cc_1='$reprentative_email_cc_1',
            reprentative_email_cc_2='$reprentative_email_cc_2',
            reprentative_email_cc_3='$reprentative_email_cc_3',
            xero_contractid = '$contract_id'
            ";
            $wpdb->query($insert);
            

            echo "<font>Client created successfully.</font>";
            echo "<script>";
            echo "location.replace('admin.php?page=client_details');";
            echo "</script>";
        }


    }

    $usersavebutton_name = 'insertuserset';
    $account_number = '';
    $emailaddress = '';
    $client_name = '';
    $client_address='';
    $client_country='';
    $postal_code='';
    $client_city='';
    
    if (isset($_REQUEST['edit']) && $_REQUEST['edit'] != '') {
        $edit_user_id = $_REQUEST['edit'];
        $usersavebutton_name = 'updateuserset';


        if (isset($_REQUEST['updateuserset'])) {
            $account_number = $_REQUEST['account_number'];
            $emailaddress = $_REQUEST['emailaddress'];
            $client_name = $_REQUEST['client_name'];
            $client_address= $_REQUEST['address_line1'];
            $client_country= $_REQUEST['country'];
            $postal_code= $_REQUEST['postal_code'];
            $client_city= $_REQUEST['city'];
            $postal_state= $_REQUEST['state'];

            $client_represantative_name = $_REQUEST['client_represantative_name'];
            $client_mobile_number = $_REQUEST['client_mobile_number'];
            $website_url=$_REQUEST['website_url'];
    
            $street_address_line1= $_REQUEST['street_address_line1'];
            $street_city= $_REQUEST['street_city'];
            $street_state= $_REQUEST['street_state'];
            $street_postal_code= $_REQUEST['street_postal_code'];
            $street_country= $_REQUEST['street_country'];
            
            $business_registration_number= $_REQUEST['business_registration_number'];
            $vat_id_number= $_REQUEST['vat_id_number'];
            $default_vat_for_sales= $_REQUEST['default_vat_for_sales'];

            $contract_id= $_REQUEST['contract_id'];

            $client_department= $_REQUEST['client_department'];
            $reprentative_email_cc_1= $_REQUEST['reprentative_email_cc_1'];
            $reprentative_email_cc_2= $_REQUEST['reprentative_email_cc_2'];
            $reprentative_email_cc_3= $_REQUEST['reprentative_email_cc_3'];


            $insert = "UPDATE $contractors set account_number='$account_number',
          client_name='$client_name',
            client_email='$emailaddress',
            client_address='$client_address',
            `state`='$postal_state',
            postal_code='$postal_code',
            client_country='$client_country',
            client_represantative_name='$client_represantative_name',
            client_mobile_number='$client_mobile_number',
            website_url='$website_url',
            street_address_line1='$street_address_line1',
            street_city='$street_city',
            street_state='$street_state',
            street_postal_code='$street_postal_code',
            street_country='$street_country',
            business_registration_number='$business_registration_number',
            vat_id_number='$vat_id_number',
            default_vat_for_sales='$default_vat_for_sales',
            xero_contractid = '$contract_id',
            client_department='$client_department',
            reprentative_email_cc_1='$reprentative_email_cc_1',
            reprentative_email_cc_2='$reprentative_email_cc_2',
            reprentative_email_cc_3='$reprentative_email_cc_3'
            where ID='" . $edit_user_id . "'";
            $wpdb->query($insert);
            echo "<font>Client edit successfully.</font>";
            echo "<script>";
            echo "location.replace('admin.php?page=client_details');";
            echo "</script>";
        }
        $id = $_REQUEST['edit'];
        $contractors = $wpdb->prefix . "clients";
        $select = "select * from $contractors where ID='$id'";
        $results = $wpdb->get_results($select);

    

        $i = 1;
        foreach ($results as $value) {
            $id = $value->ID;
            //    $userid=$value->userid;
            //    $userdata = get_userdata($userid);
            $account_numer = $value->account_number;
            $client_name = $value->client_name;
            $client_email = $value->client_email;
            $address_line1= $value->client_address;
            $city=$value->client_city;
            $postal_code=$value->postal_code;
            $country=$value->client_country;


            $client_represantative_name = $value->client_represantative_name;
            $client_mobile_number= $value->client_mobile_number;
            $website_url=$value->website_url;
            $postal_code=$value->postal_code;
            $street_address_line1=$value->street_address_line1;
            $street_city = $value->street_city;
            $street_state= $value->street_state;
            $street_postal_code=$value->street_postal_code;
            $street_country=$value->street_country;
            $business_registration_number=$value->business_registration_number;
            $vat_id_number=$value->vat_id_number;
            $default_vat_for_sales=$value->default_vat_for_sales;
            $state=$value->state;

            $client_department=$value->client_department;
            $reprentative_email_cc_1=$value->reprentative_email_cc_1;
            $reprentative_email_cc_2=$value->reprentative_email_cc_2;
            $reprentative_email_cc_3=$value->reprentative_email_cc_3;

            $contract_id=$value->xero_contractid;

        }

        $display_fields = "display:block;";
    }



    $arr = array();

    $authors = $wpdb->get_results("SELECT ID, display_name from $wpdb->users 
                                ORDER BY display_name");

    foreach ($authors as $auth) {
        $user_id = $auth->ID;
        $user_name = $auth->display_name;
        $selected_hwe = '';
        if ($userid == $user_id) {
            $selected_hwe = 'selected';
        }
        $options .= '<option value="' . $user_id . '" ' . $selected_hwe . '>' . $user_name . '</option>';
    }
    ?>
    <form method="post">
        <!-- <div class="form-group">
                    <label for="inputState">Select Users</label>
                    <select id="inputState" class="form-control" name="userset" required>
                        <option selected>Select User</option>
                        <?php echo $options; ?>
                    </select>
                </div> -->
        <input type="hidden" id="contract_id" value="<?php echo $contract_id; ?>" name="contract_id"
                class="form-control">
        <h3>Contact Details:</h3>
        <div class="form-group account_number">
            <label for="exampleInputPassword1">Client Account Number</label>
            <input required type="number" id="account_number" value="<?php echo $account_numer; ?>" name="account_number"
                class="form-control" placeholder="Client Account Number">
        </div>
        <div class="form-group client_name" >
            <label for="exampleInputPassword1">Client Name</label>
            <input type="text" value="<?php echo $client_name; ?>" id="client_name" name="client_name" class="form-control"
                placeholder="Client Name">
        </div>
        <div class="form-group emailaddress">
            <label for="exampleInputEmail1">Client Email address</label>
            <input type="email" value="<?php echo $client_email; ?>" id="emailaddress" name="emailaddress" class="form-control"
                 aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group client_represantative_name">
            <label for="exampleInputEmail1">Client Representative Name</label>
            <input type="text" value="<?php echo $client_represantative_name; ?>" id="client_represantative_name" name="client_represantative_name" class="form-control"
                aria-describedby="emailHelp" placeholder="Enter Client Representative Name">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group client_represantative_name">
            <label for="exampleInputEmail1">Client Department</label>
            <input type="text" value="<?php echo $client_department; ?>" id="client_department" name="client_department" class="form-control"
                aria-describedby="emailHelp" placeholder="Enter Client Department">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <h4>Cleint Representative Emails:</h4>
        <div class="form-group client_represantative_name">
            <label for="exampleInputEmail1">CC Email 1</label>
            <input type="text" value="<?php echo $reprentative_email_cc_1; ?>" id="reprentative_email_cc_1" name="reprentative_email_cc_1" class="form-control"
                aria-describedby="emailHelp" placeholder="Cleint Representative CC Email 1">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group client_represantative_name">
            <label for="exampleInputEmail1">CC Email 2</label>
            <input type="text" value="<?php echo $reprentative_email_cc_2; ?>" id="reprentative_email_cc_2" name="reprentative_email_cc_2" class="form-control"
                aria-describedby="emailHelp" placeholder="Cleint Representative CC Email 2">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group client_represantative_name">
            <label for="exampleInputEmail1">CC Email 3</label>
            <input type="text" value="<?php echo $reprentative_email_cc_3; ?>" id="reprentative_email_cc_3" name="reprentative_email_cc_3" class="form-control"
                aria-describedby="emailHelp" placeholder="Cleint Representative CC Email 3">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group client_mobile_number hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputEmail1">Client Mobile Number</label>
            <input type="text" value="<?php echo $client_mobile_number; ?>" id="client_mobile_number" name="client_mobile_number" class="form-control"
                aria-describedby="emailHelp" placeholder="Enter Mobile Number" readOnly>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group website_ur hide_fieldsl hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputEmail1">Website URL</label>
            <input type="text" value="<?php echo $website_url; ?>" id="website_url" name="website_url" class="form-control"
                aria-describedby="emailHelp" placeholder="Enter Website URL" readOnly>
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <!-- <h4>Postal Address:</h4> -->
        <div class="form-group address_line1 hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputPassword1">Postal Address Area</label>
            <input type="text" value="<?php echo $address_line1; ?>" id="address_line1" name="address_line1" class="form-control"
                placeholder="Enter Postal Address Area" readOnly>
        </div>
        <div class="form-group city hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputPassword1">Postal Address City</label>
            <input type="text" value="<?php echo $city; ?>" id="city" name="city" class="form-control"
                placeholder="Enter Postal Address City" readOnly>
        </div>
        <div class="form-group state hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputPassword1">Postal Address State</label>
            <input type="text" value="<?php echo $state; ?>" id="state" name="state" class="form-control"
                placeholder="Enter Postal Address State" readOnly>
        </div>
        <div class="form-group postal_code hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputPassword1">Postal Address Code</label>
            <input type="text" value="<?php echo $postal_code; ?>" id="postal_code" name="postal_code" class="form-control"
                placeholder="Enter Postal Address Code" readOnly>
        </div>
        <div class="form-group country hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputPassword1">Postal Address Country</label>
            <input type="text" value="<?php echo $country; ?>" id="country" name="country" class="form-control"
                placeholder="Enter Postal Address Country Name" readOnly>
        </div>
        <!-- <h4>Street Address:</h4> -->
        <div class="form-group street_address_line1 hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputPassword1">Street Address Area</label>
            <input type="text" value="<?php echo $street_address_line1; ?>" id="street_address_line1" name="street_address_line1" class="form-control"
                placeholder="Enter Street Address Area" readOnly>
        </div>
        <div class="form-group street_city hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputPassword1">Street Address City</label>
            <input type="text" value="<?php echo $street_city; ?>" id="street_city" name="street_city" class="form-control"
                placeholder="Enter Street Address City" readOnly>
        </div>
        <div class="form-group street_state hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputPassword1">Street Address State</label>
            <input type="text" value="<?php echo $street_state; ?>" id="street_state" name="street_state" class="form-control"
                placeholder="Enter Street Address State" readOnly>
        </div>
        <div class="form-group street_postal_code hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputPassword1">Street Address Postal Code</label>
            <input type="text" value="<?php echo $street_postal_code; ?>" id="street_postal_code" name="street_postal_code" class="form-control"
                placeholder="Enter Street Address Postal Code" readOnly>
        </div>
        <div class="form-group street_country hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputPassword1">Street Address Country</label>
            <input type="text" value="<?php echo $street_country; ?>" id="street_country" name="street_country" class="form-control"
                placeholder="Enter Street Address Country" readOnly>
        </div>
        <!-- <h3>Financial Details:</h3> -->
        <div class="form-group business_registration_number hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputPassword1">Business Registration Number</label>
            <input type="number" value="<?php echo $business_registration_number; ?>" id="business_registration_number" name="business_registration_number" class="form-control"
                placeholder="Enter Business Registration Number" readOnly>
        </div>
        <div class="form-group vat_id_number hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputPassword1">VAT ID Number</label>
            <input type="number" value="<?php echo $vat_id_number; ?>" id="vat_id_number" name="vat_id_number" class="form-control"
                placeholder="Enter VAT ID Number" readOnly>
        </div>
        <div class="form-group default_vat_for_sales hide_fields" style="<?php echo $display_fields; ?>">
            <label for="exampleInputPassword1">Default VAT for Sales</label>
            <input type="text" value="<?php echo $default_vat_for_sales; ?>" id="default_vat_for_sales" name="default_vat_for_sales" class="form-control"
                placeholder="Enter Default VAT for Sales" readOnly>
        </div>
        <div class="form-group sales_vat hide_fields" style="display:none;">
            <label for="exampleInputPassword1">Sales VAT</label>
            <input type="text" value="<?php echo $sales_vat; ?>" id="sales_vat" name="sales_vat" class="form-control"
                placeholder="Enter Sales VAT" readOnly>
        </div>
        <div class="form-group purchases_vat hide_fields" style="display:none;">
            <label for="exampleInputPassword1">Purchases VAT</label>
            <input type="text" value="<?php echo $purchases_vat; ?>" id="purchases_vat" name="purchases_vat" class="form-control"
                placeholder="Enter Purchases VAT" readOnly>
        </div>
        <div class="form-group sales_account hide_fields" style="display:none;">
            <label for="exampleInputPassword1">Sales Account</label>
            <input type="text" value="<?php echo $sales_account; ?>" id="sales_account" name="sales_account" class="form-control"
                placeholder="Enter Sales Account" readOnly>
        </div>
        <div class="form-group purchase_unit hide_fields" style="display:none;">
            <label for="exampleInputPassword1">Purchases Account</label>
            <input type="text" value="<?php echo $purchases_account; ?>" id="purchases_account" name="purchases_account" class="form-control"
                placeholder="Enter Purchases Account" readOnly>
        </div>
       


        <button type="submit" style="<?php echo $display_fields; ?>" id="save_client_details" name="<?php echo $usersavebutton_name; ?>" class="btn btn-primary hide_fields">Submit</button>
    </form>
</div>
<script>
jQuery(document).ready(function(){
    jQuery('#account_number').on('focusout', function() {

        var account_number = jQuery(this).val();
        if(account_number != '')
        {
            jQuery.ajax({

                type: "post",
                url: "<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php",
                dataType: "json",
                data: {
                action: "get_client_xero_info",
                "account_number":account_number
                
                
                },
                success: function (result) {

                if(result.client_status == 1)
                {
                    var client_data = result.client_data;

                        var ContactID = client_data.ContactID;
                        var registration_number = client_data.CompanyNumber;
                        var ContactStatus = client_data.ContactStatus;
                        var Name = client_data.Name;
                        var FirstName = client_data.FirstName;
                        var LastName = client_data.LastName;
                        var EmailAddress = client_data.EmailAddress;
                        var TaxNumber = client_data.TaxNumber;

                        var Addresses = client_data.Addresses;

                            var AddressType = Addresses[0].AddressType;
                            if(AddressType == 'POBOX')
                            {
                                var postal_area = Addresses[0].AddressLine1;
                                var postal_city = Addresses[0].City;
                                var postal_state = Addresses[0].Region;
                                var postal_code = Addresses[0].PostalCode;
                                var postal_country = Addresses[0].Country;
                            }
                            var AddressType_street = Addresses[1].AddressType;
                            if(AddressType_street == 'STREET')
                            {
                                var street_area = Addresses[1].AddressLine1;
                                var street_city = Addresses[1].City;
                                var street_state = Addresses[1].Region;
                                var street_code = Addresses[1].PostalCode;
                                var street_country = Addresses[1].Country;
                            }


                        var Phones = client_data.Phones;

                    

                            var PhoneType = Phones[1].PhoneType;
                            if(PhoneType == 'DEFAULT')
                            {
                                var PhoneNumber = Phones[1].PhoneNumber;
                                var PhoneAreaCode = Phones[1].PhoneAreaCode;


                                var mobile_number = "+"+PhoneAreaCode+" "+PhoneNumber;
                            }
                           

                        var website = client_data.Website;
                        var default_vat_for_sale = "122-030-2428";

                        jQuery("#client_name").attr("value",Name);
                        jQuery("#emailaddress").attr("value",EmailAddress);
                        jQuery("#client_represantative_name").attr("value",Name);
                        jQuery("#client_mobile_number").attr("value",mobile_number);
                        jQuery("#website_url").attr("value",website);

                        jQuery("#address_line1").attr("value",postal_area);
                        jQuery("#city").attr("value",postal_city);
                        jQuery("#state").attr("value",street_state);
                        jQuery("#postal_code").attr("value",postal_code);
                        jQuery("#country").attr("value",postal_country);

                        jQuery("#street_address_line1").attr("value",postal_area);
                        jQuery("#street_city").attr("value",postal_city);
                        jQuery("#street_state").attr("value",street_state);
                        jQuery("#street_postal_code").attr("value",postal_code);
                        jQuery("#street_country").attr("value",postal_country);

                        jQuery("#business_registration_number").attr("value",registration_number);
                        jQuery("#vat_id_number").attr("value",TaxNumber);
                        jQuery("#default_vat_for_sales").attr("value",default_vat_for_sale); 

                        jQuery("#contract_id").attr("value",ContactID); 

                        ///display:block

                  
                        jQuery(".website_url").attr("style","display:block;");
                        jQuery(".client_mobile_number").attr("style","display:block;");

                        jQuery(".address_line1").attr("style","display:block;");
                        jQuery(".city").attr("style","display:block;");
                        jQuery(".state").attr("style","display:block;");
                        jQuery(".postal_code").attr("style","display:block;");
                        jQuery(".country").attr("style","display:block;");


                        jQuery(".street_address_line1").attr("style","display:block;");
                        jQuery(".street_city").attr("style","display:block;");
                        jQuery(".street_state").attr("style","display:block;");
                        jQuery(".street_postal_code").attr("style","display:block;");
                        jQuery(".street_country").attr("style","display:block;");

                        

                        jQuery(".business_registration_number").attr("style","display:block;");
                        jQuery(".vat_id_number").attr("style","display:block;");
                        jQuery(".default_vat_for_sales").attr("style","display:block;");

                        jQuery("#save_client_details").attr("style","display:block;");


                        
                        // var ContactID = client_data.ContactID;
                        // var ContactID = client_data.ContactID;
                        // var ContactID = client_data.ContactID;
                }
                else
                {
                    alert("Client Not Exist With Related Account Number.");
                    jQuery(".hide_fields").attr("style","display:none;");
                }
                

                }
            });
        }
        else
        {
            alert("Account Number can not be blank");
        }
        

    });
});
</script>