<?php 
class Annual_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	// LOAD
	public function load_family($student_id, $registration_id) {
		$this->db->where('f.registration_id', $registration_id);
		$this->db->where('f.student_id', $student_id);
		$this->db->join('district AS d', 'd.district_id = f.district_id');
		$this->db->join('amphure AS a', 'a.amphure_id = d.amphure_id');
		$this->db->join('province AS p', 'p.province_id = a.province_id');
		return $this->db->get('family AS f')->result_array();
	}
	public function load_student_id($student_id) {
		$this->luck	= $this->load->database('luck', true);
		$year	= substr($student_id, 0, 2) + 2500;
		$at	= $GLOBALS['CAMPUS_AT']['0'.substr($student_id, 2, 1)];
		return	$this->luck->query("
			SELECT S.STUDENT_ID AS STUDENT_ID, S.STUD_NAME_THAI AS FNAME, S.STUD_SNAME_THAI AS SNAME, S.CAMPUS_ID AS CAMPUS_ID,
				S.FAC_ID AS FAC_ID, F.FAC_NAME_THAI AS FAC_NAME,
				S.DEPT_ID AS DEPT_ID, D.DEPT_NAME_THAI AS DEPT_NAME,
				S.MAJOR_ID AS MAJOR_ID, M.MAJOR_NAME_THAI AS MAJOR_NAME,
				T.TITLE_NAME_THAI AS TITLE,
				G.EDU_YEAR AS YEAR, G.EDU_TERM AS TERM, NVL(G.CUM_GPA, SN.GPA) AS GPA
			FROM REGIST2005_NEW.STUDENT{$at} S
			LEFT JOIN REGIST2005_NEW.FACULTY F ON S.FAC_ID = F.FAC_ID
			LEFT JOIN REGIST2005_NEW.DEPT D ON S.DEPT_ID = D.DEPT_ID
			LEFT JOIN REGIST2005_NEW.MAJOR M ON S.MAJOR_ID = M.MAJOR_ID
			LEFT JOIN REGIST2005_NEW.TITLE T ON S.TITLE_ID = T.TITLE_ID
			LEFT JOIN REGIST2005_NEW.SN_STUDENT SN ON SN.STUDENT_ID = S.STUDENT_ID
			LEFT JOIN (
				SELECT MAX(YT.EDU_YEAR || YT.EDU_TERM) AS LASTEST, YT.STUDENT_ID
				FROM REGIST2005_NEW.GPA YT
				WHERE YT.EDU_YEAR >= TO_NUMBER(SUBSTR(YT.STUDENT_ID, 0, 2) + 2500)
				GROUP BY YT.STUDENT_ID
			) YT ON YT.STUDENT_ID = S.STUDENT_ID
			LEFT JOIN REGIST2005_NEW.GPA G ON G.STUDENT_ID = S.STUDENT_ID AND G.EDU_YEAR || G.EDU_TERM = YT.LASTEST
			WHERE S.STUDENT_ID = '{$student_id}'
		")->result_array();
	}
	public function load_registration($post) {
		$where = ($post['year'] != '' ? " WHERE r.year = '{$post['year']}'" : '');
		return $this->db->query("
			SELECT r.*,
				COALESCE(i.num, 0) AS num, COALESCE(i.seat, 0) AS seat,
				COALESCE(re1.student, 0) AS student,
				COALESCE(re2.applying, 0) AS applying,
				COALESCE(re3.applied, 0) AS applied
			FROM registration AS r
			LEFT JOIN (
				SELECT i.registration_id, COUNT(i.interview_id) AS num, SUM(i.seat) AS seat
				FROM interview AS i
				GROUP BY i.registration_id
			) AS i ON i.registration_id = r.registration_id
			LEFT JOIN (
				SELECT re.registration_id, COUNT(re.student_id) AS student
				FROM register AS re
				WHERE re.interview IS NOT NULL
				GROUP BY re.registration_id
			) AS re1 ON re1.registration_id = r.registration_id
			LEFT JOIN (
				SELECT re.registration_id, COUNT(re.student_id) AS applying
				FROM register AS re
				WHERE re.register IS NULL
				GROUP BY re.registration_id
			) AS re2 ON re2.registration_id = r.registration_id
			LEFT JOIN (
				SELECT re.registration_id, COUNT(re.student_id) AS applied
				FROM register AS re
				WHERE re.register IS NOT NULL
				GROUP BY re.registration_id
			) AS re3 ON re3.registration_id = r.registration_id{$where}
			ORDER BY r.modify DESC"
		)->result_array();
	}
	public function load_registration_id($post) {
		return $this->db->query("
			SELECT r.*, COALESCE(re.student, 0) AS student
			FROM registration AS r
			LEFT JOIN (
				SELECT re.registration_id, COUNT(re.student_id) AS student
				FROM register AS re
				GROUP BY re.registration_id
			) AS re ON re.registration_id = r.registration_id
			WHERE r.registration_id = '{$post['registration_id']}'
		")->result_array();
	}
	public function list_student($post) {
		return $this->db->query("
			SELECT r.*, i.start, COALESCE(c.total, 0) AS total, g.googledrive
			FROM register AS r
			LEFT JOIN interview AS i ON i.interview_id = r.interview
			LEFT JOIN googledrive AS g ON g.registration_id = r.registration_id AND g.student_id = r.student_id
			LEFT JOIN (
				SELECT COUNT(*) AS total, c.registration_id, c.student_id
				FROM certificate AS c
				WHERE c.status = 1 OR c.status = 2
				GROUP BY c.registration_id, c.student_id
			) AS c ON c.registration_id = r.registration_id AND c.student_id = r.student_id
			WHERE r.registration_id = {$post['registration_id']}".
			($post['apply'] != '' ? ($post['apply'] == 1 ? " AND r.register IS NULL" : " AND r.register IS NOT NULL") : '')
		)->result_array();
	}
	public function list_interviewee($post) {
		return $this->db->query("
			SELECT r.*, i.start, i.stop, i.interview_name,COALESCE(i2.total, 0) AS total, COALESCE(i2.num, 0) AS num, p.province_name
			FROM register AS r
			JOIN interview AS i ON i.interview_id = r.interview
			LEFT JOIN family AS f ON f.registration_id = r.registration_id AND f.student_id = r.student_id
			LEFT JOIN district AS d ON d.district_id = f.district_id
			LEFT JOIN amphure AS a ON a.amphure_id = d.amphure_id
			LEFT JOIN province AS p ON p.province_id = a.province_id
			LEFT JOIN (
				SELECT COUNT(*) AS num, SUM(i.point) AS total, interview_id, student_id
				FROM interviewee AS i
				GROUP BY interview_id, student_id
			) AS i2 ON i2.interview_id = r.interview AND i2.student_id = r.student_id
			WHERE i.registration_id = {$post['registration_id']}
		")->result_array();
	}
	public function load_interviewee_id($interview_id, $student_id) {
		return $this->db->query("
			SELECT r.interview_id, r.username, e.point, e.comment
			FROM interviewer AS r
			LEFT JOIN (
				SELECT *
				FROM interviewee AS e
				WHERE student_id = '{$student_id}'
			) AS e ON e.interview_id = r.interview_id AND e.username = r.username
			WHERE r.interview_id = '{$interview_id}'
			UNION
			SELECT e.interview_id, e.username, e.point, e.comment
			FROM interviewer AS r
			RIGHT JOIN (
				SELECT *
				FROM interviewee AS e
				WHERE student_id = '{$student_id}'
			) AS e ON e.interview_id = r.interview_id
			WHERE r.interview_id = '{$interview_id}'
		")->result_array();
	}
	public function load_interview($registration_id) {
		return $this->db->query("
			SELECT i.*, COALESCE(r.student, 0) AS student
			FROM interview AS i
			LEFT JOIN (
				SELECT r.interview, COUNT(r.student_id) AS student
				FROM register AS r
				WHERE r.register IS NOT NULL
				GROUP BY r.interview
			) AS r ON r.interview = i.interview_id
			WHERE registration_id = {$registration_id}
		")->result_array();
	}
	public function find_name($psu) {
		$this->nora	= $this->load->database('nora', true);
		$result = $this->nora->query("
			SELECT A.USERNAME AS USERNAME, C.TITLE_NAME_THAI || P.STAFF_NAME_THAI || ' ' || P.STAFF_SNAME_THAI AS PSU_FULL_NAME
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
			WHERE A.USERNAME = '{$psu}'
		")->result_array();
		return count($result) ? $result[0]['PSU_FULL_NAME'] : false;
	}
	public function load_register($registration_id, $student_id) {
		return $this->db->query("
			SELECT *
			FROM register AS re
			LEFT JOIN profile AS p ON p.registration_id = re.registration_id AND p.student_id = re.student_id
			WHERE re.registration_id = {$registration_id} AND re.student_id = {$student_id}
		")->result_array();
	}
	public function load_inteview_student($registration_id) {
		$student	= $this->db->query("
			SELECT i.*, i2.start, i2.stop, r.student_id, i3.point, i3.comment
			FROM interviewer AS i
			LEFT JOIN interview AS i2 ON i2.interview_id = i.interview_id
			LEFT JOIN register AS r ON r.interview = i.interview_id
			LEFT JOIN interviewee AS i3 ON i3.interview_id = i.interview_id AND i3.username = i.username AND i3.student_id = r.student_id
			WHERE i.registration_id = {$registration_id}
				AND i.username = '{$this->session->userdata('username')}'
			ORDER BY i2.start ASC
		")->result_array();

		$ar_temp		= [];
		foreach ($student as $ar) {
			$ar_return	= $ar;
			if($ar['student_id'] != null) {
				$student		= $this->load_student_id($ar['student_id']);
				$ar_return['student_name']	= $student[0]['TITLE'].$student[0]['FNAME'].' '.$student[0]['SNAME'];
				$ar_return['fac_name']			= $student[0]['FAC_NAME'];
			}
			$ar_temp	= array_merge($ar_temp, [$ar_return]);
		}
		return $ar_temp;
	}
	public function load_interview_username($registration_id, $student_id) {
		return $this->db->query("
			SELECT i.*, i2.point, i2.comment
			FROM interviewer AS i
			JOIN register AS r ON r.interview = i.interview_id
			LEFT JOIN interviewee AS i2 ON i2.interview_id = i.interview_id AND i2.username = i.username AND i2.student_id = r.student_id
			WHERE i.registration_id = {$registration_id}
				AND r.student_id = '{$student_id}'
				AND i.username = '{$this->session->userdata('username')}'
		")->result_array();
	}







	public function load_student_family($student_id) {
		$this->luck	= $this->load->database('luck', true);
		return	$this->luck->query("
			SELECT R.STUDENT_ID, R.TYPE_ID,
				T.TITLE_NAME_THAI AS TITLE, F.FAMILY_FNAME || ' ' || F.FAMILY_SNAME AS FULL_NAME,
				F.FAMILY_FNAME AS FNAME, F.FAMILY_SNAME AS SNAME, F.BIRTH_DATE
			FROM REGIST2005_NEW.STUDENT_RELATION R
			LEFT JOIN REGIST2005_NEW.STUDENT_FAMILY F ON F.FAMILY_KEY = R.FAMILY_KEY
			LEFT JOIN REGIST2005_NEW.TITLE T ON T.TITLE_ID = F.FAMILY_TITLE_ID
			WHERE R.STUDENT_ID = '{$student_id}'
				AND (R.TYPE_ID = 1 OR R.TYPE_ID = 2)
			ORDER BY R.TYPE_ID ASC
		")->result_array();
	}
	public function find_student_name($student_id) {
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
}