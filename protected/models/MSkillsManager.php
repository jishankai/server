<?php

/** 
* @file MSkillsManager.php
* @brief
* @author Ji Shankai
* @version 1.0
* @date 2012-11-08
 */
class MSkillsManager extends CActiveRecordBehavior
{
    private $_skills;

    public function initSkills()
    {
        $skills = new MSkills;
        $skills->playerId = $this->owner->playerId;
        $skills->skills = AP_VALUE;
        $skills->createTime = $this->owner->createTime;
        $skills->save();
    }

    public function getSkills()
    {
        if (isset($this->_skills)) {
            return $this->_skills;
        }
        return $this->_skills = MSkills::model()->findByPk($this->owner->playerId);
    }
}
