<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SalesCoordinationModel extends CI_model
{
  public function deleteEnquiryData($tableName, $condition)
  {
    $q = $this->db->where($condition);
    $this->db->delete($tableName);
    return $this->db->affected_rows();
  }
  public function fetch_single_data($tablename, $condition = array(), $fields = null, $orderby = array())
  {

    $fields = !empty($fields) ? $fields : '*';
    $this->db->select($fields);
    $this->db->from($tablename);
    if (!empty($condition)) {

      foreach ($condition as $key => $value) {
        $this->db->where($key, $value);
      }
    }
    if (!empty($orderby)) {
      foreach ($orderby as $key => $value) {
        $this->db->order_by($key, $value);
      }
    }
    $query = $this->db->get();

    //echo $this->db->last_query();//die;

    return $query->row();
  }
}
