<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\FaqSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'faqQuestion') ?>

    <?= $form->field($model, 'faqAnswer') ?>

    <?= $form->field($model, 'faqIsFeatured')->dropDownList($model->getFaqIsFeaturedList(),['prompt'=>'Por favor elija uno']) ?>

    <?= $form->field($model, 'faqCategory_id')->dropDownList($model->getFaqCategoryList(),['prompt'=>'Por favor elija uno']) ?>

    <?= $form->field($model, 'faqWeight') ?>

    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Resetear', ['class' => 'btn btn-info']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
