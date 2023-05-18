<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Role;


function getUrl()
{
	return getAuthGaurd()."/";
}

/* get guard name */
function getAuthGaurd()
{
	foreach(array_keys(config('auth.guards')) as $guard){
		if(auth()->guard($guard)->check()) return $guard;
	}
	return null;
}

/* get role name */
function getRole($role) {
	$role =Role::where('name',$role)->first();
	return $role['id']; 
}

function generateRandomStringToken($type, $length = 4)
{
	if ($type == 'otp') {
		return substr(str_shuffle(str_repeat($x = '0123456789', ceil($length / strlen($x)))), 1, $length);
	} else {
		return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
	}
}
//upload image
function uploadImage($foldername,$image){
	
	$imageName = time() . rand(11111, 99999) . '.' . $image->getClientOriginalExtension();
  $destination = public_path() . '/'.$foldername;

  //check directory avilable
  if (!is_dir($destination)) {
            \File::makeDirectory($destination, $mode = 0777, true, true);
  }
  $fileName = str_replace(" ", "-", $imageName);
  $image->move($destination, $fileName);
  return $fileName;
}

//check token expireornot
 function validToken($token){
	 $updatePassword = \DB::table('password_resets')->where(['token' => $token])->first();
	 return $updatePassword;
}
// zoho access token generation
function zohoAccessTokenCurl(){
	$clientId = "1000.LB78SVJ76RXBD50RK07ECTRGOAUF0F";
	$clientSecret = "f3240bb2f288a9112ebda30f2fc15167d70073b669";
	$refreshToken = "1000.5a5a4024579ca5efd74cbf156959e4a6.5bb5cd145c6c26d45e15ed6eac9428aa";
	$url = "https://accounts.zoho.in/oauth/v2/token";

	$data = array(
	    "grant_type" => "refresh_token",
	    "client_id" => $clientId,
	    "client_secret" => $clientSecret,
	    "refresh_token" => $refreshToken
	);
	$options = array(
	    "http" => array(
	        "header" => "Content-Type: application/x-www-form-urlencoded\r\n",
	        "method" => "POST",
	        "content" => http_build_query($data),
	    ),
	);
	$context = stream_context_create($options);
	$response = file_get_contents($url, false, $context);
	$accessToken = json_decode($response, true)['access_token'];

	if(!empty($accessToken)){
		return $accessToken;
	}
	return null;
}

// save contact to zoho account
function zohoSaveContact($data){
	$listkey = '3z35e04a822903028613ce434fa6aed0b78597aa02ce3e43625c4214e18bb971a8';

	$firstname = @$data['first_name']; //'Anmol';
	$lastname = @$data['last_name']; // kumar
	$email = $data['email'];  //'anmol@ekmatra.store';

	$token = zohoAccessTokenCurl();

	if(!empty($token)){

		if(!empty($data['first_name'])){
			$fullUrl = 'https://campaigns.zoho.in/api/v1.1/json/listsubscribe?resfmt=JSON&listkey='.$listkey.'&contactinfo=%7BFirst%20Name:'.$firstname.',Last%20Name:'.$lastname.',Contact%20Email:'.$email.'%7D';
		}else{
			$fullUrl = 'https://campaigns.zoho.in/api/v1.1/json/listsubscribe?resfmt=JSON&listkey='.$listkey.'&contactinfo=%7BContact%20Email:'.$email.'%7D';
		}

		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => $fullUrl,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
		CURLOPT_HTTPHEADER => array(
		'Authorization: Bearer '.$token
		),
		));

		$response = curl_exec($curl);
		curl_close($curl);

        // \Log::info('=================zoho Helper function ==============');		
        // \Log::info($response);
		return $response;
	}
}






