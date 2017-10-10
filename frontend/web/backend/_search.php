<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\CarouselSettingsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="carousel-settings-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'carousel_name') ?>

    <?= $form->field($model, 'image_height') ?>

    <?= $form->field($model, 'image_width') ?>

    <?= $form->field($model, 'carousel_autoplay') ?>

    <?php // echo $form->field($model, 'show_indicators') ?>

    <?php // echo $form->field($model, 'show_caption_title') ?>

    <?php // echo $form->field($model, 'show_captions') ?>

    <?php // echo $form->field($model, 'show_caption_background') ?>

    <?php // echo $form->field($model, 'caption_font_size') ?>

    <?php // echo $form->field($model, 'show_controls') ?>

    <?php // echo $form->field($model, 'status_id') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
