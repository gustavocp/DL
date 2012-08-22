<?php
	class DefaultController extends Controller
	{
		public function actionIndex()
		{
			$this->render('index');
		}
	
/*		public function actionRegister()
		{
			$model = new RegisterForm;
		
			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax'] === 'register-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
		
			// collect user input data
			if(isset($_POST['RegisterForm']))
			{
				$model->attributes = $_POST['RegisterForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->register())
					$this->redirect(Yii::app()->user->returnUrl);
			}
		
			$this->render('register', array('model' => $model));
			
		}
*/		
		/**
		 * Displays the login page
		 */
		public function actionLogin()
		{
			$model = new LoginForm;
		
			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}
		
			// collect user input data
			if(isset($_POST['LoginForm']))
			{
				$model->attributes = $_POST['LoginForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login())
				{
					$this->redirect(Yii::app()->createUrl('admin/default'));
				}
					
			}
			// display the login form
			$this->render('login', array('model' => $model));
		}
		
		/**
		 * Logs out the current user and redirect to homepage.
		 */
		public function actionLogout()
		{
			Yii::app()->user->logout();
			Yii::app()->cache->flush();
			$this->redirect(Yii::app()->getModule('admin')->homeUrl);
		}
		
		public function actionError()
		{
		    if($error = Yii::app()->errorHandler->error)
		    {
		    	if(Yii::app()->request->isAjaxRequest)
//		    		echo $error['message'];
					echo "<div class='msg msg-error push-1 span-21  prepend-top'><p><strong>".$error['message']."</strong></p></div>";
		    	else
		        	$this->render('error', array('error' => $error));
		    }
		}
/*
		public function accessRules()
        {
            return array(array('allow', 'actions'=>array('Login'), 'users'=>array('*')));
        }		

		public function filters()
		{
			return array('accessControl');
		} */
        
	}
	
?>