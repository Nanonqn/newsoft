<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TipoEquipo */

$this->title = 'Actualizar Tipo: ' . $model->tipoEquipoNombre;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizando...';
?>
<div class="tipo-equipo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
