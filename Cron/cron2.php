<?php

include('httpful.phar');

$host = 'localhost';
$db   = 'admin_default';
$user = 'admin_admin';
$pass = '9pGbApfHey';
$charset = 'utf8';

$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION, PDO::ATTR_PERSISTENT);

$service_url = "https://api.elasticemail.com/v2/campaign/list?apikey=c599a973-a4d2-4ce5-9654-8aaa335db46e&offset=20";
$response = \Httpful\Request::get($service_url)->send();

$result = json_decode($response, true);

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