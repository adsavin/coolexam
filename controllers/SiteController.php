<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\components\AccessRule;
use app\models\User;

class SiteController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

//    public function behaviors() {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['index', 'create', 'view'], // กำหนด action ทั้งหมดภายใน Controller นี้
//                'ruleConfig' => [
//                    'class' => AccessRule::className() // เรียกใช้งาน accessRule (component) ที่เราสร้างขึ้นใหม่
//                ],
//                'rules' => [
//                    [
//                        'actions' => ['index', 'login'], // กำหนด rules ให้ actionIndex()
//                        'allow' => false,
//                        'roles' => [
//                            User::ROLE_STUDENT, // อนุญาตให้ "ผู้ใช้งาน / สมาชิก" ใช้งานได้
//                            User::ROLE_TEACHER, // อนุญาตให้ "พนักงาน" ใช้งานได้
//                            User::ROLE_ADMIN        // อนุญาตให้ "ผู้ดูแลระบบ" ใช้งานได้
//                        ]
//                    ],
//                    [
//                        'actions' => ['create'], // กำหนด rules ให้ actionCreate()
//                        'allow' => true,
//                        'roles' => [
//                            User::ROLE_STUDENT, // อนุญาตให้ "พนักงาน" ใช้งานได้
//                            User::ROLE_ADMIN        // อนุญาตให้ "ผู้ดูแลระบบ" ใช้งานได้
//                        ]
//                    ]
//                ],
//            ],
//        ];
//    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {
        if (\Yii::$app->user->isGuest) {
            $this->redirect(array("login"));
        } else {
            $exam = \app\models\Exam::find()->where("1=1")->one();
            return $this->render('index', ["exam" => $exam]);
        }
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->login()) {
                return $this->redirect(array("index"));
            }
        }

        return $this->render('login', [
                    'model' => $model,
        ]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

//    public function actionContact() {
//        $model = new ContactForm();
//        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
//            Yii::$app->session->setFlash('contactFormSubmitted');
//
//            return $this->refresh();
//        }
//        return $this->render('contact', [
//                    'model' => $model,
//        ]);
//    }
//
//    public function actionAbout() {
//        return $this->render('about');
//    }
}
