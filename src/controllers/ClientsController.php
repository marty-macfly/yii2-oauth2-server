<?php

namespace macfly\oauth2server\controllers\admin;

use macfly\oauth2server\models\OauthClients;
use macfly\oauth2server\models\SearchClientsModel;
use macfly\oauth2server\models\SearchAccesstokensModel;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ClientsController implements the CRUD actions for OauthClients model.
 */
class ClientsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all OauthClients models.
     * @return mixed
     */
    public function actionIndex()
    {
        $params = Yii::$app->request->queryParams;
        $searchModel = new SearchClientsModel();
        $dataProvider = $searchModel->search($params);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OauthClients model.
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
     * Creates a new OauthClients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OauthClients();

        if ($model->load(Yii::$app->request->post())) {
            $model->grant_types = implode(" ", $model->grant_types);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->client_id]);
            } else {
                return $this->render('create', [
                    'model'  => $model,
                    'module' => $this->module,
                ]);
            }
        } else {
            return $this->render('create', [
                'model'  => $model,
                'module' => $this->module,
            ]);
        }
    }

    /**
     * Updates an existing OauthClients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->grant_types = explode(" ", $model->grant_types);

        if ($model->load(Yii::$app->request->post())) {
            $model->grant_types = implode(" ", $model->grant_types);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->client_id]);
            } else {
                return $this->render('update', [
                    'model'  => $model,
                    'module' => $this->module,
                ]);
            }
        } else {
            return $this->render('update', [
                'model'  => $model,
                'module' => $this->module,
            ]);
        }
    }

    /**
     * Deletes an existing OauthClients model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OauthClients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return OauthClients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OauthClients::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
