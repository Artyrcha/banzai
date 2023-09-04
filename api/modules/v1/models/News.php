<?php

namespace api\modules\v1\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $text
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class News extends \yii\db\ActiveRecord
{
    private const CURSE_WORDS_REPLACEMENT = '...';
    private const PATTERN_DELETE_TAGS = '/<img[^>]*>/i';
    private const PATTERN_WRAPPER_LINK = '/(https?:\/\/[^\s]+)/i';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'text'], 'required'],
            [['description', 'text'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }


    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            $this->processText();
            return true;
        }

        return false;
    }


    private function processText()
    {
        $this->deleteTags();
        $this->replaceCurseWords();
        $this->wrapperLinks();
    }

    private function deleteTags()
    {
        $this->title = preg_replace(self::PATTERN_DELETE_TAGS, '', $this->title);
        $this->description = preg_replace(self::PATTERN_DELETE_TAGS, '', $this->description);
        $this->text = preg_replace(self::PATTERN_DELETE_TAGS, '', $this->text);
    }

    private function replaceCurseWords()
    {
        foreach (CurseWords::find()->select('word')->column() as $word) {
            $this->title = preg_replace("/\b$word\b/ui", self::CURSE_WORDS_REPLACEMENT, $this->title);
            $this->description = preg_replace("/\b$word\b/ui", self::CURSE_WORDS_REPLACEMENT, $this->description);
            $this->text = preg_replace("/\b$word\b/ui", self::CURSE_WORDS_REPLACEMENT, $this->text);
        }
    }

    private function wrapperLinks()
    {
        $this->title = preg_replace(self::PATTERN_WRAPPER_LINK, '<a href="$1">$1</a>', $this->title);
        $this->description = preg_replace(self::PATTERN_WRAPPER_LINK, '<a href="$1">$1</a>', $this->description);
        $this->text = preg_replace(self::PATTERN_WRAPPER_LINK, '<a href="$1">$1</a>', $this->text);
    }
}
