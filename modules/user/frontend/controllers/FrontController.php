<?php

namespace modules\user\frontend\controllers;

use Yii;
use yii\web\Controller;
use modules\user\frontend\models\RegisterForm;
use modules\user\common\components\UserIdentity;
use modules\user\frontend\Module;

class FrontController extends Controller
{
    public function actionRegister()
    {
        $this->layout = Module::getInstance()->layout;
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }
        $model = new RegisterForm;
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash(
                'success',
                Module::getInstance()->successFlash
            );
            $user = UserIdentity::findByEmail($model->email);
            if(Yii::$app->user->login($user, 3600 * 24 * 14)){
                return $this->redirect(Module::getInstance()->successRedirectPath);
            }
            
        } else {
            return $this->render('register', [
                'model' => $model,
            ]);
        }
    }
}
