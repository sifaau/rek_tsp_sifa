<?php

class Member_model extends CI_Model 
{

    private $table,$pk; 

    function __construct() 
    {
        parent::__construct();
        $this->table ='member';
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

public function list_complaint($limit){
    $this->db->select('name,(SELECT subdistrict FROM subdistrict WHERE id=member.id_district) as lokasi');
    $this->db->select('status',1);
    $this->db->order_by('id','RANDOM');
    $this->db->limit($limit);      
    return $this->db->get($this->table);
}

}


?>
