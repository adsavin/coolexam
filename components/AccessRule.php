<?php

namespace app\components;

class AccessRule extends \yii\filters\AccessRule {

    protected function matchRole($user) {

        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ($role == '?' && $user->getIsGuest()) {
                return true;
            } else if ($role == '@' && !$user->getIsGuest()) {
                return true;
            } elseif (!$user->getIsGuest() && $role == $user->identity->level_user) {
                return true;
            }
        }
        return false;
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'view'], // กำหนด action ทั้งหมดภายใน Controller นี้
                'ruleConfig' => [
                    'class' => AccessRule::className() // เรียกใช้งาน accessRule (component) ที่เราสร้างขึ้นใหม่
                ],
                'rules' => [
                    [
                        'actions' => ['index'], // กำหนด rules ให้ actionIndex()
                        'allow' => false,
                        'roles' => [
                            User::ROLE_USER, // อนุญาตให้ "ผู้ใช้งาน / สมาชิก" ใช้งานได้
                            User::ROLE_EMPLOYEE, // อนุญาตให้ "พนักงาน" ใช้งานได้
                            User::ROLE_ADMIN        // อนุญาตให้ "ผู้ดูแลระบบ" ใช้งานได้
                        ]
                    ],
                    [
                        'actions' => ['login'], // กำหนด rules ให้ actionCreate()
                        'allow' => false,
                        'roles' => [
                            User::ROLE_EMPLOYEE, // อนุญาตให้ "พนักงาน" ใช้งานได้
                            User::ROLE_ADMIN        // อนุญาตให้ "ผู้ดูแลระบบ" ใช้งานได้
                        ]
                    ],
                    [
                        'actions' => ['view'], // กำหนด rules ให้ actionView()
                        'allow' => true,
                        'roles' => [
                            User::ROLE_USER, // อนุญาตให้ "ผู้ใช้งาน / สมาชิก" ใช้งานได้
                            User::ROLE_EMPLOYEE, // อนุญาตให้ "พนักงาน" ใช้งานได้
                            User::ROLE_ADMIN        // อนุญาตให้ "ผู้ดูแลระบบ" ใช้งานได้
                        ]
                    ]
                ],
            ],
        ];
    }

}
