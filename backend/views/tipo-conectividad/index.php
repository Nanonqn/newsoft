<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\TipoConectividadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo de Conectividad';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-conectividad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo Collapse::widget([
            'items' => [
                    [
                        'label' => 'Buscar Tipo',
                        'content' => $this->render('_search', ['model' => $searchModel]),
                        'contentOptions' => [
                                'style' => 'background-color: #4a4a4a'
                        ]
                    ]
            ]
    ]);?>

    <p>
        <?= Html::a('Crear Tipo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'conectividad',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
