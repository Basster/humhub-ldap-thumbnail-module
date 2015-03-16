<div class="panel panel-default">
    <div class="panel-heading"><?php echo Yii::t('LdapThumbnailModule.forms', 'title'); ?></div>
    <div class="panel-body">

        <?php
        $form = $this->beginWidget('CActiveForm',
            [
                'id' => 'ldap-thumbnail-attribute-form',
                'enableAjaxValidation' => true,
            ]);
        ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'ldapAttribute'); ?>
            <?php echo $form->textField($model, 'ldapAttribute', ['class' => 'form-control']); ?>
            <?php echo $form->error($model, 'ldapAttribute'); ?>
        </div>

        <hr>

        <?php echo CHtml::submitButton(Yii::t('LdapThumbnailModule.forms', 'save'), ['class' => 'btn btn-primary']); ?>
        <a class="btn btn-default" href="<?php echo $this->createUrl('//admin/module'); ?>">
            <?php echo Yii::t('LdapThumbnailModule.forms', 'back.to.modules'); ?>
        </a>

        <?php $this->endWidget(); ?>

    </div>
</div>
