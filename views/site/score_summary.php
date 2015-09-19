<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="jumbotron">
            <h1><?php echo Yii::t('app', 'Examination Result') ?></h1>
            <p class="lead"><?= Yii::t("app", "Score") . ": " . $userScore->score ?></p>
            <p class="lead"><?= Yii::t("app", "Total") . ": " . $totalScore ?></p>
            <p class="lead"><?= Yii::t("app", "Percent") . ": " . $userScore->score * 100 / $totalScore ?></p>
        </div>
    </div>
</div>