<?php

/* Install the library via composer or download the .zip file to your project folder. */
/* This line loads the library */
require_once "vendor/autoload.php";

/* Setup your SDK options, most commonly the Kazoo URL. If not provided defaults to localhost */
$options = array('base_url' => 'http://127.0.0.1:8000');

/* Get an authentication token using ONE of the provided methods */
// $authToken = new \Kazoo\AuthToken\None(); /* must have IP auth enabled on Kazoo */
// $authToken = new \Kazoo\AuthToken\ApiKey('XXXXX');
$authToken = new \Kazoo\AuthToken\User('kanderson', 'fakepassword', 'master.kazoo.dev.andersonkarl.net');

$sdk = new \Kazoo\SDK($authToken, $options);


$account = $sdk->Account('05c910d6cfa4e09f39c644e7b0f8447c')->setHydrate(FALSE);
$account->name = 'PHP SDK Test 7';
$account->save();

///echo $account;

