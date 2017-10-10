<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Equipos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?php // $form->field($model, 'fechaCompra')->textInput() ?>

    <?php // $form->field($model, 'creado')->textInput() ?>

    <?= $form->field($model, 'actualizado')->textInput() ?>

    <?= $form->field($model, 'proveedores_id')->dropDownList($model->getProveedoresLista(), ['prompt' => 'Porfavor elije uno']) ?>

    <?= $form->field($model, 'marcas_id')->dropDownList($model->getMarcasLista(), ['prompt' => 'Porfavor elije uno']) ?>

    <?= $form->field($model, 'tipoEquipo_id')->dropDownList($model->getTipoEquipoLista(), ['prompt' => 'Porfavor elije uno']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
