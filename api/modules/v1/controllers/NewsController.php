<?php

namespace api\modules\v1\controllers;

use api\components\ApiController;
use api\modules\v1\models\News;
use api\modules\v1\models\search\NewsSearch;
use Yii;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class NewsController extends ApiController
{

    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search();

        return $dataProvider;
    }

    /**
     * Lists all News models.
     * @return \yii\data\ActiveDataProvider
     */
    public function actionGetList(): \yii\data\ActiveDataProvider
    {
        $searchModel = new NewsSearch();
        return $searchModel->search();
    }


    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
        return $model->load(Yii::$app->getRequest()->getBodyParams(), "") && $model->save();
    }

    /**
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        return $model->load(Yii::$app->getRequest()->getBodyParams(), "") && $model->save();
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return bool
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     * @throws \Throwable
     */
    public function actionDelete(int $id)
    {
        return (bool)$this->findModel($id)->delete();
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'Page not found'));
    }
}