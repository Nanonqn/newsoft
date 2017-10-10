<?php
use common\models\Marcas;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker

/* @var $this yii\web\View */
/* @var $model common\models\Conectividad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="conectividad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'fechaCompra')->widget(DatePicker::className(),[
            'language' => 'es',
            'dateFormat' => 'yyyy-MM-dd',
            'clientOptions' => [
                    'yearRange' => '-115:-0',
                    'changeYear' => true
            ],
    ]);?>

    <?= $form->field($model, 'proveedores_id')->dropDownList($model->getProveedoresLista(),['prompt' => 'Elija un proveedor']) ?>

    <?= $form->field($model, 'marcas_id')->dropDownList($model->getMarcasLista(),['prompt' => 'Elija una marca'])  ?>

    <?= $form->field($model, 'tipoConectividad_id')->dropDownList($model->getTipoConectividadLista(),['prompt' => 'Elija un tipo']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
