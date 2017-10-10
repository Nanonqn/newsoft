<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\PuestoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="puesto-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?php // $form->field($model, 'creado') ?>

    <?php // $form->field($model, 'actualizado') ?>

    <?= $form->field($model, 'sector_id')->dropDownList($model->getSectorLista(), ['prompt' => 'Porfavor elija uno']) ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetear', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
