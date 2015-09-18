<?php
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="jumbotron">
            <h1><?= $exam->subject ?></h1>
            <p class="lead"><?= Yii::t("app", "Duration") . ": " . $exam->duration . " " . Yii::t('app', 'Minutes') ?></p>
            <p class="lead"><?= Yii::t("app", "Start From") . ": " . $exam->exam_date ?></p>
        </div>
    </div>
</div>
<?php if ($exam): $i = 0;
    ?>
    <div class="row">
        <?php foreach ($exam->getQuestions()->all() as $question): ?>
            <div class="col-lg-4 col-md-6">
                <p><?= ++$i . ". " . $question->title . " <strong>" . $question->score . " Point(s)</strong>" ?></p>
                <div>
                    <?php foreach ($question->getAnswers()->all() as $answer) : ?>
                        <div class="radio">
                            <label><input type="radio" name="optradio"><?= $answer->title ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>