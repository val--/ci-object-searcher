<?php
class Search_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_results($keyword, $date, $category, $field, $order)
    {
        $this->db->select('o.name as name, o.category_id as category, o.created_at as date, c.name as category_name');
        $this->db->from('objects o, categories c');
        $this->db->where('o.category_id = c.category_id');
        $this->db->like('o.name', $keyword);

        if(isset($date) && !empty($date)){
            $newdate = DateTime::createFromFormat('j/m/Y', $date);
            $this->db->like('o.created_at', $newdate->format('Y-m-d'));
        }

        if(isset($category) && !empty($category)){
            $this->db->where('o.category_id', $category);
        }

        $this->db->order_by($field, $order);
        $query = $this->db->get();

        return $query->result_array();
    }

}