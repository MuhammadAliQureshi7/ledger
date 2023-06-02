<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            return redirect('userlogin/index');
        }
    }
    public function index(){
        return redirect('users/dashboard');
    }
    public function dashboard(){
        $this->load->model('loginmodel');
        $data['user']=$this->loginmodel->get_userinfo(); 
        $data['balance']=$this->loginmodel->getbalanceamount();    
        $data['credit']=$this->loginmodel->getcreditamount();
        $data['requests']=$this->loginmodel->get_requests_user();       
        $data['title']="Welcome To The Ledger";
        $this->load->view('users/dashboard',$data);
    }
    public function make_request(){
        
        $this->load->model('loginmodel');
        $this->form_validation->set_rules('category', ' Category','required');						
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');        

        $config['upload_path']='./assets/uploads/';

        $config['allowed_types']='jpg|png|jpeg|PNG|gif|pdf';        

        $this->load->library('upload', $config);
        if($this->form_validation->run()){
            if($this->upload->do_upload('proof'))
		    {
			
                $post = $this->input->post();
                $post['user']=$this->session->userdata('id');
                $post['date'] = date('d-M-y H:i:s', time());            						
                $post['transaction_id']=rand(10000,99999);
                $data=$this->upload->data();
                
                $image_path="assets/uploads/".$data['raw_name'].$data['file_ext'];
                $post['proof']=$image_path;
                if($this->loginmodel->insert_request($post))
                {
                    $this->load->library('email');  
                    $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'smtp.gmail.com',
                        'smtp_port' => 587,
                        'smtp_crypto' => 'tls',
                        'smtp_user' => 'ledger.admin@patriotpacific.com', // change it to yours
                        'smtp_pass' => 'nkpjmkjbroyukgpp', // change it to yours
                        'smtp_timeout'=>60,
                        'mailtype' => 'html',
                        'newline' => "\r\n",
                        'charset' => 'utf-8',
                        'wordwrap' => TRUE
                    );       
                    $user_id = $this->session->userdata('id');
                    $email = $this->loginmodel->getuseremail($user_id);                                              
                    $this->email->initialize($config);
                    foreach($email as $email){
                        $message = "
                        <b>From:</b> ".$email->full_name."<br>
                        <b>Category :</b> ". $post['category']."<br>
                        <b>Amount :</b> $". $post['amount']."<br>
                        <b>Note :</b> " .$post['note']; 
                        $this->email->from($email->email, $email->full_name);
                        $this->email->to('ledger.admin@patriotpacific.com');
                        $this->email->subject('User Reimbursment Request');
                        $this->email->message($message);
                        //$this->email->attach(base_url('assets/uploads/'.$post['proof']));
                        if($this->email->send()){
                            return redirect('user/success');
                        }
                        else{
                            show_error($this->email->print_debugger());
                        }
                    }
                    
                
                }

                else
                {
                    $this->session->set_flashdata('msg_news', 'Your Request Not Sent !');
                    $this->session->set_flashdata('msg_news_class', 'alert-danger');
                }
                
            }
            else{

                $post = $this->input->post();
                $post['user']=$this->session->userdata('id');
                $post['date'] = date('d-M-y H:i:s', time());            						
                $post['transaction_id']=rand(10000,99999);
                if($this->loginmodel->insert_request($post))
                {
                    $this->load->library('email');  
                    $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => 'smtp.gmail.com',
                        'smtp_port' => 587,
                        'smtp_crypto' => 'tls',
                        'smtp_user' => 'ledger.admin@patriotpacific.com', // change it to yours
                        'smtp_pass' => 'nkpjmkjbroyukgpp', // change it to yours
                        'smtp_timeout'=>60,
                        'mailtype' => 'html',
                        'newline' => "\r\n",
                        'charset' => 'utf-8',
                        'wordwrap' => TRUE
                    );       
                    $user_id = $this->session->userdata('id');
                    $email = $this->loginmodel->getuseremail($user_id);
                                                
                    $this->email->initialize($config);
                    foreach($email as $email){
                        $message = "
                        <b>From:</b> ".$email->full_name."<br>
                        <b>Category :</b> ". $post['category']."<br>
                        <b>Amount :</b> $". $post['amount']."<br>
                        <b>Note :</b> " .$post['note'];
                        $this->email->from($email->email, $email->full_name);
                        $this->email->to('ledger.admin@patriotpacific.com');
                        $this->email->subject('User Reimbursment Request');
                        $this->email->message($message);
                        //$this->email->attach(base_url('assets/uploads/'.$post['proof']));
                        if($this->email->send()){
                            return redirect('user/success');
                        }
                        else{
                            show_error($this->email->print_debugger());
                        }
                    }
                
                }

                else
                {
                    $this->session->set_flashdata('msg_news', 'Your Request Not Sent !');
                    $this->session->set_flashdata('msg_news_class', 'alert-danger');
                }

            }
        }
        else{
                $upload_error = $this->upload->display_errors();
                $data['user']=$this->loginmodel->get_userinfo(); 
                $data['title']="Make A Request";
                $data['error']=compact('upload_error');
                $this->load->view('users/index', $data);
        }
		
    }
    public function success(){
        $this->load->model('loginmodel');
        $data['user']=$this->loginmodel->get_userinfo();
        $data['title']="Your Request has been Submitted Successfully";
        $this->load->view('users/success',$data);
    }
    public function logout(){
        $this->session->unset_userdata('id');
        return redirect('userlogin');
    }    
    public function view_details($id){
        $this->load->model('loginmodel');
        $data['request']=$this->loginmodel->get_request_by_id($id);
        $data['more_details']=$this->loginmodel->get_more_details($id);        
        $data['user']=$this->loginmodel->get_userinfo(); 
        $data['title']="Details of Request";        
        $this->load->view('users/view_details',$data);
    }       
    public function response($id){
        $this->load->model('loginmodel');
        $this->form_validation->set_rules('amount_response', ' Amount','required');						
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        
		if($this->form_validation->run())
		{
			
			$post = $this->input->post();	
            unset($post['id']);   
            unset($post['transaction_id']);
            unset($post['category']);
            unset($post['amount']);
            unset($post['note']);
            unset($post['date']);
            unset($post['user']);
            unset($post['admin']);
            unset($post['status']);		
			$post['date_response'] = date('d-M-y H:i:s', time());            						        
            
			if($this->loginmodel->insert_response($id,$post))
			{
                return redirect('user/success');
			
			}
			else
			{
			$this->session->set_flashdata('msg', 'Your Response for Request Not Submitted !');
			$this->session->set_flashdata('msg_class', 'alert-danger');
			}
			
		}
		else
		{            
            $data['user']=$this->loginmodel->get_userinfo(); 
            $data['request']=$this->loginmodel->get_request_by_id($id);
			$data['title']="Response to Request";
            $data['id']=$id;
		    $this->load->view('users/respond',$data);
		}
    }   
    public function pay($id){
        $this->load->library('paypal_lib');
        $returnURL = base_url('paypal/success');
        $cancelURL = base_url('paypal/cancel');
        $notifyURL = base_url('paypal/ipn');

        $data=$this->input->post();        
        $amount=$data['amount_response'];
        $note=$data['note_response'];        
        $logo = base_url('assets/images/logo.png');

        $this->paypal_lib->add_field('return',$returnURL);
        $this->paypal_lib->add_field('cancel_return',$cancelURL);
        $this->paypal_lib->add_field('notify_url',$notifyURL);        
        $this->paypal_lib->add_field('custom',$id);
        $this->paypal_lib->add_field('amount',$amount);
        $this->paypal_lib->add_field('item_number',$note);
        $this->paypal_lib->image($logo);

        $this->paypal_lib->paypal_auto_form();
    }
    public function more_details($id){  
        
        
        $this->load->model('loginmodel');           

        $config['upload_path']='./assets/uploads/more_details';

        $config['allowed_types']='pdf';        

        $this->load->library('upload', $config);
        if($this->upload->do_upload('document'))
        {
        
            $post = $this->input->post();
            $post['request_id']=$id;
            $post['time'] = date('d-M-y H:i:s', time());
            $data=$this->upload->data();
            $status = "Details Submitted";
            $data=$this->upload->data();
            
            $image_path="assets/uploads/more_details/".$data['raw_name'].$data['file_ext'];
            $post['document']=$image_path;
            if($this->loginmodel->more_details($post) && $this->loginmodel->updateStatus($status,$id))
            {
                $user = $this->input->get('full_name');
                $email = $this->input->get('email');
                $this->load->library('email');  
                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'smtp.gmail.com',
                    'smtp_port' => 587,
                    'smtp_crypto' => 'tls',
                    'smtp_user' => 'ledger.admin@patriotpacific.com', // change it to yours
                    'smtp_pass' => 'nkpjmkjbroyukgpp', // change it to yours
                    'smtp_timeout'=>20,
                    'mailtype' => 'html',
                    'newline' => "\r\n",
                    'charset' => 'utf-8',
                    'wordwrap' => TRUE
                ); 
                $details = $this->loginmodel->get_request_by_id($id);          
                $this->email->initialize($config);      
                $this->email->from($email);
                $this->email->to('ledger.admin@patriotpacific.com');
                foreach($details as $details){                    
                    $this->email->subject($user.' submitted more details for their request regarding "'.$details->category.'"');                                          
                }
                $message = "
                    <h2 style='color:#850101; font-weight:bold;'>Request Details</h2>
                    <b>Transaction id:</b> ".$details->transaction_id."<br>
                    <b>Category:</b> ".$details->category."<br>
                    <b>Amount Request:</b> $".$details->amount."<br>
                    <b>Dated:</b> ". date('M-d-Y',strtotime($details->date))."<br>
                    <b>Status:</b> ".$details->status;
                $this->email->message($message);
                if($this->email->send()){
                    return redirect('user/success');
                }
                else{
                    show_error($this->email->print_debugger());
                }  
                    
                
            }

            else
            {
                $this->session->set_flashdata('msg_news', 'Your Request Not Sent !');
                $this->session->set_flashdata('msg_news_class', 'alert-danger');
            }
            
        }
        else{

            $post=$this->input->post();
            $post['request_id']=$id;
            $post['time'] = date('d-M-y H:i:s', time());            
            $status = "Details Submitted";
            $this->load->model('loginmodel');
            if($this->loginmodel->more_details($post) && $this->loginmodel->updateStatus($status,$id))
            {
                $user = $this->input->get('full_name');
                $email = $this->input->get('email');
                $this->load->library('email');  
                $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'smtp.gmail.com',
                    'smtp_port' => 587,
                    'smtp_crypto' => 'tls',
                    'smtp_user' => 'ledger.admin@patriotpacific.com', // change it to yours
                    'smtp_pass' => 'nkpjmkjbroyukgpp', // change it to yours
                    'smtp_timeout'=>20,
                    'mailtype' => 'html',
                    'newline' => "\r\n",
                    'charset' => 'utf-8',
                    'wordwrap' => TRUE
                ); 
                $details = $this->loginmodel->get_request_by_id($id);          
                $this->email->initialize($config);      
                $this->email->from($email);
                $this->email->to('ledger.admin@patriotpacific.com');
                foreach($details as $details){                    
                    $this->email->subject($user.' submitted more details for their request regarding "'.$details->category.'"');                                           
                }
                $message = "
                    <h2 style='color:#850101; font-weight:bold;'>Request Details</h2>
                    <b>Transaction id:</b> ".$details->transaction_id."<br>
                    <b>Category:</b> ".$details->category."<br>
                    <b>Amount Request:</b> $".$details->amount."<br>
                    <b>Dated:</b> ". date('M-d-Y',strtotime($details->date))."<br>
                    <b>Status:</b> ".$details->status;
                $this->email->message($message);
                if($this->email->send()){
                    return redirect('user/success');
                }
                else{
                    show_error($this->email->print_debugger());
                } 
            }
            else
            {
                $this->session->set_flashdata('msg_news', 'More Details for Request Not Submitted !');
                $this->session->set_flashdata('msg_news_class', 'alert-danger');
                return redirect('user/dashboard');
            }
        }                             
    }    
    public function payment_details(){
        $this->form_validation->set_rules('full_name', ' Full Name','required');
        $this->form_validation->set_rules('card_number', ' Card Number','required | min_length[16] | max_length[16]');
        $this->form_validation->set_rules('exp_month', ' Expiration Month','required');
        $this->form_validation->set_rules('exp_year', ' Expiration Year','required');
        $this->form_validation->set_rules('cvv', ' CVV','required | min_length[3] | max_length[3]');						
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        $this->load->model('loginmodel');
        if($this->form_validation->run())
		{
            $post = $this->input->post();
            $post['user_id']=$this->session->userdata('id');
            if($this->loginmodel->payment_details($post))
            {
                $this->session->set_flashdata('msg', 'Payment Details Submitted Successfully !');
                $this->session->set_flashdata('msg_class', 'alert-success');        
            }
            else
            {
                $this->session->set_flashdata('msg', 'Payment Details Not Submitted !');
                $this->session->set_flashdata('msg_class', 'alert-danger');
            }
            return redirect('user/payment_details');
        }        
        $data['card']=$this->loginmodel->get_payment_details();
        $data['user']=$this->loginmodel->get_userinfo();         
        $data['title']="Response to Request";
        $this->load->view('users/payment_details',$data);
    }
    public function del_card($id){
        $this->load->model('loginmodel');
        if($this->loginmodel->del_card($id)){
            $this->session->set_flashdata('msg','Card Deleted Successfully');    
            $this->session->set_flashdata('msg_class','alert-success');    
        }
        else{    
            $this->session->set_flashdata('msg','Card Not Deleted');    
            $this->session->set_flashdata('msg_class','alert-danger');    
        }
        return redirect('user/payment_details');
    }  
    public function profile(){
        $this->form_validation->set_rules('full_name', ' Full Name','required');						
        $this->form_validation->set_rules('email', ' Email','required');						
        $this->form_validation->set_rules('phone', ' Phone','required');						
        $this->form_validation->set_rules('password', ' Password','required');						
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        $this->load->model('loginmodel');
        $id=$this->session->userdata('id');
        if($this->form_validation->run()){
            
            
            $config['upload_path']='./assets/uploads/userprofile/';
            $config['allowed_types']='png|jpg|gif';        

            $this->load->library('upload', $config);
            
            if($this->upload->do_upload('image'))
		    {
                $post = $this->input->post();
                $data=$this->upload->data();
                $image_path="assets/uploads/userprofile/".$data['raw_name'].$data['file_ext'];
                $profile = array(
                    'full_name' => $post['full_name'],
                    'email' => $post['email'],
                    'phone' => $post['phone'],
                    'password' => $post['password'],
                    'image' => $image_path
                );
                if($this->loginmodel->updateuserprofile($profile,$id)){
                    $this->session->set_flashdata('msg','Profile Updated Successfully');    
                    $this->session->set_flashdata('msg_class','alert-success'); 
                    return redirect('user/profile');   
                }
                else{
                    $this->session->set_flashdata('msg','Profile Not Updated');    
                    $this->session->set_flashdata('msg_class','alert-danger'); 
                    return redirect('user/profile');     
                }
            }
                            
            else{
                $post = $this->input->post();
                $profile = array(
                    'full_name' => $post['full_name'],
                    'email' => $post['email'],
                    'phone' => $post['phone'],
                    'password' => $post['password']                    
                );
                unset($profile['image']);
                if($this->loginmodel->updateuserprofile($profile,$id)){
                    $this->session->set_flashdata('msg','Profile Updated Successfully');    
                    $this->session->set_flashdata('msg_class','alert-success');
                    return redirect('user/profile');     
                }
                else{
                    $this->session->set_flashdata('msg','Profile Not Updated');    
                    $this->session->set_flashdata('msg_class','alert-danger');
                    return redirect('user/profile');     
                }
            }
        }
        else{
            $data['user']=$this->loginmodel->get_userinfo();         
            $data['title']="My Profile";
            $this->load->view('users/profile',$data);
        }
        
    }
}