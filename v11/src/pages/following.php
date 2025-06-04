<?php
use TiagoDaniel\Validate\Validate;

$seguem_se = [];

$followings = $cms->getFollow()->getFollowing($id);

foreach ($followings as $following) {
    $seguem_se[] = $cms->getFollow()->get($session->id, $following['id']);
}

/*echo "<pre>";

var_dump($seguem_se);*/

// var_dump($id);

$data['followings'] = $followings;
$data['seguem_se'] = $seguem_se;

echo $twig->render('following.html', $data);
