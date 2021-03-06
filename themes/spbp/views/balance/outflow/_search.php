<?php
/**
 * Отображение для _search:
 *
 *   @category YupeView
 *   @package  yupe
 *   @author   Yupe Team <team@yupe.ru>
 *   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
 *   @link     http://yupe.ru
 **/
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm', [
        'action'      => Yii::app()->createUrl($this->route),
        'method'      => 'get',
        'type'        => 'vertical',
        'htmlOptions' => ['class' => 'well'],
    ]
);
?>

<fieldset>
    <div class="row">
        <div class="col-sm-3">
            <?php echo $form->textFieldGroup($model, 'id', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('id'),
                        'data-content' => $model->getAttributeDescription('id')
                    ]
                ]
            ]); ?>
        </div>
		<div class="col-sm-3">
            <?php echo $form->dropDownListGroup($model, 'cost_id', [
                    'widgetOptions' => [
                        'data' => CHtml::listData(Cost::model()->findAll(), 'id', 'name')
                    ]
                ]); ?>
        </div>
		<div class="col-sm-3">
            <?php echo $form->textFieldGroup($model, 'receiver', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('receiver'),
                        'data-content' => $model->getAttributeDescription('receiver')
                    ]
                ]
            ]); ?>
        </div>
		<div class="col-sm-3">
            <?php echo $form->textFieldGroup($model, 'date', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('date'),
                        'data-content' => $model->getAttributeDescription('date')
                    ]
                ]
            ]); ?>
        </div>
		<div class="col-sm-3">
            <?php echo $form->textFieldGroup($model, 'price', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('price'),
                        'data-content' => $model->getAttributeDescription('price')
                    ]
                ]
            ]); ?>
        </div>
		<div class="col-sm-3">
            <?php echo $form->textFieldGroup($model, 'based', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('based'),
                        'data-content' => $model->getAttributeDescription('based')
                    ]
                ]
            ]); ?>
        </div>
		<div class="col-sm-3">
            <?php echo $form->textFieldGroup($model, 'note', [
                'widgetOptions' => [
                    'htmlOptions' => [
                        'class' => 'popover-help',
                        'data-original-title' => $model->getAttributeLabel('note'),
                        'data-content' => $model->getAttributeDescription('note')
                    ]
                ]
            ]); ?>
        </div>
		    </div>
</fieldset>

    <?php $this->widget(
        'bootstrap.widgets.TbButton', [
            'context'     => 'primary',
            'encodeLabel' => false,
            'buttonType'  => 'submit',
            'label'       => '<i class="fa fa-search">&nbsp;</i> ' . Yii::t('BalanceModule.balance', 'Искать Расход'),
        ]
    ); ?>

<?php $this->endWidget(); ?>