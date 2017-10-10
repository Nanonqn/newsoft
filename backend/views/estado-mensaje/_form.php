<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EstadoMensaje */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estado-mensaje-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'controladorNombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'accionNombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estadoMensajeNombre')->textInput(['maxlength' => true]) ?>
    
       <?= $form->field($model, 'estadoMensajeDescripcion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asunto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuerpo')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
