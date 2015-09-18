<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $firstname
 * @property string $lastname
 * @property string $tel
 * @property string $email
 * @property integer $status
 * @property string $password_reset_token
 * @property string $role
 * @property string $auth_key
 * @property string $last_login
 *
 * @property Exam[] $exams
 * @property UserHasAnswer[] $userHasAnswers
 * @property Answer[] $answers
 * @property UserScrore[] $userScrores
 */
class UserBase extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'password_hash', 'firstname', 'tel', 'email', 'status', 'password_reset_token', 'role', 'auth_key', 'last_login'], 'required'],
            [['status'], 'integer'],
            [['role'], 'string'],
            [['last_login'], 'safe'],
            [['username'], 'string', 'max' => 20],
            [['password_hash', 'firstname', 'lastname'], 'string', 'max' => 100],
            [['tel', 'email', 'password_reset_token'], 'string', 'max' => 45],
            [['auth_key'], 'string', 'max' => 200],
            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'firstname' => Yii::t('app', 'Firstname'),
            'lastname' => Yii::t('app', 'Lastname'),
            'tel' => Yii::t('app', 'Tel'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'role' => Yii::t('app', 'Role'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'last_login' => Yii::t('app', 'Last Login'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExams() {
        return $this->hasMany(Exam::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasAnswers() {
        return $this->hasMany(UserHasAnswer::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers() {
        return $this->hasMany(Answer::className(), ['id' => 'answer_id'])->viaTable('user_has_answer', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserScrores() {
        return $this->hasMany(UserScrore::className(), ['user_id' => 'id']);
    }

}
