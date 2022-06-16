<?php

use Phpfastcache\Helper\Psr16Adapter;

require 'vendor/autoload.php';

$instagram = \InstagramScraper\Instagram::withCredentials(new \GuzzleHttp\Client([
    'proxy' => 'Bzd3jj:VbyEFN@196.18.222.242:8000',
]), 'username', 'password', new Psr16Adapter('Files'));
$instagram->login();
sleep(2); // Delay to mimic user

$username = 'extraversum';
$followers = [];
$account = $instagram->getAccount($username);
sleep(1);
$followers = $instagram->getFollowing($account->getId(), 1000, 100, true); // Get 1000 followings of 'kevin', 100 a time with random delay between requests
echo '<pre>' . json_encode($followers, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . '</pre>';
