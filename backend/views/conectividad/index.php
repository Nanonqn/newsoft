<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ConectividadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Conectividad';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conectividad-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo Collapse::widget([
            'items' => [
                    [
                        'label' => 'Buscar Conectividad',
                        'content' => $this->render('_search', ['model' => $searchModel]),
                        'contentOptions' => [
                                'style' => 'background-color: #4a4a4a',
                        ]
                    ],
            ],
    ])  ?>

    <p>
        <?= Html::a('Crear Conectividad', ['create'], ['class' => 'btn btn-success']) ?>
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
            'tipoConectividad.conectividad',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
