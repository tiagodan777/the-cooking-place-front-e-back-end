<?php
require_once '../src/bootstrap.php';

$member = $cms->getMember()->get(1);

$data['member'] = $member;

echo $twig->render('messages.html', $data);