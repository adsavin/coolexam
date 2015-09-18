<?php

namespace app\models;

class User extends UserBase implements \yii\web\IdentityInterface {

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
        return array_merge(parent::rules(), [
            ['role', 'default', 'value' => self::ROLE_STUDENT],
            ['role', 'in', 'range' => [self::ROLE_STUDENT, self::ROLE_TEACHER, self::ROLE_ADMIN]],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
        ]);
    }

    public static function findIdentity($id) {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
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
