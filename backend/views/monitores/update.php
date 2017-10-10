<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Monitores */

$this->title = 'Actualizar Monitor: ' . $model->descripcion;
$this->params['breadcrumbs'][] = ['label' => 'Monitores', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizando...';
?>
<div class="monitores-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
