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
    </head>
    <body>
        <?php $this->beginBody() ?>

        <!--<div class="wrap">-->            
        <div class="container">
            <div class="row">
                <?php
                NavBar::begin([
                    'brandLabel' => Yii::$app->user->isGuest ? '' : "Exam",
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse navbar-fixed-top',
                    ],
                ]);

                echo Yii::$app->user->isGuest ? "" : Nav::widget([
                            'options' => ['class' => 'navbar-nav navbar-right'],
                            'items' => [
                                [ 'label' => Yii::t('app', 'Users'),
                                    'url' => ['/user'],
                                    'visible' => Yii::$app->user->identity->role === "admin"
                                ],
                                [ 'label' => Yii::t('app', 'Examination'),
                                    'url' => ['/exam'],
                                    'visible' => Yii::$app->user->identity->role === "teacher"
                                ],
                                [ 'label' => Yii::t('app', 'Question'),
                                    'url' => ['/question'],
                                    'visible' => Yii::$app->user->identity->role === "teacher"
                                ],
                                [ 'label' => Yii::t('app', 'Answer'),
                                    'url' => ['/answer'],
                                    'visible' => Yii::$app->user->identity->role === "teacher"
                                ],
                                [ 'label' => Yii::t('app', 'User Score'),
                                    'url' => ['/userScore'],
                                    'visible' => Yii::$app->user->identity->role === "student"
                                ],
                                [ 'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                                    'url' => ['/site/logout'],
                                    'linkOptions' => ['data-method' => 'post']
                                ]
                            ]
                ]);
                NavBar::end();
                ?>
            </div>
            <div class="row" style="margin-top: 80px;">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
            </div>
            <div class="row">
                <?= $content ?>
            </div>
        </div>
        <!--</div>-->

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; Adsavin <?= date('Y') ?></p>                
            </div>
        </footer>

        <?php $this->endBody() ?>
        <script>
            $(document).ready(function (e) {
                $("input[class='form-control']").first().focus();
            });
        </script>
    </body>
</html>
<?php $this->endPage() ?>
