<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_has_answer".
 *
 * @property integer $user_id
 * @property integer $answer_id
 * @property integer $exam_id
 *
 * @property Exam $exam
 * @property Answer $answer
 * @property User $user
 */
class UserHasAnswerBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_has_answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'answer_id', 'exam_id'], 'required'],
            [['user_id', 'answer_id', 'exam_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'answer_id' => Yii::t('app', 'Answer ID'),
            'exam_id' => Yii::t('app', 'Exam ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExam()
    {
        return $this->hasOne(Exam::className(), ['id' => 'exam_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswer()
    {
        return $this->hasOne(Answer::className(), ['id' => 'answer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
