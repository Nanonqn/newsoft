<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\TipoInsumoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo de Insumos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-insumo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo Collapse::widget([
            'items' => [
                    [
                        'label' => 'Buscar Tipo de Insumo',
                        'content' => $this->render('_search', ['model' => $searchModel]),
                    ]
            ]
    ])?>

    <p>
        <?= Html::a('Crear Tipo de Insumos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'tipoInsumoNombre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
