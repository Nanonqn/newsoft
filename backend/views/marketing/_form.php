<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Marketingimage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marketingimage-form">

    <?php $form = ActiveForm::begin(['options'=>
        ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'marketingImageName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marketingImageCaptionTitle') ?>

    <?= $form->field($model, 'marketingImageCaption') ?>

    <?= $form->field($model, 'marketingImageIsFeatured')->dropDownList($model->getMarketingImageIsFeaturedList(),
        ['prompt' => 'Por favor elija uno']) ?>

    <?= $form->field($model, 'marketingImageIsActive')->dropDownList($model->getMarketingImageIsActiveList(),
        ['prompt' => 'Por favor elija uno']) ?>

    <?= $form->field($model, 'marketingImageWeight')?>

    <?= $form->field($model, 'status_id')->dropDownList($model->getStatusList()); ?>

    <?= $form->field($model, 'file')->fileInput();?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
