<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<div class="site-about">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <?php
                if ($settings['featuredOnly'] == true){
                    echo 'Featured Questions';
                } else {
                    echo 'FAQs';
                }
                ?>
            </h3>
        </div>
        <?php
        foreach ($models as $model){
            $url = Url::to(['faq/view', 'id'=>$model->id]);
            $options = [];
            echo '<div class="panel-body">'. Html::a($model->faqQuestion, $url, $options) .'</div>';
        }
        echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
    </div>
</div>