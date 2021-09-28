<?php
class Prepare_model extends CI_Model {

  public function __construct() {
    parent::__construct();
  }

  // LOAD
  public function load_data($tb, $field = [], $value = [], $order = [], $by = []) {
    $field  = is_array($field) ? $field : [$field];
    $value  = is_array($value) ? $value : [$value];
    $order  = is_array($order) ? $order : [$order];
    $by      = is_array($by) ? $by : [$by];

    for ($i = 0; $i < count($field); $i++)
      $this->db->where($field[$i], $value[$i]);

    for ($i = 0; $i < count($order); $i++)
      $this->db->order_by($order[$i], isset($by[$i]) ? $by[$i] : 'ASC');

    return $this->db->get($tb)->result_array();
  }

  // INSERT
  public function insert_data($tb, $ar) {
    $this->db->insert($tb, $ar);
    return $this->db->insert_id();
  }

  public function insert_batch($tb, $ar) {
    count($ar) == 0 ?: $this->db->insert_batch($tb, $ar);
  }

  //UPDATE
  public function update_data($tb, $field, $value, $ar) {
    $field  = is_array($field) ? $field : [$field];
    $value  = is_array($value) ? $value : [$value];
    for ($i = 0; $i < count($field); $i++) {
      $this->db->where($field[$i], $value[$i]);
    }
    $this->db->update($tb, $ar);
  }

  //DELETE
  public function delete_data($tb, $field, $value) {
    $tb      = is_array($tb) ? $tb : [$tb];
    $field  = is_array($field) ? $field : [$field];
    $value  = is_array($value) ? $value : [$value];
    foreach ($tb as $ar_tb) {
      for ($i = 0; $i < count($field); $i++) {
        $this->db->where($field[$i], $value[$i]);
      }
      $this->db->delete($ar_tb);
    }
  }

  //OTHER
  public function load_interviewer($username) {
    $this->db->where('username', $username);
    return $this->db->get('interviewer')->result_array();
  }

  public function load_admin_enable($username) {
    $this->db->where('username', $username);
    $this->db->where('enable', 1);
    return $this->db->get('admin')->result_array();
  }

  public function load_name($username, $campus_id = '') {
    if (is_numeric($username)) {
      $this->luck  = $this->load->database('luck', true);
      $at          = $GLOBALS['CAMPUS_AT'][$campus_id];
      $result     = $this->luck->query(
        "SELECT S.STUDENT_ID AS STUDENT_ID,
					T.TITLE_NAME_THAI || S.STUD_NAME_THAI || ' ' || S.STUD_SNAME_THAI AS FULL_NAME
				FROM REGIST2005_NEW.STUDENT$at S
				LEFT JOIN REGIST2005_NEW.TITLE T ON S.TITLE_ID = T.TITLE_ID
				WHERE S.STUDENT_ID = '{$username}'"
      )->result_array();
    } else {
      $this->nora  = $this->load->database('nora', true);
      $result      = $this->nora->query(
        "SELECT A.USERNAME AS USERNAME,
					C.TITLE_NAME_THAI || P.STAFF_NAME_THAI || ' ' || P.STAFF_SNAME_THAI AS FULL_NAME
				FROM (SELECT *
					FROM PERSONEL.P_STAFF
					WHERE STAFF_ID in (
						SELECT MAX(P.STAFF_ID) AS STAFF_ID
						FROM PERSONEL.P_STAFF P
						GROUP BY P.STAFF_PERS_ID
					)
				) P
				LEFT JOIN DIR_SERVICE.AD_STAFF A ON A.CITIZENID = P.STAFF_PERS_ID 
				LEFT JOIN CENTRAL.C_TITLE C ON C.TITLE_ID = P.TITLE_ID
				WHERE A.USERNAME = '{$username}'"
      )->result_array();
    }
    return count($result) > 0 ? $result[0]['FULL_NAME'] : false;
  }

  public function displayDate($start, $stop = false, $color = true) {
    $m  = ['ม.ค.', 'ก.พ', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];

    $text  = '<div class="date ' . (!$color ?: ($start <= time() && $stop > time()  ? 'text-success' : 'text-muted')) . '"><span>' . date('j ', $start) . $m[date('n', $start) - 1] . ' ' . (date('Y', $start) + 543 - 2500) . ' | ' . date('G:i', $start) . '</span></div>';
    $text  .= $stop ? '<small><div class="date ' . (!$color ?: ($start <= time() && $stop > time()  ? 'text-warning' : 'text-muted')) . '"> <span>' . date('j ', $stop) . $m[date('n', $stop) - 1] . ' ' . (date('Y', $stop) + 543 - 2500) . ' | ' . date('G:i', $stop) . '</span></div></small>' : '';
    return $text;
  }
  public function date_between($start, $end) {
    $m  = ['ม.ค.', 'ก.พ', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
    return '<span' . ($start <= time() && $end > time() ? ' class="text-success"' : '') . '>' . date('j ', $start) . $m[date('n', $start) - 1] . ' ' . (date('Y', $start) + 543 - 2500) . ' | ' . date('G:i', $start) . ' - ' . date('G:i', $end) . '</span>';
  }
}
