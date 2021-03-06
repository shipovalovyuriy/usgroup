<?php
/**
 * Отображение для index:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$this->breadcrumbs = [
    $this->getModule()->getCategory() => [],
    Yii::t('ListnerModule.listner', 'Положения') => ['/listner/positionBackend/index'],
    Yii::t('ListnerModule.listner', 'Управление'),
];

$this->pageTitle = Yii::t('ListnerModule.listner', 'Положения - управление');

$this->menu = [
    ['icon' => 'fa fa-fw fa-list-alt', 'label' => Yii::t('ListnerModule.listner', 'Управление Положениями'), 'url' => ['/listner/positionBackend/index']],
    ['icon' => 'fa fa-fw fa-plus-square', 'label' => Yii::t('ListnerModule.listner', 'Добавить Положение'), 'url' => ['/listner/positionBackend/create']],
];
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('ListnerModule.listner', 'Положения'); ?>
        <small><?php echo Yii::t('ListnerModule.listner', 'управление'); ?></small>
    </h1>
</div>

<p>
    <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="collapse" data-target="#search-toggle">
        <i class="fa fa-search">&nbsp;</i>
        <?php echo Yii::t('ListnerModule.listner', 'Поиск Положений');?>
        <span class="caret">&nbsp;</span>
    </a>
</p>

<div id="search-toggle" class="collapse out search-form">
        <?php Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function () {
            $.fn.yiiGridView.update('position-grid', {
                data: $(this).serialize()
            });

            return false;
        });
    ");
    $this->renderPartial('_search', ['model' => $model]);
?>
</div>

<br/>

<p> <?php echo Yii::t('ListnerModule.listner', 'В данном разделе представлены средства управления Положениями'); ?>
</p>

<?php
 $this->widget(
    'yupe\widgets\CustomGridView',
    [
        'id'           => 'position-grid',
        'type'         => 'striped condensed',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => [
            'id',
            'code',
            [
                'header' => 'Формы обучения',
                'name'   => 'form.name',
            ],
            [
                'header' => 'Имя слушателя',
                'name'   => 'listner.name',
            ],
            [
                'header' => 'Имя преподавателя',
                'name'   => 'teacher.name',
            ],
            [
                'header' => 'Предмет',
                'name'   => 'subject.name',
            ],
            [
                'header' => 'Группа',
                'name'   => 'group.name',
            ],
            'lvl',
            'note',
//            'time',
//            'start_date',
            [
                'class' => 'yupe\widgets\CustomButtonColumn',
            ],
        ],
    ]
); ?>
