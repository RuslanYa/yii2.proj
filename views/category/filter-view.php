<?php

use app\widgets\MenuWidget;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

?>

                <!-- <div class="features_items">features_items -->
                <div class="dump category-id" data-id="<?php echo $category->id ?>">
                
                    <?php if (!empty($products)): ?>
                    <?php $i = 0 ;foreach ($products as $product): ?>
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <?php echo Html::img("{$product->getImage()->getUrl('250x250')}", ['alt' => $product->name]) ?>

                                
                                    <h2>$<?php echo $product->price ?></h2>
                                    <p> <a href="<?php echo Url::to(['product/view', 'id'=> $product->id]); ?>"><?php echo $product->name ?></a></p>
                                    <a href="#" data-id="<?php echo $product->id ?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                </div>
                                <?php if ($product->new) :?>
                                    <?php echo Html::img("@web/images/home/new.png", ['alt'=>'Новинка', 'class'=>'new']) ?>
                                <?php endif; ?>
                                <?php if ($product->sale) :?>
                                    <?php echo Html::img("@web/images/home/sale.png", ['alt'=>'Распродажа', 'class'=>'new']) ?>
                                <?php endif; ?>
                            </div>
<!--                            <div class="choose">-->
<!--                                <ul class="nav nav-pills nav-justified">-->
<!--                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>-->
<!--                                    <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>-->
<!--                                </ul>-->
<!--                            </div>-->
                        </div>
                    </div>
                    <?php $i++ ?>
                     <?php if ($i % 3 == 0) : ?>
                            <div class="clearfix"></div>
                     <?php endif; ?>
                        <?php endforeach; ?>
                        <div class="clearfix"></div>
                    <?php echo
                        LinkPager::widget([
                            'pagination' => $pages,
                        ]); ?>
                    <?php else :?>
                    <h2>Здесь товаров нет</h2>

                    <?php endif; ?>

                    </div>
                <!-- </div>features_items -->
            