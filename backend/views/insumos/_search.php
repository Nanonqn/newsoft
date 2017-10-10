<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\InsumosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="insumos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'fechaCompra')->widget(\yii\jui\DatePicker::className(),[
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                    'yearRange' => '-155:+0',
                    'changeYear' => true,
            ],
    ])?>

    <?= $form->field($model, 'proveedores_id')->dropDownList($model->getProveedoresLista(),['prompt' => 'Elija un proveedor']) ?>

    <?= $form->field($model, 'marcas_id')->dropDownList($model->getMarcasLista(),['prompt' => 'Elija una marca']) ?>

    <?= $form->field($model, 'tipoInsumo_id')->dropDownList($model->getTipoInsumoLista(),['prompt' => 'Elija un tipo de insumo']) ?>


    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetear', ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
