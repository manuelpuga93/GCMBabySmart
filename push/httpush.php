
<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 'http://babysmart.cloudapp.net/api/alertasjs');
$result = curl_exec($ch);
curl_close($ch);

//$obj = json_decode($result);
  

echo $result;
?>
