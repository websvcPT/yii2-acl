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
 * This is the model class for table "w_modules".
 *
 * @property int $id
 * @property int $status
 * @property string $created_at
 * @property string $name
 * @property string $yii_module_id
 * @property string $url Relative URL
 * @property string $logo
 * @property string $icon
 * @property string $css_class
 * @property int $pos Position
 */
class Modules extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'w_modules';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'pos'], 'integer'],
            [['created_at'], 'safe'],
            [['name', 'yii_module_id', 'pos'], 'required'],
            [['name', 'yii_module_id', 'url', 'logo', 'icon', 'css_class'], 'string', 'max' => 255],
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
            'yii_module_id' => Yii::t('app', 'Yii Module ID'),
            'url' => Yii::t('app', 'Url'),
            'logo' => Yii::t('app', 'Logo'),
            'icon' => Yii::t('app', 'Icon'),
            'css_class' => Yii::t('app', 'Css Class'),
            'pos' => Yii::t('app', 'Pos'),
        ];
    }
}
