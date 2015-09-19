<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;
use app\models\Answer;
use app\models\Exam;
use app\models\UserScore;
use app\models\UserHasAnswer;

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
            $exam = Exam::find()->where("1=1")->one(); // modify later
            if (Yii::$app->request->post()) {
                $post = Yii::$app->request->post();
                $answers = $post["Answers"];
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $userscore = new UserScore();
                    $userscore->finished_time = date("Y-m-d H:i:s");
                    $userscore->user_id = Yii::$app->user->identity->id;
                    $userscore->exam_id = $exam->id;
                    $userscore->score = 0;
                    $userAnswers = [];
                    $totalScore = 0;
                    foreach ($exam->getQuestions()->all() as $question) {
                        $userAnswer = new UserHasAnswer();
                        $userAnswer->user_id = Yii::$app->user->identity->id;
                        $userAnswer->answer_id = $answers[$question->id];
                        $userAnswer->exam_id = $exam->id;
                        $userAnswer->save();
                        $correctAnswer = Answer::find()->where("is_correct=:is_correct AND question_id=:question_id", [":is_correct" => 1, ":question_id" => $question->id])->one();
                        if ($userAnswer->answer_id === $correctAnswer->id) {
                            $userscore->score += $question->score;
                        }
                        $totalScore += $question->score;
                        $userAnswers[] = $userAnswer;
                    }
                    $userAnswer->save();
                    $transaction->commit();
//                    $this->redirect(["showScore"], ["userAnswers" => $userAnswers, "userScore" => $userscore]);
                    return $this->render("score_summary", [
                                "userAnswers" => $userAnswers,
                                "userScore" => $userscore,
                                "totalScore" => $totalScore
                    ]);
                } catch (Exception $exc) {
                    $transaction->rollBack();
                    Yii::$app->session->setFlash("error", $exc->getTraceAsString());
                }
            }

            return $this->render('index', ["exam" => $exam]);
        }
    }

//    public function actionShowScore($userAnswers, $userscore) {
//        $this
//    }

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
