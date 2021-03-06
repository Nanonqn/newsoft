<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Impresora */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="impresora-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

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
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
