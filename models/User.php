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
 * @property integer $role
 * @property string $password_reset_token
 * @property string $status
 * @property string $auth_key
 * @property string $last_login
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /* เพิ่มเติม const ลงไป */
    const ROLE_STUDENT = 'student';
    const ROLE_TEACHER = 'teacher';
    const ROLE_ADMIN = 'admin';

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
            [['username', 'password_hash', 'firstname', 'tel', 'email', 'role', 'password_reset_token', 'status', 'auth_key', 'last_login'], 'required'],
            [['role'], 'integer'],
            [['status'], 'string'],
            [['last_login'], 'safe'],
            [['username'], 'string', 'max' => 20],
            [['password_hash', 'firstname', 'lastname'], 'string', 'max' => 100],
            [['tel', 'email', 'password_reset_token'], 'string', 'max' => 45],
            [['auth_key'], 'string', 'max' => 200],
            [['username'], 'unique'],
            //identity
            ['role', 'default', 'value' => self::ROLE_STUDENT],
            ['role', 'in', 'range' => [self::ROLE_STUDENT, self::ROLE_TEACHER, self::ROLE_ADMIN]],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
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
            'role' => Yii::t('app', 'Role'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'status' => Yii::t('app', 'Status'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'last_login' => Yii::t('app', 'Last Login'),
        ];
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
//        return static::findOne(['access_token' => $token]);
        return static::findOne(['password_reset_token' => $token]);
    }

    public function getAuthKey() {
        return $this->auth_key;
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey) {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password) {
        return $this->password_hash === $password;
    }

}
