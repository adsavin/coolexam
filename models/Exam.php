<?php
namespace app\models;

/**
 * Description of Exam
 *
 * @author Adsavin
 */
class Exam extends ExamBase {
    public function beforeValidate() {
        $this->created_time = date("Y-m-d H:i:s");
        $this->user_id = \Yii::$app->user->identity->id;
        $this->completed = 0;
        
        return parent::beforeValidate();
    }
}
