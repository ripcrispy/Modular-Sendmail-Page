// Last Updated: 14-10-2014

$input_name 	= htmlspecialchars($_GET['input_1']); 	// name
$input_company 	= htmlspecialchars($_GET['input_2']); 	// company
$input_city 	= htmlspecialchars($_GET['input_3']); 	// city
$input_phone 	= htmlspecialchars($_GET['input_4']); 	// phone
$input_email 	= htmlspecialchars($_GET['input_5']); 	// email
$input_message 	= htmlspecialchars($_GET['input_6']); 	// message

function auditGet($i) {
	if (!isset($i) || empty($i)) {
		$i = "Unknown";
	}
}

auditGet($input_name);
auditGet($input_company);
auditGet($input_city);
auditGet($input_phone);
auditGet($input_email);
auditGet($input_message);

// Configuration
$subject		= "Website Contact Request from: {$input_name} at {$input_company}";
$recipient		= "sales@email.com.au";
$redir_time		= "10";
$footer			= "This Email has been automatically generated. For Support please contact Support.";
$passmsg		= "Thank you! Your Message has been sent successfully. You will be redirected in 10 seconds...";
$failmsg		= "Sorry! Your Message could not be sent. Please <a href='http://website.com.au/contact-page'>click here</a> to go back to the contact form.";
// End Configuration

$headers		= array();
$headers[]		= "MIME-Version: 1.0";
$headers[]		= "Content-type: text/html; charset=iso-8859-1";
$headers[]		= "From: {$input_name} <{$input_email}>";
$headers[]		= "Reply-To: {$recipient_name} <{$recipient}>";
$headers[]		= "Subject: {$subject}";
$headers[]		= "X-Mailer: PHP/".phpversion();

$message		= array();
$message[]		= "<html><body>";
$message[]		= "<h2>Website Contact Request Received:</h2>";
$message[]		= "<table rules='all' style='border-color: #666;' cellpadding='10'>";
$message[]		= "<tr style='background: #eee;'><td><strong>Name:</strong></td><td>{$input_name}</td></tr>";
$message[]		= "<tr><td><strong>Company:</strong></td><td>{$input_company}</td></tr>";
$message[]		= "<tr><td><strong>City:</strong></td><td>{$input_city}</td></tr>";
$message[]		= "<tr><td><strong>Phone:</strong></td><td>{$input_phone}</td></tr>";
$message[]		= "<tr><td><strong>Email:</strong></td><td>{$input_email}</td></tr>";
$message[]		= "<tr><td><strong>Message:</strong></td><td>{$input_message}</td></tr>";
$message[]		= "</table><br /><small>{$footer}</small></body></html>";

$retval			= mail($recipient, $subject, implode("\r\n", $message), implode("\r\n", $headers));

if ( $retval == true ) {
	echo $passmsg;
	header("Refresh: ".$redir_time."; URL=".$redirection);
}
else {
	echo $failmsg;
}

?>
