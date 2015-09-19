<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Answer;

$this->title = Yii::t('app', 'Examination');
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
        <?php $form = ActiveForm::begin(); ?>

        <?php
        foreach ($exam->getQuestions()->all() as $question):
            ?>
            <div class="col-lg-4 col-md-6">
                <p><?= ++$i . ". " . $question->title . " <strong style='color: red'>" . $question->score . " Point(s)</strong>" ?></p>
                <div>
                    <?php
                    echo Html::radioList("Answers[$question->id]", null, ArrayHelper::map($question->getAnswers()->all(), "id", "title"), ['separator' => "<br/>",
                        'encode' => false
                    ]);
                    ?>
                </div>
            </div>
        <?php endforeach; ?>                
    </div>
    <hr/>
    <div class="form-group ">
        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-success btn-lg center-block']) ?>        
    </div>
    <?php ActiveForm::end(); ?>
<?php endif; ?>

<?php
$this->registerJs("
                setTimeout(function () {
                alert('Time is up');
                $('#btnlogout').click();
        }, 5000);
                ")
?>