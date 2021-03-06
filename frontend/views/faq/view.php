<?php
use yii\helpers\Html;
use kartik\widgets\Growl;

$this->title = 'FAQ: '. $model->faqQuestion;

$this->params['breadcrumbs'][] = ['label' => 'FAQ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

    </br>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">

                <h1>   <?= $model->faqQuestion;?> </h1>

            </h3>
        </div>

        <?= '<div class="panel-body"><h3>'. $model->faqAnswer .'</h3></div>';?>

    </div>
<?php

if (Yii::$app->getSession()->hasFlash('success')){

    echo Growl::widget([
        'type' => Growl::TYPE_SUCCESS,
        'title' => 'Thank you!',
        'icon' => 'glyphicon glyphicon-ok-sign',
        'body' => Yii::$app->session->getFlash('success'),
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ]
    ]);
}

Yii::$app->getSession()->removeFlash('success');

?>
    <div id="showAverage">
        <strong>  Faq Rating    </strong>
        <?php
        $faqRating->showAverageRating($model->id);

        ?>
        <br>
        <button type="button" id="rateMe" class="btn btn-default">Add Your Rating</button>
    </div>



    <div id="rateIt">
        <?php
        echo $this->render('_rating-form', ['model'=> $model, 'faqRating' => $faqRating]);
        ?>
    </div>
<?Php
$script = <<< JS
$(document).ready(function(){
    $("#rateIt").hide();
    $("#rateMe").click(function(){
        $("#showAverage").hide();
        $("#rateIt").show();
    });
    
});
JS;

$this->registerJs($script);

?>