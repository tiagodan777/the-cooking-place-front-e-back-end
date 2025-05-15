<?php
use TiagoDaniel\Validate\Validate;

$followers = $cms->getFollow()->getFollowers($id);

$data['followers'] = $followers;

echo $twig->render('followers.html', $data);
