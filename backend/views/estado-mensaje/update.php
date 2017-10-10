<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EstadoMensaje */

$this->title = 'Actualizar Mensaje de Estado: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Estado Mensajes', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizando...';
?>
<div class="estado-mensaje-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
