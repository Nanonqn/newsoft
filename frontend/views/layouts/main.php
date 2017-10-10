<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\assets\FontAwesomeAsset;
use backend\models\search\CarouselSettingsSearch;

AppAsset::register($this);
FontAwesomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php
        $carouselSettings = CarouselSettingsSearch::getCarouselSettings('Front Page');
        if($carouselSettings['caption_font_size']){
            echo '<style>.carousel-caption{';
            if($carouselSettings['show_caption_background']){
                echo 'background: rgba(0,0,0,0.5);';
            }
            echo 'font-size:' . $carouselSettings['caption_font_size'].';}</style>';
        }
    ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Yii2 Framework <i class="fa fa-plug"></i>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems[] = ['label' => 'Perfil', 'url' => ['/perfil/view']];
    $menuItems = [
        ['label' => 'Inicio', 'url' => ['/site/index']],
        ['label' => 'Acerca de...', 'url' => ['/site/about']],
   		['label' => 'FAQs', 'url' => ['/faq/index']],
        ['label' => 'Contacto', 'url' => ['/site/contact']],

    ];
    if (Yii::$app->user->isGuest) {
    	$menuItems[] = ['label' => 'Registrarse', 'url' => ['/site/signup']];
    	$menuItems[] = ['label' => 'Entrar', 'url' => ['/site/login']];
    } else {
    	$menuItems[] = ['label' => 'Perfil', 'url' => ['/perfil/view']];
    	$menuItems[] = ['label' => 'Salir ('
    			. Yii::$app->user->identity->username . ')',
    			'url' => ['/site/logout'],
    			'linkOptions' => ['data-method' => 'post']];
	}
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
