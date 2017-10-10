<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\models\PermisosHelpers;
use backend\assets\FontAwesomeAsset;
/**
 * @var \yii\web\View $this
 * @var string $content
 */
AppAsset::register($this);
FontAwesomeAsset::register($this);
?>

<?php $this->beginPage() ?>

    <!DOCTYPE html>

    <html lang="<?= Yii::$app->language ?>">

    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?= Html::csrfMetaTags() ?>

        <title><?= Html::encode($this->title) ?></title>

        <?php $this->head() ?>

    </head>

    <body>
    <?php $this->beginBody() ?>

    <div class="wrap">


        <?php

        if (!Yii::$app->user->isGuest){
            $esAdmin = PermisosHelpers::requerirMinimoRol('Administrador');
                NavBar::begin([
                    'brandLabel' => 'SoftAmen <i class="fa fa-desktop" aria-hidden="true"></i> SuperAdmin',
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse navbar-fixed-top',
                    ],
                ]);
        } else {
            NavBar::begin([
                'brandLabel' => 'SoftAmen <i class="fa fa-desktop" aria-hidden="true"></i>',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
        }

        if (Yii::$app->user->isGuest) {
            $menuItemsLogOut[] = ['label' => 'Login', 'url' => ['site/login']];
        } else {
            $menuItemsLogOut[] = [
                'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => ['/site/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItemsLogOut
        ]);
        if (!Yii::$app->user->isGuest &&  $esAdmin) {
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Sectores', 'items' => [
                        ['label' => 'Sector', 'url' => ['sector/index']],
                        ['label' => 'Puesto', 'url' => ['puesto/index']],
                    ]],
                    ['label' => 'Equipos', 'items' => [
                        ['label' => 'Equipos', 'url' => ['equipos/index']],
                        ['label' => 'Tipo de Equipo', 'url' =>['tipo-equipo/index']],
                        ['label' => 'Monitores', 'url' => ['monitores/index']],
                        ['label' => 'Impresoras', 'url' => ['impresora/index']],
                        ['label' => 'Tipo de Impresoras', 'url' => ['tipo-impresora/index']],
                        ['label' => 'Marcas', 'url' => ['marcas/index']],
                        ['label' => 'Proveedores','url' => ['proveedores/index']],
                    ]],
                    ['label' => 'Accesorios', 'items' => [
                        ['label' => 'Accesorios', 'url' => ['accesorios/index']],
                        ['label' => 'Insumos', 'url' => ['insumos/index']],
                        ['label' => 'Tipo de Insumnos', 'url' => ['tipo-insumo/index']],
                    ]],
                    ['label' => 'Conectividad', 'items' =>[
                        ['label' => 'Conectividad', 'url' => ['conectividad/index']],
                        ['label' => 'Tipo Conectividad', 'url' => ['tipo-conectividad/index']],
                        ['label' => 'IP´s', 'url' => ['tcp-ip/index']],
                    ]],
                    ['label' => 'RBAC', 'items' => [
                        ['label' => 'Usuarios', 'url' => ['user/index']],
                        ['label' => 'Perfiles', 'url' => ['perfil/index']],
                        ['label' => 'Roles', 'url' => ['rol/index']],
                        ['label' => 'Tipos de Usuario', 'url' => ['tipo-usuario/index']],
                        ['label' => 'Estados', 'url' => ['estado/index']],
                    ]],
                    ['label' => 'Soporte', 'items' => [
                        ['label' => 'Solicitudes de Soporte', 'url' => ['content/index']],
                        ['label' => 'Marketing Image', 'url' => ['marketing/index']],
                        ['label' => 'Mensajes de Estado', 'url' => ['estado-mensaje/index']],
                        ['label' => 'FAQ', 'url' => ['faq/index']],
                        ['label' => 'Categorías de FAQ', 'url' => ['faq-category/index']],
                    ]],
                ],
            ]);
        }
        $menuItems = [['label' => 'Inicio', 'url' => ['site/index']],
        ];
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems
        ]);
        NavBar::end();
        ?>


        <div class="container">

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ?
                    $this->params['breadcrumbs'] : [],
            ])?>

            <?= $content ?>

        </div>
    </div>

    <footer class="footer">

        <div class="container">

            <p class="pull-left">&copy; SoftAmen <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>

        </div>

    </footer>

    <?php $this->endBody() ?>

    </body>
    </html>

<?php $this->endPage() ?>