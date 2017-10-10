<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\MonitoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Monitores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo Collapse::widget([
            'items' => [
                    [
                        'label' => 'Buscar Monitor',
                        'content' => $this->render('_search',['model' => $searchModel]),
                        'contentOptions' => [
                                'style' => 'background-color: #4a4a4a',
                        ],
                    ],
            ],
    ]) ?>

    <p>
        <?= Html::a('Crear Monitores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'descripcion:ntext',
            'fechaCompra',
            //'creado',
            'actualizado',
            'proveedores.razonSocial',
            'marcas.marca',
            'marcas.modelo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
