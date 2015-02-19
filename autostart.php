<?php
Yii::app()->moduleManager->register(
    [
        'id'           => 'ldap_thumbnail',
        'class'        => 'application.modules.ldap_thumbnail.LdapThumbnailModule',
        'import' => array(
            'application.modules.ldap_thumbnail.*',
        ),
        // Events to Catch
        'events' => array(
            array('class' => 'User', 'event' => 'onAfterSave', 'callback' => array('LdapThumbnailModule', 'handleLdapUser')),
        ),
    ]);
?>
