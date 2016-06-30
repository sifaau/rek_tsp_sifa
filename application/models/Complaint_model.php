<?php

class Complaint_model extends CI_Model 
{

    private $table,$pk; 

    function __construct() 
    {
        parent::__construct();
        $this->table ='complaint';
        $this->pk ='id';        
    }

    public function insert_data($data)
    {
        return $this->db->insert($this->table,$data);
    }

    public function update_data($data,$condition)
    {
        $this->db->where($condition);
        return $this->db->update($this->table,$data);
    }

    public function delete_data($condition)
    {
        $this->db->where($condition);
        return $this->db->delete($this->table);
    }

    public function all_data()
    {
        return $this->db->get($this->table);
    }

    public function select_data($array,$condition)
    {
        $this->db->select($array);
        $this->db->where($condition);      
        return $this->db->get($this->table);
    }

    public function get_data_by_field($field,$condition)
    {
        $hasil=NULL;
        $this->db->select($field);
        $this->db->where($condition);
        $query=$this->db->get($this->table);
        if ($query->num_rows() > 0)
        {
          $column = $query->row_array();
          $hasil = $column["$field"];
      }
      return $hasil;
  }

  public function count_rows($condition){
    $this->db->select($this->pk);
    $this->db->where($condition);       
    $query=$this->db->get($this->table);
    return $query->num_rows();
}

public function list_complaint($array,$condition,$limit,$start)
{
    $this->db->select($array);
    $this->db->where($condition);
    $this->db->order_by('date(date_create)','DESC');
    $this->db->order_by('status','ASC');
    $this->db->limit($limit,$start);      
    return $this->db->get($this->table);
}


}


?>
