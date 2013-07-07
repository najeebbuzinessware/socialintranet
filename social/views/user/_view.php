<div class="view"> 

   
    <b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
    <?php echo CHtml::encode($data->Name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('Nick')); ?>:</b>
    <?php echo CHtml::encode($data->Nick); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
    <?php echo CHtml::encode($data->Email); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('Password')); ?>:</b>
    <?php echo CHtml::encode($data->Password); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('PhoneNo')); ?>:</b>
    <?php echo CHtml::encode($data->PhoneNo); ?>
    <br />

    <?php /*
    <b><?php echo CHtml::encode($data->getAttributeLabel('Avatar')); ?>:</b>
    <?php echo CHtml::encode($data->Avatar); ?>
    <br />
 */ ?>
    <b><?php echo CHtml::encode($data->getAttributeLabel('Bio')); ?>:</b>
    <?php echo CHtml::encode($data->Bio); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('Department')); ?>:</b>
    <?php echo CHtml::encode(TblDepartments::model()->findByPk($data->Department)->Department); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('JobTitle')); ?>:</b>
    <?php echo CHtml::encode($data->JobTitle); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('TimeZone')); ?>:</b>
    <?php echo CHtml::encode($data->TimeZone); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('Zoom')); ?>:</b>
    <?php echo CHtml::encode($data->Zoom); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('Preferences')); ?>:</b>
    <?php echo CHtml::encode($data->Preferences); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('Skills')); ?>:</b>
    <?php echo CHtml::encode($data->Skills); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('Language')); ?>:</b>
    <?php echo CHtml::encode($data->Language); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('UserInterface')); ?>:</b>
    <?php echo CHtml::encode($data->UserInterface); ?>
    <br />

   

</div>