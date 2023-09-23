<?php

namespace frontend\controllers;

use app\models\Item;
use app\models\ItemSearch;
use app\models\Statistic;
use PhpParser\Node\Stmt\Static_;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * ItemController implements the CRUD actions for Item model.
 */
class ItemController extends Controller
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

    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (in_array($action->id, ['index', 'view'])) {
                $this->insertStatistics();
            }

            return true;
        }

        return false;
    }
    /**
     * Lists all Item models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ItemSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Item model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    private function insertStatistics()
    {
        $accessTime = date("Y-m-d H:i:s");
        $userIp = Yii::$app->request->userIP;
        $userHost = gethostname();
        $pathInfo = Yii::$app->request->pathInfo;
        $queryString = Yii::$app->request->queryString;

        Yii::$app->db->createCommand()->insert('{{%statistic}}', [
            'access_time' => $accessTime,
            'user_ip' => $userIp,
            'user_host' => $userHost,
            'path_info' => $pathInfo ? $pathInfo : Yii::$app->defaultRoute,
            'query_string' => $queryString,
        ])->execute();
    }

    protected function findModel($id)
    {
        if (($model = Item::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
