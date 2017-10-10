<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'FAQs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Preguntas</h3>
        </div>
        <?php
        $data = $provider->getModels();
        $questions = Arrayhelper::map($data, 'faqQuestion', 'id');
        foreach ($questions as $question => $id){
            $url = Url::to(['faq/view', 'id'=>$id]);
            $options = [];
            echo '<div class="panel-body">'.Html::a($question, $url, $options) .'</div>';
        }
        ?>
    </div>
</div>
