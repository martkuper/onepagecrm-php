<?php

namespace MartKuper\OnePageCRM\Contact;

/**
 * ContactAddressList class
 *
 * Contains a OnePageCRM address
 *
 * @package onepagecrm-php
 * @author Mart Kuper
 * @version 0.5.4
 */
class ContactTag {

    /**
     * Random ID
     * @var  string
     */
    private $id;

    /**
     * @var string Name of the tag
     */
    private $tag_name;

    /**
     * Initialize class variables
     * @param array $data The data to initialize the class with
     */
    public function __construct($data = null)
    {
        $this->id = uniqid();

        if(!empty($data)) {
            $this->tag_name = $data;
        }
    }

    /**
     * Exports the class variables to an array
     * @return array Array of class variables
     */
    public function toArray()
    {
        $keys = [
            'tag_name'
        ];

        $return = [];

        foreach ($keys as $key) {
            if(!empty($this->$key)) {
                $return[$key] = $this->$key;
            }
        }

        return $return;
    }

    public function toString($delimiter = null)
    {
        if(empty($delimiter)) {
            $delimiter = ',';
        }
        $to_array = $this->toArray();
        $array = [];

        foreach ($to_array as $key => $value) {
            $array[] = $value;
        }
        return implode($delimiter, $array);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTagName()
    {
        return $this->tag_name;
    }

    public function setTagName($tag_name)
    {
        $this->tag_name = $tag_name;
    }
}