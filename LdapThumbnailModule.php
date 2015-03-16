<?php


class LdapThumbnailModule extends HWebModule
{
    public function getConfigUrl()
    {
        return Yii::app()->createUrl('//ldap_thumbnail/admin/index');
    }

    public function enable()
    {
        $ldapEnabled = HSetting::Get('enabled', 'authentication_ldap');
        $extensionLoaded = extension_loaded('ldap');

        if ($ldapEnabled && $extensionLoaded) {
            parent::enable();
        } else {
            $msg = Yii::t('LdapThumbnailModule.errors', 'could.not.enable');

            if (!$extensionLoaded) {
                $msg .= Yii::t('LdapThumbnailModule.errors', 'could.not.enable.extension');
            }
            if (!$ldapEnabled) {
                $msg .= Yii::t('LdapThumbnailModule.errors', 'could.not.enable.auth');
            }
            throw new CHttpException(400, $msg);
        }
    }
}

