<?php
if(isset($_REQUEST['signup_email']) && $_REQUEST['signup_email']!='') {
	$signup_email=$_REQUEST['signup_email'];
} else {
	die('Error: Required field missing.');
}

require_once 'newsletter-config.php';

if($newsletter_service_provider=='CampaignMonitor') {
	
	require_once 'inc/campaign-monitor/csrest_subscribers.php';
	
	$wrap = new CS_REST_Subscribers($list_id, $api_key);
	$result = $wrap->add(array(
		'EmailAddress' => $signup_email,
		'Resubscribe' => true
	));
	
	if($result->was_successful()) {
		die('Success');
	} else {
		die('Error: Signup failed.');
	}
	
} else if($newsletter_service_provider=='MailChimp') {
	
	require_once 'inc/mail-chimp/MCAPI.class.php';
	
	$api = new MCAPI($api_key);
	
	$retval = $api->listSubscribe( $list_id, $signup_email );
	
	if ($api->errorCode){
		die('Error: Signup failed.');
	} else {
		die('Success');
	}
	
} else {
	die('Error: Invalid Newsletter Service Provider.');
}

?>