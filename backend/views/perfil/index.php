<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\bootstrap\Collapse;
use yii\base\Widget;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\PerfilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Perfiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
    	echo Collapse::widget([
    			'items' => [
    					[
    						'label' => 'Buscar',
    						'content' => $this->render('_search', ['model' => $searchModel]) ,
    						'contentOptions' => [
                                'style' => 'background-color: #4a4a4a',
                            ],
    					],
    			],
    	]);
    ?>

<!--     <p> -->
        <?php  //Html::a('Crear Perfil', ['create'], ['class' => 'btn btn-success']) ?>
<!--     </p> -->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
            ['attribute' => 'perfilIdLink','format' => 'raw'],
            ['attribute' => 'userLink','format' => 'raw'],
            'nombre',
            'apellido',
            'created_at',
            'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
