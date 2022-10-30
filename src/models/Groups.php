<?php
/**
 * This file is part of the Acl package.
 *
 * (c) WebsvcPT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace websvc\acl\models;

use Yii;

/**
 * This is the model class for table "sys_groups".
 *
 * @property int $id
 * @property int $status
 * @property string $name
 * @property int $level Higher means more power
 * @property string $created_at
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_groups';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'level'], 'integer'],
            [['created_at'], 'safe'],
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'status' => Yii::t('app', 'Status'),
            'name' => Yii::t('app', 'Name'),
            'level' => Yii::t('app', 'Level'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
