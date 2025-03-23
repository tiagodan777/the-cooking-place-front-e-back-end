<?php
$comentarios = $cms->getOpinion()->getAll($id);

$data['comentarios'] = $comentarios;

echo $twig->render('opinions.html', $data);
