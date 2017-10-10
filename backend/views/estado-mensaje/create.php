<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\EstadoMensaje */

$this->title = 'Crear Mensaje de Estado';
$this->params['breadcrumbs'][] = ['label' => 'Mensaje de Estado', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estado-mensaje-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
