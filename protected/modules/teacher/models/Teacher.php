<?php

/**
 * This is the model class for table "{{user_teacher}}".
 *
 * The followings are the available columns in table '{{user_teacher}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $branch_id
 * @property string $start_time
 * @property string $end_time
 *
 * The followings are the available model relations:
 * @property ListnerPosition[] $listnerPositions
 * @property BranchBranch $branch
 * @property UserUser $user
 * @property UserTeacherToSubject[] $userTeacherToSubjects
 */
class Teacher extends yupe\models\YModel
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_teacher}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, branch_id', 'numerical', 'integerOnly'=>true),
			array('start_time, end_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, branch_id, start_time, end_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'groups' => [self::HAS_MANY, 'Group', 'teacher_id'],
			'user' => [self::BELONGS_TO, 'User', 'user_id'],
			'subject' => [self::HAS_MANY, 'TeacherToSubject', 'teacher_id'],
                        'branch' => [self::BELONGS_TO, 'Branch', 'branch_id'],
                        'position' => [self::HAS_MANY, 'Position', 'teacher_id'],
                        'schedule'=>[self::HAS_MANY, 'Schedule', 'teacher_id'],                  
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'user_id' => 'Имя',
                        'start_time' => 'Начало рабочего дня',
                        'end_time' => 'Конец рабочего дня',
                        'branch_id' => 'Филиал'
		);
	}

        /**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.


		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('branch_id',$this->branch_id);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('is_test', $this->is_test);
		$criteria->compare('end_time',$this->end_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getHours(){
		$a = Yii::app()->db->createCommand()
			->select('count(b.id) as hours')
			->from('spbp_listner_position a')
			->join('spbp_listner_schedule b', 'b.position_id = a.id')
			->where('(a.teacher_id =:id) and (b.end_time < now())and (a.is_test = 0)', [':id' =>$this->id])
			->queryRow();
		return $a['hours'];
	}
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Teacher the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
