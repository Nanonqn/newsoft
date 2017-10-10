<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TipoEquipo */

$this->title = 'Crear Tipo de Equipo';
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Equipo', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-equipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
