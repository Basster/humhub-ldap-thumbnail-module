<?php


class LdapThumbnailModule extends HWebModule
{
    public function getConfigUrl()
    {
        return Yii::app()->createUrl('//ldap_thumbnail/admin/index');
    }
}

