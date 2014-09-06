<?php
class AdminCategory extends CI_Model{
    public function get_parent_category(){
        $this->db->select()->from('category')->where('parentcategory',0);
        $query=$this->db->get();
        return $query->row_array();
    }
    public function set_new_category($data){
        $this->db->insert('category',$data);
    }
    public function getcategoryid($categoryname){
        $this->db->select('categoryid')->from('category')->where('categoryname',$categoryname);
        $query=  $this->db->get();
        $row=$query->row_array();
        return $row['categoryid'];
    }
    public function set_new_attributes($Attributes){
        $this->db->insert('attributes', $Attributes); 
    }

}


/* End of file admincategory.php */
/* Location: ./application/models/admincategory.php */
