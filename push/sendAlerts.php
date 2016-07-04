
 <?php
  if(isset($_POST['data'])){
  $json = $_POST['data'];
 
   // Set POST variables
         $url = 'https://android.googleapis.com/gcm/send';
   
    $message = array
(
  'message'   => $json['mensaje'],
  'title'   => 'This is a title. title',
  'subtitle'  => 'This is a subtitle. subtitle',
  'tickerText'  => 'Ticker text here...Ticker text here...Ticker text here',
  'vibrate' => 1,
  'sound'   => 1,
  'largeIcon' => 'large_icon',
  'smallIcon' => 'small_icon'
);
         $fields = array(
             'registration_ids' => $json['tokens'],
             'data' => $message,
         );
   
         $headers = array(
             'Authorization: key=AIzaSyDW6WdUQQNwHq543_HZY1-XWoxrP1IIcNU',
             'Content-Type: application/json'
         );
         // Open connection
         $ch = curl_init();
   
         // Set the url, number of POST vars, POST data
         curl_setopt($ch, CURLOPT_URL, $url);
   
         curl_setopt($ch, CURLOPT_POST, true);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   
         // Disabling SSL Certificate support temporarly
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
   
         curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
   
         // Execute post
         $result = curl_exec($ch);
         if ($result === FALSE) {
             die('Curl failed: ' . curl_error($ch));
         }
   
         // Close connection
         curl_close($ch);

         //Uptading database
        $data = array(
          "id"=>$json['alerta']['id'],
          "nombre"=>$json['alerta']['nombre'],
          "enviado"=>"true",
          "descripcion"=>$json['alerta']['descripcion'],
          "fecha"=>$json['alerta']['fecha'],
          "tipo"=>$json['alerta']['tipo'],
          "idDispositivo"=>$json['alerta']['idDispositivo']
        );
        $ch = curl_init("http://babysmart.cloudapp.net/api/alertasjs/".$json['alerta']['id']);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));

        $response = curl_exec($ch);
        if(!$response) {
            return false;
        }
          echo $result;
  }
 ?>