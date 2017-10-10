<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\MarketingImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marketing Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marketing-image-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php   echo Collapse::widget([

        'encodeLabels'  => false,
        'items' => [
            [
                'label' => "Search<i class='fa fa-caret-square-o-down'></i>",
                'content' => $this->render('_search', ['model' => $searchModel]) ,
                'contentOptions' => [
                        //'class' => 'in',
                        'style' => 'background-color: #4a4a4a'
                ]
            ],

        ]
    ]);
    ?>
    <p>
        <?= Html::a('Crear Marketing Imagen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'marketingImagePath',
            'marketingImageName',
            'marketingImageCaptionTitle',
            'marketingImageCaption',
            ['attribute'=>'marketingImageIsFeatured', 'format'=>'boolean'],
            ['attribute'=>'marketingImageIsActive', 'format'=>'boolean'],

            'statusName',
            'thumb:html',

            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>

</div>