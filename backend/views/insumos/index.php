<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\InsumosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Insumos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="insumos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo Collapse::widget([
            'items' => [
                    [
                        'label' => 'Buscar Insumos',
                        'content' => $this->render('_search', ['model' => $searchModel]),
                        'contentOptions' => [
                                'style' => 'background-color: #4a4a4a',
                        ]
                    ],
            ],

    ]); ?>

    <p>
        <?= Html::a('Crear Insumo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'descripcion:ntext',
            'fechaCompra',
            'actualizado',
            'proveedores.razonSocial',
            'marcas.marca',
            'marcas.modelo',
            'tipoInsumo.tipoInsumoNombre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
