<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Sector */

$this->title = 'Actualizar Sector: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Sectores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sector-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
