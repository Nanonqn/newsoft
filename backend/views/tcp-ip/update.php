<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TcpIp */

$this->title = 'Actualizar IP: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'TCP/IP', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizando...';
?>
<div class="tcp-ip-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
