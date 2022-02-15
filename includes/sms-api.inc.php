<?php
$phonenumber=$_GET["phonenumber"];
function sendRequest($site_name,$send_xml,$header_type) {

      //die('SITENAME:'.$site_name.'SEND XML:'.$send_xml.'HEADER TYPE '.var_export($header_type,true));
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$site_name);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS,$send_xml);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch, CURLOPT_HTTPHEADER,$header_type);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_TIMEOUT, 120);

      $result = curl_exec($ch);

      return $result;

}

$username   = '5374313450';
$password   = '0512eray';
$orgin_name = 'APITEST';

$xml = <<<EOS
       <request>
         <authentication>
           <username>{$username}</username>
           <password>{$password}</password>
         </authentication>

         <order>
             <sender>{$orgin_name}</sender>
             <sendDateTime>01/05/2013 18:00</sendDateTime>
             <message>
                 <text>WRTS SMS DENEMESİ</text>
                 <receipents>
                     <number>{$phonenumber}</number>
                 </receipents>
             </message>
         </order>
       </request>
EOS;


$result = sendRequest('http://api.iletimerkezi.com/v1/send-sms',$xml,array('Content-Type: text/xml'));

if(strpos($result, 'İşlem başarılı') !== false){
    echo '<script>alert("Message sent successfully.")</script>';
    
} 
else
{
  echo '<script>alert("Message could not be sent")</script>';
  
}
 
header("Refresh: 0; url=../ramp_list.php");


?>

