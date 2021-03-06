<div class="page-header">
    <h1>
        <?php echo Yii::t('ListnerModule.listner', 'Просмотр') . ' ' . Yii::t('ListnerModule.listner', 'Расписания Студента').' Номер листа учета №'.$model->code ?>        <br/>
        <a href="/listner/view/<?= $model->listner->id?>"><small>&laquo;<?php echo $model->listner->name . ' ' . $model->listner->lastname ?>&raquo;</small></a>
    </h1>
</div>
<div class="col-lg-12">
    <section class="panel portlet-item">
        <header class="panel-heading"><?= $model->subject->name?> 
            <div class="pull-right">
                <a class="text-right" href="#">
                    <i></i>
                </a>
                <a class="text-right" href="/listner/view/<?= $model->listner_id?>/create/<?= $model->id?>">
                    <i class="fa fa-plus-circle"></i> Продлить курс
                </a>
                <a class="text-right" target="_blank" href="/listner/subject/lessons/<?= $model->id?>/doc">
                    <i class="fa fa-file-o"></i>  Документ
                </a>
            </div>
        </header>
        <div class="list-group bg-white">
            <div class="list-group-item">
                <?php if($model->prev):?>
                    <a href="<?= $model->prev->id?>">
                        <i class="fa fa-arrow-circle-left"></i><span>Предыдущее |</span>
                    </a>
                <?php endif;?>
                <?= $model->month;?>
                <?php if($model->next):?>
                    <a href="<?= $model->next->id?>">
                        <span>| Следующее</span><i class="fa fa-arrow-circle-right"></i>
                    </a>
                <?php endif;?>
            </div>
            <?php foreach($model->schedule as $schedule):?>
                <div class="list-group-item <?= $schedule->is_active == 0  ? 'bg-warning' : ''?>" <?php if(date('c')>=$schedule->end_time && $schedule->is_active==1):?>style="text-decoration: line-through;"<?php endif;?>>
                    Урок № <?= $schedule->number .' | '. str_replace('T', ' ', $schedule->start_time) .' | '. $schedule->room->alias?>
                    <?php if($schedule->checkEdit()):?>
                        <a href="/listner/subject/lessons/<?= $model->id?>/update/<?= $schedule->id?>">
                            <i class="fa fa-pencil pull-right"></i>
                        </a>
                        <a class="change" href="#" data-id="<?= $schedule->id?>">
                            <i class="fa fa-<?= $schedule->is_active == 0  ? 'refresh' : 'eraser'?> pull-right"></i>
                        </a>
                    <?php endif;?>
                </div>
            <?php endforeach;?>            
        </div>
    </section>
</div>

<script>
    $(function(){
        $('.change').click(function(){
            var lesson = $(this);
            var id = lesson.attr('data-id');
            var change, remove;
            $.ajax({
                url: '/listner/position/change',
                type: 'GET',
                data: {'id': id},
            }).done(function(data) {
                if(data == 0){
                    remove="fa-eraser";
                    change="fa-refresh";
                    lesson.parent("div").addClass("bg-warning");
                }
                else{
                    remove="fa-refresh";
                    change="fa-eraser";
                    lesson.parent("div").removeClass("bg-warning");
                }
                lesson.children("i").removeClass(remove);
                lesson.children("i").addClass(change);
            }).fail(function() {
                alert('Непредвиденная ошибка, перезагрузите страницу и попробуйте еще раз.');
            });

        });
    });

</script>
