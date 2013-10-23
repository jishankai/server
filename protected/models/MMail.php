<?php

class MMail extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MMail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
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
		);
	}

    public static function create($playerId, $desc, $gift, $from=MAIL_FROM_SYSTEM)
    {
        $mail = new MMail;
        $mail->playerId = $playerId;
        $mail->from = $from;
        $mail->desc = $desc;
        $mail->gift = $gift; 
        $mail->createTime = time();
        
        $mail->save();
    }

}
