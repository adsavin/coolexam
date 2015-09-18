<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UserScore */

$this->title = Yii::t('app', 'Create User Score');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Scores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-score-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
