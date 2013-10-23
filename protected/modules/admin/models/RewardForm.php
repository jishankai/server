<?php

class RewardForm extends CFormModel
{
    public $playerName;
    public $props;
    public $desc;

    public function rules()
    {
        return array(
            array('playerName, props, desc', 'required'),
            array('props', 'stylish_item', 'message'=>'道具格式不正确'),
        );
    }

    public function attributeLabels()
	{
		return array(
            'playerName'=>'玩家名',
            'props' => '道具',
            'desc' => '描述',
		);
	}

    public function sendRewards()
    {
        $playerIds = Yii::app()->db->createCommand("SELECT playerId FROM player WHERE name IN ($this->playerName)")->queryColumn();  

        foreach ($playerIds as $playerId) {
            BPMail::create($playerId, $this->desc, $this->props);
        }

        return TRUE;
    }

    public function stylish_item($attribute, $params)
    {
        $string = $this->$attribute;
        if($string == '') {
            return ;
        }
        $pattern = '/^100[1-3]_\d+$/u';
        if (preg_match($pattern, $string)) {
            return ;
        } else {
            $this->addError($attribute, $params['message']);
        }
        
    }
}
