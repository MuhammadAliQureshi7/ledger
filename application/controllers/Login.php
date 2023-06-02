<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if($this->session->userdata('id')){
            return redirect('admin/dashboard');
        }
    }
    public function index(){
        $this->form_validation->set_rules('user','User Name','required');
        $this->form_validation->set_rules('pass','Password','required|max_length[12]');
        
        if($this->form_validation->run()){
            $user=$this->input->post('user');
            $pass=$this->input->post('pass');

            $this->load->model('loginmodel');
            $login_id=$this->loginmodel->isvalidate($user,$pass);
            if($login_id){
                $this->session->set_userdata('id',$login_id);
                return redirect('admin/dashboard');
            }
            else{
                $this->session->set_flashdata('login_failed','Invalid Username/Password');
                return redirect('login');
            }
        }
        else{
            $data['title']="Admin Login";
            $this->load->view('admin/login', $data);    
        }
    }   

   
}

/*          
           
           
          
           if($login_id){
             $this->session->set_userdata('id',$login_id);
             return redirect('admin/welcome');
           }
           else{
             $this->session->set_flashdata('Login_Failed','Invalid Username/Password');
             return redirect('login');
           }*/