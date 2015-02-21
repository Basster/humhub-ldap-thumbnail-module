<?php


class LdapUserProfileImageHandler
{
    const SETTINGS_MODULE = 'ldap_thumnail';
    const LDAP_ATTRIBUTE = 'ldap_attribute';
    const DEFAULT_ATTRIBUTE = 'thumbnailphoto';

    /**
     * @var Zend_Ldap
     */
    private $ldap;
    /**
     * @var string
     */
    private $imageAttribute;

    /**
     * @param Zend_Ldap $zendLdap
     * @param           $profileImageLdapAttribute
     */
    private function __construct(Zend_Ldap $zendLdap, $profileImageLdapAttribute)
    {
        $this->ldap           = $zendLdap;
        $this->imageAttribute = $profileImageLdapAttribute;
    }

    /**
     * @param User $user
     */
    public function pullImage(User $user)
    {
        $dn             = $this->ldap->getBoundUser();
        $ldapUser       = $this->ldap->getNode($dn);
        $thumbnailPhoto = $ldapUser->getAttribute($this->imageAttribute, 0);

        if ($thumbnailPhoto) {
            $profileImage = new ProfileImage($user->guid);
            if (!file_exists($profileImage->getPath())) {
                $file = $this->storeProfileImage($thumbnailPhoto);
                $profileImage->setNew($file);
                @unlink($file)
            }
        }
    }

    /**
     * @param CEvent $event
     */
    public static function handleLdapUser(CEvent $event)
    {
        /** @var User $user */
        $user          = $event->sender;
        $hLdap         = HLdap::getInstance();
        $ldapAttribute = HSetting::Get(self::LDAP_ATTRIBUTE, self::SETTINGS_MODULE) ?: self::DEFAULT_ATTRIBUTE;
        $handler       = new self($hLdap->ldap, $ldapAttribute);

        try {
            $handler->pullImage($user);
        } catch (\Exception $ex) {

        }
    }

    /**
     * @param $thumbnailPhoto
     *
     * @return string
     */
    private function storeProfileImage($thumbnailPhoto)
    {
        $file = tempnam(realpath(sys_get_temp_dir()), 'humhub');
        $fp   = fopen($file, 'w');
        fwrite($fp, $thumbnailPhoto);
        fclose($fp);

        return $file;
    }
}
