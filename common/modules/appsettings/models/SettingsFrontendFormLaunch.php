<?php

class SettingsFrontendFormLaunch extends CFormModel
{
	public $config_show_frontend;
	public $config_frontend_type;
	public $config_frontend_url;
	public $config_backlink_url;
	public $config_listlimit;
	public $config_introtext;
	public $config_frontend_username;
	public $config_frontend_password;
	public $config_frontend_startdate;
	public $config_frontend_enddate;
	public $config_frontend_offline_msg;
	public $config_frontend_starttime;
	public $config_frontend_endtime;

    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('config_backlink_url', 'required'),
			
			array('config_backlink_url','safe'),
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
			'config_frontend_password' => 'Value',
			'config_frontend_startdate' => 'Value',
			'config_frontend_enddate' => 'Value',
			'config_frontend_offline_msg' => 'Value',
        );
    }
}