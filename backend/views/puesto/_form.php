<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Sector;

/* @var $this yii\web\View */
/* @var $model backend\models\Puesto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="puesto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'creado')->textInput() ?>

    <?php // $form->field($model, 'actualizado')->textInput() ?>

    <?= $form->field($model, 'sector_id')->dropDownList($model->getSectorLista(), ['prompt' => 'Porfavor elija uno'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
