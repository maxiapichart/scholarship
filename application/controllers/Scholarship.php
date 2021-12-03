<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Scholarship extends CI_Controller {
  public function __construct() {
    parent::__construct();
    if (!$this->session->userdata('logged_in') || $this->session->userdata('user_type') != 'Student') {
      redirect();
    }
    $this->load->model('Scholarship_model');
  }
  public function index() {
    $data['title']        = 'ทุนการศึกษา';
    $data['content']      = 'register/list';
    $this->load->view('include/layout', $data);
  }
  public function register($registration_id = '') {
    $registration_id != '' ?: redirect('scholarship');
    $registration  = $this->Prepare_model->load_data('registration', 'registration_id', $registration_id);
    if ($registration[0]['registration_start'] <= date('Y-m-d H:i:s') && $registration[0]['registration_stop'] >= date('Y-m-d H:i:s')) {
      $register    = $this->Prepare_model->load_data('register', ['registration_id', 'student_id'], [$registration[0]['registration_id'], $this->session->userdata('username')]);
      if (count($register) > 0) {
        $register[0]['register'] == null ?: redirect('scholarship');
      }
      $data['registration']  = $registration[0];
      $data['profile']      = $this->Scholarship_model->load_student_id();
      $data['family']        = $this->Scholarship_model->load_student_family();
      $data['bank']          = $this->Scholarship_model->load_select('bank');
      $data['religion']      = $this->Scholarship_model->load_select('religion');
      $data['address']      = $this->Scholarship_model->load_select('address');
      $data['tostudy']      = $this->Scholarship_model->load_select('tostudy');
      $data['accessories']  = $this->Scholarship_model->load_select('accessories');
      $data['mobile']        = $this->Scholarship_model->load_select('mobile');
      $data['status']        = $this->Scholarship_model->load_select('status');
      $data['statusFather']  = $this->Scholarship_model->load_select('statusFather');
      $data['statusMother']  = $this->Scholarship_model->load_select('statusMother');
      $data['statusPatron']  = $this->Scholarship_model->load_select('statusPatron');
      $data['job']          = $this->Scholarship_model->load_select('job');
      $data['marital']      = $this->Scholarship_model->load_select('marital');
      $data['education']    = $this->Scholarship_model->load_select('education');
      $data['siblingAddr']  = $this->Scholarship_model->load_select('siblingAddr');
      $data['asset']        = $this->Scholarship_model->load_select('asset');
      $data['rent']          = $this->Scholarship_model->load_select('rent');
      $data['installment']  = $this->Scholarship_model->load_select('installment');
      $data['relative']      = $this->Scholarship_model->load_select('relative');
      $data['income']        = $this->Scholarship_model->load_select('income');
      $data['outcome']      = $this->Scholarship_model->load_select('outcome');
      $data['certificate']  = $this->Scholarship_model->load_select('certificate');
    } else {
      redirect('scholarship');
    }
    $data['breadcrumb']  = ['รอบเปิดรับทุน' => 'scholarship'];
    $data['title']      = "ส่งใบสมัคร \"{$registration[0]['registration_title']}\"";
    $data['content']    = 'register/main';
    $this->load->view('include/layout', $data);
  }
  public function find_name() {
    echo $this->Scholarship_model->find_name($this->input->post('student_id'));
  }
  public function addrSearch() {
    foreach ($this->Scholarship_model->addrSearch($this->input->get('addr')) as $ar) {
      echo "<p>{$ar['district_name']} >> {$ar['amphure_name']} >> <b>{$ar['province_name']}</b> >> " . ($ar['zip_code'] != null ? $ar['zip_code'] : '-') . " <small>({$ar['district_id']})</small></p>";
    }
  }
  public function profile() {
    if ($this->input->post()) {
      $ar  = [
        'registration_id'  => $this->input->post('registration_id'),
        'student_id'      => $this->session->userdata('username'),
        'number'          => $this->input->post('number'),
        'account'          => $this->input->post('account'),
        'email'            => trim($this->input->post('email')),
        'line'            => trim($this->input->post('line')),
        'tostudy'          => json_encode($this->input->post('tostudy')),
        'accessories'      => json_encode($this->input->post('accessories')),
        'fnumber'          => $this->input->post('fnumber'),
        'fstudent_id'      => $this->input->post('fstudent_id'),
        'mobile'          => $this->input->post('mobile')    != 0 ? $this->input->post('mobile')    : trim($this->input->post('mobile-specify')),
        'bank'            => $this->input->post('bank')    != 0 ? $this->input->post('bank')    : trim($this->input->post('bank-specify')),
        'religion'        => $this->input->post('religion')  != 0 ? $this->input->post('religion')  : trim($this->input->post('religion-specify')),
        'address'          => $this->input->post('address')  != 0 ? $this->input->post('address')  : trim($this->input->post('address-specify'))
      ];
      if ($this->input->post('address') == 4) {
        $ar['address-name']    = $this->input->post('address-name');
        $ar['address-room']    = $this->input->post('address-room');
        $ar['address-number']  = $this->input->post('address-number');
        $ar['address-alley']  = $this->input->post('address-alley');
        $ar['address-road']    = $this->input->post('address-road');
        $ar['address-tel']    = $this->input->post('address-tel');
      }
      $tb      = ['register', 'profile'];
      $field  = ['student_id', 'registration_id'];
      $value  = [$ar['student_id'], $ar['registration_id']];
      $this->Prepare_model->delete_data($tb, $field, $value);
      $this->Prepare_model->insert_data('register', ['student_id' => $ar['student_id'], 'registration_id' => $ar['registration_id']]);
      unset($tb);
      unset($field);
      unset($value);

      $this->Prepare_model->insert_data('profile', $ar);
      unset($ar);
    }
  }
  public function get_profile() {
    $username          = $this->session->userdata('username');
    $registration_id  = $this->input->post('registration_id');

    $profile  = $this->Prepare_model->load_data('profile', ['student_id', 'registration_id'], [$username, $registration_id]);
    echo json_encode(count($profile) > 0 ? $profile[0] : false);
    unset($profile);
  }
  // public function parent($v, $post) {
  public function parent($v) {
    $post = $this->input->post();
    $ar_v  = ['f' => '0', 'm' => '1', 'p' => '2', 'c' => '3'];
    // parent
    $ar  = [
      'registration_id'  => $post['registration_id'],
      'student_id'      => $this->session->userdata('username'),
      'parent'          => $ar_v[$v],
      'fname'            => trim($post[$v . 'fname']),
      'sname'            => trim($post[$v . 'sname']),
      'year'            => $post[$v . 'year'] - 543,
      'number'          => $post[$v . 'number']
    ];
    $this->Prepare_model->insert_data('parent', $ar);
    // job
    $ar  = [
      'registration_id'  => $post['registration_id'],
      'student_id'      => $this->session->userdata('username'),
      'parent'          => $ar_v[$v],
      'job'              => $post[$v . 'job']
    ];
    if ($ar['job'] == 0) {
      $ar['job']    = trim($post[$v . 'job-specify']);
      $ar['income']  = $post[$v . 'income'];
      $ar['detail']  = trim($post[$v . 'detail']);
    } else {
      $job  = $this->Prepare_model->load_data('selectdata', ['selectdata_id', 'selectdata_type'], [$ar['job'], 'job']);
      if (($job = $job[0]['selectdata_group']) != 4) {
        $ar['income']      = $post[$v . 'income'];
        if ($job == 1) {
          $ar['detail']    = $post[$v . 'detail'];
        } else if ($job == 2) {
          $ar['position']  = $post[$v . 'position'];
        }
      }
    }
    $this->Prepare_model->insert_data('job', $ar);
    unset($ar_v);
    unset($ar);
    unset($post);
  }
  public function family() {
    if ($this->input->post()) {
      $post  = $this->input->post();
      $ar  = [
        'registration_id'  => $post['registration_id'],
        'student_id'      => $this->session->userdata('username'),
        'fmstatus'        => $post['fmstatus'],
        'pstatus'          => $post['pstatus'],
        'number'          => $post['address-number'],
        'alley'            => $post['address-alley'],
        'road'            => $post['address-road'],
        'village'          => $post['address-village'],
        'district_id'      => $post['address-district_id'],
        // 'subdistrict'			=> $post['address-subdistrict'],
        // 'district'				=> $post['address-district'],
        // 'province'				=> $post['address-province'],
        // 'postcode'				=> $post['address-postcode']
      ];
      $tb      = ['register', 'family', 'parent', 'job', 'child', 'loan', 'vehicle', 'property'];
      $field  = ['student_id', 'registration_id'];
      $value  = [$ar['student_id'], $ar['registration_id']];
      $this->Prepare_model->delete_data($tb, $field, $value);
      $this->Prepare_model->insert_data('register', ['student_id' => $ar['student_id'], 'registration_id' => $ar['registration_id']]);
      unset($tb);
      unset($field);
      unset($value);

      if ($ar['fmstatus'] != 7) {
        if ($ar['fmstatus'] != 5) {
          if (($ar['fstatus'] = $post['fstatus']) != 3) {
            $this->parent('f', $post);
          }
        }
        if ($ar['fmstatus'] != 6) {
          if (($ar['mstatus'] = $post['mstatus']) != 3) {
            $this->parent('m', $post);
          }
        }
      }
      $this->Prepare_model->insert_data('family', $ar);
      if ($ar['pstatus'] == 2) {
        $this->parent('p', $post);
        if ($post['pchild'] > 0) {
          $ar  = [
            'registration_id'  => $post['registration_id'],
            'student_id'      => $this->session->userdata('username'),
            'study'            => $post['pchild-study'],
            'working'          => $post['pchild-working'],
            'noworking'        => $post['pchild-noworking']
          ];
          $this->Prepare_model->insert_data('child', $ar);
        }
        if ($post['pmarital'] == 1) {
          $this->parent('c', $post);
        }
      }
      if (isset($post['loan'])) {
        $ar  = [];
        foreach ($post['loan'] as $k => $v) {
          $i  = 0;
          foreach ($v as $value) {
            $ar[$i]['registration_id']  = $post['registration_id'];
            $ar[$i]['student_id']        = $this->session->userdata('username');
            $ar[$i]['seq']              = $i + 1;
            $ar[$i][$k]                  = $value;
            $i++;
          }
        }
        $this->Prepare_model->insert_batch('loan', $ar);
      }
      $type  = ['motocycle', 'car'];
      foreach ($type as $vehicle) {
        $ar  = [];
        if (isset($post[$vehicle])) {
          foreach ($post[$vehicle] as $k => $v) {
            $i  = 0;
            foreach ($v as $value) {
              $ar[$i]['registration_id']  = $post['registration_id'];
              $ar[$i]['student_id']        = $this->session->userdata('username');
              $ar[$i]['type']              = array_search($vehicle, $type);
              $ar[$i]['seq']              = $i + 1;
              $ar[$i][$k]                  = $value;
              $i++;
            }
          }
          $this->Prepare_model->insert_batch('vehicle', $ar);
        }
      }
      $type  = ['asset', 'rent', 'installment'];
      foreach ($type as $property) {
        $ar  = [];
        if (isset($post[$property])) {
          foreach ($post[$property] as $k => $v) {
            $i  = 0;
            foreach ($v as $key => $value) {
              $ar[$i]['registration_id']  = $post['registration_id'];
              $ar[$i]['student_id']        = $this->session->userdata('username');
              $ar[$i]['type']              = array_search($property, $type);
              $ar[$i]['id']                = $key;
              $ar[$i][$k]                  = $value;
              $i++;
            }
          }
          $this->Prepare_model->insert_batch('property', $ar);
        }
      }
      unset($post);
      unset($type);
      unset($ar);
    }
  }
  public function get_family() {
    $username          = $this->session->userdata('username');
    $registration_id  = $this->input->post('registration_id');

    $family  = $this->Scholarship_model->load_family($registration_id);
    $family  = array_merge($family, [$this->Prepare_model->load_data('parent', ['student_id', 'registration_id'], [$username, $registration_id])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('job', ['student_id', 'registration_id'], [$username, $registration_id])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('child', ['student_id', 'registration_id'], [$username, $registration_id])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('loan', ['student_id', 'registration_id'], [$username, $registration_id], ['seq'])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('vehicle', ['student_id', 'registration_id'], [$username, $registration_id], ['seq'])]);
    $family  = array_merge($family, [$this->Prepare_model->load_data('property', ['student_id', 'registration_id'], [$username, $registration_id])]);
    echo json_encode(count($family[0]) > 0 ? $family : false);
    unset($family);
  }
  public function sibling() {
    if ($this->input->post()) {
      $post  = $this->input->post();
      $ar  = [
        'registration_id'  => $post['registration_id'],
        'student_id'      => $this->session->userdata('username')
      ];
      $tb      = ['register', 'nosibling', 'sibling_study', 'sibling_working'];
      $field  = ['student_id', 'registration_id'];
      $value  = [$ar['student_id'], $ar['registration_id']];
      $this->Prepare_model->delete_data($tb, $field, $value);
      $this->Prepare_model->insert_data('register', ['student_id' => $ar['student_id'], 'registration_id' => $ar['registration_id']]);
      unset($tb);
      unset($field);
      unset($value);

      if ($post['nosibling']) {
        $this->Prepare_model->insert_data('nosibling', $ar);
      } else {
        $type  = ['study', 'working'];
        foreach ($type as $sibling) {
          $ar  = [];
          if (isset($post[$sibling])) {
            foreach ($post[$sibling] as $k => $v) {
              $i  = 0;
              foreach ($v as $value) {
                $ar[$i]['registration_id']  = $post['registration_id'];
                $ar[$i]['student_id']        = $this->session->userdata('username');
                $ar[$i]['seq']              = $i + 1;
                $ar[$i][$k]                  = $k == 'year' ? $value - 543 : $value;
                $i++;
              }
            }
            $this->Prepare_model->insert_batch('sibling_' . $sibling, $ar);
          }
        }
      }
      unset($post);
      unset($ar);
    }
  }
  public function get_sibling() {
    $username          = $this->session->userdata('username');
    $registration_id  = $this->input->post('registration_id');

    $sibling          = $this->Prepare_model->load_data('nosibling', ['student_id', 'registration_id'], [$username, $registration_id]);
    if (count($sibling) > 0) {
      echo json_encode('nosibling');
    } else {
      $sibling  = $this->Prepare_model->load_data('sibling_study', ['student_id', 'registration_id'], [$username, $registration_id], ['seq']);
      $sibling  = array_merge([$sibling], [$this->Prepare_model->load_data('sibling_working', ['student_id', 'registration_id'], [$username, $registration_id], ['seq'])]);
      echo json_encode(count($sibling[0]) > 0 || count($sibling[1]) > 0 ? $sibling : false);
      unset($sibling);
    }
  }
  public function finance() {
    if ($this->input->post()) {
      $post  = $this->input->post();
      $ar  = [
        'registration_id'    => $post['registration_id'],
        'student_id'        => $this->session->userdata('username'),
        'income_parent'      => $post['income'][1],
        'income_loan'        => $post['income'][2],
        'income_job'        => $post['income'][3],
        'outcome_rest'      => $post['outcome'][1],
        'outcome_food'      => $post['outcome'][2],
        'outcome_equipment'  => $post['outcome'][3],
        'outcome_travel'    => $post['outcome'][4],
        'outcome_other'      => $post['outcome'][0],
        'outcome_specify'    => $post['outcome']['specify'],
        'outcome_total'      => $post['outcome']['total'],
      ];
      $tb      = ['register', 'finance', 'finance_fund', 'finance_scholarship', 'finance_job'];
      $field  = ['student_id', 'registration_id'];
      $value  = [$ar['student_id'], $ar['registration_id']];
      $this->Prepare_model->delete_data($tb, $field, $value);
      $this->Prepare_model->insert_data('register', ['student_id' => $ar['student_id'], 'registration_id' => $ar['registration_id']]);
      unset($tb);
      unset($field);
      unset($value);

      $this->Prepare_model->insert_data('finance', $ar);
      $type  = ['fund', 'scholarship', 'job'];
      foreach ($type as $finance) {
        $ar  = [];
        if (isset($post[$finance])) {
          foreach ($post[$finance] as $k => $v) {
            $i  = 0;
            foreach ($v as $value) {
              $ar[$i]['registration_id']  = $post['registration_id'];
              $ar[$i]['student_id']        = $this->session->userdata('username');
              $ar[$i]['seq']              = $i + 1;
              $ar[$i][$k]                  = $value;
              $i++;
            }
          }
          $this->Prepare_model->insert_batch('finance_' . $finance, $ar);
        }
      }
      unset($post);
      unset($ar);
    }
  }
  public function get_finance() {
    $username          = $this->session->userdata('username');
    $registration_id  = $this->input->post('registration_id');

    $finance  = $this->Prepare_model->load_data('finance', ['student_id', 'registration_id'], [$username, $registration_id]);
    $finance  = array_merge($finance, [$this->Prepare_model->load_data('finance_fund', ['student_id', 'registration_id'], [$username, $registration_id], ['seq'])]);
    $finance  = array_merge($finance, [$this->Prepare_model->load_data('finance_scholarship', ['student_id', 'registration_id'], [$username, $registration_id], ['seq'])]);
    $finance  = array_merge($finance, [$this->Prepare_model->load_data('finance_job', ['student_id', 'registration_id'], [$username, $registration_id], ['seq'])]);
    echo json_encode(count($finance[0]) > 0 ? $finance : false);
    unset($finance);
  }
  public function explain() {
    if ($this->input->post()) {
      $ar  = [
        'registration_id'  => $this->input->post('registration_id'),
        'student_id'      => $this->session->userdata('username'),
        'explain'          => $this->input->post('explain')
      ];
      $tb      = ['register', 'explain'];
      $field  = ['student_id', 'registration_id'];
      $value  = [$ar['student_id'], $ar['registration_id']];
      $this->Prepare_model->delete_data($tb, $field, $value);
      $this->Prepare_model->insert_data('register', ['student_id' => $ar['student_id'], 'registration_id' => $ar['registration_id']]);
      unset($tb);
      unset($field);
      unset($value);

      $this->Prepare_model->insert_data('explain', $ar);
      unset($ar);
    }
  }
  public function get_explain() {
    $username          = $this->session->userdata('username');
    $registration_id  = $this->input->post('registration_id');

    $explain  = $this->Prepare_model->load_data('explain', ['student_id', 'registration_id'], [$username, $registration_id]);
    echo json_encode(count($explain) > 0 ? $explain : false);
    unset($explain);
  }
  public function certificate() {
    if ($this->input->post()) {
      $ar  = [
        'registration_id'  => $this->input->post('registration_id'),
        'student_id'      => $this->session->userdata('username'),
        'googledrive'          => $this->input->post('googledrive')
      ];
      $tb      = ['register', 'googledrive'];
      $field  = ['student_id', 'registration_id'];
      $value  = [$ar['student_id'], $ar['registration_id']];
      $this->Prepare_model->delete_data($tb, $field, $value);
      $this->Prepare_model->insert_data('register', ['student_id' => $ar['student_id'], 'registration_id' => $ar['registration_id']]);
      unset($tb);
      unset($field);
      unset($value);

      $this->Prepare_model->insert_data('googledrive', $ar);
      unset($ar);
    }
  }
  public function get_certificate() {
    $username          = $this->session->userdata('username');
    $registration_id  = $this->input->post('registration_id');

    $certificate  = $this->Prepare_model->load_data('certificate', ['student_id', 'registration_id'], [$username, $registration_id]);
    $googledrive  = $this->Prepare_model->load_data('googledrive', ['student_id', 'registration_id'], [$username, $registration_id]);
    echo json_encode([count($certificate) > 0 ? $certificate : false, count($googledrive) > 0 ? $googledrive : false]);
    unset($certificate);
    unset($googledrive);
  }
  public function downloadfile() {
    $this->load->helper('download');
    force_download('certificate.pdf', file_get_contents('assets/files/certificate.pdf'));
  }
  public function downloadfileGoogleDrive() {
    $this->load->helper('download');
    force_download('googledrive.pdf', file_get_contents('assets/files/googledrive.pdf'));
  }
  public function confirmSubmit() {
    $username          = $this->session->userdata('username');
    $registration_id  = $this->input->post('registration_id');
    $this->Prepare_model->delete_data('register', ['student_id', 'registration_id'], [$username, $registration_id]);
    $this->Prepare_model->insert_data('register', ['student_id' => $username, 'registration_id' => $registration_id, 'register' => 1]);
    redirect('scholarship/interview/' . $registration_id);
  }
  public function interview($registration_id) {
    $register    = $this->Prepare_model->load_data('register', ['registration_id', 'student_id'], [$registration_id, $this->session->userdata('username')]);
    if (count($register) > 0) {
      $register[0]['register'] != null ?: redirect('scholarship');
      $register[0]['interview'] == null ?: redirect('scholarship');
      $registration          = $this->Prepare_model->load_data('registration', 'registration_id', $registration_id);
      if ($registration[0]['interview_start'] <= date('Y-m-d H:i:s') && $registration[0]['interview_stop'] >= date('Y-m-d H:i:s')) {
        $interview            = $this->Scholarship_model->load_interview($registration_id);
        $data['registration']  = $registration[0];
        $data['interview']    = $interview;
        $data['breadcrumb']    = ['รอบเปิดรับทุน' => 'scholarship'];
        $data['title']        = "เลือกวันสัมภาษณ์ \"{$registration[0]['registration_title']}\"";
        $data['content']      = 'register/interview';
        $this->load->view('include/layout', $data);
      } else {
        redirect('scholarship');
      }
    } else {
      redirect('scholarship');
    }
  }
  public function bookingInterview($registration_id) {
    if ($this->input->post()) {
      $ar  = [
        'interview'  => $this->input->post('id')
      ];
      $this->Prepare_model->update_data('register', ['registration_id', 'student_id'], [$registration_id, $this->session->userdata('username')], $ar);
      redirect('scholarship');
    }
  }
}
