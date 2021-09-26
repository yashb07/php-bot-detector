<?php
  $botCheck = 0;
  echo "Bot Check using PHP: <br>" . "-----------------------------<br>";

  $user_agent = $_SERVER['HTTP_USER_AGENT'];
  function getOS() { 
    global $user_agent;
    $os_platform  = "Unknown OS Platform";
    $os_array     = array(
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
    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;
    return $os_platform;
  }
  $user_os = getOS();
  echo 'Operating System: ' . $user_os . '<br>';
  if ($user_os = "")
    $botCheck = 1;

  // function isDevice() {
  //   return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
  // |fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
  // , $_SERVER["HTTP_USER_AGENT"]);
  // }
  // if(isDevice()){
  //   echo "Device Check: Mobile Browser Detected<br>";
  //   $botCheck = 0;
  // }
  // else {
  //   echo "Device Check: Not using Mobile Browser<br>";
  //   $botCheck = 0;
  // }

  $ipaddress = getenv("REMOTE_ADDR") ;
  echo "Client IP Address: " . $ipaddress . "<br>";

  function ipbetweenrange($needle, $start, $end) {
    if((ip2long($needle) >= ip2long($start)) && (ip2long($needle) <= ip2long($end))) {
      return true;
    }
    return false;
  }
  
  $ipCheckArray = new SplFixedArray(18);
  //Google.com Public IP Addresses ->
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
  //Googlebot IP Addresses ->
  $ipCheckArray[13] = ipbetweenrange($ipaddress, '64.68.90.1', '64.68.90.255');
  $ipCheckArray[14] = ipbetweenrange($ipaddress, '64.233.173.193', '64.233.173.255');
  $ipCheckArray[15] = ipbetweenrange($ipaddress, '66.249.64.1', '66.249.79.255');
  $ipCheckArray[16] = ipbetweenrange($ipaddress, '216.239.33.96', '216.239.59.128');
  //Google.com DNS IP Addresses ->
  $ipCheckArray[17] = ipbetweenrange($ipaddress, '8.8.8.8.8', '8.8.8.4.4');

  for ($i = 0; $i<13; $i++) {
    if ($ipCheckArray[$i] == 1)
      $botCheck = 1;
  }


  // function is_bot($system) {
  //   $bot_list = array(
  //       'Googlebot', 'Baiduspider', 'ia_archiver',
  //       'R6_FeedFetcher', 'NetcraftSurveyAgent',
  //       'Sogou web spider', 'bingbot', 'Yahoo! Slurp',
  //       'facebookexternalhit', 'PrintfulBot', 'msnbot',
  //       'Twitterbot', 'UnwindFetchor', 'urlresolver'
  //   );
  //   foreach($bot_list as $bl) {
  //       if( stripos( $system, $bl ) !== false )
  //           return true;
  //   }
  //   return false;
  // }

  function userAgents($USER_AGENT) {
      $crawlers = array(
      'Google' => 'Google',
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
      // to get crawlers string used in function uncomment it
      // it is better to save it in string than use implode every time
      // global $crawlers
      $crawlers_agents = implode('|',$crawlers);
      if (strpos($crawlers_agents, $USER_AGENT) === false)
        return false;
      else {
        return TRUE;
      }
  }

  // Device Window Detection
  $tablet_browser = 0;
  $mobile_browser = 0;

  if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
      $tablet_browser++;
  }

  if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
      $mobile_browser++;
  }

  if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
      $mobile_browser++;
  }

  $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
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

  if (in_array($mobile_ua,$mobile_agents)) {
      $mobile_browser++;
  }

  if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
      $mobile_browser++;
      //Check for tablets on opera mini alternative headers
      $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
      if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
        $tablet_browser++;
      }
  }

  if ($tablet_browser > 0) {
    echo "Client Device used: Tablet<br>";
    $botCheck = 0;
  }
  else if ($mobile_browser > 0) {
    echo "Client Device used: Mobile<br>";
    $botCheck = 0;
  }
  else {
    echo "Client Device used: Browser<br>";
    $botCheck = 0;
  }

  // Reverse lookup on Domain Name to find number of sites hosted on shared hosting server
  $domain = gethostbyaddr($ipaddress);
  echo "Reverse DNS Lookup: " . $domain . "<br>";

  // Remote DNS Host Lookup
  $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    if($hostname === $_SERVER['REMOTE_ADDR']) {
        echo "The remote host name could not be resolved.<br/>\n";
        $botCheck = 1;
    } else {
        echo "The remote host name is: $hostname<br/>\n";
        $botCheck = 0;
    }

  // Reverse Lookup on IP based on Domain
  $ip_addr = gethostbyname("http://localhost/BotCheckPHP/");
    if($ip_addr === "http://localhost/BotCheckPHP/") {
        echo "Could not resolve the IP address for the host.<br/>\n";
        // $botCheck = 1;
    } else {
        echo "The IP address for the host is: $ip_addr<br/>\n";
        $botCheck = 0;
    }

  if (userAgents($user_agent))
    $botCheck = 1;

  if($botCheck == 1) {
    include 'bot.html';
  }
  else {
    include 'human.html';
  }

?>