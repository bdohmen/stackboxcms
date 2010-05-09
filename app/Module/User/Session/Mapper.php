<?php
class Module_User_Session_Mapper extends Cx_Module_Mapper
{
	// Table
	protected $_datasource = "user_session";
	
	// Fields
	public $user_id = array('type' => 'int', 'key' => true, 'required' => true);
	public $session_id = array('type' => 'string', 'required' => true, 'key' => true);
	public $date_created = array('type' => 'datetime');
	
	// User session/login
	public $user = array(
		'type' => 'relation',
		'relation' => 'HasOne', // Actually a 'BelongsTo', but that is currently not implemented in phpDataMapper
		'mapper' => 'Module_User_Mapper',
		'where' => array('id' => ':entity.user_id')
	);
}