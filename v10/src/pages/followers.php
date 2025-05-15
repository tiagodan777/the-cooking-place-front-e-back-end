<?php
use TiagoDaniel\Validate\Validate;

$seguem_se = [];

$followers = $cms->getFollow()->getFollowers($id);

foreach ($followers as $follower) {
    $seguem_se[] = $cms->getFollow()->get($session->id, $follower['id']);
}

/*echo "<pre>";

var_dump($seguem_se);

// var_dump($followers);*/

$data['followers'] = $followers;
$data['seguem_se'] = $seguem_se;

echo $twig->render('followers.html', $data);
