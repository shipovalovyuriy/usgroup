<?php
/**
* Класс BranchController:
*
*   @category Yupe\yupe\components\controllers\FrontController
*   @package  yupe
*   @author   Yupe Team <team@yupe.ru>
*   @license  https://github.com/yupe/yupe/blob/master/LICENSE BSD
*   @link     http://yupe.ru
**/
class BranchController extends \yupe\components\controllers\FrontController
{
    /**
    * Отображает Филиал по указанному идентификатору
    *
    * @param integer $id Идинтификатор Филиал для отображения
    *
    * @return void
    */
    public function actionView($id)
    {
        $roles = ['1'];
        $role = \Yii::app()->user->role;
        if (array_intersect($role, $roles)){
            $this->render('view', ['model' => $this->loadModel($id)]);        
        } else {
            throw new CHttpException(403,  'Ошибка прав доступа.');
        }
    }
    
    /**
    * Создает новую модель Филиала.
    * Если создание прошло успешно - перенаправляет на просмотр.
    *
    * @return void
    */
    public function actionCreate()
    {
        $roles = ['1'];
        $role = \Yii::app()->user->role;
        if (array_intersect($role, $roles)){
            $model = new Branch;

            if (Yii::app()->getRequest()->getPost('Branch') !== null) {
                $model->setAttributes(Yii::app()->getRequest()->getPost('Branch'));

                if ($model->save()) {
                    Yii::app()->user->setFlash(
                        yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                        Yii::t('BranchModule.branch', 'Запись добавлена!')
                    );

                    $this->redirect(
                        (array)Yii::app()->getRequest()->getPost(
                            'submit-type',
                            [
                                'update',
                                'id' => $model->id
                            ]
                        )
                    );
                }
            }
            $this->render('create', ['model' => $model]);
        } else {
            throw new CHttpException(403,  'Ошибка прав доступа.');
        }
    }
    
    /**
    * Редактирование Филиала.
    *
    * @param integer $id Идинтификатор Филиал для редактирования
    *
    * @return void
    */
    public function actionUpdate($id)
    {
        $roles = ['1'];
        $role = \Yii::app()->user->role;
        if (array_intersect($role, $roles)){
            $model = $this->loadModel($id);

            if (Yii::app()->getRequest()->getPost('Branch') !== null) {
                $model->setAttributes(Yii::app()->getRequest()->getPost('Branch'));

                if ($model->save()) {
                    Yii::app()->user->setFlash(
                        yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                        Yii::t('BranchModule.branch', 'Запись обновлена!')
                    );

                    $this->redirect(
                        (array)Yii::app()->getRequest()->getPost(
                            'submit-type',
                            [
                                'update',
                                'id' => $model->id
                            ]
                        )
                    );
                }
            }
            $this->render('update', ['model' => $model]);
        } else {
            throw new CHttpException(403,  'Ошибка прав доступа.');
        }
    }
    
    /**
    * Удаляет модель Филиала из базы.
    * Если удаление прошло успешно - возвращется в index
    *
    * @param integer $id идентификатор Филиала, который нужно удалить
    *
    * @return void
    */
    public function actionDelete($id)
    {
        $roles = ['1'];
        $role = \Yii::app()->user->role;
        if (array_intersect($role, $roles)){
            if (Yii::app()->getRequest()->getIsPostRequest()) {
                // поддерживаем удаление только из POST-запроса
                $this->loadModel($id)->delete();

                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t('BranchModule.branch', 'Запись удалена!')
                );

                // если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
                if (!Yii::app()->getRequest()->getIsAjaxRequest()) {
                    $this->redirect(Yii::app()->getRequest()->getPost('returnUrl', ['index']));
                }
            } else
                throw new CHttpException(400, Yii::t('BranchModule.branch', 'Неверный запрос. Пожалуйста, больше не повторяйте такие запросы'));
        } else {
            throw new CHttpException(403,  'Ошибка прав доступа.');
        }
    }
    
    /**
    * Управление Филиалами.
    *
    * @return void
    */
    public function actionIndex()
    {
        $roles = ['1'];
        $role = \Yii::app()->user->role;
        if (array_intersect($role, $roles)){
            $model = new Branch('search');
            $model->unsetAttributes(); // clear any default values
            if (Yii::app()->getRequest()->getParam('Branch') !== null)
                $model->setAttributes(Yii::app()->getRequest()->getParam('Branch'));
            $this->render('index', ['model' => $model]);
        } else {
            throw new CHttpException(403,  'Ошибка прав доступа.');
        }
    }
    
    /**
    * Возвращает модель по указанному идентификатору
    * Если модель не будет найдена - возникнет HTTP-исключение.
    *
    * @param integer идентификатор нужной модели
    *
    * @return void
    */
    public function loadModel($id)
    {
        $model = Branch::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, Yii::t('BranchModule.branch', 'Запрошенная страница не найдена.'));

        return $model;
    }
}
