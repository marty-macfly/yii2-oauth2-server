<?php

namespace macfly\oauth2server\behaviors;

use Yii;

class BlameableBehavior extends \yii\behaviors\BlameableBehavior
{
    /**
     * @inheritdoc
     */
    public $createdByAttribute = 'user_id';
    /**
     * @inheritdoc
     */
    public $updatedByAttribute = false;

    /**
     * @inheritdoc
     */
    protected function getValue($event)
    {
        $createdByAttribute = $this->createdByAttribute;
        if ($event->name == 'beforeInsert' && !empty($this->owner->$createdByAttribute)) {
            return $this->owner->$createdByAttribute;
        }

        return parent::getValue($event);
    }
}
