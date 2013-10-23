<?php

/**
 * This is the model class for table "point".
 *
 * The followings are the available columns in table 'point':
 * @property string $playerId
 * @property string $point
 * @property string $createTime
 * @property string $updateTime
 */
class MPoint extends CActiveRecord
{
    private $_changeMax;

    function __construct($scenario='insert')
    {
        $this->_changeMax = AP_CHANGEMAX;
        $ap = Util::loadConfig('ap');
        if (!empty($ap['changeMax'])) {
            $time = time();
            foreach ($ap['changeMax'] as $value) {
                $startTime = date('Y-m-d H:i:s',$value['startTime']);
                $endTime = date('Y-m-d H:i:s',$value['endTime']);
                if ($time>=$startTime && $time<$endTime) {
                    $this->_changeMax = $value['changeMax'];
                }
            }
        } 
        parent::__construct($scenario);
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return MPoint the static model class
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
        return 'point';
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

    public function updatePoint($value, $refreshTime)
    {
        $this->point = $value;
        $this->refreshTime = $refreshTime;
        $this->saveAttributes(array('point', 'refreshTime'));
    }

    public  function getValue($time=NULL)
    {
        if (empty($time)) {
            $time = time();
        }
        if($this->point<$this->_changeMax) {
            $value = min($this->point + (AP_CHANGEVALUE * intval(($time - $this->refreshTime) / AP_CHANGEINTERVAL)), $this->_changeMax);
        } else {
            $value = $this->point;
        }
        return $value;
    }

    public function getRemainTime()
    {
        $refreshTime = $this->_getRefreshTimestamp();

        if ($refreshTime>time()) {
            return AP_CHANGEINTERVAL;
        } else {
            return $refreshTime+AP_CHANGEINTERVAL-time();
        }
    }

    public function addValue($value, $time=NULL)
    {
        if(empty($time)){
            $time = time();
        }

        $this->point = $this->getValue($time) + $value;
        $this->point = min($this->point, AP_MAX);

        $refreshTime = $this->_getRefreshTimestamp($time);

        $this->updatePoint($this->point, $refreshTime);
    }

    public function subValue($value, $time=NULL)
    {
        if(empty($time)){
            $time = time();
        }

        $value = $this->getValue($time) - $value;
        if ($value<0) {
            throw new MException(Yii::t('Player', 'ap is not enough')); //行动力不足 
        }

        if($this->getValue($time) >= $this->_changeMax){
            //The old value was stopped on max, restart update from the time of 
            //being substracted.
            $refreshTime = $time;
        }else{
            $refreshTime = $this->_getRefreshTimestamp($time);
        }
        $this->updatePoint($value, $refreshTime);
    }

    public function sub()
    {
        $this->subValue(1, time());
    }
    
    public function add()
    {
        $this->addValue(1, time()); 
    }

    public function reMax($time=NULL)
    {
        if (empty($time)) {
            $time = time();
        }

        $this->updatePoint(AP_MAX, $time);
    }

    protected function _getRefreshTimestamp($time=NULL)
    {
        if(empty($time)){
            $time = time();
        }
        if ($this->getValue($time) >= $this->_changeMax) {
            $refreshTimestamp = time();
        } else {
            $refreshTimestamp = $this->refreshTime + intval(($time - $this->refreshTime)/AP_CHANGEINTERVAL) * AP_CHANGEINTERVAL;
        }

        return $refreshTimestamp;
    }

    public function check()
    {
        $time = time();
        if ($this->getValue($time) <= 0) {
            throw new MException(Yii::t('Player', '行动力不足')); //行动力不足
        }
        return ;
    }

    public function getAutoMax()
    {
        return AP_CHANGEMAX; 
    }
}
