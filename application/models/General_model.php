<?php defined('BASEPATH') or exit('No direct script access allowed');
class General_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	public function fetch_data($tablename, $condition = array(), $fields = null, $orderby = array(), $limit = array())
	{

		$fields = !empty($fields) ? $fields : '*';
		$this->db->select($fields);
		$this->db->from($tablename);
		if (!empty($condition)) {
			if (!empty($condition)) {

				foreach ($condition as $key => $value) {
					$this->db->where($key, $value);
				}
			}
		}
		if (!empty($orderby)) {
			foreach ($orderby as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		if (!empty($limit)) {
			$this->db->limit($limit[1], $limit[0]);
		}
		$query = $this->db->get();

		//echo $this->db->last_query();die;

		return $query->result_array();
	}

	public function fetch_data_in($tablename, $condition = array(), $fields = null, $orderby = array())
	{

		$fields = !empty($fields) ? $fields : '*';
		$this->db->select($fields);
		$this->db->from($tablename);
		if (!empty($condition)) {
			if (!empty($condition['condition'])) {

				foreach ($condition['condition'] as $key => $value) {
					$this->db->where($key, $value);
				}
			}

			if (!empty($condition['condition_in'])) {

				foreach ($condition['condition_in'] as $key => $value) {
					$this->db->where_in($key, $value);
				}
			}

			if (!empty($condition['condition_not_in'])) {

				foreach ($condition['condition_not_in'] as $key => $value) {
					$this->db->where_not_in($key, $value);
				}
			}
		}
		if (!empty($orderby)) {
			foreach ($orderby as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		$query = $this->db->get();

		//echo $this->db->last_query();die;

		return $query->result_array();
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

		return $query->row_array();
	}

	public function record_count($tablename, $condition = null)
	{

		return  $this->db->where($condition)->from($tablename)->count_all_results(); //$this->db->count_all('banner_master');

	}

	public function pagination_data($tablename, $condition = array(), $limit, $offset)
	{

		$this->db->select('*');

		$this->db->limit($limit, $offset);

		$this->db->from($tablename);

		!empty($condition) ? $this->db->where($condition) : '';
		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return $query->result_array();
	}

	public function single_image_upload($directory_folder_name, $image_title, $image_file_name, $resizeimg = array())
	{

		$today_date = date('Y-m-d');

		$config['upload_path'] = './' . $directory_folder_name . '/';
		$config['allowed_types'] = '*';
		$config['overwrite'] = FALSE;
		$config['file_name'] = $image_title . '-' . $today_date;
		$this->upload->initialize($config);

		if (!$this->upload->do_upload($image_file_name)) {
			$result = $this->upload->display_errors();

			print_r($result);
			die;
			return FALSE;
		} else {
			if (!empty($resizeimg)) {
				$config['source_image'] = $this->upload->upload_path . $this->upload->file_name;
				$config['maintain_ratio'] = FALSE;
				$config['width'] = $resizeimg['width'];
				$config['height'] = $resizeimg['height'];

				$this->load->library('image_lib', $config);

				if (!$this->image_lib->resize()) {
					$result = $this->image_lib->display_errors();
					return FALSE;
				}
				return $result['file_name'] = $this->upload->file_name;
			} else {
				$result = $this->upload->data();
				return $result['file_name'];
			}
		}
	}
	public function insert($table = '', $value = '')
	{
		if ($this->db->field_exists('added_date', $table)) {
			$value['added_date'] =  date('Y-m-d H:i:s');
		}

		if ($this->db->insert($table, $value)) {
			return $this->db->insert_id();
		} else {
			return FALSE;
		}
	}

	public function update($table = '', $value = '', $condition = '')
	{
		if ($this->db->field_exists('update_date', $table)) {
			$value['update_date'] =  date('Y-m-d H:i:s');
		}
		if ($condition != '') {
			$this->db->where($condition);
			$this->db->update($table, $value);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function delete_data($tablename = '', $condition = array())
	{
		if (!empty($condition)) {
			//$this->db->where($condition);
			//$this->db->delete($table);

			if (!empty($condition)) {
				if (array_key_exists('condition', $condition)) {

					foreach ($condition['condition'] as $key => $value) {
						$this->db->where($key, $value);
					}
				}

				if (array_key_exists('condition_not_in', $condition)) {

					foreach ($condition['condition_not_in'] as $key => $value) {
						$this->db->where_not_in($key, $value);
					}
				}

				if (array_key_exists('condition_in', $condition)) {

					foreach ($condition['condition_in'] as $key => $value) {
						$this->db->where_in($key, $value);
					}
				}
			}


			$this->db->delete($tablename);

			//echo $this->db->last_query(); die;
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function next_insertId($table)
	{
		$query = $this->db->query("SELECT AUTO_INCREMENT
		FROM information_schema.TABLES
		WHERE TABLE_SCHEMA = '" . DATABASE_NAME . "'
		AND TABLE_NAME = '" . $table . "'");

		$data =  $query->row_array();

		return $data['AUTO_INCREMENT'];
	}

	public function get_insertId($table)
	{
		$querykey = $this->db->query("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");
		$keyname =  $querykey->row_array();

		$keyId = $keyname['Column_name'];

		$query = $this->db->query("SELECT $keyId
		FROM $table order by $keyId desc");

		$data =  $query->row_array();
		$nextId = $data[$keyId] + 1;

		return $nextId;
	}

	public function multiple_join_where_order_by_group_by($select = '', $table = '', $join_table = array(), $join_on = array(), $join_name = array(), $where = array(), $order = '', $group_by = array())
	{



		if (!empty($select)) {
			$this->db->select($select);
		}

		if (!empty($table)) {
			$this->db->from($table);
		}

		if (count($join_table) != 0 && count($join_on) != 0 && count($join_name) != 0) {
			for ($i = 0; $i < count($join_table); $i++) {
				$this->db->join($join_table[$i], $join_on[$i], $join_name[$i]);
			}
		} else {
			for ($j = 0; $j < count($join_table); $j++) {
				$this->db->join($join_table[$j], $join_on[$j]);
			}
		}

		if (count($where) != 0) {
			$this->db->where($where);
		}

		if (!empty($order)) {
			$this->db->order_by($order);
		}

		if (count($group_by) > 0) {
			$this->db->group_by($group_by);
		}
		//echo $this->db->last_query();//die;
		//echo '<br><br>';
		$query = $this->db->get();

		$result = $query->result_array();
		return $result;
	}

	#############Slef Query################
	public function appointment_with_doctor($table, $condition)
	{
		if (!empty($condition)) {
			$this->db->select('a.*,d.doctorname');
			$this->db->join('doctor d', 'd.id=a.doctor', 'full');
			$this->db->where($condition);
			$q = $this->db->get('appointment a');

			//echo '<br><br>';
			return $q->result_array();
		} else {
			$this->db->select('a.*,d.doctorname');
			$this->db->join('doctor d', 'd.id=a.doctor', 'full');
			$q = $this->db->get('appointment a');
			// echo $this->db->last_query();
			// die;
			return $q->result_array();
		}
	}
	public function appointment_with_doctor_search($table, $from, $to)
	{

		$this->db->select('a.*,d.doctorname');
		$this->db->join('doctor d', 'd.id=a.doctor', 'full');
		$this->db->where(['appointdate >=' => $from, 'appointdate<=' => $to]);
		$q = $this->db->get('appointment a');
		//echo '<br><br>';
		return $q->result_array();
	}
	public function login_valid($username, $password)
	{
		$this->db->where(['email' => $username, 'password' => $password]);

		$q = $this->db->get('admin');

		if ($q->num_rows()) {
			return $q->row();
			exit;
		} else {
			return false;
		}
	}
}
