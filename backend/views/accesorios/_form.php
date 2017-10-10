<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Accesorios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accesorios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 5]) ?>

    <?= $form->field($model, 'fechaCompra')->widget(DatePicker::className(),[
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                    'yearRange' => '-115:+0',
                    'changeYear' => true
            ],
    ]); ?>

    <?php // $form->field($model, 'creado')->textInput() ?>

    <?php // $form->field($model, 'actualizado')->textInput() ?>

    <?= $form->field($model, 'proveedores_id')->dropDownList($model->getProveedoresLista(),['prompt' => 'Elija un proveedor']) ?>

    <?= $form->field($model, 'marcas_id')->dropDownList($model->getMarcasLista(), ['prompt' => 'Elija una marca']) ?>

    <?= $form->field($model, 'tipoAccesorio_id')->dropDownList($model->getTipoAccesoriosLista(),['prompt' => 'Elija un tipo'])?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
