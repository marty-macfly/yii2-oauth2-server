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
        $behaviors = [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];

        if (!empty($this->module->accesstokensAccessRules)) {
            $behaviors['access'] = $this->module->accesstokensAccessRules;
        }

        return $behaviors;
    }

    /**
     * Lists all OauthAccessTokens models.
     * @return mixed
     */
    public function actionIndex()
    {
        $params = Yii::$app->request->queryParams;
        $searchModel  = new SearchAccesstokensModel();
        $dataProvider = $searchModel->search($params);

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
        $model->loadDefaultValues();
        $model->client_id = $client_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->access_token]);
        } else {
            return $this->render('create', [
                'model'  => $model,
                'module' => $this->module,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->access_token]);
        } else {
            return $this->render('update', [
                'model'  => $model,
                'module' => $this->module,
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
        $model     = $this->findModel($id);
        $client_id = $model->client_id;
        $model->delete();
        return $this->redirect(['admin/accesstokens','SearchAccesstokensModel[client_id]'=>$client_id]);
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
        if (($model = OauthAccessTokens::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
