<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Twilio SMS By Abdulla Nilam</title>

</head>
<body>
<form method="post" action="<?php echo base_url()?>index.php/Welcome/sendSMS" >
    <input type="number" name="country" placeholder="94">
    <input type="number" name="number" placeholder="123456789">
    <input type="submit" value="Send SMS">
</form>
</body>
</html>

