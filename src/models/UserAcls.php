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
 * This is the model class for table "w_user_acls".
 *
 * @property int $id
 * @property int $user_id
 * @property int $acl_id
 * @property int $mode 1=add privileges;0=revoke privileges
 */
class UserAcls extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_user_acls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'acl_id'], 'required'],
            [['user_id', 'acl_id', 'mode'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'acl_id' => Yii::t('app', 'Acl ID'),
            'mode' => Yii::t('app', 'Mode'),
        ];
    }
}
