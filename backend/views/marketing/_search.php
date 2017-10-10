<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\MarketingimageSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="marketingimage-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'marketingImagePath') ?>

    <?= $form->field($model, 'marketingImageName') ?>

    <?= $form->field($model, 'marketingImageCaptionTitle') ?>

    <?= $form->field($model, 'marketingImageCaption') ?>

    <?= $form->field($model, 'marketingImageIsFeatured')->dropDownList($model->getMarketingImageIsFeaturedList(),
        ['prompt' => 'Por favor elija uno']) ?>

    <?= $form->field($model, 'marketingImageIsActive')->dropDownList($model->getMarketingImageIsActiveList(),
        ['prompt' => 'Por favor elija uno']) ?>

    <?php // echo $form->field($model, 'marketingImageWeight') ?>

    <?= $form->field($model, 'status_id')->dropDownList($model->getStatusList(),
        ['prompt' => 'Por favor elija uno']) ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetear', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
