<?php
/**
 * This file is part of the Acl package.
 *
 * (c) Nelson Dias - WebsvcPT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WebsvcAcl\models;

use Yii;

/**
 * This is the model class for table "w_groups".
 *
 * @property int $id
 * @property int $status
 * @property string $created_at
 * @property string $name
 * @property int $level Higher is more power
 */
class Groups extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_groups';
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
            'created_at' => Yii::t('app', 'Created At'),
            'name' => Yii::t('app', 'Name'),
            'level' => Yii::t('app', 'Level'),
        ];
    }
}
