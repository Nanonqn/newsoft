<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rol_id')->dropDownList($model->rolLista, ['prompt' => 'Por favor elija uno']) ?>

    <?= $form->field($model, 'estado_id')->dropDownList($model->estadoLista, ['prompt' => 'Por favor elija uno']) ?>

    <?= $form->field($model, 'tipoUsuario_id')->dropDownList($model->tipoUsuarioLista, ['prompt' => 'Por favor elija uno']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
