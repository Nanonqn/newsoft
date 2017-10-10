<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\AccesoriosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accesorios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php //$form->field($model, 'id') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?php //$form->field($model, 'fechaCompra') ?>

    <?php //$form->field($model, 'creado') ?>

    <?php // $form->field($model, 'actualizado') ?>

    <?= $form->field($model, 'proveedores_id')->dropDownList($model->getProveedoresLista(),['prompt' => 'Elija un proveedor']) ?>

    <?= $form->field($model, 'marcas_id')->dropDownList($model->getMarcasLista(),['prompt' => 'Elija un proveedor']) ?>

    <?= $form->field($model, 'tipoAccesorio_id')->dropDownList($model->getTipoAccesoriosLista(),['prompt' => 'Elija un proveedor']) ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetear', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
