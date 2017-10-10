<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tipoaccesorios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipoaccesorios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'accesorio')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
