<?php
  ob_start();
  session_start();

  if (isset($_GET['cid'])) {
      $cid =  $_GET['cid'];
  }else{
      $cid = 'null';
  }

  if (isset($_GET['ap'])) {
      $ap =  $_GET['ap'];
  }else{
      $ap = 'null';
  }

  if (isset($_GET['ssid'])) {
      $ssid =  $_GET['ssid'];
  }else{
      $ssid = 'null';
  }

  if (isset($_GET['t'])) {
      $t =  $_GET['t'];
  }else{
      $t = 'null';
  }

  if (isset($_GET['rid'])) {
      $rid =  $_GET['rid'];
  }else{
      $rid = 'null';
  }
  if (isset($_GET['site'])) {
      $site =  $_GET['site'];
  }else{
      $site = 'null';
  }

  $time = 60;// One hour; 

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_COOKIEJAR, "/tmp/cookieFileName");
  curl_setopt($ch, CURLOPT_URL, "https://127.0.0.1:8043/login");
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "name=admin&password=password");

  ob_start();      // prevent any output

  $login = curl_exec ($ch); // execute the curl command
  ob_end_clean();

  curl_setopt($ch, CURLOPT_URL,"https://127.0.0.1:8043/extportal/Default/auth");
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'cid='.$cid.'&ap='.$ap.'&ssid='.$ssid.'&t='.$t.'&rid='.$rid.'&site='.$site.'&time='.$time);

  ob_start();
  $portal = curl_exec ($ch);
  ob_end_clean();


  curl_setopt($ch, CURLOPT_URL,"https://127.0.0.1:8043/logout");
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_POST, true);

  ob_start();
  $logout = curl_exec ($ch);
  //echo "string2<br/>";
  //echo $buf.'<br/>';
  curl_close ($ch);
  ob_end_clean();

  header("Location: http://www.ktudu.com", true, 301);
  exit();
?>
