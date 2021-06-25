<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Shop_stamps_relations_model extends Base_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->table = 'Shop_stamps_relations';
    }

}