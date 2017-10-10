<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker

/* @var $this yii\web\View */
/* @var $model backend\models\search\MonitoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="monitores-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'id') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'fechaCompra')->widget(DatePicker::className(),[
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                    'rangeYear' => '-115:+0',
                    'changeYear' => true,
            ]
    ]); ?>

    <?php // $form->field($model, 'creado') ?>

    <?php // $form->field($model, 'actualizado') ?>

    <?php // echo $form->field($model, 'proveedores_id') ?>

    <?php // echo $form->field($model, 'marcas_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetear', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
