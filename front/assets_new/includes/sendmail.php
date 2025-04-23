<?php 
//////////////////////////
//Specify default values//
//////////////////////////

//Your E-mail

$your_email = 'example@mail.com';

//Default Subject if 'subject' field does not exist
$default_subject = 'From My Contact Form';

//Message if 'name' field not specified
$name_not_specified = 'Please type a valid name';

//Message if 'message' field not specified
$message_not_specified = 'Please type a vaild message';

//Message if e-mail sent successfully
$email_was_sent = 'Send message complete!';

//Message if e-mail not sent (server not configured)
$server_not_configured = 'Sorry, mail server not configured';


///////////////////////////
//Contact Form Processing//
///////////////////////////
$errors = array();
$response = array('error' => '', 'success' => '');

$params = array();
parse_str($_POST['data'], $params);

header('Content-type: application/json');

if(isset($params['message']) and isset($params['username'])) {

	if(!empty($params['username']))
		$sender_name  = stripslashes(strip_tags(trim($params['username'])));
	
	if(!empty($params['message']))
		$message      = stripslashes(strip_tags(trim($params['message'])));
	
	if(!empty($params['email']))
		$sender_email = stripslashes(strip_tags(trim($params['email'])));
	
	if(!empty($params['subject']))
		$subject      = stripslashes(strip_tags(trim($params['subject'])));


	//Message if no sender name was specified
	if(empty($sender_name)) {
		$errors[] = $name_not_specified;
	}

	//Message if no message was specified
	if(empty($message)) {
		$errors[] = $message_not_specified;
	}

	$from = (!empty($sender_email)) ? 'From: '.$sender_email : '';

	$subject = (!empty($subject)) ? $subject : $default_subject;

	//$message = (!empty($message)) ? wordwrap($message, 70) : '';

	$message = "	Name: $sender_name 

	E-mail: $sender_email 

	Message: $message

	";


	//sending message if no errors
	if(empty($errors)) {
		if (mail($your_email, $subject, $message, $from)) {
            $response['success'] = $email_was_sent;
		} else {
			$errors[] = $server_not_configured;
            $response['error'] = implode('<br>', $errors );
		}
	} else {
        $response['error'] = implode('<br>', $errors );
	}
} else {
	// if "name" or "message" vars not send ('name' attribute of contact form input fields was changed)
    $response['error'] = '"name" and "message" variables were not received by server. Please check "name" attributes for your input fields';
}

echo json_encode( $response );

?>
