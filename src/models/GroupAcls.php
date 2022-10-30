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
 * This is the model class for table "acl_group".
 *
 * @property int $id
 * @property int $group_id
 * @property int $acl_id
 */
class GroupAcls extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_group_acls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id', 'acl_id'], 'required'],
            [['group_id', 'acl_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'acl_id' => Yii::t('app', 'Acl ID'),
        ];
    }
}
