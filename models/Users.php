<?php
//
//namespace app\models;
//
////class User extends \yii\base\Object implements \yii\web\IdentityInterface {
//class Users extends \yii\db\BaseActiveRecord implements \yii\web\IdentityInterface {
//
//    const STATUS_DELETED = 0;
//    const STATUS_ACTIVE = 10;
//
//    /* เพิ่มเติม const ลงไป */
//    const ROLE_STUDENT = 'student';
//    const ROLE_TEACHER = 'teacher';
//    const ROLE_ADMIN = 'admin';
//
//    public $id;
//    public $username;
//    public $password;
//    public $authKey;
//    public $accessToken;
//
//    public function rules() {
//        return [
//            ['role', 'default', 'value' => self::ROLE_STUDENT],
//            ['role', 'in', 'range' => [self::ROLE_STUDENT, self::ROLE_TEACHER, self::ROLE_ADMIN]],
//            ['status', 'default', 'value' => self::STATUS_ACTIVE],
//            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
//        ];
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public static function findIdentity($id) {
//        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public static function findIdentityByAccessToken($token, $type = null) {
//        foreach (self::$users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }
//
//        return null;
//    }
//
//    /**
//     * Finds user by username
//     *
//     * @param  string      $username
//     * @return static|null
//     */
//    public static function findByUsername($username) {
//        foreach (self::$users as $user) {
//            if (strcasecmp($user['username'], $username) === 0) {
//                return new static($user);
//            }
//        }
//
//        return null;
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public function getId() {
//        return $this->id;
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public function getAuthKey() {
//        return $this->authKey;
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public function validateAuthKey($authKey) {
//        return $this->authKey === $authKey;
//    }
//
//    /**
//     * Validates password
//     *
//     * @param  string  $password password to validate
//     * @return boolean if password provided is valid for current user
//     */
//    public function validatePassword($password) {
//        return $this->password === $password;
//    }
//
//    public function insert($runValidation = true, $attributes = null) {
//        
//    }
//
//    public static function find() {
//        
//    }
//
//    public static function getDb() {
//        
//    }
//
//    public static function primaryKey() {
//        
//    }
//
//}
