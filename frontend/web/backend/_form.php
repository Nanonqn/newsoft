<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CarouselSettings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carousel-settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'carousel_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'carousel_autoplay')->textInput() ?>

    <?= $form->field($model, 'show_indicators')->textInput() ?>

    <?= $form->field($model, 'show_caption_title')->textInput() ?>

    <?= $form->field($model, 'show_captions')->textInput() ?>

    <?= $form->field($model, 'show_caption_background')->textInput() ?>

    <?= $form->field($model, 'caption_font_size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'show_controls')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
