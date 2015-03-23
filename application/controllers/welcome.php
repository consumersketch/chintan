<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
    {
        parent::__construct();
		$this->load->model('welcomemodel');
    } 
	 
	public function index()
	{
	  	//Call Model function to populate client dropdown
	   	$data['client_data'] = $this->welcomemodel->getAllclients();
		$this->load->view('welcome_message',$data);
	}
	public function getproducts($id=0)
	{
	   	//Call Model function to populate products dropdown based on client dropdown selection.
		$data['product_data'] = $this->welcomemodel->getAllProducts($id);
	}
	public function generatereport($client_id=0,$date_id=0)
	{
	   	 //Call Model function to generate report data based on filters applied.
		 $this->welcomemodel->generatereport($client_id,$date_id);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */