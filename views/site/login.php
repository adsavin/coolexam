<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-8 col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading"><h3><?= Html::encode($this->title) ?></h3></div>
            <div class="panel-body">
                <?php
                $form = ActiveForm::begin([
                            'id' => 'login-form',
                            'options' => ['class' => 'form-horizontal'],
                            'fieldConfig' => [
//                                'template' => "{label}\n<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
                                'template' => "<div class=\"col-lg-12\">{input}</div>\n<div class=\"col-lg-12\">{error}</div>",
//                                'labelOptions' => ['class' => 'col-lg-1 control-label'],
                            ],
                ]);
                ?>

                <?= $form->field($model, 'username')->textInput(['placeholder' => Yii::t("app", "Username")]) ?>
                <?= $form->field($model, 'password')->passwordInput(['placeholder' => Yii::t("app", "Password")]) ?>

                <?=
                $form->field($model, 'rememberMe')->checkbox([
                    'template' => "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                ])
                ?>

                <div class="form-group">
                    <div class="col-lg-offset-1 col-lg-10">
                        <?= Html::submitButton('Login', ['class' => 'btn btn-danger col-lg-12 col-md-12 col-sm-12 col-xs-12', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>