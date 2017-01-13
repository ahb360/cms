<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kalpok\helpers\Utility;
use kartik\select2\Select2;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\Button;
use kalpok\i18n\widgets\LanguageSelect;
use modules\post\backend\models\Category;
use themes\admin360\widgets\editor\Editor;
use dosamigos\selectize\SelectizeTextInput;
use kalpok\file\widgets\singleupload\SingleImageUpload;

$backLink = $model->isNewRecord ? ['index'] : ['view', 'id' => $model->id];
?>
<div class="post-form">
    <?php $form = ActiveForm::begin([
        'options'=>['enctype'=>'multipart/form-data']
    ]); ?>
    <div class="row">
        <div class="col-md-8">
            <?php Panel::begin([
                'title' => 'اطلاعات نوشته'
            ]) ?>
                <?=
                    $form->field($model, 'title')
                        ->textInput(
                            [
                                'maxlength' => 255,
                                'class' => 'form-control input-large'
                            ]
                        )
                ?>

                <?php if (\Yii::$app->controller->module->editableSlug): ?>
                    <?=
                        $form->field($model, 'slug')
                            ->textInput(
                                [
                                    'maxlength' => 255,
                                    'class' => 'form-control input-large'
                                ]
                            )->hint('مقدار این فیلد پس از پردازش و حذف کاراکتر های غیرمجاز در url این نوشته قرار می گیرد.')
                    ?>
                <?php endif ?>

                <?= $form->field($model, 'summary')->textarea(['rows' => 6]) ?>

                <?=
                    $form->field($model, 'content')
                        ->widget(
                            Editor::className(),
                            ['preset' => 'advanced']
                        )
                ?>
            <?php Panel::end() ?>
        </div>
        <div class="col-md-4">
            <?php Panel::begin() ?>
                <?=
                    Html::submitButton(
                        '<i class="fa fa-save"></i> ذخیره',
                        [
                            'class' => 'btn btn-lg btn-success'
                        ]
                    )
                ?>
                <?= Button::widget([
                        'label' => 'انصراف',
                        'options' => ['class' => 'btn-lg'],
                        'type' => 'warning',
                        'icon' => 'undo',
                        'url' => $backLink,
                    ])
                ?>
            <?php Panel::end() ?>

            <?php if (Yii::$app->i18n->isMultiLanguage()): ?>
                <?php Panel::begin([
                    'title' => 'زبان'
                ]) ?>
                    <?php if ($model->isNewRecord): ?>
                        <?= $form->field($model, 'language')->widget(
                            LanguageSelect::className(),
                            ['options' => ['class' => 'form-control input-large']]
                        )->label(false); ?>
                    <?php else: ?>
                        <?= $form->field($model, 'language')->textInput([
                            'class' => 'form-control input-large',
                            'disabled' => true,
                            'value' => Yii::$app->formatter->asLanguage($model->language)
                        ])->label(false) ?>
                    <?php endif ?>
                <?php Panel::end() ?>
            <?php endif ?>

            <?php Panel::begin([
                'title' => 'تصویر شاخص'
            ]) ?>
                <?php
                    echo SingleImageUpload::widget(
                        [
                            'model' => $model,
                            'group' => 'image',
                        ]
                    );
                ?>
            <?php Panel::end() ?>
            <?php Panel::begin([
                'title' => 'دسته‌ها'
            ]) ?>
            <?=  $form->field($model, 'categories')->widget(Select2::classname(), [
                    'data' => $model->getAllCategories(),
                    'options' => ['placeholder' => 'دسته های مورد نظر را انتخاب کنید', 'multiple' => true,'dir' => 'rtl'],
                    'toggleAllSettings' => [
                        'selectLabel' => '<i class="glyphicon glyphicon-ok-circle"></i> انتخاب همه',
                        'unselectLabel' => '<i class="glyphicon glyphicon-remove-circle"></i> عدم انتخاب همه',
                        'selectOptions' => ['class' => 'text-success'],
                        'unselectOptions' => ['class' => 'text-danger'],
                    ],
                    'pluginOptions' => [
                        'tags' => true,
                        'tokenSeparators' => [',', ' '],
                        'maximumInputLength' => 10,
                    ],
                ])->label('');
            ?>
            <?php Panel::end() ?>
            <?php Panel::begin([
                'title' => 'ویژگی های نوشته'
            ]) ?>
                <?= $form->field($model, 'isActive')->checkbox(); ?>

                <?= $form->field($model, 'priority')
                    ->dropDownList(
                        Utility::listNumbers(10, 1),
                        ['prompt' => '', 'class' => 'form-control input-medium']
                    )
                ?>
            <?php Panel::end() ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>
</div>




