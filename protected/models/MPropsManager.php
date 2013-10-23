<?php

/** 
* @file MPropsManager.php
* @brief
* @author Ji Shankai
* @version 1.0
* @date 2012-11-08
 */
class MPropsManager extends CActiveRecordBehavior
{
    private $_props;
    private $_battleProps;

    public function initProps()
    {
        $arr = Util::loadConfig('props');

        foreach ($arr as $key=>$value) {
            MProps::createProps($this->owner->playerId, $key, $value['total'], PROPS_OPERATE_SENT);
        }
    }

    public function getProps()
    {
        if (isset($this->_props)) {
            return $this->_props;
        }
        $records = MProps::model()->findAllbyAttributes(array('playerId'=>$this->owner->playerId));
        foreach ($records as $record) {
            $this->_props[$record->propsId] = intval($record->num);
        }
        return $this->_props;
    }

    public function getBattleProps() {
        if (isset($this->_battleProps)) {
            return $this->_battleProps;
        }
        $this->_battleProps = $this->getProps();
        unset($this->_battleProps[PROPS_CP_ID]);

        return $this->_battleProps;
    }

    public function usePropsQueue($props)
    {
        $newProps = array();

        $sProps = $this->getProps();
        $arr = explode('a', $props);
        foreach ($arr as $value) {
            $item = explode('_', $value);
            if ($item[1] <= $sProps[$item[0]]) {
                $newProps[$item[0]] = MProps::useProps($this->owner->playerId, $item[0], $item[1]);
            } else {
                return NULL; //判断作弊
            }
        }

        return $newProps;
    }
}
