<?php

namespace app\controllers;

use app\models\Invoices;
use app\models\InvoicesSearch;
use app\models\Places;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InvoicesController implements the CRUD actions for Invoices model.
 */
class InvoicesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Invoices models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new InvoicesSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Invoices model.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Invoices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Invoices();

        if ($this->request->isAjax) {
            $model->from_id = $this->request->post('from_id');
            $model->to_id = $this->request->post('to_id');
            $model->receiver_id = $this->request->post('receiver_id');
            $model->status_id = $this->request->post('status_id');
            if ($model->save()) {
                return json_encode(['status' => 'OK','code' => '200', 'text' => 'Успешно сохранен!']);
            }else{
                return json_encode(['status' => 500, 'text' => $this->renderPartial('_form', ['model' => $model, 'text' => 'create', 'message' => 'Валидация не прошла! Заполните все поля!'])]);
            }
        }

        return json_encode(['status' => 500, 'text' => $this->renderPartial('_form', ['model' => $model, 'text' => 'create', 'message' => 'Валидация не прошла! Заполните все поля!'])]);
    }

    /**
     * Updates an existing Invoices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isAjax) {
            $model->from_id = $this->request->post('from_id');
            $model->to_id = $this->request->post('to_id');
            $model->receiver_id = $this->request->post('receiver_id');
            $model->status_id = $this->request->post('status_id');
            if ($model->save()) {
                return json_encode(['status' => 'OK','code' => '200', 'text' => 'Успешно сохранен!']);
            }else{
                return json_encode(['status' => 500, 'text' => $this->renderPartial('_form', ['model' => $model, 'text' => 'create', 'message' => 'Валидация не прошла! Заполните все поля!'])]);
            }
        }

        return json_encode(['status' => 500, 'text' => $this->renderPartial('_form', ['model' => $model, 'text' => 'create', 'message' => 'Валидация не прошла! Заполните все поля!'])]);
    }

    /**
     * Deletes an existing Invoices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Invoices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Invoices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Invoices::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionGetForm($id=null, $text='create'){
        if(\Yii::$app->request->isAjax){
            if($text=='update'){
                $model = Invoices::findOne($id);
                return $this->renderPartial('_form', ['model' => $model, 'text' => $text]);
            }
            $model = new Invoices();
            return $this->renderPartial('_form', ['model' => $model, 'text' => $text]);
        }
    }

    public function actionChangeStatus(){
        if(\Yii::$app->request->isPost){
            $selectedItems = Html::encode($this->request->post('selectedItems'));
            $status = Html::encode($this->request->post('status'));
            if(!empty($selectedItems) && !empty($status)){
                \Yii::$app->db->createCommand('UPDATE invoices SET status_id = '.$status.' WHERE id IN('.$selectedItems.')')->execute();
                \Yii::$app->session->setFlash('success', 'Статус успешно обновлен!');
            }else{
                \Yii::$app->session->setFlash('warning', 'Статус не обновлен!');
            }
            return $this->redirect('/invoices/index');
        }
    }
}
