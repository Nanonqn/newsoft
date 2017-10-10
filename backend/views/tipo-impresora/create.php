<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TipoImpresora */

$this->title = 'Crear Tipo: ';
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Impresora', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-impresora-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
