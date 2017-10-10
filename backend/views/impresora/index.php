<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\ImpresoraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Impresoras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="impresora-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo Collapse::widget([
            'items' => [
                    [
                        'label' => 'Buscar Impresora',
                        'content' => $this->render('_search', ['model' => $searchModel]),
                        'contentOptions' => [
                                'style' => 'background-color: #4a4a4a',
                        ]
                    ]
            ]
    ]) ?>

    <p>
        <?= Html::a('Crear Impresora', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idImpresora',
            'descripcion:ntext',
            'fechaCompra',
            //'creado',
            //'actualizado',
            'marcas.marca',
            'marcas.modelo',
            'proveedores.razonSocial',
            'tipoImpresora.tipoImpresoraNombre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
