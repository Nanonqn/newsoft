<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TipoInsumo */

$this->title = 'Crear Tipo de Insumo';
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Insumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-insumo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
