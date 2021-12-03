<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Annual extends CI_Controller {
  public function __construct() {
    parent::__construct();
    if (!$this->session->userdata('logged_in') || ($this->session->userdata('user_type') != 'Admin' && $this->session->userdata('user_type') != 'interviewer')) {
      redirect('?url=' . current_url());
    }
    $this->load->model('Annual_model');
    $this->load->model('Scholarship_model');
  }
  public function addrSearch() {
    foreach ($this->Annual_model->addrSearch($this->input->get('addr')) as $ar) {
      echo "<p>ต.{$ar['district_name']} อ.{$ar['amphure_name']} จ.{$ar['province_name']} {$ar['zip_code']} <small>({$ar['district_id']})</small></p>";
    }
  }
  public function index() {
    $data['title']    = 'วันสมัคร | รอบสัมภาษณ์';
    $data['content']  = 'registration/main';
    $this->load->view('include/layout', $data);
  }
  public function ratings() {
    if ($this->input->post()) {
      $ar  = [
        'interview_id'  => $this->input->post('interview_id'),
        'student_id'    => $this->input->post('student_id'),
        'point'          => $this->input->post('point'),
        'comment'        => $this->input->post('comment'),
        'username'      => $this->session->userdata('username'),
      ];
      $this->Prepare_model->delete_data('interviewee', ['interview_id', 'student_id', 'username'], [$ar['interview_id'], $ar['student_id'], $ar['username']]);
      $this->Prepare_model->insert_data('interviewee', $ar);
    }
    redirect("annual/interview/");
  }
  public function list_interviewee() {
    $ar_temp    = [];
    foreach ($this->Annual_model->list_interviewee($this->input->post()) as $ar) {
      $student    = $this->Annual_model->load_student_id($ar['student_id']);
      $ar_return  = $ar;
      $ar_return['student_name']  = $student[0]['TITLE'] . $student[0]['FNAME'] . ' ' . $student[0]['SNAME'];
      $ar_return['fac_name']      = $student[0]['FAC_NAME'];
      $ar_return['gpa']            = $student[0]['GPA'];
      // echo $ar['student_id'];
      // print_r($student);
      $ar_temp  = array_merge($ar_temp, [$ar_return]);
    }
    echo json_encode($ar_temp);
  }
  public function interviewee($registration_id) {
    $registration_id != '' ?: redirect();
    $registration  = $registration_id != 0 ? $this->Prepare_model->load_data('registration', 'registration_id', $registration_id) : [];
    $data['certificate']      = $this->Annual_model->load_select('certificate');
    $data['registration_id']  = $registration_id;
    $data['breadcrumb']        = ['วันสมัคร | รอบสัมภาษณ์' => 'annual'];
    $data['title']            = "ผลสัมภาษณ์นักศึกษา  \"{$registration[0]['registration_title']}\"";
    $data['content']          = 'registration/interviewee';
    $this->load->view('include/layout', $data);
  }
  public function interviewer($registration_id, $student_id) {
    $registration_id != '' && $student_id != '' ?: redirect('annual');
    $interview            = $this->Annual_model->load_interview_username($registration_id, $student_id);
    $registration          = $this->Prepare_model->load_data('registration', 'registration_id', $registration_id);
    count($interview) > 0 || $this->session->userdata('developer') ?: redirect('annual');
    $get['apply']          = $this->input->get('apply');
    $data['interview']    = $interview[0];
    $data['registration']  = $registration[0];
    $data['profile']    = $this->Annual_model->load_student_id($student_id);
    $data['family']      = $this->Annual_model->load_student_family($student_id);
    $data['bank']    = $this->Annual_model->load_select('bank');
    $data['religion']    = $this->Annual_model->load_select('religion');
    $data['address']    = $this->Annual_model->load_select('address');
    $data['tostudy']    = $this->Annual_model->load_select('tostudy');
    $data['accessories']  = $this->Annual_model->load_select('accessories');
    $data['mobile']      = $this->Annual_model->load_select('mobile');
    $data['status']      = $this->Annual_model->load_select('status');
    $data['statusFather']  = $this->Annual_model->load_select('statusFather');
    $data['statusMother']  = $this->Annual_model->load_select('statusMother');
    $data['statusPatron']  = $this->Annual_model->load_select('statusPatron');
    $data['job']      = $this->Annual_model->load_select('job');
    $data['marital']    = $this->Annual_model->load_select('marital');
    $data['education']    = $this->Annual_model->load_select('education');
    $data['siblingAddr']  = $this->Annual_model->load_select('siblingAddr');
    $data['asset']      = $this->Annual_model->load_select('asset');
    $data['rent']      = $this->Annual_model->load_select('rent');
    $data['installment']  = $this->Annual_model->load_select('installment');
    $data['relative']    = $this->Annual_model->load_select('relative');
    $data['income']      = $this->Annual_model->load_select('income');
    $data['outcome']    = $this->Annual_model->load_select('outcome');
    $data['certificate']  = $this->Annual_model->load_select('certificate');
    $data['student_id']    = $student_id;
    $data['student']    = $this->Annual_model->load_student_id($student_id);
    $data['googledrive']  = $this->Prepare_model->load_data('googledrive', ['student_id', 'registration_id'], [$student_id, $registration_id]);


    $data['profile']['data']    = $this->Prepare_model->load_data('profile', ['student_id', 'registration_id'], [$student_id, $registration_id])[0];
    $family  = $this->Annual_model->load_family($student_id, $registration_id);
    $family  = array_merge($family, [$this->Prepare_model->load_data('parent', ['student_id', 'registration_id'], [$student_id, $registration_id])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('job', ['student_id', 'registration_id'], [$student_id, $registration_id])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('child', ['student_id', 'registration_id'], [$student_id, $registration_id])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('loan', ['student_id', 'registration_id'], [$student_id, $registration_id], ['seq'])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('vehicle', ['student_id', 'registration_id'], [$student_id, $registration_id], ['seq'])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('property', ['student_id', 'registration_id'], [$student_id, $registration_id])]);
    $data['family']['data']  = $family;

    $sibling          = $this->Prepare_model->load_data('nosibling', ['student_id', 'registration_id'], [$student_id, $registration_id]);
    if (count($sibling) > 0) {
      $data['sibling']['data']  = false;
    } else {
      $sibling  = $this->Prepare_model->load_data('sibling_study', ['student_id', 'registration_id'], [$student_id, $registration_id], ['seq']);
      $sibling  = array_merge([$sibling], [$this->Prepare_model->load_data('sibling_working', ['student_id', 'registration_id'], [$student_id, $registration_id], ['seq'])]);
      $data['sibling']['data']  = $sibling;
    }

    $finance  = $this->Prepare_model->load_data('finance', ['student_id', 'registration_id'], [$student_id, $registration_id]);
    $finance  = array_merge($finance, [$this->Prepare_model->load_data('finance_fund', ['student_id', 'registration_id'], [$student_id, $registration_id], ['seq'])]);
    $finance  = array_merge($finance, [$this->Prepare_model->load_data('finance_scholarship', ['student_id', 'registration_id'], [$student_id, $registration_id], ['seq'])]);
    $finance  = array_merge($finance, [$this->Prepare_model->load_data('finance_job', ['student_id', 'registration_id'], [$student_id, $registration_id], ['seq'])]);
    $data['finance']['data']  = $finance;

    $data['explain']['data']  = $this->Prepare_model->load_data('explain', ['student_id', 'registration_id'], [$student_id, $registration_id]);

    $data['breadcrumb']    = ['สัมภาษณ์' => 'annual'];
    $data['title']      = "สัมภาษณ์ {$student_id}";
    $data['content']    = 'interview/interview';
    $this->load->view('include/layout', $data);
  }
  public function interview() {
    $get['year'] = $this->input->get('year') ?: date('Y');
    $data['registration'] = $this->Annual_model->load_registration($get);

    $data['title']    = 'สัมภาษณ์';
    $data['content']  = 'interview/main';
    $this->load->view('include/layout', $data);
  }

  public function register($registration_id, $student_id) {
    $registration_id != '' && $student_id != '' ?: redirect('annual');
    $get['apply']          = $this->input->get('apply');
    $registration          = $this->Prepare_model->load_data('registration', 'registration_id', $registration_id);
    $data['registration']  = $registration[0];
    $data['profile']      = $this->Annual_model->load_student_id($student_id);
    $data['family']        = $this->Annual_model->load_student_family($student_id);
    $data['bank']          = $this->Scholarship_model->load_select('bank');
    $data['religion']      = $this->Annual_model->load_select('religion');
    $data['address']      = $this->Annual_model->load_select('address');
    $data['tostudy']      = $this->Annual_model->load_select('tostudy');
    $data['accessories']  = $this->Annual_model->load_select('accessories');
    $data['mobile']        = $this->Annual_model->load_select('mobile');
    $data['status']        = $this->Annual_model->load_select('status');
    $data['statusFather']  = $this->Annual_model->load_select('statusFather');
    $data['statusMother']  = $this->Annual_model->load_select('statusMother');
    $data['statusPatron']  = $this->Annual_model->load_select('statusPatron');
    $data['job']          = $this->Annual_model->load_select('job');
    $data['marital']      = $this->Annual_model->load_select('marital');
    $data['education']    = $this->Annual_model->load_select('education');
    $data['siblingAddr']  = $this->Annual_model->load_select('siblingAddr');
    $data['asset']        = $this->Annual_model->load_select('asset');
    $data['rent']          = $this->Annual_model->load_select('rent');
    $data['installment']  = $this->Annual_model->load_select('installment');
    $data['relative']      = $this->Annual_model->load_select('relative');
    $data['income']        = $this->Annual_model->load_select('income');
    $data['outcome']      = $this->Annual_model->load_select('outcome');
    $data['certificate']  = $this->Annual_model->load_select('certificate');
    $data['student_id']    = $student_id;
    $data['student']      = $this->Annual_model->load_student_id($student_id);
    $data['breadcrumb']    = ['วันสมัคร | รอบสัมภาษณ์' => 'annual', "รายชื่อนักศึกษา  \"{$registration[0]['registration_title']}\"" => "annual/student/{$registration[0]['registration_id']}" . ($get['apply'] != '' ? "/?apply={$get['apply']}" : '')];
    $data['title']      = "ใบสมัคร {$student_id}";
    $data['content']    = 'registration/register';
    $this->load->view('include/layout', $data);
  }
  public function registration($registration_id = 0) {
    $registration  = $registration_id != 0 ? $this->Prepare_model->load_data('registration', 'registration_id', $registration_id) : [];
    $data['breadcrumb']  = ['วันสมัคร | รอบสัมภาษณ์' => 'annual'];
    $data['title']      = ($registration_id != 0 ? 'แก้ไข' : 'เพิ่ม') . 'วันสมัคร | รอบสัมภาษณ์' . ($registration_id != 0 ? "\"{$registration[0]['registration_title']}\"" : '');
    $data['content']    = 'registration/registration';
    $this->load->view('include/layout', $data);
  }
  public function load_interviewee_id() {
    $interviewee  = $this->Annual_model->load_interviewee_id($this->input->post('interview_id'), $this->input->post('student_id'));
    for ($i = 0; $i < count($interviewee); $i++) {
      $interviewee[$i]['admin_name']  = $this->Prepare_model->load_name($interviewee[$i]['username']);
    }
    echo json_encode($interviewee);
  }
  public function student($registration_id) {
    $registration_id != '' ?: redirect();
    $registration  = $registration_id != 0 ? $this->Prepare_model->load_data('registration', 'registration_id', $registration_id) : [];
    $data['certificate']      = $this->Annual_model->load_select('certificate');
    $data['registration_id']  = $registration_id;
    $data['breadcrumb']        = ['วันสมัคร | รอบสัมภาษณ์' => 'annual'];
    $data['title']            = "รายชื่อนักศึกษา  \"{$registration[0]['registration_title']}\"";
    $data['content']          = 'registration/student';
    $this->load->view('include/layout', $data);
  }
  public function find_name() {
    echo $this->Annual_model->find_name($this->input->post('psu'));
  }
  public function find_student_name() {
    echo $this->Annual_model->find_student_name($this->input->post('student_id'));
  }

  public function get_profile($student_id) {
    $registration_id  = $this->input->post('registration_id');

    $profile  = $this->Prepare_model->load_data('profile', ['student_id', 'registration_id'], [$student_id, $registration_id]);
    echo json_encode(count($profile) > 0 ? $profile[0] : false);
    unset($profile);
  }

  public function get_family($student_id) {
    $registration_id  = $this->input->post('registration_id');

    $family  = $this->Annual_model->load_family($student_id, $registration_id);
    $family  = array_merge($family, [$this->Prepare_model->load_data('parent', ['student_id', 'registration_id'], [$student_id, $registration_id])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('job', ['student_id', 'registration_id'], [$student_id, $registration_id])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('child', ['student_id', 'registration_id'], [$student_id, $registration_id])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('loan', ['student_id', 'registration_id'], [$student_id, $registration_id], ['seq'])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('vehicle', ['student_id', 'registration_id'], [$student_id, $registration_id], ['seq'])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('property', ['student_id', 'registration_id'], [$student_id, $registration_id])]);
    echo json_encode(count($family[0]) > 0 ? $family : false);
    unset($family);
  }

  public function get_sibling($student_id) {
    $registration_id  = $this->input->post('registration_id');

    $sibling          = $this->Prepare_model->load_data('nosibling', ['student_id', 'registration_id'], [$student_id, $registration_id]);
    if (count($sibling) > 0) {
      echo json_encode('nosibling');
    } else {
      $sibling  = $this->Prepare_model->load_data('sibling_study', ['student_id', 'registration_id'], [$student_id, $registration_id], ['seq']);
      $sibling  = array_merge([$sibling], [$this->Prepare_model->load_data('sibling_working', ['student_id', 'registration_id'], [$student_id, $registration_id], ['seq'])]);
      echo json_encode(count($sibling[0]) > 0 || count($sibling[1]) > 0 ? $sibling : false);
      unset($sibling);
    }
  }

  public function get_finance($student_id) {
    $registration_id  = $this->input->post('registration_id');

    $finance  = $this->Prepare_model->load_data('finance', ['student_id', 'registration_id'], [$student_id, $registration_id]);
    $finance  = array_merge($finance, [$this->Prepare_model->load_data('finance_fund', ['student_id', 'registration_id'], [$student_id, $registration_id], ['seq'])]);
    $finance  = array_merge($finance, [$this->Prepare_model->load_data('finance_scholarship', ['student_id', 'registration_id'], [$student_id, $registration_id], ['seq'])]);
    $finance  = array_merge($finance, [$this->Prepare_model->load_data('finance_job', ['student_id', 'registration_id'], [$student_id, $registration_id], ['seq'])]);
    echo json_encode(count($finance[0]) > 0 ? $finance : false);
    unset($finance);
  }

  public function get_explain($student_id) {
    $registration_id  = $this->input->post('registration_id');

    $explain  = $this->Prepare_model->load_data('explain', ['student_id', 'registration_id'], [$student_id, $registration_id]);
    echo json_encode(count($explain) > 0 ? $explain : false);
    unset($explain);
  }
  public function get_certificate($student_id) {
    $registration_id  = $this->input->post('registration_id');

    $certificate  = $this->Prepare_model->load_data('certificate', ['student_id', 'registration_id'], [$student_id, $registration_id]);
    $googledrive  = $this->Prepare_model->load_data('googledrive', ['student_id', 'registration_id'], [$student_id, $registration_id]);
    echo json_encode([count($certificate) > 0 ? $certificate : false, count($googledrive) > 0 ? $googledrive : false]);
    unset($certificate);
  }

  public function certificate() {
    if ($this->input->post()) {
      $post  = $this->input->post();
      $this->Prepare_model->delete_data('certificate', ['registration_id', 'student_id'], [$post['registration_id'], $post['student_id']]);
      for ($i = 0; $i < 7; $i++) {
        $ar[$i]  = [
          'registration_id'  => $post['registration_id'],
          'student_id'      => $post['student_id'],
          'certificate_id'  => $i + 1,
          'status'          => isset($post['certificate' . ($i + 1)]) ? (isset($post['cer' . ($i + 1)]) ? 1 : 0) : 2
        ];
      }
      $this->Prepare_model->insert_batch('certificate', $ar);
      unset($post);
      unset($ar);
      redirect('annual/student/' . $this->input->post('registration_id') . '/?apply=' . $post['apply']);
    }
    redirect('annual');
  }
  public function load_certificate() {
    echo json_encode([$this->Prepare_model->load_data('certificate', ['registration_id', 'student_id'], [$this->input->post('registration_id'), $this->input->post('student_id')]), $this->Prepare_model->load_data('googledrive', ['registration_id', 'student_id'], [$this->input->post('registration_id'), $this->input->post('student_id')])]);
  }
  public function list_registration() {
    echo json_encode($this->Annual_model->load_registration($this->input->post()));
  }
  public function list_student() {
    $ar_temp    = [];
    foreach ($this->Annual_model->list_student($this->input->post()) as $ar) {
      $student    = $this->Annual_model->load_student_id($ar['student_id']);
      $ar_return  = $ar;
      $ar_return['student_name']  = $student[0]['TITLE'] . $student[0]['FNAME'] . ' ' . $student[0]['SNAME'];
      $ar_return['fac_name']      = $student[0]['FAC_NAME'];
      $ar_temp  = array_merge($ar_temp, [$ar_return]);
    }
    echo json_encode($ar_temp);
  }
  public function load_registration_id() {
    echo json_encode($this->Annual_model->load_registration_id($this->input->post()));
  }
  public function delete_registration() {
    $this->Prepare_model->delete_data(['interviewer', 'interview', 'registration'], 'registration_id', $this->input->post('registration_id'));
  }
  public function load_registration_interview() {
    $result  = $this->Prepare_model->load_data('registration', 'registration_id', $this->input->post('registration_id'));
    $result  = array_merge($result, [$this->Annual_model->load_interview($this->input->post('registration_id'))]);
    echo json_encode($result);
  }
  public function load_interviewer_id() {
    echo json_encode($this->Prepare_model->load_data('interviewer', 'interview_id', $this->input->post('interview_id')));
  }
  public function actionRegistration() {
    if ($this->input->post()) {
      $post  = $this->input->post();
      $ar  = [
        'registration_title'  => $post['registration_title'],
        'campus_id'            => '00',
        'year'                => $post['year'],
        'registration_start'  => $this->switchdate($post['r_start_d']) . " {$post['r_start_t']}",
        'registration_stop'    => $this->switchdate($post['r_stop_d']) . " {$post['r_stop_t']}",
        'interview_start'      => $this->switchdate($post['i_start_d']) . " {$post['i_start_t']}",
        'interview_stop'      => $this->switchdate($post['i_stop_d']) . " {$post['i_stop_t']}",
        'username'            => $this->session->userdata('username')
      ];
      if ($post['registration_id'] != 0) {
        $registration_id  = $post['registration_id'];
        $this->Prepare_model->update_data('registration', 'registration_id', $registration_id, $ar);
      } else {
        $registration_id  = $this->Prepare_model->insert_data('registration', $ar);
      }
      $ar_id  = json_decode($post['all_i_id']);
      // if(isset($post['seat'])) {
      $i    = 0;
      $ari  = [];
      foreach ($post['seat'] as $k => $v) {
        $ar  = [
          'registration_id'  => $registration_id,
          'seat'  => $v,
          'interview_name'  => (!!$post['interview_name'][$k] ? $post['interview_name'][$k] : null),
          'start'  => $this->switchdate($post['in_d'][$k]) . " {$post['in_h_start'][$k]}:{$post['in_m_start'][$k]}:00",
          'stop'  => $this->switchdate($post['in_d'][$k]) . " {$post['in_h_stop'][$k]}:{$post['in_m_stop'][$k]}:00",
        ];
        if ($post['interview_id'][$k] != 0) {
          $interview_id  = $post['interview_id'][$k];
          $this->Prepare_model->update_data('interview', 'interview_id', $interview_id, $ar);
          if (($key = array_search($interview_id, $ar_id)) !== false) {
            unset($ar_id[$key]);
          }
        } else {
          $interview_id  = $this->Prepare_model->insert_data('interview', $ar);
        }
        if (isset($post['psu'][$k])) {
          foreach (array_unique($post['psu'][$k]) as $value) {
            $ari[$i]['registration_id']  = $registration_id;
            $ari[$i]['interview_id']    = $interview_id;
            $ari[$i]['username']        = $value;
            $i++;
          }
        }
      }
      foreach ($ar_id as $value) {
        $this->Prepare_model->delete_data('interviewer', 'interview_id', $value);
        $this->Prepare_model->delete_data('interview', 'interview_id', $value);
      }
      $this->Prepare_model->delete_data('interviewer', 'registration_id', $registration_id);
      $this->Prepare_model->insert_batch('interviewer', $ari);
      // }
      redirect('annual/?year=' . $post['year']);
    }
    redirect();
  }
  private function switchdate($day) {
    $day  = explode('-', $day);
    return ($day[2] - 543) . "-{$day[1]}-{$day[0]}";
  }
}
