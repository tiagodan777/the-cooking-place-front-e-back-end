<?php
return function($cms, $parts, $id) {
    switch ($parts[0]) {
        case 'article':
            $keyword = $cms->getArticle()->get($id)['keywords'];
            break;
        case 'post':
            $keyword = $cms->getPost()->get($id)['descricao'];
            break;
        case 'whats-happening':
            $keyword = $cms->getQuik()->get($id)[0]['keywords'];
            break;
        case 'video':
            $keyword = $cms->getLongVideo()->get($id)[0]['keywords'];
            break;
        default:
            $keyword = "Porque é que te estás a armar em parva?";
    }

    $count = $cms->getContent()->searchCount($keyword);
    if ($count > 0) {
        $conteudos = $cms->getContent()->search($keyword);
    }

    return $conteudos;
};