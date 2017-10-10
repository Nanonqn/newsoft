<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TcpIp */

$this->title = 'Crear TCP/IP';
$this->params['breadcrumbs'][] = ['label' => 'TCP/IP', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tcp-ip-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
