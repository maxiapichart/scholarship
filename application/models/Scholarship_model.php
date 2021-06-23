<?php 
class Scholarship_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	// LOAD

	public function load_family($registration_id) {
		$this->db->where('f.registration_id', $registration_id);
		$this->db->where('f.student_id', $this->session->userdata('username'));
		$this->db->join('district AS d', 'd.district_id = f.district_id');
		$this->db->join('amphure AS a', 'a.amphure_id = d.amphure_id');
		$this->db->join('province AS p', 'p.province_id = a.province_id');
		return $this->db->get('family AS f')->result_array();
	}
	public function addrSearch($addr) {
		return $this->db->query("
			SELECT d.district_id, d.zip_code, d.district_name, a.amphure_name, p.province_name, g.geography_name
			FROM district AS d
			LEFT JOIN amphure AS a ON a.amphure_id = d.amphure_id
			LEFT JOIN province AS p ON p.province_id = a.province_id
			LEFT JOIN geography AS g ON g.geography_id = p.geography_id
			WHERE d.district_name LIKE '%{$addr}%' OR a.amphure_name LIKE '%{$addr}%' OR p.province_name LIKE '%{$addr}%' OR d.zip_code LIKE '{$addr}%'
			ORDER BY (
				CASE
					WHEN d.district_name	= '{$addr}' THEN 1
					WHEN a.amphure_name		= '{$addr}' THEN 2
					WHEN p.province_name	= '{$addr}' THEN 3
					WHEN d.district_name	LIKE '{$addr}%' THEN 4
					WHEN a.amphure_name		LIKE '{$addr}%' THEN 5
					WHEN p.province_name	LIKE '{$addr}%' THEN 6
					ELSE 7
				END
			), d.district_name, a.amphure_name, p.province_name
			LIMIT 10
		")->result_array();
	}
	public function load_student_id() {
		$this->luck	= $this->load->database('luck', true);
		return	$this->luck->query("
			SELECT S.STUDENT_ID AS STUDENT_ID, S.STUD_NAME_THAI AS FNAME, S.STUD_SNAME_THAI AS SNAME, S.CAMPUS_ID AS CAMPUS_ID,
				S.FAC_ID AS FAC_ID, F.FAC_NAME_THAI AS FAC_NAME,
				S.DEPT_ID AS DEPT_ID, D.DEPT_NAME_THAI AS DEPT_NAME,
				S.MAJOR_ID AS MAJOR_ID, M.MAJOR_NAME_THAI AS MAJOR_NAME,
				T.TITLE_NAME_THAI AS TITLE
			FROM REGIST2005_NEW.STUDENT{$GLOBALS['CAMPUS_AT'][$this->session->userdata('campus_id')]} S
			LEFT JOIN REGIST2005_NEW.FACULTY F ON S.FAC_ID = F.FAC_ID
			LEFT JOIN REGIST2005_NEW.DEPT D ON S.DEPT_ID = D.DEPT_ID
			LEFT JOIN REGIST2005_NEW.MAJOR M ON S.MAJOR_ID = M.MAJOR_ID
			LEFT JOIN REGIST2005_NEW.TITLE T ON S.TITLE_ID = T.TITLE_ID
			WHERE S.STUDENT_ID = '{$this->session->userdata('username')}'
		")->result_array();
	}
	public function load_student_family() {
		$this->luck	= $this->load->database('luck', true);
		return	$this->luck->query("
			SELECT R.STUDENT_ID, R.TYPE_ID,
				T.TITLE_NAME_THAI AS TITLE, F.FAMILY_FNAME || ' ' || F.FAMILY_SNAME AS FULL_NAME,
				F.FAMILY_FNAME AS FNAME, F.FAMILY_SNAME AS SNAME, F.BIRTH_DATE
			FROM REGIST2005_NEW.STUDENT_RELATION R
			LEFT JOIN REGIST2005_NEW.STUDENT_FAMILY F ON F.FAMILY_KEY = R.FAMILY_KEY
			LEFT JOIN REGIST2005_NEW.TITLE T ON T.TITLE_ID = F.FAMILY_TITLE_ID
			WHERE R.STUDENT_ID = '{$this->session->userdata('username')}'
				AND (R.TYPE_ID = 1 OR R.TYPE_ID = 2)
			ORDER BY R.TYPE_ID ASC
		")->result_array();
	}
	public function find_name($student_id) {
		$this->luck	= $this->load->database('luck', true);
		if(!isset($GLOBALS['CAMPUS_AT']['0'.substr($student_id, 2, 1)])) {
			return false;
		}
		$result	=	$this->luck->query("
			SELECT S.STUDENT_ID AS STUDENT_ID, T.TITLE_NAME_THAI || S.STUD_NAME_THAI || ' ' || S.STUD_SNAME_THAI AS FULL_NAME
			FROM REGIST2005_NEW.STUDENT{$GLOBALS['CAMPUS_AT']['0'.substr($student_id, 2, 1)]} S
			LEFT JOIN REGIST2005_NEW.TITLE T ON S.TITLE_ID = T.TITLE_ID
			WHERE S.STUDENT_ID = '{$student_id}'
		")->result_array();
		return count($result) ? $result[0]['FULL_NAME'] : false;
	}
	public function load_select($selectdata_type) {
		return	$this->db->query("
			SELECT s.*
			FROM selectdata AS s
			WHERE s.selectdata_type = '{$selectdata_type}'
			ORDER BY CASE WHEN s.selectdata_group IS NULL THEN 1 ELSE 0 END, s.selectdata_group
		")->result_array();
	}
	public function load_interview($registration_id) {
		return	$this->db->query("
			SELECT i.*, COALESCE(r.student, 0) AS student
			FROM interview AS i
			LEFT JOIN (
				SELECT COUNT(r.student_id) AS student, r.interview
				FROM register AS r
				GROUP BY r.interview
			) AS r ON r.interview = i.interview_id
			WHERE i.registration_id = {$registration_id}
			ORDER BY start
		")->result_array();
	}

	// INSERT
}