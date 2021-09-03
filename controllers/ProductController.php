<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;


class ProductController extends AppController
{
    public function actionView($id)
    {
        $id = Yii::$app->request->get('id');
        $product = Product::findOne($id);

        if ($product === null) { // item does not exist
            throw new HttpException(404, 'Такого товара нет.');
        }

        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $this->setMeta('E-SHOPER | '. $product->name, $product->keywords, $product->description);

        return $this->render('view', compact('product', 'hits'));

    }

    public function actionGetFullImage(){
        // return "its work";
        $id = Yii::$app->request->get('id');
        $idImage = Yii::$app->request->get('idimage');
        $product = Product::findOne($id);

        $images = $product->getImages();
        $count = 0;
        foreach($images as $img){
            if($count == $idImage ){
                // return $img->getPathToOrigin();
                return $img->getUrl('250x250');
            }
        $count++;
        }

    }
}