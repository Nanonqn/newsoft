<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Puesto */

$this->title = 'Actualizar Puesto: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Puestos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizando: '. $model->nombre;
?>
<div class="puesto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
