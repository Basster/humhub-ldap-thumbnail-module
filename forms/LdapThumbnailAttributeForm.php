<?php


class LdapThumbnailAttributeForm extends CFormModel
{

    public $ldapAttribute;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return [
            ['ldapAttribute', 'required'],
        ];
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return [
            'ldapAttribute' => Yii::t('LdapThumbnailModule.forms', 'label.attribute'),
        ];
    }

}
