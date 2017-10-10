<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\AccesoriosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accesorios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accesorios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo Collapse::widget([
            'items' => [
                    [
                        'label' => 'Buscar Accesorios',
                        'content' => $this->render('_search', ['model' => $searchModel]),
                        'contentOptions' => [
                                'style' => 'background-color: #4a4a4a'
                        ],
                    ]
            ]
    ]);  ?>

    <p>
        <?= Html::a('Crear Accesorio', ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'proveedores_id',
            'marcas.marca',
            'marcas.modelo',
            // 'tipoAccesorio_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
