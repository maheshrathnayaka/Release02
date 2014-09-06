<?php

class View_k_stores_model extends CI_Model{


    function __construct()
    {
            // Call the Model constructor
            parent::__construct();
    }
     
    
    function getLatLng() 
    {
        $queryline = "SELECT addressline,city,telephone,lat,lng FROM kstores";       
        $query1 = $this->db->query($queryline);       
        return $query1->result();
    }
    
    
}