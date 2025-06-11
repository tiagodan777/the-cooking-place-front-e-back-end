<?php
$data = [];
$emojis = [];
$from = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0;
$tokenLogin = $_GET['loginToken'] ?? '';

if ($session->id != 0 && empty($tokenLogin)) {
    $tokenLogin = $cms->getToken()->create($session->id, 'login');
}

$conteudos = $cms->getContent()->get(from: $from, session: $session->id);
$num_emojis = $cms->getContent()->count();
$emojis_cod = array_map(fn() => mt_rand(1, 98), range(1, $num_emojis));

/*echo "<pre>";
var_dump($conteudos);*/

//$novas_datas = postado_ha_x_horas($receitas);

$count_contents = $cms->getContent()->count();
$total_pages = ceil($count_contents / 10);
$current_page = ceil($from / 10) + 1;

$data['conteudos'] = $conteudos;
$data['emojis_cod'] = $emojis_cod;
$data['count'] = 1;
$data['count_contents'] = $count_contents;
$data['total_pages'] = $total_pages;
$data['current_page'] = $current_page;
$data['tokenLogin'] = $tokenLogin;
//$data['novas_datas'] = $novas_datas;

echo $twig->render('index.html', $data);
?>
