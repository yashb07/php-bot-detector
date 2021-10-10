<?php
  $botCheck = 0;
  $userAgent = strtolower(isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : " ");

    $os_platform  = "Unknown OS Platform";
    $os_array     = array( // Array consisting of the many different Operating Systems.
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );
    foreach ($os_array as $regex => $value) // Matches each value in os_array to user_agent.
        if (preg_match($regex, $userAgent)) // preg_match performs a regular expression match.
            $os_platform = $value;  // Value is set to os_platform.
  if ($os_platform != "Unknown OS Platform")
    $botCheck = 0;
  else
    $botCheck = 1;

//   // 2) Check IP Address ranges for known Google and Googlebot IP's to flag a bot.
  $ipaddress = getenv("REMOTE_ADDR") ;

  function ipbetweenrange($needle, $start, $end) {
    if((ip2long($needle) >= ip2long($start)) && (ip2long($needle) <= ip2long($end)))
      return true;
    return false;
  }
  
  $ipCheckArray = new SplFixedArray(18);
  //Google.com Known Public IP Addresses List ->
  $ipCheckArray[0] = ipbetweenrange($ipaddress, '64.233.160.0', '64.233.191.255');
  $ipCheckArray[1] = ipbetweenrange($ipaddress, '66.102.0.0', '66.102.15.255');
  $ipCheckArray[2] = ipbetweenrange($ipaddress, '66.249.64.0', '66.249.95.255');
  $ipCheckArray[3] = ipbetweenrange($ipaddress, '72.14.192.0', '72.14.255.255');
  $ipCheckArray[4] = ipbetweenrange($ipaddress, '74.125.0.0', '74.125.255.255');
  $ipCheckArray[5] = ipbetweenrange($ipaddress, '209.85.128.0', '209.85.255.255');
  $ipCheckArray[6] = ipbetweenrange($ipaddress, '216.239.32.0', '216.239.63.255');
  $ipCheckArray[7] = ipbetweenrange($ipaddress, '64.18.0.0', '64.18.15.255');
  $ipCheckArray[8] = ipbetweenrange($ipaddress, '108.177.8.0', '108.177.15.255');
  $ipCheckArray[9] = ipbetweenrange($ipaddress, '172.217.0.0', '172.217.31.255');
  $ipCheckArray[10] = ipbetweenrange($ipaddress, '173.194.0.0', '173.194.255.255');
  $ipCheckArray[11] = ipbetweenrange($ipaddress, '207.126.144.0', '207.126.159.255');
  $ipCheckArray[12] = ipbetweenrange($ipaddress, '216.58.192.0', '216.58.223.255');
  //Googlebot Known IP Addresses ->
  $ipCheckArray[13] = ipbetweenrange($ipaddress, '64.68.90.1', '64.68.90.255');
  $ipCheckArray[14] = ipbetweenrange($ipaddress, '64.233.173.193', '64.233.173.255');
  $ipCheckArray[15] = ipbetweenrange($ipaddress, '66.249.64.1', '66.249.79.255');
  $ipCheckArray[16] = ipbetweenrange($ipaddress, '216.239.33.96', '216.239.59.128');
  //Google.com Known DNS IP Addresses ->
  $ipCheckArray[17] = ipbetweenrange($ipaddress, '8.8.8.8.8', '8.8.8.4.4');

  for ($i = 0; $i<13; $i++) {
    if ($ipCheckArray[$i] == 1)
      $botCheck = 1;
  }

//   // 3) The third check will be done using user agents (They retrieve and present web content for end users).
  function userAgents($userAgent) {
      $crawlers = array(
      'Google' => 'Google',
      'Googlebot' => 'Googlebot',
      'MSN' => 'msnbot',
      'Rambler' => 'Rambler',
      'Yahoo' => 'Yahoo',
      'AbachoBOT' => 'AbachoBOT',
      'accoona' => 'Accoona',
      'AcoiRobot' => 'AcoiRobot',
      'ASPSeek' => 'ASPSeek',
      'CrocCrawler' => 'CrocCrawler',
      'Dumbot' => 'Dumbot',
      'FAST-WebCrawler' => 'FAST-WebCrawler',
      'GeonaBot' => 'GeonaBot',
      'Gigabot' => 'Gigabot',
      'Lycos spider' => 'Lycos',
      'MSRBOT' => 'MSRBOT',
      'Altavista robot' => 'Scooter',
      'AltaVista robot' => 'Altavista',
      'ID-Search Bot' => 'IDBot',
      'eStyle Bot' => 'eStyle',
      'Scrubby robot' => 'Scrubby',
      'Facebook' => 'facebookexternalhit',
      );
      $crawlers_agents = implode('|',$crawlers);
      if (strpos($crawlers_agents, $userAgent) === false)
        return false;
      else
        return true;
  }
  if (userAgents($userAgent))
  $botCheck = 1;
  
  //   // 4) Device Canvas Size (Window) Detection
  $tablet_browser = 0;
  $mobile_browser = 0;

  if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($userAgent)))
      $tablet_browser++;
  if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($userAgent)))
      $mobile_browser++;

  $mobile_ua = strtolower(substr($userAgent, 0, 4));
  $mobile_agents = array(
      'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
      'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
      'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
      'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
      'newt','noki','palm','pana','pant','phil','play','port','prox',
      'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
      'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
      'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
      'wapr','webc','winw','winw','xda ','xda-');

  if (in_array($mobile_ua, $mobile_agents)) {
      $mobile_browser++;
  }
  if (strpos(strtolower($userAgent),'opera mini') > 0) {
      $mobile_browser++;
      $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
      if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
        $tablet_browser++;
      }
  }
  if ($tablet_browser == 0 and $mobile_browser == 0) {
    $botCheck = 1;
    if ($os_platform != "Unknown OS Platform")
        $botCheck = 0;
  }
  else if ($tablet_browser != 0 or $mobile_browser != 0) {
    $botCheck = 0;
    if (preg_match('/bot/i', strtolower($userAgent)))
        $botCheck = 1;
  }
    

//   // Final bot check: If any one botCheck flags 1, the bot.html website will be shown. Otherwise, human.html website will be shown.
  if($botCheck == 1) {
    header("HTTP/1.1 301 Moved Permanently");
    header('location: check/bot.php');
    exit;
  }
  else if ($botCheck == 0) {
    header("HTTP/1.1 301 Moved Permanently");
    header('location: check/human.php');
    exit;
  }
?>
