<?php


namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use \yii\web\HttpException;
use yii\helpers\ArrayHelper;

class CategoryController extends AppController
{
    public function  actionIndex()
    {
        // $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $this->setMeta('E-SHOPER');

        $query = Product::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 6,  'forcePageParam' => false, 'pageSizeParam' => false]);
        $hits = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', compact('hits', 'pages'));
    }

    public function actionView($id)
    {
        $category = Category::findOne($id);
        if ($category === null) { // item does not exist
            throw new HttpException(404, 'Такой категории нет.');
        }
        $query = Product::find()->where(['category_id'=>$id]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta('E-SHOPER | '. $category->name, $category->keywords, $category->description);
        return $this->render('view', compact('products', 'pages', 'category'));
    }

    public function actionSearch()
    {
        $q = trim(Yii::$app->request->get('q'));
        $this->setMeta('E-SHOPER | '. $q);
        if (!$q) return $this->render('search');
        $query = Product::find()->where(['like', 'name', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('search', compact('products', 'pages', 'q'));
    }

    public function actionFilter(){

        $id = Yii::$app->request->get('id');

        $category = Category::findOne($id);
        if ($category === null) { // item does not exist
            throw new HttpException(404, 'Такой категории нет.');
        }

        $low = Yii::$app->request->get('low');
        $hight = Yii::$app->request->get('hight');



        $query = Product::find()->where(['category_id'=>$id])    
                                ->andWhere(['between', 'price', $low, $hight]);
                                
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $this->layout = false;
        return $this->render('filter-view', compact('products', 'pages', 'category'));
    }
}