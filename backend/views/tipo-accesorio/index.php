<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Collapse;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\TipoAccesorioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos de Accesorios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipoaccesorios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo Collapse::widget([
            'items' => [
                    [
                        'label' => 'Buscar tipos',
                        'content' => $this->render('_search', ['model' => $searchModel])
                    ]
            ]
    ]); ?>

    <p>
        <?= Html::a('Crear Tipo Accesorio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'accesorio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
