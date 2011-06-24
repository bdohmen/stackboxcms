<?php
namespace Module\Blog;
use Stackbox;

class Entity extends Stackbox\Module\EntityAbstract
{
    protected static $_datasource = "module_blog";
    
    /**
     * Fields
     */
    public static function fields()
    {
        return array_merge(parent::fields(), array(
            'title' => array('type' => 'string', 'required' => true),
            'description' => array('type' => 'text')
        ));
    }
}