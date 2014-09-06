<?php

class Adapprovalview extends CI_Controller {

    public function index() {
        if (!isset($_GET['adid'])) {
            echo "Page not Found!";
        } else {
            $this->load->model('adapprovalview_model');
            $data['ad'] = $this->adapprovalview_model->get_ad_details($_GET['adid']);
            $data['images'] = $this->adapprovalview_model->get_ad_images($_GET['adid']);
            foreach ($data['ad'] as $value) {
                $seller = $value['sellerid'];
            }
            $data['seller'] = $this->adapprovalview_model->get_seller_details($seller);
            $this->load->view('adapproval_view', $data);
        }
    }

    public function approving() {
        if (!isset($_GET['status'])) {
            echo "Page not Found!";
        } else {
            $this->load->model('adapprovalview_model');
            if ($this->adapprovalview_model->approve_advertisement($_GET['status'], $_GET['adid'])) {
//                $this->load->view('header');
                $this->load->view('links');
//                $this->load->view('footer');
            } else {
                echo 'Unsuccessful';
            }
        }
    }

}
