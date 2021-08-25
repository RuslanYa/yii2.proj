<?php

use app\widgets\MenuWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
mihaildev\elfinder\Assets::noConflict($this);

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <div class="form-group field-product-categiry_id has-success">
        <label class="control-label" for="product-categiry_id">Родительская</label>
        <select id="product-categiry_id" class="form-control" name="Product[category_id]" aria-invalid="false">
            <option value="0">Самостоятельная категория</option>
            <?= MenuWidget::widget(['tpl'=> 'select_product', 'model' => $model])?>
        </select>

    </div>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php  /*$form->field($model, 'content')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]);*/ ?>

    <?php echo $form->field($model, 'content')->widget(CKEditor::className(), [

        'editorOptions' => ElFinder::ckeditorOptions('elfinder',[]),

    ]); ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image')->fileInput() ?>

    <?= $form->field($model, 'image')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>



    <?= $form->field($model, 'hit')->checkbox([ '0', '1', ]) ?>

    <?= $form->field($model, 'new')->checkbox([ '0', '1', ]) ?>

    <?= $form->field($model, 'sale')->checkbox([ '0', '1', ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
