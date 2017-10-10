<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Impresora */

$this->title = $model->marcas->marca .' '.$model->marcas->modelo;
$this->params['breadcrumbs'][] = ['label' => 'Impresoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="impresora-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->idImpresora], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idImpresora], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idImpresora',
            'descripcion:ntext',
            'fechaCompra',
            'creado',
            'actualizado',
            'marcas.marca',
            'marcas.modelo',
            'proveedores.razonSocial',
            'tipoImpresora.tipoImpresoraNombre',
        ],
    ]) ?>

</div>
