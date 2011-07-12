<?php
namespace Module\Site;
use Stackbox, Spot;

/**
 * Site entity - what properties define a site
 */
class Entity extends Stackbox\EntityAbstract
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 0;

    // Table
    protected static $_datasource = "sites";
    
    /**
     * Fields
     */
    public static function fields() {
        return array(
            'id' => array('type' => 'int', 'primary' => true, 'serial' => true),
            'reseller_id' => array('type' => 'int', 'index' => true, 'default' => 0),
            'shortname' => array('type' => 'string', 'required' => true, 'unique' => true),
            'title' => array('type' => 'string', 'required' => true),
            'theme' => array('type' => 'string'),
            'status' => array('type' => 'int', 'length' => 1, 'default' => self::STATUS_ACTIVE),
            'date_created' => array('type' => 'datetime'),
            'date_modified' => array('type' => 'datetime')
        );
    }
    
    /**
     * Relations
     */
    public static function relations() {
        return array(
            // Modules in regions on page
            'modules' => array(
                'type' => 'HasMany',
                'entity' => 'Module\Page\Module\Entity',
                'where' => array('site_id' => ':entity.site_id', 'page_id' => ':entity.id'),
                'order' => array('ordering' => 'ASC')
                )
        ) + parent::relations();
    }


    /**
     * Formats shortname on save
     * All lowercase, alphanumeric characters only
     */
    public function beforeSave(Spot\Mapper $mapper)
    {
        $this->__set('shortname', strtolower(preg_replace("/[^a-zA-Z0-9]/g", "", $this->__get('shortname'))));
        return parent::beforeSave($mapper);
    }


    /**
     * Get array of themes available to site for use
     */
    public function themes()
    {
        return array_map('trim', explode(',', $this->theme));
    }
}