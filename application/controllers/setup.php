<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class setup extends CI_Controller {

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct()
    {  
        parent::__construct();
		include FCPATH . '/config/variabel.php';
		
		$this->load->dbforge();
    }
	
	public function index()
	{
		$data 			= $this->data;
		
		$this->load->view('setup_view', $data);
	}
	
	function create_table_blog(){
                $fields = array(
                'blog_id' => array(
                        'type' => 'INT',
                        'constraint' => 5,
                        'unsigned' => TRUE,
                        'auto_increment' => TRUE
                ),
                'blog_title' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '100',
                        'unique' => TRUE,
                ),
                'blog_author' => array(
                        'type' =>'VARCHAR',
                        'constraint' => '100',
                        'default' => '',
                ),
                'blog_description' => array(
                        'type' => 'TEXT',
                        'null' => TRUE,
                ),
                );
                $this->dbforge->add_key('blog_id', TRUE);
                $this->dbforge->add_field($fields);
                $this->dbforge->create_table('tbl_blog');
                echo $this->session->set_flashdata('msg','Table Blog Created!');
                redirect('setup');
        }
 
        function create_table_user(){
                $fields = array(
                'user_id' => array(
                        'type' => 'INT',
                        'constraint' => 5,
                        'unsigned' => TRUE,
                        'auto_increment' => TRUE
                ),
                'user_username' => array(
                        'type' => 'VARCHAR',
                        'constraint' => '50',
                        'unique' => TRUE,
                ),
                'user_password' => array(
                        'type' =>'VARCHAR',
                        'constraint' => '100',
                ),
                 
                );
                $this->dbforge->add_key('user_id', TRUE);
                $this->dbforge->add_field($fields);
                $this->dbforge->create_table('tbl_user');
                echo $this->session->set_flashdata('msg','Table User Created!');
                redirect('setup');
        }
}
