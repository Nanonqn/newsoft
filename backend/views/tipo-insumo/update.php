<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TipoInsumo */

$this->title = 'Actualizar: ' . $model->tipoInsumoNombre;
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Insumos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizando...';
?>
<div class="tipo-insumo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
