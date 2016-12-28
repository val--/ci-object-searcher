<?php
class Category_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_categories()
    {
        $this->db->select('*');
        $this->db->from('categories');
        $query = $this->db->get();

        return $query->result_array();
    }

}