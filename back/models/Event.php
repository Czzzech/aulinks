<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property string $id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property string $description
 * @property string $author
 * @property string $status
 * @property string $color
 *
 * @property User $author0
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public function extraFields()
    {
        return ['author0', 'user' => function($model){
            return $model->author->user;
        }];
    }

    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'start', 'end', 'description', 'author'], 'required'],
            [['start', 'end'], 'safe'],
            [['description', 'status'], 'string'],
            [['author'], 'integer'],
            [['title'], 'string', 'max' => 50],
            [['color'], 'string', 'max' => 10],
            [['author'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Name',
            'start' => 'StartTime',
            'end' => 'EndTime',
            'description' => 'Description',
            'author' => 'Author',
            'status' => 'Status',
            'color' => 'Color',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor0()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    public function updateStatuses(){
        $timestamp = time();
        $events = $this->find()->each();
        foreach($events as $event){
            $changes = false;
            $eventStart = strtotime($event->start);
            $eventEnd = strtotime($event->end);

            if($eventStart < $timestamp){
                if($eventEnd > $timestamp){
                    if($event->status !== 'inprogress') {
                        $event->status = 'inprogress';
                        $changes = true;
                    }
                }else{
                    if($event->status !== 'done') {
                        $event->status = 'done';
                        $changes = true;
                    }
                }
            }else{
                if($event->status !== 'new') {
                    $event->status = 'new';
                    $changes = true;
                }
            }
            if($changes)
                $event->update();
        }
    }
}
