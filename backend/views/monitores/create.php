<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Monitores */

$this->title = 'Crear Monitores';
$this->params['breadcrumbs'][] = ['label' => 'Monitores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="monitores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
