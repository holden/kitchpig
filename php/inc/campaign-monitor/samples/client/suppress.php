<?php

require_once '../../csrest_clients.php';

$wrap = new CS_REST_Clients('Your clients ID', 'Your API Key');

$emails = array(
  'example@example.com',
  'another@example.com'
);

$result = $wrap->suppress($emails);

echo "Result of PUT /api/v3/clients/{id}/suppress\n<br />";
if($result->was_successful()) {
    echo "Updated with Code ".$result->http_status_code;
} else {
    echo 'Failed with code '.$result->http_status_code."\n<br /><pre>";
    var_dump($result->response);
    echo '</pre>';
}