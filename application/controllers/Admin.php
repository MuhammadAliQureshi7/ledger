<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('id')){
            return redirect('login/index');
        }
    }
    public function index(){
        return redirect('admin/dashboard');
    }
    public function dashboard(){
        $this->load->model('loginmodel');
        $data['userinfo']=$this->loginmodel->get_admininfo(); 
        $data['requests']=$this->loginmodel->get_requests();            
        $data['title']="Welcome To The Ledger";
        $this->load->view('admin/dashboard',$data);
    }

    public function logout(){
        $this->session->unset_userdata('id');
        return redirect('login');
    }

    public function users(){        
        $this->load->model('loginmodel');
        $data['userinfo']=$this->loginmodel->get_admininfo(); 
        $data['users']=$this->loginmodel->get_users();       
        $data['title']="Registered Users";
        $this->load->view('admin/users',$data);
    }
    public function admins(){        
        $this->load->model('loginmodel');
        $data['userinfo']=$this->loginmodel->get_admininfo(); 
        $data['admin']=$this->loginmodel->get_admins();       
        $data['title']="Admins";
        $this->load->view('admin/admins',$data);
    }
    public function add_admin(){
        $this->form_validation->set_rules('full_name', ' Full Name','required');
		$this->form_validation->set_rules('email', ' Email','required');	
        $this->form_validation->set_rules('role', ' Role','required');	
		$this->form_validation->set_rules('username', ' Username','required|is_unique[admin.username]|alpha_dash');
        $this->form_validation->set_rules('password', ' Password','required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        $config['upload_path']='./assets/uploads/userprofile/';

        $config['allowed_types']='jpg|png|jpeg|PNG';
        $this->load->library('upload', $config);
        $this->load->model('loginmodel');
        
        
        
		if($this->form_validation->run())
		{
            if($this->upload->do_upload('image'))
		    {
                $post = $this->input->post();
                if($this->loginmodel->add_admin($post) ){
                    $this->session->set_flashdata('msg_news','Admin added Successfully');
                    $this->session->set_flashdata('msg_news_class', 'alert-success');
                    return redirect('admin/admins');                    
                }
                else{			
                    $this->session->set_flashdata('msg_news', 'Your Admin Not Added !');
                    $this->session->set_flashdata('msg_news_class', 'alert-danger');
                    
                }		                            
            }
            else{
                $post = $this->input->post();               
                if($this->loginmodel->add_admin($post) ){
                    $this->session->set_flashdata('msg_news','Admin added Successfully');
                    $this->session->set_flashdata('msg_news_class', 'alert-danger');
                    return redirect('admin/admins');                    
                }
                else{			
                    $this->session->set_flashdata('msg_news', 'Your Admin Not Added !');
                    $this->session->set_flashdata('msg_news_class', 'alert-danger');
                    
                }		                        
            }
		}
		else
		{
            $data['userinfo']=$this->loginmodel->get_admininfo(); 
			$data['title']="Add a new user";
		    $this->load->view('admin/add_admin',$data);
		}
    } 
    public function add_user(){
        $this->form_validation->set_rules('full_name', ' Full Name','required');
		$this->form_validation->set_rules('email', ' Email','required');	
        $this->form_validation->set_rules('phone', ' Phone','required');	
		$this->form_validation->set_rules('username', ' Username','required|is_unique[users.username]|alpha_dash');
        $this->form_validation->set_rules('password', ' Password','required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        $config['upload_path']='./assets/uploads/userprofile/';

        $config['allowed_types']='jpg|png|jpeg|PNG';
        $this->load->library('upload', $config);
        $this->load->model('loginmodel');
        
        
        
		if($this->form_validation->run())
		{
            if($this->upload->do_upload('image'))
		    {
                $post = $this->input->post();
                
                $this->load->library('email');
                /* $config = Array(
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
                );  */
                $this->email->initialize($config);
                $this->email->from('ledger.admin@patriotpacific.com', 'Charles Vamadeva');
                $this->email->to($post['email']);
                $this->email->subject("Request");
                $data=$this->upload->data();
                
                $image_path="assets/uploads/userprofile/".$data['raw_name'].$data['file_ext'];
                $post['image']=$image_path;
                $message="
                Personal Information 
                Name:" .$post['full_name']."\n
                Email: " .$post['email']." \n   
                Username: " .$post['username']." \n 
                Phone:" .$post['phone']." \n
                Password:" .$post['password'] 
                ;

                $this->email->message($message);
                $this->email->set_newline('\r\n');  
                
                if($this->email->send()){
                    if($this->loginmodel->add_user($post) ){
                        $this->session->set_flashdata('msg_news','User added Successfully');
                        $this->session->set_flashdata('msg_news_class', 'alert-success');
                        return redirect('admin/users');                    
                    }
                    else{			
                        $this->session->set_flashdata('msg_news', 'Your User Not Added !');
                        $this->session->set_flashdata('msg_news_class', 'alert-danger');
                        
                    }		        
                    }
                else
                {
                    show_error($this->email->print_debugger());
                }
            }
            else{
                $post = $this->input->post();
                $this->load->library('email');
                /* $config = Array(
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
                );  */
                $this->email->initialize($config);
                $this->email->from('ledger.admin@patriotpacific.com', 'Charles Vamadeva');
                $this->email->to($post['email']);
                $this->email->subject("Request");
                
                $message="
                Personal Information 
                Name:" .$post['full_name']."\n
                Email: " .$post['email']." \n   
                Username: " .$post['username']." \n 
                Phone:" .$post['phone']." \n
                Password:" .$post['password'] 
                ;

                $this->email->message($message);
                $this->email->set_newline('\r\n');  
                
                if($this->email->send()){
                    if($this->loginmodel->add_user($post) ){
                        $this->session->set_flashdata('msg_news','User added Successfully');
                        $this->session->set_flashdata('msg_news_class', 'alert-danger');
                        return redirect('admin/users');                    
                    }
                    else{			
                        $this->session->set_flashdata('msg_news', 'Your User Not Added !');
                        $this->session->set_flashdata('msg_news_class', 'alert-danger');
                        
                    }		        
                    }
                else
                {
                    show_error($this->email->print_debugger());
                }
            }
		}
		else
		{
            $data['userinfo']=$this->loginmodel->get_admininfo(); 
			$data['title']="Add a new user";
		    $this->load->view('admin/add_user',$data);
		}
    }  
    
    public function make_request(){
        
        $this->load->model('loginmodel');
        $this->form_validation->set_rules('category', ' Category','required');						
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');        

        $config['upload_path']='./assets/uploads/';

        $config['allowed_types']='jpg|png|jpeg|PNG|gif|pdf';        

        $this->load->library('upload', $config);
        $this->load->library('email');          
        $this->email->initialize($config);   
        if($this->form_validation->run()){
            if($this->upload->do_upload('proof'))
		    {
			
                $post = $this->input->post();  
                $message = "
                    <b>Category :</b> ". $post['category']."<br>
                    <b>Amount :</b> $". $post['amount']."<br>
                    <b>Note :</b> " .$post['note'];               
                $post['status'] = "Approved";
                $post['admin']=$this->session->userdata('id');
                $user_id = $this->input->post('user');
                $post['date'] = date('d-M-y H:i:s', time());            						
                $post['transaction_id']=rand(10000,99999);
                $data=$this->upload->data();
                
                $image_path="assets/uploads/".$data['raw_name'].$data['file_ext'];
                $post['proof']=$image_path;
                                
                    if($this->loginmodel->insert_request($post))
                    {                        
                        $email = $this->loginmodel->getuseremail($user_id);
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
                        $this->email->initialize($config); 
                            
                        foreach($email as $email){
                            $this->email->from('ledger.admin@patriotpacific.com', 'Charles Vamadeva');
                            $this->email->to($email->email);
                            $this->email->subject('Charge to Debit');
                            $this->email->message($message);
                            $this->email->attach(base_url('assets/uploads/'.$post['proof']));
                            if($this->email->send()){
                                return redirect('admin/success');
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
                $user_id = $this->input->post('user');
                $message = "
                    Category : ". $post['category']."<br>
                    Amount : $". $post['amount']."<br>
                    Note : " .$post['note'];
                $post['admin']=$this->session->userdata('id');
                $post['date'] = date('d-M-y H:i:s', time()); 
                $post['status'] = "Approved";           						
                $post['transaction_id']=rand(10000,99999);                                               
                
                if($this->loginmodel->insert_request($post))
                {
                    $email = $this->loginmodel->getuseremail($user_id);
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
                    $this->email->initialize($config);      
                    foreach($email as $email){
                        $this->email->from('ledger.admin@patriotpacific.com', 'Charles Vamadeva');
                        $this->email->to($email->email);
                        $this->email->subject('Charge to Debit');
                        $this->email->message($message);
                        if($this->email->send()){
                            return redirect('admin/success');
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
                $data['userinfo']=$this->loginmodel->get_admininfo(); 
                $data['users']=$this->loginmodel->get_users_list();
                $data['title']="Make A Request";
                $data['error']=compact('upload_error');
                $this->load->view('admin/index', $data);
        }
		
    } 
    public function sendemail($id){
        $this->load->model('loginmodel');
        $email = $this->loginmodel->getuseremail($id);
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
        $this->email->initialize($config);      
        foreach($email as $email){
            $this->email->from('ledger.admin@patriotpacific.com', 'Charles Vamadeva');
            $this->email->to($email->email);
            $this->email->subject('Email Test');
            $this->email->message('Testing the email class.');
            if($this->email->send()){
                return redirect('admin/sendemail');
            }
            else{
                show_error($this->email->print_debugger());
            }
        }
    }  
    public function success(){
        $this->load->model('loginmodel');
        $data['userinfo']=$this->loginmodel->get_admininfo();
        $data['title']="Your Request has been Submitted Successfully";
        $this->load->view('admin/success',$data);
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
                return redirect('admin/success');
			
			}
			else
			{
			$this->session->set_flashdata('msg', 'Your Response for Request Not Submitted !');
			$this->session->set_flashdata('msg_class', 'alert-danger');
			}
			
		}
		else
		{            
            $data['userinfo']=$this->loginmodel->get_admininfo(); 
            $data['request']=$this->loginmodel->get_request_by_id($id);
            $data['admin']=$this->loginmodel->get_request_by_id($id);
			$data['title']="Response to Request";
            $data['id']=$id;
		    $this->load->view('admin/respond',$data);
		}
    }   
    public function view_details($id){
        $this->load->model('loginmodel');
        $data['request']=$this->loginmodel->get_request_by_id($id);    
        $data['more_details']=$this->loginmodel->get_more_details($id);       
        $data['userinfo']=$this->loginmodel->get_admininfo(); 
        $data['title']="Details of Request";        
        $this->load->view('admin/view_details',$data);
    } 
    public function add_request_status($id){
        $this->load->model('loginmodel');
        $post=$this->input->post();     
        unset($post['id']);   
        unset($post['transaction_id']);
        unset($post['category']);
        unset($post['amount']);
        unset($post['note']);
        unset($post['date']);
        unset($post['user']);
        unset($post['admin']);
        unset($post['amount_response']);
        unset($post['note__response']);
        unset($post['date_response']);
        if($this->loginmodel->add_request_status($id,$post))        
        {
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
            $this->email->from('ledger.admin@patriotpacific.com', 'Charles Vamadeva');
            $this->email->to($email);
            foreach($details as $details){
                if($post['status'] == "Approved"){
                    $this->email->subject('Your request for "'.$details->category.'" has been Approved.');
                    
                }
                elseif($post['status'] == "Rejected"){
                    $this->email->subject('Your request for "'.$details->category.'" has been Rejected.');                    
                }
                else{
                    $this->email->subject('Admin requires more details regarding Your request for "'.$details->category);                   
                }
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
                $this->session->set_flashdata('msg', 'Your Request Status has been Updated Successfully !');
                $this->session->set_flashdata('msg_class', 'alert-success');
            }
            else{
                show_error($this->email->print_debugger());
            }                      
        }
        else
        {
            $this->session->set_flashdata('msg', 'Your Request Status Not Updated!');
            $this->session->set_flashdata('msg_class', 'alert-danger');
        }
        return redirect('admin/dashboard');

    }
    public function del_user($id){
        $this->load->model('loginmodel');
        if($this->loginmodel->del_user($id)){
            $this->session->set_flashdata('msg','User Deleted Successfully');    
            $this->session->set_flashdata('msg_class','alert-success');    
        }
        else{    
            $this->session->set_flashdata('msg','User Not Deleted');    
            $this->session->set_flashdata('msg_class','alert-danger');    
        }
        return redirect('admin/users');
    }
    public function profile(){
        $this->form_validation->set_rules('full_name', ' Full Name','required');						
        $this->form_validation->set_rules('email', ' Email','required');						        						
        $this->form_validation->set_rules('password', ' Password','required');						
		$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
        $this->load->model('loginmodel');
        $id=$this->session->userdata('id');
        if($this->form_validation->run()){
            
            
            $config['upload_path']='./assets/uploads/adminprofile/';
            $config['allowed_types']='png|jpg|gif';        

            $this->load->library('upload', $config);
            
            if($this->upload->do_upload('image'))
		    {
                $post = $this->input->post();
                $data=$this->upload->data();
                $image_path="assets/uploads/adminprofile/".$data['raw_name'].$data['file_ext'];
                $profile = array(
                    'full_name' => $post['full_name'],
                    'email' => $post['email'],                    
                    'password' => $post['password'],
                    'image' => $image_path
                );
                if($this->loginmodel->updateadminprofile($profile,$id)){
                    $this->session->set_flashdata('msg','Profile Updated Successfully');    
                    $this->session->set_flashdata('msg_class','alert-success'); 
                    return redirect('admin/profile');   
                }
                else{
                    $this->session->set_flashdata('msg','Profile Not Updated');    
                    $this->session->set_flashdata('msg_class','alert-danger'); 
                    return redirect('admin/profile');     
                }
            }
                            
            else{
                $post = $this->input->post();
                $profile = array(
                    'full_name' => $post['full_name'],
                    'email' => $post['email'],                    
                    'password' => $post['password']                    
                );
                unset($profile['image']);
                if($this->loginmodel->updateadminprofile($profile,$id)){
                    $this->session->set_flashdata('msg','Profile Updated Successfully');    
                    $this->session->set_flashdata('msg_class','alert-success');
                    return redirect('admin/profile');     
                }
                else{
                    $this->session->set_flashdata('msg','Profile Not Updated');    
                    $this->session->set_flashdata('msg_class','alert-danger');
                    return redirect('admin/profile');     
                }
            }
        }
        else{
            $data['userinfo']=$this->loginmodel->get_admininfo();         
            $data['title']="My Profile";
            $this->load->view('admin/profile',$data);
        }
        
    }
}