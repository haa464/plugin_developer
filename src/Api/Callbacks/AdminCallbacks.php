<?php 
/**
 * @package  AlecadddPlugin
 */
namespace TSW\Api\Callbacks;

class AdminCallbacks {
    public function adminDashboard()
	{
		return require_once( TSW_PLUGIN_DIR . 'templates/admin.php' );
	}

	public function adminCpt()
	{
		return require_once( TSW_PLUGIN_DIR . 'templates/cpt.php' );
	}

	public function adminTaxonomy()
	{
		return require_once( TSW_PLUGIN_DIR . 'templates/taxonomy.php' );
	}

	public function adminWidget()
	{
		return require_once( TSW_PLUGIN_DIR . 'templates/widget.php' );
	}
}