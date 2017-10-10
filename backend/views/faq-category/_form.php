<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\FaqCategory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'faqCategoryName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'faqCategoryWeight')->textInput() ?>

    <?= $form->field($model, 'faqCategoryIsFeatured')->dropDownList($model->faqCategoryIsFeaturedList,['prompt'=>'Por favor elija uno']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
