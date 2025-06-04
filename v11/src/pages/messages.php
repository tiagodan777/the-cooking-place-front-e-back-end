<?php
require_login($session);

$member = $cms->getMember()->get(1);

$data['member'] = $member;

echo $twig->render('messages.html', $data);