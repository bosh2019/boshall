<?php
require_once("vendor/autoload.php");


$config = new \PHRETS\Configuration;
$config->setLoginUrl('https://mlspin-dd.apps.retsiq.com/contact/rets/login')
        ->setUsername('AN2159')
        ->setPassword('vczmxm6')
        ->setRetsVersion('1.8');


// optional.  value shown below are the defaults used when not overridden
//$config->setUserAgent('PHRETS/1.0');
//$config->setUserAgentPassword($rets_user_agent_password); // string password, if given
$config->setHttpAuthenticationMethod('basic'); // or 'basic' if required 
$config->setOption('use_post_method', true); // boolean
$config->setOption('disable_follow_location', true); // boolean

$rets = new \PHRETS\Session($config);

// If you're using Monolog already for logging, you can pass that logging instance to PHRETS for some additional
// insight into what PHRETS is doing.
//
$log = new \Monolog\Logger('PHRETS');
$log->pushHandler(new \Monolog\Handler\StreamHandler('php://stdout', \Monolog\Logger::DEBUG));
$rets->setLogger($log);

$connect = $rets->Login();
if ($connect) {
 //echo "Connected!<br>";
}
else {
 //echo "Not Connected!<br>";
 print_r($rets->Error());
 exit;
}
?>