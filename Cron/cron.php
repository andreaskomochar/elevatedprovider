<?php

include('httpful.phar');

$host = 'localhost';
$db   = 'admin_default';
$user = 'admin_admin';
$pass = '9pGbApfHey';
$charset = 'utf8';

$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT);

$service_url = file_get_contents("https://api.elasticemail.com/v2/campaign/list?apikey=a4266009-1c30-4ac7-b17e-04827319bd0f&offset=20");

//$response = \Httpful\Request::get($service_url)->send();

$result = json_decode($service_url, true);

foreach($result as $ime){
  foreach((array) $ime as $current){
      

    if($current['lastactivity'] == "") {
          continue;
          
          } 
			$ee_channelid = $current['channelid'];
            $ee_name = $current['name'];
            $ee_clicked = $current['clickedcount'];
            $ee_open = $current['openedcount'];
            $ee_recipient = $current['recipientcount'];
            $ee_sent = $current['sentcount'];
            $ee_failed = $current['failedcount'];
            $ee_unsubscribed = $current['unsubscribedcount'];
            $ee_dateadded = $current['dateadded'];
            $ee_lastactive = $current['lastactivity'];

      

			$sql = "INSERT IGNORE INTO ee_campaigns (ee_name,ee_channelid,ee_clicked,ee_open,ee_recipient,ee_sent,ee_failed,ee_unsubscribed, ee_dateadded, ee_lastactive ) 
				VALUES ('$ee_name', '$ee_channelid','$ee_clicked','$ee_open','$ee_recipient','$ee_sent','$ee_failed','$ee_unsubscribed', '$ee_dateadded','$ee_lastactive' )";

			$statement = $conn->prepare($sql);		
			$statement->execute();
			
  
} 
}


$conn = null;
$sql = null;

