<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "curse_words".
 *
 * @property int $id
 * @property string $word
 */
class CurseWords extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'curse_words';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['word'], 'required'],
            [['word'], 'string', 'max' => 255],
        ];
    }
}
