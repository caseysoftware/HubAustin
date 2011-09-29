<?php

require_once("base.php");

$errmsg = "";
$successmsg = "";
$fullname = "";
$email = "";
$phone = "";
	
if (isset($_POST["signmeup"])) {
	if (isset($_POST["full_name"]) && $_POST["full_name"]) $full_name = substr(htmlspecialchars($_POST["full_name"]),0,20);
	if (isset($_POST["email"]) && $_POST["email"]) $email = substr(htmlspecialchars($_POST["email"]),0,50);
	if (isset($_POST["phone"]) && $_POST["phone"]) $phone = substr(htmlspecialchars($_POST["phone"]),0,20);
		
	if (!$errmsg && (!$full_name || strlen($full_name) < 2)) $errmsg = "Please provide your full name.";
	if (!$errmsg && (!$email || strlen($email) < 7 || strpos($email,"@")===false || strpos($email,".")===false)) $errmsg = "Please provide your email address.";
	
	if (!$errmsg) {
		$to = "hubaustinco+signup@gmail.com";
		$subject = sprintf("Sign up: %s %s",$full_name,$phone);
		$from = $email;
		$mail = mail($to,$subject,".",sprintf("From: %s\nReply-To: %s",$from,$from));
		if (!$mail) $errmsg = "Error signing up. Please check your information and try again.";
	}
	
	if (!$errmsg) {
		$successmsg = "Thank you! You will be contacted shortly with more information about HubAustin Coworking.";
		$full_name = "";
		$email = "";
		$phone = "";
	}
}

?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="South Austin's first general coworking space" />
        <meta name="keywords" content="hubaustin, hub austin, cowork, coworking, south austin, austin, south austin coworking, office, space, austin, texas, south austin, collaboration, hub, hubs, group work" />
        <title>HubAustin Coworking | Sign-up For Updates</title>
        <link rel="stylesheet" type="text/css" href="css/style.css?v=<?=CSS_VERSION?>" />
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
    </head>
<body>

<div id="page">

	<div id="header">
		<a href="/" title="HubAustin Coworking">Home</a>
		<h1>Meet. Work. Enjoy.</h1>
	</div>
	
	<div id="content">
		<h2>Sign up to get more information about HubAustin Coworking</h2>
		
		<p>We will contact you with information about the open-house launch party, happening at 6pm, Thursday Sept 29.</p>
		<p><small>(your information will not be shared with anyone, only used to connect with you about HubAustin)</small></p>
		
		<?php if ($errmsg) { ?>
		<p class="error"><?=$errmsg?></p>
		<?php } else if ($successmsg) { ?>
		<p class="success"><?=$successmsg?></p>
		<?php } ?>
		
		<form method="post" action="signup.php">
		<input name="full_name" maxlength="20" value="<?=$full_name?>" /> Name<span class="required">*</span><br />
		<input name="email" maxlength="50" value="<?=$email?>" /> Email<span class="required">*</span><br />
		<input name="phone" maxlength="20" value="<?=$phone?>" /> Phone<br />
		<br />
		<input type="submit" name="signmeup" value="Sign Me Up!" /><br />
		<small class="required">* required</small>
		</form>
	</div>
	
	<div id="footer">
        &copy;2011 HubAustin Coworking<br />
        <span style="font-size: small; font-style: italic;">HubAustin Coworking is a joint effort of <a href="http://getify.me/">Kyle Simpson</a>, <a href="http://www.linkedin.com/in/toyinakinmusuru">Toyin Akinmusuru</a>, and <a href="http://caseysoftware.com/blog">D. Keith Casey, Jr.</a></span>
    </div>

</div>

</body>
</html>
