<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\MarcasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marcas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marcas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        echo Collapse::widget([
           'items' => [
                   [
                       'label' => 'Buscar Marca',
                       'content' => $this->render('_search',['model' => $searchModel]),
                       'contentOptions' => [
                               'style' => 'background-color: #4a4a4a',
                       ]
                   ]
           ]
        ]);
    ?>

    <p>
        <?= Html::a('Crear Marcas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'marca',
            'modelo',
            //'creado',
            'actualizado',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
