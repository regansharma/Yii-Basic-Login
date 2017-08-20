<?php

namespace app\controllers;

use Yii;
use app\models\Forms\LoginForm;

class RootController extends \yii\web\Controller
{
	public $layout = "@app/views/layouts/root";
	
    public function actionIndex()
    {
		$request = Yii::$app->request;
		$model = new LoginForm();
		
		$request = Yii::$app->request;
		if($this->check_for_ajax_request($request))
		{
			Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
			if ($model->load(Yii::$app->request->post()) && $model->login())
			{
				echo 'success';
			}
			else
			{
				echo json_encode($model->errors);
			}
		}
		else
		{
			return $this->render('index',['model' => $model]);
		}
    }
	
	private function check_for_ajax_request($request)
	{
		if($request->isAjax)
			return true;
		else
			return false;
	}
	
}
