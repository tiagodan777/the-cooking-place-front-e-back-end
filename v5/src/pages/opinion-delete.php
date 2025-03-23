<?php
$opiniao_apagar = $cms->getOpinion()->get($id);
$apagado = $cms->getOpinion()->delete($id);
redirect(DOC_ROOT . 'opinions/' . $opiniao_apagar['receita_id']);
