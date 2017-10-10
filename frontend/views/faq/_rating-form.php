<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use kartik\widgets\StarRating;
?>

<div class="faq-rating-form">
    <?php
        $form = ActiveForm::begin([
            'method' => 'post',
            'action' => ['faq-rating/rating'],
        ]);
    ?>
    <?= Html::activeHiddenInput($faqRating,'faq_id',['value' => $model->id]) ?>
    <?= $form->field($faqRating,'faq_rating')->label('Rate This FAQ')->widget(StarRating::className(),[
        'pluginOptions' => [

        ]
    ])?>
</div>

