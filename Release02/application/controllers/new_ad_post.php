<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class New_Ad_Post extends CI_Controller {

    function __costruct() {
        parent::__costruct();
    }

    public function index() {
        $this->load->library('session');
        $this->session->set_userdata('newcount',0);
        $this->getComboValues();
    }

    public function getComboValues() {
        $this->load->model('new_ad_post_model');
        $data['cat'] = $this->new_ad_post_model->getCategory();
        //$this->load->view('new_ad_post', $data);
        $this->load->view('new_ad_posting', $data);
    }

    public function getSubCat($bb) {
        $this->load->model('new_ad_post_model');
        $data['subcat'] = $this->new_ad_post_model->getSubCategory($bb);

        if (!empty($data['subcat'])) {
            //$this->load->view('sub_category_view', $data);

            echo '<select class="input-group" id="ChooseSubCategory" onchange="checkSubSubCat(this.value)" name="category" style="margin-left: 68px;width: 400px; margin-top: 10px; margin-bottom: 10px; padding-top: 4px; border-top-width: 1px; top: 20px;" >';
            echo '<option value="select" disabled selected>Select a Subcategory...</option>';

            if (isset($data['subcat'])) {
                foreach ($data['subcat'] as $row) {
                    $catid = $row->categoryid;
                    $catname = $row->categoryname;
                    $cattype = $row->parentcategory;
                    $isendnode = $row->isendnode;


                    echo '<option value="' . $catid . " " . $isendnode . '">' . $catname . '</option>';
                }
            }

            echo '</select>';
        }
    }

    public function getSubSubCat($bb) {
        $this->load->model('new_ad_post_model');
        $data['subcat'] = $this->new_ad_post_model->getSubCategory($bb);

        if (!empty($data['subcat'])) {
            //$this->load->view('sub_sub_category_view', $data);

            echo '<select class="input-group" id="ChooseSubSubCategory" onchange="checklastSubCat(this.value)" name="category" style="margin-left: 68px;width: 300px; margin-top: 10px; margin-bottom: 40px; padding-top: 4px; border-top-width: 1px; top: 20px;" >';
            echo '<option value="select" disabled selected>Select a Subcategory...</option>';

            if (isset($data['subcat'])) {
                foreach ($data['subcat'] as $row) {

                    $catid = $row->categoryid;
                    $catname = $row->categoryname;
                    //$cattype = $row->parentcategory;
                    $isendnode = $row->isendnode;

                    echo '<option value="' . $catid . " " . $isendnode . '">' . $catname . '</option>';
                }
            }
            echo '</select>';
        }
    }

    public function getfields($cc) {

        $this->load->model('new_ad_post_model');
        $data['catFields'] = $this->new_ad_post_model->getCategoryFields($cc);
        
        $counntt=0;
        foreach($data['catFields'] as $row) 
        {
            $counntt++;
        }
        $this->load->library('session');
        $this->session->set_userdata('newcount',$counntt);
        
        
        $data['catselect'] = $this->new_ad_post_model->getCategoryselect($cc);

        $this->load->view('new_category_view', $data);
    }

    public function adCoupon() {
        $this->load->library('session');
        $adID = $this->session->userdata['adId'];

        $data1 = array('coupencode' => $_POST['coupencode'],
            'adid' => $adID,
            'expdate' => $_POST['expdate'],
            'addeddate' => $_POST['addeddate'],
            'percentage' => $_POST['percentage'],
            'noofcoupons' => $_POST['noofcoupons']
        );

        $this->load->model('new_ad_post_model');
        $this->new_ad_post_model->setCoupon($data1);
    }

    public function adPost() {

        $user = $this->session->userdata['logged_in']['userid'];

//        $data1 = array('title' => $_POST['title'],
//            'description' => $_POST['description'],
//            'price' => $_POST['price'],
//            'categoryid' => $_POST['categoryid'],
//            'isnegotiable' => $_POST['isnegotiable'],
//            'quantity' => $_POST['qty'],
//            'location' => $_POST['location'],
//            'sellerid' => $user
//        );
//
//        $this->load->model('new_ad_post_model');
//        $id = $this->new_ad_post_model->setAd($data1);
//        
//
//        $this->load->library('session');
//        $this->session->set_userdata('adId', $id);
//
//
//        $this->load->model('new_ad_post_model');
//        $data['catFields2'] = $this->new_ad_post_model->getCategoryFields($_POST['categoryid']);
//        $countrow = 0;
//
//        foreach ($data['catFields2'] as $row) {
//            $countrow++;
//        }
//        
//        if ($countrow != 0) {
//            $x = 1;
//            foreach ($data['catFields2'] as $row) {
//                $attributeid = $row->attributeid;
//
//                $data2 = array('adid' => $id,
//                    'attributeid' => $attributeid,
//                    'attributevalue' => $_POST['values'][$x]);
//                
//                
//                
//                $this->load->model('new_ad_post_model');
//                $this->new_ad_post_model->setAdValues($data2);
//                $x++;
//            }
//
//
//        }


        $this->load->helper('file');
        $allimages = get_filenames(APPPATH . '../images/temp/');
       
        $count = 1;
        foreach ($allimages as $image) {
            
                             
//        $split0 = explode(".",$image);
//        $imgNameWithThumb = $split0[0];
         
        
                     
        $split2 = explode("-",$image);
        $uid = $split2[0];
        $imgNameWithThumb =  $split2[1];
        
        $split3 = explode("_",$imgNameWithThumb);
       
        $thumb=$split3[1];
        
        $checkthumb=substr($thumb, 0, 5);
        
        if($uid == $user)
        {
            

           
            if($checkthumb == "thumb")
            {
            $tempname = APPPATH . '../images/temp2/' . '12' . '_' . $count .'_thumb'.'.jpg';
            rename(APPPATH . '../images/temp/' . $image, $tempname);
            $count++;
            }
            else {
            
            $tempname = APPPATH . '../images/temp2/' . '12' . '_' . $count . '.jpg';
            rename(APPPATH . '../images/temp/' . $image, $tempname);
           
            }
        }
        }

//        $this->load->model('new_ad_post_model');
//        $this->new_ad_post_model->uploadImageName($id . '_1.jpg', $id);
//
//
//        $namess = array('adid' => $id, 'imageurl' => $id . '_1.jpg');
//        $this->load->model('new_ad_post_model');
//        $this->new_ad_post_model->uploadImagetoTable($namess); 
//        $this->save_search_string($data1['title'], $id);
    }

    function save_search_string($title, $ad_id) {
        $title = trim($title, "~");
        $pieses = explode(" ", $title);
        $text = "";
        $max = sizeof($pieses);
        //var_dump($pieses); 
        for ($x=0; $x<$max; $x++) {
            $text = $text . "~" . $pieses[$x];
        }
        $text = ltrim($text, "~");
        $data = array(
            'ad_id' => $ad_id,
            'Title_Text' => $text
        );
        //var_dump($data);
        $this->new_ad_post_model->save_search_string($data);
    }

    public function genarateLink() {
        $this->load->library('session');
        $showAdID = $this->session->userdata['adId'];
        echo '<div> <h1> Click the link to preview your advertisement </h1> <a href="http://kstoretesting.net16.net/ad_details?adid=' . $showAdID . '" target="_blank"> http://kstoretesting.net16.net/advertisement </a> </div>';
    }

}