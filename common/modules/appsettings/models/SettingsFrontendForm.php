<?php

class SettingsFrontendForm extends CFormModel
{
	public $config_logo;
	public $config_frontend_url;
	public $config_backlink_url;
	public $config_listlimit;
	public $config_link_color;
	public $config_border_color;
	public $config_nav_color;
	public $config_nav_hover;
	public $config_grad_start;
	public $config_grad_end;
	public $config_widgets;
	public $config_introtext;
	public $config_layout;
	public $config_background_image;
	
	public $config_show_frontend;
	public $config_frontend_type;
	public $config_frontend_username;
	public $config_frontend_password;
	public $config_frontend_startdate;
	public $config_frontend_enddate;
	public $config_frontend_offline_msg;
	public $config_display_list_type;
	
	public $config_frontend_starttime;
	public $config_frontend_endtime;
	
	public $config_twitter_widget;

	public $saveLaunchBtn;
	public $saveBrandingBtn;
	public $saveLayoutBtn;
	public $saveNotificationsBtn;
	
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            //array('config_link_color, config_border_color, config_nav_color, config_nav_hover, config_grad_start, config_grad_end, config_frontend_starttime, config_frontend_endtime, config_layout, config_backlink_url, config_frontend_url', 'required'),
			
			array('saveLaunchBtn', 'common.extensions.YiiConditionalValidator.YiiConditionalValidator',
            'validation'=>array('compare', 'compareValue'=>"Save Launch Changes"),
            'dependentValidations'=>array(
                'config_frontend_type,config_frontend_url,config_backlink_url,config_display_list_type,config_frontend_offline_msg'=>array(
                    array('required'),
                	),					
	            ),
    	    ),
			
			array('saveBrandingBtn', 'common.extensions.YiiConditionalValidator.YiiConditionalValidator',
            'validation'=>array('compare', 'compareValue'=>"Save Branding Changes"),
            'dependentValidations'=>array(
                'config_link_color, config_border_color, config_nav_color, config_nav_hover, config_grad_start, config_grad_end'=>array(
                    array('required'),
                	),					
	            ),
    	    ),
			
			array('saveLayoutBtn', 'common.extensions.YiiConditionalValidator.YiiConditionalValidator',
            'validation'=>array('compare', 'compareValue'=>"Save Layout Changes"),
            'dependentValidations'=>array(
                'config_layout'=>array(
                    array('required'),
                	),					
	            ),
    	    ),
			
			/*array('saveLaunchBtn', 'common.extensions.YiiConditionalValidator.YiiConditionalValidator',
            'if' => array(
                array('saveLaunchBtn', 'compare', 'compareValue'=>"Save Changes"),
            ),
            'then' => array(
                array('config_frontend_url', 'required'),
            ),
        ),
			
			array('config_show_frontend', 'common.extensions.YiiConditionalValidator.YiiConditionalValidator',
				'validation'=>array('compare', 'compareValue'=>"Yes"),
				'dependentValidations'=>array('config_frontend_type'=>array(array('required'),),),),
				
			array('config_frontend_type', 'common.extensions.YiiConditionalValidator.YiiConditionalValidator',
				'validation'=>array('compare', 'compareValue'=>"Private"),
				'dependentValidations'=>array('config_frontend_username, config_frontend_password'=>array(array('required'),),),),
				
			array('config_frontend_type', 'common.extensions.YiiConditionalValidator.YiiConditionalValidator',
				'validation'=>array('compare', 'compareValue'=>"Both"),
				'dependentValidations'=>array('config_frontend_username, config_frontend_password'=>array(array('required'),),),),
				
			array('config_show_frontend', 'common.extensions.YiiConditionalValidator.YiiConditionalValidator',
				'validation'=>array('compare', 'compareValue'=>"No"),
				'dependentValidations'=>array('config_frontend_offline_msg'=>array(array('required'),),),),*/
			
			array('config_link_color, config_border_color, config_nav_color, config_nav_hover, config_grad_start, config_grad_end, config_layout, config_frontend_type, config_frontend_startdate, config_frontend_enddate, config_frontend_username, config_frontend_password, config_twitter_widget, config_frontend_offline_msg ,config_frontend_url ,config_backlink_url ,config_listlimit,config_display_list_type','safe'),
		);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
			'config_logo' => 'Your Company Logo',
			'config_frontend_url' => 'Value',
			'config_backlink_url' => 'Value',
			'config_listlimit' => 'Value',
			'config_link_color' => 'Value',
			'config_border_color' => 'Value',
			'config_nav_color' => 'Value',
			'config_nav_hover' => 'Value',
			'config_grad_start' => 'Value',
			'config_grad_end' => 'Value',
			'config_widgets' => 'Value',
			'config_introtext' => 'Value',
			'config_layout' => 'Value',
			'config_show_frontend' => 'Value',
			'config_frontend_type' => 'Value',
			'config_frontend_username' => 'Value',
        	'config_twitter_widget' => 'Value',
			'config_frontend_password' => 'Value',
			'config_frontend_startdate' => 'Value',
			'config_frontend_enddate' => 'Value',
			'config_frontend_offline_msg' => 'Value',
        );
    }
}