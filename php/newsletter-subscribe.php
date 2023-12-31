<?php
/*
Name: 			Newsletter Subscribe
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version:	9.2.0
*/

include('./mailchimp/mailchimp.php'); 

use \DrewM\MailChimp\MailChimp;

// Step 1 - Set the apiKey - How get your Mailchimp API KEY - http://kb.mailchimp.com/article/where-can-i-find-my-api-key
$apiKey 	= '86c22e67e3d99e645093c7520c489eff-us20';

// Step 2 - Set the listId - How to get your Mailchimp LIST ID - http://kb.mailchimp.com/article/how-can-i-find-my-list-id
$listId 	= 'e8794a1b4f';

if (isset($_POST['email'])) {
	$email = $_POST['email'];
} else if (isset($_GET['email'])) {
	$email = $_GET['email'];
} else {
	$email = '';
}

$MailChimp = new MailChimp($apiKey);

$result = $MailChimp->post('lists/' . $listId . '/members', array(
	'email_address' => $email,
	'merge_fields'  => array('FNAME'=>'', 'LNAME'=>''), // Step 3 (Optional) - Vars - More Information - http://kb.mailchimp.com/merge-tags/using/getting-started-with-merge-tags
	'status' 		=> 'subscribed'
));

if ($result['id'] != '') {
	$arrResult = array('response'=>'success');	
} else {
	$arrResult = array('response'=>'error','message'=>$result['detail']);
}

echo json_encode($arrResult);