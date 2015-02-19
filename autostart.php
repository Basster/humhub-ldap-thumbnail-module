<?php
Yii::app()->moduleManager->register(
    [
        'id'           => 'ldap_thumbnail',
        'class'        => 'application.modules.ldap_thumbnail.LdapThumbnailModule',
        'import' => [
            'application.modules.ldap_thumbnail.services.*',
        ],
        // Events to Catch
        'events' => [
            ['class'    => 'User',
             'event'    => 'onAfterSave',
             'callback' => ['LdapUserProfileImageHandler', 'handleLdapUser']
            ],
        ],
    ]);
?>
