<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('search_model');
		$this->load->model('category_model');
	}

	public function index()
	{
		$data['categories'] = $this->category_model->get_all_categories();
		$this->load->view('search_engine', $data);
	}

	public function do_search()
    {
        $keyword = $_POST['keyword'];
        $date = $_POST['date'];
        $category = $_POST['category'];

        // par défaut on trie par nom (ordre alphabétique ascendant), sinon on récupère ce qui a été envoyé dans la requête POST
        $field = isset($_POST['field']) ? $_POST['field'] : 'name';
        $order = isset($_POST['order']) ? $_POST['order'] : 'asc';

        // récupération de tous les noms de catégories pour le menu déroulant (tri par catégories)
        $data['categories'] = $this->category_model->get_all_categories();
        $data['results'] = $this->search_model->get_results($keyword, $date, $category, $field, $order);
        $this->load->view('search_results', $data);
    }

}
