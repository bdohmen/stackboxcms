<?php
/**
 * Base application module controller
 * Used as a base module class other modules must extend from
 */
abstract class Cx_Module_Controller_Abstract extends Alloy_Module_Controller
{
	/**
	 * Access control list for controller methods
	 */
	public function acl()
	{
		return array(
			'view' => array('index', 'view', 'get', 'indexAction', 'viewAction', 'getMethod'),
			'edit' => array('new', 'edit', 'delete', 'post', 'put', 'newAction', 'editAction', 'deleteAction', 'postMethod', 'putMethod', 'deleteMethod')
			);
	}
	
	
	/**
	 * Authorize user to execute action
	 */
	public function userCanExecute(Module_User_Entity $user, $action)
	{
		// Default role for all users
		$roles = array('view');
		
		// Add roles for current user
		if($user && $user->isLoggedIn()) {
			if($user->isAdmin()) {
				return true; // Admin users can always do everything
				$roles = array('view', 'edit', 'admin');
			}
		}
		
		// Get required role to execute requested action
		$requiredRole = null;
		foreach($this->acl() as $role => $acl) {
			if(in_array($action, $acl)) {
				$requiredRole = $role;
				break;
			}
		}
		
		// If required role is in user's roles
		if(in_array($requiredRole, $roles)) {
			return true;
		}
		
		return false;
	}
	
	
	/**
	 * Return view object for the add/edit form
	 */
	protected function formView()
	{
		$fields = $this->kernel->mapper()->fields("Module_" . $this->name() . "_Entity");
		$view = new Alloy_View_Generic_Form('form');
		$view->action("")
			->fields($fields)
			->removeFields(array('id', 'site_id', 'module_id', 'date_created', 'date_modified'));
		return $view;
	}
}