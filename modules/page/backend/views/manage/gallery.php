<?php
$this->params['breadcrumbs'][] = ['label' => 'برگه ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url' => ['view', 'id' => $model->id]
];
$this->params['breadcrumbs'][] = 'گالری';
$this->title = 'مدیریت گالری برگه';

echo $this->render(
    '@extensions/gallery/views/index.php',
    [
        'gallery' => $gallery,
        'ownerId' => $model->id
    ]
);
