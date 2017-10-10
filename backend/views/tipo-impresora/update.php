<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TipoImpresora */

$this->title = 'Actualizar: ' . $model->tipoImpresoraNombre;
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Impresoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizando...';
?>
<div class="tipo-impresora-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
