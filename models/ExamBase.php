<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exam".
 *
 * @property integer $id
 * @property string $subject
 * @property integer $duration
 * @property string $created_time
 * @property integer $completed
 * @property string $exam_date
 * @property integer $user_id
 *
 * @property User $user
 * @property Question[] $questions
 * @property UserScrore[] $userScrores
 */
class ExamBase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'duration', 'created_time', 'completed', 'exam_date', 'user_id'], 'required'],
            [['duration', 'completed', 'user_id'], 'integer'],
            [['created_time', 'exam_date'], 'safe'],
            [['subject'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'subject' => Yii::t('app', 'Subject'),
            'duration' => Yii::t('app', 'Duration'),
            'created_time' => Yii::t('app', 'Created Time'),
            'completed' => Yii::t('app', 'Completed'),
            'exam_date' => Yii::t('app', 'Exam Date'),
            'user_id' => Yii::t('app', 'User ID'),
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
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['exam_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserScrores()
    {
        return $this->hasMany(UserScrore::className(), ['exam_id' => 'id']);
    }
}
