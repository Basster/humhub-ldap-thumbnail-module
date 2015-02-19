<?php


class LdapThumbnailModule extends HWebModule
{
    public static function handleLdapUser(CEvent $event)
    {
        try {
            /** @var User $user */
            $user = $event->sender;
            /** @var HLdap $ldap */
            $ldap           = HLdap::getInstance();
            $dn             = $ldap->ldap->getBoundUser();
            $ldapUser       = $ldap->ldap->getNode($dn);
            $thumbnailPhoto = $ldapUser->getAttribute('thumbnailphoto', 0);

            if ($thumbnailPhoto) {
                $profileImage = new ProfileImage($user->guid);
                if (!file_exists($profileImage->getPath())) {
                    $file = tempnam(sys_get_temp_dir(), 'intrahub');
                    $fp   = fopen($file, 'w');
                    fwrite($fp, $thumbnailPhoto);
                    fclose($fp);
                    $profileImage->setNew($file);
                }
            }
        }
        catch (\Exception $ex) {

        }
    }
}

