<?php 

namespace TSW\includes;
use TSW\Api\SettingApi;
use TSW\Api\Callbacks\AdminCallbacks;

class Admin {

    public $settings;

	public $callbacks;

    public $pages = array();

    public $subpages = array();

    public function register() {
        $this->settings = new SettingApi();

       $this->callbacks = new AdminCallbacks();

		$this->setPages();

		$this->setSubpages();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

    public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'Twilio Sender', 
				'menu_title' => 'Twilio Sender', 
				'capability' => 'manage_options', 
				'menu_slug' => 'twilio_sender', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-store', 
				'position' => 110
			)
		);
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'twilio_sender', 
				'page_title' => 'Custom Post Types', 
				'menu_title' => 'CPT', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_cpt', 
				'callback' => function() { echo '<h1>CPT Manager</h1>'; }
			),
			array(
				'parent_slug' => 'twilio_sender', 
				'page_title' => 'Custom Taxonomies', 
				'menu_title' => 'Taxonomies', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_taxonomies', 
				'callback' => function() { echo '<h1>Taxonomies Manager</h1>'; }
			),
			array(
				'parent_slug' => 'twilio_sender', 
				'page_title' => 'Custom Widgets', 
				'menu_title' => 'Widgets', 
				'capability' => 'manage_options', 
				'menu_slug' => 'alecaddd_widgets', 
				'callback' => function() { echo '<h1>Widgets Manager</h1>'; }
			)
		);
	}
}