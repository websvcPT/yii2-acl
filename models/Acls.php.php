<?php
/**
 * This file is part of the Acl package.
 *
 * (c) Nelson Dias - WebsvcPT
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace websvc\acl\models;

use Yii;

/**
 * This is the model class for table "w_acls".
 *
 * @property int $id
 * @property int $status
 * @property string $created_at
 * @property int $module_id
 * @property int $parent_id
 * @property string $controlleraction
 * @property string $type
 * @property string $name
 * @property string $url
 * @property string $description
 * @property int $pos
 * @property string $css_class
 * @property string $user_function PUF=php user function
 */
class Acls extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_acls';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'module_id', 'parent_id', 'pos'], 'integer'],
            [['created_at'], 'safe'],
            [['module_id', 'controlleraction', 'type'], 'required'],
            [
                ['controlleraction', 'type', 'name', 'url', 'description', 'css_class', 'user_function'],
                'string',
                'max' => 255
            ],
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
            'module_id' => Yii::t('app', 'Module ID'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'controlleraction' => Yii::t('app', 'Controlleraction'),
            'type' => Yii::t('app', 'Type'),
            'name' => Yii::t('app', 'Name'),
            'url' => Yii::t('app', 'Url'),
            'description' => Yii::t('app', 'Description'),
            'pos' => Yii::t('app', 'Pos'),
            'css_class' => Yii::t('app', 'Css Class'),
            'user_function' => Yii::t('app', 'Function'),
        ];
    }
}
