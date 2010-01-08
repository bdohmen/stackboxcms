<?php
class Module_Page_Module_Mapper extends Cx_Mapper
{
	// Custom row class
	protected $_entityClass = 'Module_Page_Module_Entity';
	
	// Setup table and fields
	protected $source = "page_modules";
	
	// Fields
	public $id = array('type' => 'int', 'primary' => true);
	public $page_id = array('type' => 'int', 'key' => true);
	public $region = array('type' => 'string', 'required' => true);
	public $name = array('type' => 'string', 'required' => true);
	public $date_created = array('type' => 'datetime');
}


// Custom entity object
class Module_Page_Module_Entity extends Cx_Mapper_Entity
{
	
}