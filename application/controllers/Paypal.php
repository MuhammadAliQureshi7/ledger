<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Paypal extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            return redirect('userlogin/index');
        }
    }
    public function success(){
        $post=$this->input->post();        
        /*echo "<pre>";
        print_r($post);
        exit;*/
        unset($post['id']);   
        unset($post['transaction_id']);
        unset($post['category']);
        unset($post['amount']);
        unset($post['note']);
        unset($post['date']);
        unset($post['user']);
        unset($post['admin']);        
        unset($post['note__response']);        
        $id = $post['custom'];
        $data['amount_response']=$post['mc_gross'];
        $data['date_response']=date('d-M-y H:i:s', time());
        $this->load->model('loginmodel');
        $this->loginmodel->insert_response($id,$data);
        $data['title']="Response to Request";
        return redirect('user/dashboard');

    }
    public function cancel(){        
        $this->load->view('users/cancel');
    }
    public function ipn(){
        $data=$this->input->post();
        $this->load->library('paypal_lib');
        $paypalURL = $this->paypal_lib->paypal_url;
        $result = $this->paypal_lib->curlPost($paypalURL,$data);
        if(preg_match("/Verified/i",$result)){
            $this->load->model('loginmodel');
            $this->loginmodel->insertTransaction($data);
        }        
    }
    
}