<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;


$this->title = 'FAQs';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    </BR>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Preguntas
            </h3>
        </div>

        <?php

        foreach ($models as $model){

            $url = Url::to(['faq/view', 'id'=>$model->id]);
            $options = [];
            echo '<div class="panel-body">'. Html::a($model->faqQuestion, $url, $options) .'</div>';

        }

        echo LinkPager::widget([
            'pagination' => $pages,

        ]);

        ?>


    </div>
</div>