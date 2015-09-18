<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_scrore".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $exam_id
 * @property integer $score
 * @property string $finished_time
 *
 * @property User $user
 * @property Exam $exam
 */
class UserScoreBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_scrore';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'exam_id', 'score', 'finished_time'], 'required'],
            [['user_id', 'exam_id', 'score'], 'integer'],
            [['finished_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'exam_id' => Yii::t('app', 'Exam ID'),
            'score' => Yii::t('app', 'Score'),
            'finished_time' => Yii::t('app', 'Finished Time'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExam()
    {
        return $this->hasOne(Exam::className(), ['id' => 'exam_id']);
    }
}
