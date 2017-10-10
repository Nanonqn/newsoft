<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Equipos */

$this->title = 'Actualizar Equipo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizando: ';
?>
<div class="equipos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
