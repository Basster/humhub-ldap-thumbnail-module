<?php

class AdminController extends Controller
{

    public $subLayout = "application.modules_core.admin.views._layout";


    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'accessControl', // perform access control for CRUD operations
        ];
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return [
            [
                'allow',
                'expression' => 'Yii::app()->user->isAdmin()',
            ],
            [
                'deny', // deny all users
                'users' => ['*'],
            ],
        ];
    }

    /**
     * Configuration Action for Super Admins
     */
    public function actionIndex()
    {

        Yii::import('ldap_thumbnail.forms.*');
        Yii::import('ldap_thumbnail.services.*');

        $form = new LdapThumbnailAttributeForm;
        $form->ldapAttribute = HSetting::Get(LdapUserProfileImageHandler::LDAP_ATTRIBUTE,
                                             LdapUserProfileImageHandler::SETTINGS_MODULE);

        // Ajax Check of Form
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'ldap-thumbnail-attribute-form') {
            echo CActiveForm::validate($form);
            Yii::app()->end();
        }

        // Form Submitted
        if (isset($_POST['LdapThumbnailAttributeForm'])) {
            $form->attributes = $_POST['LdapThumbnailAttributeForm'];

            if ($form->validate()) {

                HSetting::Set(LdapUserProfileImageHandler::LDAP_ATTRIBUTE,
                              $form->ldapAttribute,
                              LdapUserProfileImageHandler::SETTINGS_MODULE);

                $this->redirect(Yii::app()->createUrl('ldap_thumbnail/admin/index'));
            }
        }

        $this->render('index', ['model' => $form]);
    }

}

?>
