<?php 
class loginmodel extends CI_Model{
    
    public function isvalidate($username,$password){
        $q=$this->db->where('username',$username)
                    ->where('password',$password)
                    ->get('admin');
        if($q->num_rows()){
            return $q->row()->id;
        }
        else{
            return false;
        }
    }
    public function userlogin($username,$password){
        $q=$this->db->where('username',$username)
                    ->where('password',$password)
                    ->get('users');
        if($q->num_rows()){
            return $q->row()->id;
        }
        else{
            return false;
        }
    }
    public function get_admininfo(){
        $id=$this->session->userdata('id');
        $q=$this->db->select()
                    ->from('admin')
                    ->where('id',$id)
                    ->get();                 
        return $q->result();
    }
    public function get_userinfo(){
        $id=$this->session->userdata('id');
        $q=$this->db->select()
                    ->from('users')
                    ->where('id',$id)
                    ->get();                 
        return $q->result();
    }
    public function getcreditamount(){
        $id=$this->session->userdata('id');
        $q=$this->db->select()
                    ->from('requests')
                    ->where('user',$id)
                    ->where('status','Approved')
                    ->where('admin','0')                    
                    ->get();                                                        
                    return $q->result();                   
    }  
    public function getbalanceamount(){
        $id=$this->session->userdata('id');
        $q=$this->db->select()
                    ->from('requests')
                    ->where('user',$id)
                    ->where('status','Approved')
                    ->where('admin >','0')                    
                    ->get();                                                        
                    return $q->result();                   
    }       
    public function insert_request($array){
        return $this->db->insert('requests',$array);
    }
    public function payment_details($array){
        return $this->db->insert('payment_details',$array);
    }
    public function get_payment_details(){
        $id = $this->session->userdata('id');
        $q=$this->db->select()
                    ->from('payment_details')
                    ->where('user_id',$id)                 
                    ->get();                 
        return $q->result();
    }
    public function del_card($id){
        return $this->db->where('id', $id)
                        ->delete('payment_details');
    }
    public function more_details($array){
        return $this->db->insert('more_details',$array);
    }
    public function get_more_details($id){
        $q=$this->db->select()
                    ->from('more_details')
                    ->where('request_id',$id)                 
                    ->get();                 
        return $q->result();
    }
    public function insert_response($id, Array $array){
        return $this->db->where('id',$id)
                        ->update('requests',$array);
    }
    public function add_user($array){               
        $insert=$this->db->insert('users',$array);
        return $insert?$this->db->insert_id():false;
        return $this->db->insert_id();
    }
    public function add_admin($array){               
        $insert=$this->db->insert('admin',$array);
        return $insert?$this->db->insert_id():false;
        return $this->db->insert_id();
    }
    public function get_user_email($id){
        $q=$this->db->select()
                    ->from('users')
                    ->where('id',$id)                 
                    ->get();                 
        return $q->result();
    }
    public function get_requests(){
        $q=$this->db->select('requests.id as request_id, requests.*,users.full_name')
                    ->from('requests')
                    ->join('users', ' users.id = requests.user ')
                    ->order_by('id','ASC')
                    ->get();                 
        return $q->result();
    }
    public function get_request_by_id($id){
        $q=$this->db->select('requests.id as request_id, requests.*,users.*')
                    ->from('requests')
                    ->join('users', ' users.id = requests.user ')                 
                    ->where('requests.id',$id)                                        
                    ->get();                 

            return $q->result();
    }
    public function get_response_by_id($id){
        $q=$this->db->select()
                    ->from('response')                                  
                    ->where('request_id',$id)                    
                    ->get();                 
        return $q->result();
    }
    public function add_request_status($id,Array $array){
        return $this->db->where('id',$id)
                        ->update('requests',$array);
    }
    public function get_requests_user(){
        $id=$this->session->userdata('id');
        $q=$this->db->select()
                 ->from('requests')                 
                 ->where('user',$id)   
                 ->order_by('id','ASC')
                 ->get();                 
                 return $q->result();
    }
    public function get_users(){
        $q=$this->db->select()
                 ->from('users')
                 ->order_by('id','DESC')
                 ->get();                 
                 return $q->result();
    }
    public function get_admins(){
        $q=$this->db->select()
                 ->from('admin')
                 ->order_by('id','DESC')
                 ->get();                 
                 return $q->result();
    }
    public function get_users_list(){
        $q=$this->db->select()
                 ->from('users')
                 ->get();                 
                 return $q->result();
    }
    public function get_articles_trending(){
        $q=$this->db->select()
                 ->from('article')
                 ->limit(3)
                 ->where('trending','Yes')
                 ->order_by('date_posted','DESC')
                 ->get();                 
                 return $q->result();
    }
    public function get_all_trending(){
        $q=$this->db->select()
                 ->from('article')                 
                 ->where('trending','Yes')
                 ->order_by('date_posted','DESC')
                 ->get();                 
                 return $q->result();
    }
    public function get_articles_exclusive(){
        $q=$this->db->select()
                 ->from('article')
                 ->limit(3)
                 ->where('exclusive','Yes')
                 ->order_by('date_posted','DESC')
                 ->get();                 
                 return $q->result();
    }
    public function get_24_articles(){
        $q=$this->db->select()
                 ->from('article')
                 ->limit(24)                 
                 ->order_by('date_posted','DESC')
                 ->get();                 
                 return $q->result();
    }
    public function get_articles_category($category){
        $q=$this->db->select()
                 ->from('article')
                 ->where('category',$category)                 
                 ->order_by('date_posted','DESC')
                 ->get();                 
                 return $q->result();
    }
    public function del_user($id){
        return $this->db->where('id', $id)
                        ->delete('users');
    }
    public function view_blog($id){
        $q=$this->db->select()
                    ->from('article')
                    ->where('id',$id)
                    ->get();
                    return $q->result(); 
    }
    public function related_blogs($hashtag){
        $q=$this->db->select()
                    ->from('article')
                    ->limit(5)
                    ->where('hashtag',$hashtag)                    
                    ->order_by('date_posted','DESC')
                    ->get();
                    return $q->result(); 
    }
    public function search($search){
        $q=$this->db->select()
                    ->from('article')
                    ->like('title',$search,'both')                    
                    ->order_by('date_posted','DESC')
                    ->get();
                    return $q->result(); 
    }
    public function inserttransaction($id,$array){
        $insert= $this->db->where('id',$id)
                          ->update('requests',$array);
        return $insert?true:false;
    }
    public function updateStatus($status,$id){
        $insert=$this->db->set('status',$status)
                          ->where('id',$id)
                          ->update('requests');
        return $insert?true:false;
    }
    public function getuseremail($id){
        $this->db->select()
                 ->from('users')
                 ->where('id',$id);                    
        $q = $this->db->get();
        return $q->result();
    }
    public function updateuserprofile($data,$id){
        $insert=$this->db->where('id',$id)                          
                         ->update('users',$data);
        return $insert?true:false;
    }
    public function updateadminprofile($data,$id){
        $insert=$this->db->where('id',$id)                          
                         ->update('admin',$data);
        return $insert?true:false;
    }
}