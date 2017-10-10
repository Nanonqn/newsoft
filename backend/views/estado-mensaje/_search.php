<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\EstadoMensajeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estado-mensaje-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'controladorNombre') ?>

    <?= $form->field($model, 'accionNombre') ?>

    <?= $form->field($model, 'estadoMensajeNombre') ?>

    <?= $form->field($model, 'asunto') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetear', ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
