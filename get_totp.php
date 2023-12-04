<?php

// Use the parameters from the latest version of the TOTP RFC (6238)
$timeStep = 30;
$codeLength = 6;
$secret = 'YEUZGVDLUDRAKXZKGDMLICISRUZMLSWE';

//date_default_timezone_set('Asia/Kolkata');
$now = new DateTime();
$date_created=$now->format('Y-m-d H:i:s');
?>
<script>
    fcookie='totp';
	var x=new Date('<?php echo $date_created;?>');
	var tempo = x.getFullYear() + '-' + x.getMonth() + '-' + x.getDate()+ ' ' + x.getHours() + ':' + x.getMinutes() + ':' + x.getSeconds();
	document.cookie=fcookie+"=" + tempo;
</script>
<?php
sleep(1);
$ttime = '';
if (isset($_COOKIE["totp"]))
	$ttime = $_COOKIE["totp"];

echo $ttime."<br>";
setcookie("totp", "");

$timestamp = floor(strtotime((string) $ttime) / $timeStep);
$hash = hash_hmac('sha1', pack('N*', 0) . pack('N*', $timestamp), $secret);
$code = substr($hash, -$codeLength);

$numericCode = 0;
for ($i = 0; $i < $codeLength; $i++)
{
	$numericCode = $numericCode * 10 + hexdec($code[$i]);
}

echo $numericCode."<br>";
?>