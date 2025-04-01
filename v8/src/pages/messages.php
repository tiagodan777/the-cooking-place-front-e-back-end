<?php
require_login($cookie);

$member = $cms->getMember()->get(1);

$data['member'] = $member;

echo $twig->render('messages.html', $data);