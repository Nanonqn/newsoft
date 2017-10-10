<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\EstadoMensaje */

$this->title = $model->asunto;
$this->params['breadcrumbs'][] = ['label' => 'Estado Mensajes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-mensaje-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Confirma que quiere eliminar este elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'controladorNombre',
            'accionNombre',
            'estadoMensajeNombre',
            'asunto',
            'cuerpo:ntext',
            'estadoMensajeDescripcion',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
