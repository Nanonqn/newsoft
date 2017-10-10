<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'faqQuestion')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'faqAnswer')->textArea(['maxlength' => 1055, 'rows' =>10]) ?>

    <?= $form->field($model, 'faqCategory_id')->dropDownList($model->getFaqCategoryList(), [ 'prompt' => 'Por favor elija una' ]);?>

    <?= $form->field($model, 'faqIsFeatured')->dropDownList($model->getFaqIsFeaturedList(), [ 'prompt' => 'Por favor elija uno' ]);?>

    <?= $form->field($model, 'faqWeight')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>