<?php
  ini_set('display_errors', 'On');
  require __DIR__ . '/vendor/autoload.php';
  require_once('storage.php');

  global $wpdb;

  // Storage Classe uses sessions for storing token > extend to your DB of choice
  $storage = new StorageClass();

  $provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => get_option('client_id_xero'),
    'clientSecret'            => get_option('client_secret_xero'),
    'redirectUri'             => get_option('client_redirecturl_xero'),
    'urlAuthorize'            => 'https://login.xero.com/identity/connect/authorize',
    'urlAccessToken'          => 'https://identity.xero.com/connect/token',
    'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation'
  ]);

  // If we don't have an authorization code then get one
  if (!isset($_GET['code'])) {
    echo "Something went wrong, no authorization code found";
    exit("Something went wrong, no authorization code found");

  // Check given state against previously stored one to mitigate CSRF attack
  } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
    echo "Invalid State";
    unset($_SESSION['oauth2state']);
    exit('Invalid state');
  } else {

    try {
      // Try to get an access token using the authorization code grant.
      $accessToken = $provider->getAccessToken('authorization_code', [
        'code' => $_GET['code']
      ]);

//echo $accessToken->accessToken();

//echo "<hr>";
 //echo $accessToken->getRefreshToken();

 
 $aces_token_hwe = $accessToken->getToken();
 $refresh_token = $accessToken->getRefreshToken();

 $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.xero.com/connections',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$aces_token_hwe
  ),
));

$response = curl_exec($curl);

curl_close($curl);
 $response_data = json_decode($response,true);

$tenanat_id =$response_data[0]['tenantId'];

 if(update_option('tenanat_id_hwe',$tenanat_id))
 {
  //echo "mohirs".$tenanat_id;
 }
 if(update_option('access_token_hwe_hwe',$aces_token_hwe))
 {
  //echo "---------rohits:".$accessToken;
 }
 update_option('refresh_token_hwe',$refresh_token);
 ?>
<script>
window.location.href ='<?php get_site_url(); ?>/wp-admin/admin.php?page=xero_setting';
</script>
 <?php
 die();

      $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken( (string)$accessToken->getToken() );
     /* $identityInstance = new XeroAPI\XeroPHP\Api\IdentityApi(
        new GuzzleHttp\Client(),
        $config
      );*/

     // $result = $identityInstance->getConnections();

      // Save my tokens, expiration tenant_id
      $storage->setToken(
          $accessToken->getToken(),
          $accessToken->getExpires(),
          'x30contractorinvoice',
          $accessToken->getRefreshToken(),
          $accessToken->getValues()["id_token"]
      );

      header('Location: ' . './authorizedResource.php');
      exit();

    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
      echo "Callback failed";
      exit();
    }
  }
?>