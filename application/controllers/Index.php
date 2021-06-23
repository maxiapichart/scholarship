<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}
	public function test() {
		$this->load->view('test');
	}
	public function index() {
		$data['title']			= 'หน้าแรก';
		$data['content']		= 'index';
		$this->load->view('include/layout', $data);
	}
	public function news() {
		if(!$this->session->userdata('logged_in') || $this->session->userdata('user_type') != 'Admin') {
			redirect();
		}
		if($this->input->post()) {
			$path	= 'assets/files/news.html';
			$file	= fopen($path, 'w+') or die('Unable to open file!');
			fwrite($file, $this->input->post('news'));
			// chmod($path, 0777);
			fclose($file);
			redirect();
		}
		$data['breadcrumb']	= ['หน้าแรก' => ''];
		$data['title']			= 'แก้ไขข่าว';
		$data['content']		= 'news';
		$this->load->view('include/layout', $data);
	}

	public function loadFile() {
		$dir = 'assets/files/upload';
		$ignored = ['.', '..', '.svn', '.htaccess'];
		$day_expire = 365;
		$day_remove = $day_expire * 2;
		$date_expire = strtotime("-{$day_expire} days", time());
		$date_remove = strtotime("-{$day_remove} days", time());

		$files		= [];
		foreach (scandir($dir) as $f) {
			if (in_array($f, $ignored)) continue;
			$filemtime = filemtime("{$dir}/{$f}");
			if($filemtime - $date_expire < 0) {
				if($filemtime - $date_remove < 0) {
					unlink("assets/files/upload/{$f}");
				}
			} else {
				$files[$f] = $filemtime;
			}
		}

		arsort($files);
		$files	= array_keys($files);

		// $files	= array_map(function($v) {
		// 	// return iconv('windows-874', 'UTF-8', $v);
		// 	return $v;
		// }, $files);

		echo json_encode([$files, $date_expire]);
	}
	public function uploadFile() {
		$path	= 'assets/files/upload';
		$config['upload_path']		= $path;
		$config['allowed_types']	= '*';
		$config['encrypt_name']		= TRUE;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file')) {
			$file			= $this->upload->data();
			$filename	= $this->rename($file['file_path'], $file['orig_name']);
			rename($file['full_path'], $filename);
			echo 1;
		} else {
			echo $this->upload->display_errors();
		}
	}
	public function deleteFile() {
		echo unlink("assets/files/upload/{$this->input->post('name')}");
	}
	public function rename($directory, $filename){
		// $filename		= iconv("UTF-8", "TIS-620", $filename);
		$basename		= pathinfo($filename, PATHINFO_FILENAME);
		$extension	= pathinfo($filename, PATHINFO_EXTENSION);
		$i = 1;
		while (file_exists($directory.$filename)) {
			$i++;
			$filename	= "{$basename}_{$i}.{$extension}";
		}
		return $directory.$filename;
	}
	public function datatableTH() {
		echo json_encode([
			'sEmptyTable'			=> "ไม่มีข้อมูล",
			'sInfo'						=> "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
			'sInfoEmpty'			=> "แสดง 0 ถึง 0 จาก 0 แถว",
			'sInfoFiltered'		=> "(กรองข้อมูล _MAX_ ทุกแถว)",
			'sInfoPostFix'		=> 	"",
			'sInfoThousands'	=> 	",",
			'sLengthMenu'			=> "แสดง _MENU_ แถว",
			'sLoadingRecords'	=> "กำลังโหลดข้อมูล...",
			'sProcessing'			=> "กำลังดำเนินการ...",
			'sSearch'					=> "ค้นหา: ",
			'sZeroRecords'		=> "ไม่พบข้อมูล",
			'oPaginate'	=> [
				'sFirst'		=> "หน้าแรก",
				'sPrevious'	=> "ก่อนหน้า",
				'sNext'			=> "ถัดไป",
				'sLast'			=> "หน้าสุดท้าย"
			],
			'oAria'	=> [
				'sSortAscending' 	=>  ": เปิดใช้งานการเรียงข้อมูลจากน้อยไปมาก",
				'sSortDescending'	=>  ": เปิดใช้งานการเรียงข้อมูลจากมากไปน้อย"
			]
		]);
	}
	public function upload() {
		$image = $_POST['image'];

		list($type, $image) = explode(';',$image);
		list(, $image) = explode(',',$image);

		$image = base64_decode($image);
		$image_name = time().'.png';
		file_put_contents("assets/uploads/{$image_name}", $image);

		echo 'successfully uploaded';
		echo '<br/>'.$image;
		echo '<br/>'.$image_name;

	}
		public function login() {
		$username	= trim($this->input->post('username'));
		$password	= $this->input->post('password');

		require_once './assets/ldappsu.php';
		$server	= array('dc2.psu.ac.th', 'dc7.psu.ac.th', 'dc1.psu.ac.th');
		$basedn	= 'dc=psu,dc=ac,dc=th';
		$domain	= 'psu.ac.th';
		$ldap		= authenticate($server, $basedn, $domain, $username, $password);
		if ($ldap[0]) {
			$status	= 1;
			$admin				= $this->Prepare_model->load_admin_enable($username);
			$interviewer	= $this->Prepare_model->load_interviewer($username);
			if(count($admin)) {
				$ar_session['user_type']	= 'Admin';
				$ar_session['level_id']		= $admin[0]['level_id'];
				$ar_session['campus_id']	= $admin[0]['campus_id'];
				$ar_session['fac_id']			= $admin[0]['fac_id'];
				$ar_session['developer']	= $admin[0]['level_id'] == 0 ? true : false;
				$ar_session['username']		= $username;
				$ar_session['name']				= $this->Prepare_model->load_name($username);
				$ar_session['logged_in']	= true;

				$this->session->set_userdata($ar_session);
				$status	= 2;
			} else if (count($interviewer)) {
				$ar_session['user_type']	= 'interviewer';
				$ar_session['username']		= $username;
				$ar_session['name']				= $this->Prepare_model->load_name($username);
				$ar_session['logged_in']	= true;

				$this->session->set_userdata($ar_session);
				$status	= 2;
			} else {
				$temp				= explode(',', $ldap[1]['dn']);
				$user_type	= str_replace('OU=', '', $temp[4]);
				if($user_type == 'Students' || $user_type == 'Alumni') {
					$ar_session['user_type']	= 'Student';
					$ar_session['username']		= $ldap[1]['accountname'];
					$ar_session['name']				= $this->Prepare_model->load_name($username, $ldap[1]['campusid']);
					$ar_session['campus_id']	= $ldap[1]['campusid'];
					$ar_session['fac_id']			= str_replace('OU=F', '', $temp)[2];
					$ar_session['logged_in']	= true;

					$this->session->set_userdata($ar_session);
					$status	= 2;
				}
			}
		} else {
			$status	= 0;
		}
		echo $status;
	}
	public function logout() {
		$this->session->sess_destroy();
		redirect();
	}
	public function reset_session() {
		foreach ($this->session->userdata() as $key => $value ) {
			$ar_session[$key] = $value;
		}
		$ar_session['user_type']	= 'Admin';
		$ar_session['username']		= $this->session->userdata('username_tmp');
		$ar_session['name']				= $this->session->userdata('name_tmp');
		$ar_session['campus_id']	= $this->session->userdata('campus_id_tmp');
		$this->session->set_userdata($ar_session);
		redirect();
	}

	public function simulator() {
		foreach ($this->session->userdata() as $key => $value ) {
			$ar_session[$key] = $value;
		}
		$student_id	= $this->input->post('student_id');
		$campus_id	= '0'.substr($student_id, 2, 1);
		$name				= $this->Prepare_model->load_name($student_id, $campus_id);
		if($name) {
			$ar_session['username_tmp']		= $this->session->userdata('username');
			$ar_session['name_tmp']				= $this->session->userdata('name');
			$ar_session['campus_id_tmp']	= $this->session->userdata('campus_id');

			$ar_session['user_type']	= 'Student';
			$ar_session['username']		= $student_id;
			$ar_session['name']				= $name;
			$ar_session['campus_id']	= $campus_id;
			$this->session->set_userdata($ar_session);
		}
		redirect();
	}
}
