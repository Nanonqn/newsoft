<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;
use yii\base\Widget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'FAQ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    	echo Collapse::widget([
    		'items' => [
    			[
    				'label'=>'Buscar',
    				'content' => $this->render('_search',['model'=>$searchModel]),
                    'contentOptions' => [
                            'style' => 'background-color: #4a4a4a',
                    ]
    			],
    		],	
    	]);
    ?>

    <p>
        <?= Html::a('Crear FAQ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'faqQuestion',
            'faqAnswer',
            ['attribute'=>'faqCategoryName','format'=>'raw'],
        	'faqWeight',
            ['attribute'=>'faqIsFeaturedName','format'=>'raw'],
            ['attribute'=>'Rating', 'value' => function($model){
                return $model->getFaqRatings($model->id);
            }],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'buttons' =>[
                        'view' => function($url,$model){
                            return Html::a('<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>', $url.'/'.$model->slug);
                        }
                ],
            ],

        ],
    ]); ?>
</div>
