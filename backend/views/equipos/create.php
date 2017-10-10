<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Equipos */

$this->title = 'Crear Equipos';
$this->params['breadcrumbs'][] = ['label' => 'Equipos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
