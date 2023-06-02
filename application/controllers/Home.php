<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
    public function index(){
        $this->load->model('loginmodel');
        $this->form_validation->set_rules('category', ' Category','required');
		$this->form_validation->set_rules('amount', ' Amount','required');		
		$this->form_validation->set_rules('note', ' Note','required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
		if($this->form_validation->run())
		{
			
			$post = $this->input->post();
			//date_default_timezone_set("Asia/Karachi");
			$post['date'] = date('d-M-y H:i:s', time());						
			$post['transaction_id']=rand(10000,99999);

			if($this->loginmodel->insert_request($post))
			{
			$this->session->set_flashdata('msg_news', 'Your Post Added Successfully !');
			$this->session->set_flashdata('msg_news_class', 'alert-success');
			
			}
			else
			{
			$this->session->set_flashdata('msg_news', 'Your Post Not Added !');
			$this->session->set_flashdata('msg_news_class', 'alert-danger');
			}
			return redirect('home/index');
		}
		else
		{
			$data['title']="Welcome to Ledger";
		    $this->load->view('users/index',$data);
		}

        
    }
    
}