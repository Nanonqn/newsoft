<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;
use yii\base\Widget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\FaqCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias de FAQ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
    	echo Collapse::widget([
    		'items' => [
    			[
	    			'label' => 'Buscar',
	    			'content' => $this->render('_search',['model'=>$searchModel]),
                    'contentOptions' => [
                            'style' => 'background-color: #4a4a4a',
                    ]
    			],
    					
    		], 	
    	]);
    ?>

    <p>
        <?= Html::a('Crear Categorias de FAQ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'faqCategoryName',
            'faqCategoryWeight',
        	['attribute'=>'faqCategoryIsFeatured','format'=>'boolean'],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
