<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\search\EquiposSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'fechaCompra')->widget(DatePicker::className(),['clientOptions' => ['dateFormat' => 'yy-mm-dd']]); ?>

    <?php // $form->field($model, 'creado') ?>

    <?php // $form->field($model, 'actualizado') ?>

    <?php // $form->field($model, 'proveedores_id') ?>

    <?= $form->field($model, 'marcas_id')->dropDownList($model->getMarcasLista(),['prompt' => 'Por favor elija una marca']) ?>

    <?= $form->field($model, 'tipoEquipo_id')->dropDownList($model->getTipoEquipoLista(),['prompt' => 'Por favor elija un tipo']) ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetear', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
