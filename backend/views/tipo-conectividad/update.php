<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TipoConectividad */

$this->title = 'Actualizar: ' . $model->conectividad;
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Conectividad', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizando...';
?>
<div class="tipo-conectividad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
