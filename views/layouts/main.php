<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/favicon.ico?v=1" type="image/x-icon" />
</head>
<body>
<?php $this->beginBody() ?>
<?php
// set label "Foto Upload" to active in menu when controller passes "activeLabel2" parameter
if (!isset($this->params['activeLabel2'])) {
    $activeLabel2 = 0;
} else {
     $activeLabel2 = $this->params['activeLabel2'];
}

?>
<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Kim Nosko Fanclub',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/login/index'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Foto Upload', 'url' => ['/ImageManager'], 'visible' => !Yii::$app->user->isGuest, 'active'=>$activeLabel2],
            Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/login/index']]
            ) : (
                '<li>'
                . Html::beginForm(['/login/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
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
