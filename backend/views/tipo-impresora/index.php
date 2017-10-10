<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\TipoImpresoraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo Impresoras';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-impresora-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo Collapse::widget([
            'items'  => [
                    [
                        'label' => 'Buscar Tipo de Impresora',
                        'content' => $this->render('_search', ['model' => $searchModel]),
                        'contentOptions' => [
                                'style' => 'background-color: #4a4a4a',
                        ]
                    ]
            ]
    ]); ?>

    <p>
        <?= Html::a('Crear Tipo Impresora', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idTipoImpresora',
            'tipoImpresoraNombre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
