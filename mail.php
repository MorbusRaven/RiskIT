<?php     
$to_email = 'gimly123@hotmail.com';
$subject = 'Testing PHP Mail';
$message = 'This mail is sent using the PHP mail function';
$headers = 'From: gimly123@hotmail.com';
mail($to_email,$subject,$message,$headers);
?>