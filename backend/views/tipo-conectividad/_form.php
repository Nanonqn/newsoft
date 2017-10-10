<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TipoConectividad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-conectividad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'conectividad')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
