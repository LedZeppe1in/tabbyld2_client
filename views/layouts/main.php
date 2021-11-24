<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\components\widgets\WLang;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="Content-Type" content="text/html">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Подключение скриптов статус-бара (spinner) -->
<?php $this->registerJsFile('/js/spin.min.js', ['position' => yii\web\View::POS_HEAD]) ?>
<?php $this->registerJsFile('/js/spinner-options.js', ['position' => yii\web\View::POS_HEAD]) ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'encodeLabels' => false,
        'items' => [
            Yii::$app->user->isGuest ? '' : [
                'label' => Yii::t('app', 'NAV_LOAD_CSV_TABLE'),
                'url' => ['/site/upload-csv-table']
            ],
            Yii::$app->user->isGuest ? '' : [
                'label' => Yii::t('app', 'NAV_LOAD_JSON_TABLE'),
                'url' => ['/site/upload-json-table']
            ],
        ],
    ]);
    echo "<form class='navbar-form navbar-right'>" . WLang::widget() . "</form>";
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ? (
                ['label' => Yii::t('app', 'NAV_SIGN_IN'), 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    Yii::t('app', 'NAV_SIGN_OUT') . ' (' .
                        Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
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
        <p class="pull-left">
            <?= ' &copy; ' . date('Y') . ' ' .Yii::t('app', 'FOOTER_INSTITUTE') ?>
        </p>
        <p class="pull-right">
            <?= Yii::t('app', 'FOOTER_POWERED_BY') . ' <a href="mailto:DorodnyxNikita@gmail.com">' .
                Yii::$app->params['adminEmail'].'</a>' ?>
        </p>
    </div>
</footer>

<?php $this->endBody() ?>

<div id="overlay"></div><!-- div for js spinner -->
<div id="center"></div><!-- div for js spinner -->

</body>
</html>
<?php $this->endPage() ?>