<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\search\ImpresoraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="impresora-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // $form->field($model, 'idImpresora') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'fechaCompra')->widget(DatePicker::className(),[
        'dateFormat' => 'yyyy-MM-dd',
        'clientOptions' => [
            'yearRange' => '-115:+0',
            'changeYear' => true,
        ]
    ]) ?>

    <?= $form->field($model, 'marcas_id')->dropDownList($model->getMarcasLista(),['prompt' => 'Por favor elija una']) ?>

    <?= $form->field($model, 'proveedores_id')->dropDownList($model->getProveedoresLista(),['prompt' => 'Por favor elija uno']) ?>

    <?= $form->field($model, 'tipoImpresora_id')->dropDownList($model->getTipoImpresoraLista(),['prompt' => 'Por favor elija uno']) ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetear', ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
