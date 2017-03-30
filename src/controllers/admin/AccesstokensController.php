<?php

namespace macfly\oauth2server\controllers\admin;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use macfly\oauth2server\models\OauthAccessTokens;
use macfly\oauth2server\models\SearchAccesstokensModel;

/**
 * AccesstokensController implements the CRUD actions for OauthAccessTokens model.
 */
class AccesstokensController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'rules'	=> $this->module->accesstokensRules,
			'verbs' => [
				'class' => VerbFilter::className(),
					'actions' => [
						'delete' => ['POST'],
				],
			],
		];
	}

	/**
	 * Lists all OauthAccessTokens models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$params	= Yii::$app->request->queryParams;

		if(!Yii::$app->user->can($this->module->adminRole))
		{
			$params['SearchAccesstokensModel']['user_id']	= Yii::$app->user->id;				
		}

		$searchModel	= new SearchAccesstokensModel();
		$dataProvider	= $searchModel->search($params);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

  /**
   * Displays a single OauthAccessTokens model.
   * @param string $id
   * @return mixed
   */
  public function actionView($id)
  {
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
  }

  /**
   * Creates a new OauthAccessTokens model.
   * If creation is successful, the browser will be redirected to the 'view' page.
   * @return mixed
   */
  public function actionCreate($client_id = null)
  {
		$model = new OauthAccessTokens();
		$model->client_id			= $client_id;
		$model->access_token	= substr(hash('sha512', mt_rand() . mt_rand() . mt_rand() . mt_rand() . microtime(true) . uniqid(mt_rand(), true)), 0, 40);
		
		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			return $this->redirect(['view', 'id' => $model->access_token]);
		} else
		{
			return $this->render('create', [
				'model'		=> $model,
				'module'	=> $this->module,
			]);
		}
  }

  /**
   * Updates an existing OauthAccessTokens model.
   * If update is successful, the browser will be redirected to the 'view' page.
   * @param string $id
   * @return mixed
   */
  public function actionUpdate($id)
  {
		$model = $this->findModel($id);
		
		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			return $this->redirect(['view', 'id' => $model->access_token]);
		} else
		{
			return $this->render('update', [
				'model'		=> $model,
				'module'	=> $this->module,
			]);
		}
  }

  /**
   * Deletes an existing OauthAccessTokens model.
   * If deletion is successful, the browser will be redirected to the 'index' page.
   * @param string $id
   * @return mixed
   */
  public function actionDelete($id)
  {
		$model			= $this->findModel($id);
		$client_id	= $model->client_id;
		$model->delete();
		return $this->redirect(['clients/accesstoken','client_id'=>$client_id]);
  }

  /**
   * Finds the OauthAccessTokens model based on its primary key value.
   * If the model is not found, a 404 HTTP exception will be thrown.
   * @param string $id
   * @return OauthAccessTokens the loaded model
   * @throws NotFoundHttpException if the model cannot be found
   */
  protected function findModel($id)
  {
		if (($model = OauthAccessTokens::findOne($id)) !== null)
		{
			return $model;
		} else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
  }
}
