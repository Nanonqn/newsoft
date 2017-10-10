<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\bootstrap\Collapse;
use yii\base\Widget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
    	echo Collapse::widget([
    		'items' => [
    				[
    					'label' => 'Buscar',
    					'content' => $this->render('_search',['model' => $searchModel]),
                        'contentOptions' => [
                                'style' => 'background-color: #4a4a4a',
                        ]
    				],
    		],	
    	]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            ['attribute' => 'userIdLink','format' => 'raw'],
        	['attribute' => 'userLink','format' => 'raw'],
        	['attribute' => 'perfilLink','format' => 'raw'],
        	'email:email',
            'rolNombre',
            'tipoUsuarioNombre',
            'estadoNombre',
             'created_at',
             'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
