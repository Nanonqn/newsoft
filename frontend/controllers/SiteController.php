<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\MailCall;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'], //invitado
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'], //logueado
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

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess']
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
    	
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                	MailCall::onMailableAction('signup', 'site');
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function onAuthSuccess($client)
    {

        $attributes = $client->getUserAttributes();

        //debug stuff
        //$attributes['email'] = null;
        //var_dump($attributes);
        //die();

        // if provider didn't supply email

        if (!isset($attributes['email'])){

            return Yii::$app->getSession()->setFlash('error', [
                Yii::t('app', "Unable to finish, {client} did not provide us with an email.  
                        Please check your settings on {client}.", ['client' => $client->getTitle()]),
            ]);
        }

        $source = $client->getId();

        //set $username to correct $attribute from each provider

        switch ($source){

            case $source == 'facebook' :

                $username = 'name';
                break;

            case $source == 'github' :

                $username = 'login';
                break;

            case $source == 'twitter' :

                $username = 'screen_name';
                break;

            default:

                $username = 'name';

        }

        $auth = Auth::find()->where([
            'source' => $source,
            'source_id' => $attributes['id'],
        ])->one();

        if (Yii::$app->user->isGuest) {

            if ($auth) { // login

                $user = $auth->user;
                Yii::$app->user->login($user);

            } else { // signup

                if (isset($attributes['email'])
                    && User::find()->where(['email' => $attributes['email']])->exists()) {
                    return Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "User with the same email as in {client} account already exists but isn't synced. 
                        Login with username and password and click the {client} sync link to sync accounts.",
                            ['client' => $client->getTitle()]),
                    ]);
                } else {
                    $password = Yii::$app->security->generateRandomString(6);
                    $user = new User([
                        'username' => $attributes[$username],
                        'email' => $attributes['email'],
                        'password' => $password,
                    ]);

                    $user->generateAuthKey();
                    //$user->generatePasswordResetToken();
                    $transaction = $user->getDb()->beginTransaction();

                    if ($user->save()) {
                        $auth = new Auth([
                            'user_id' => $user->id,
                            'source' => $client->getId(),
                            'source_id' => (string)$attributes['id'],
                        ]);

                        if ($auth->save()) {
                            $transaction->commit();
                            Yii::$app->user->login($user);
                            MailCall::onMailableAction('signup', 'site');
                        } else {
                            return Yii::$app->getSession()->setFlash('error', [
                                Yii::t('app', "We were unable to complete the process and sync {client}.",
                                    ['client' => $client->getTitle()]),
                            ]);
                        }
                    } else {
                        return Yii::$app->getSession()->setFlash('error', [
                            Yii::t('app', "We were unable to complete the process and sync {client}.",
                                ['client' => $client->getTitle()]),
                        ]);
                    }
                }
            }
        } else { // user already logged in

            if (!$auth && $this->attributes['email'] == Yii::$app->user->identity->email) { // add auth provider

                $auth = new Auth([
                    'user_id' => Yii::$app->user->id,
                    'source' => $source,
                    'source_id' => (string)$attributes['id'],
                ]);
                $auth->save();

                Yii::$app->getSession()->setFlash('success', [
                    Yii::t('app', "Your {client} account is successfully synced.",
                        ['client' => $client->getTitle()]),
                ]);

            } else { //emails don't match

                if($attributes['email'] != Yii::$app->user->identity->email){

                    Yii::$app->getSession()->setFlash('error', [
                        Yii::t('app', "Your {client} account could not be synced.", ['client' => $client->getTitle()]),
                    ]);

                } else {  // account was already synced

                    Yii::$app->getSession()->setFlash('success', [
                        Yii::t('app', "Your {client} account is already synced.", ['client' => $client->getTitle()]),
                    ]);

                }
            }

        }

    }
}
