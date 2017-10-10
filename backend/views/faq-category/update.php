<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\FaqCategory */

$this->title = 'Actualizar Categoria: ' . $model->faqCategoryName;
$this->params['breadcrumbs'][] = ['label' => 'Categorias FAQ', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizando';
?>
<div class="faq-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
