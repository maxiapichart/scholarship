<?php $get['apply']  = $this->input->get('apply'); ?>
<div class="container-fluid">
  <section class="pt-5">
    <div class="row mb-4">
      <div class="col mb-4">
        <div class="card">
          <div class="card-header text-center">
            <h2 class="mb-0">วันสมัคร-รอบสัมภาษณ์</h2>
          </div>
          <div class="card-body">
            <select id="apply" class="custom-select custom-select-sm input-block w-auto" onchange="$('#list').DataTable().ajax.reload();">
              <option value="">ทั้งหมด</option>
              <option value="1" <?php echo $get['apply'] != 1 ?: ' selected'; ?>>กำลังเขียนใบสมัคร</option>
              <option value="2" <?php echo $get['apply'] != 2 ?: ' selected'; ?>>ส่งใบสมัครแล้ว</option>
            </select>
            <div class="table-responsive pt-2">
              <table id="list" class="table table-striped table-bordered table-sm">
                <thead class="thead-dark">
                  <tr>
                    <td></td>
                    <td>รหัส</td>
                    <td>ชื่อ</td>
                    <td>คณะ</td>
                    <td>สมัครเมื่อ</td>
                    <td>เอกสารเพิ่มเติม</td>
                    <td>สถานะ/วันสอบสัมภาษณ์</td>
                    <td></td>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="modal fade" id="modalCer" tabindex="-1" role="dialog" aria-labelledby="modalCerLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCerLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php echo site_url('annual/certificate/'); ?>" method="post">
        <input type="hidden" name="apply" value="<?php echo $get['apply']; ?>">
        <input type="hidden" name="registration_id" value="<?php echo $registration_id; ?>">
        <input type="hidden" name="student_id">
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <td><b>ต้องการเอกสารนี้</b></td>
                  <td><b>เอกสาร</b></td>
                  <td><b>ส่งเอกสารนี้แล้ว</b></td>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($certificate as $ar) { ?>
                  <tr>
                    <td align="center">
                      <div class="custom-control custom-checkbox">
                        <input id="<?php echo "certificate{$ar['selectdata_id']}"; ?>" type="checkbox" class="certificate custom-control-input" onchange="$('<?php echo "#cer{$ar['selectdata_id']}"; ?>').prop('disabled', !this.checked); $('<?php echo "#cer{$ar['selectdata_id']}"; ?>').val('')" name="<?php echo "certificate{$ar['selectdata_id']}"; ?>">
                        <label class="custom-control-label" for="<?php echo "certificate{$ar['selectdata_id']}"; ?>"></label>
                      </div>
                    </td>
                    <td><?php echo $ar['selectdata_title']; ?></td>
                    <td align="center">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="cer custom-control-input" id="<?php echo "cer{$ar['selectdata_id']}"; ?>" name="<?php echo "cer{$ar['selectdata_id']}"; ?>">
                        <label class="custom-control-label" for="<?php echo "cer{$ar['selectdata_id']}"; ?>"></label>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
          <button type="submit" class="btn btn-primary">บันทึก</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditLabel">จัดการสถานะ <span class="student_id">-</span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form onsubmit="formEditSubmit()" id="form-edit" action="javascript:void(0)">
        <input type="hidden" name="registration_id" value="<?php echo $registration_id; ?>">
        <input type="hidden" name="student_id">
        <div class="modal-body">
          <div class="custom-control custom-switch text-right">
            <input type="checkbox" class="custom-control-input" id="registered" name="register" onchange="onRegisterChange(this.checked)" />
            <label class="custom-control-label" for="registered">ส่งใบสมัครแล้ว</label>
          </div>
          <div class="form-check text-center">
            <input class="form-check-input" style="cursor: pointer" type="radio" name="interview" id="interview_id_none" value="false" checked>
            <label class="form-check-label text-danger" style="cursor: pointer" for="interview_id_none">ไม่เลือกวันสัมภาษณ์</label>
          </div>
          <div id="interviews" style="height: 50vh; overflow-y: auto" class="d-none px-3">
            <?php $prevDate = null;
            $m  = ['ม.ค.', 'ก.พ', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
            foreach ($interviews as $interview) {
              $start = strtotime($interview['start']);
              $stop = strtotime($interview['stop']);
              if ($date !== $start) {
                $date = $start; ?>
                <h6 class="text-center text-muted pt-5"><?php echo $this->Prepare_model->displayDate($start, $stop, false); ?></h6>
              <?php } ?>
              <div class="form-check text-right border-bottom">
                <input class="form-check-input" style="cursor: pointer" type="radio" name="interview" id="interview_id_<?php echo $interview['interview_id']; ?>" value="<?php echo $interview['interview_id']; ?>">
                <label class="form-check-label" style="cursor: pointer" for="interview_id_<?php echo $interview['interview_id']; ?>"><?php echo $interview['interview_name']; ?></label>
              </div>
            <?php } ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
          <button type="submit" class="btn btn-primary">บันทึก</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  var month = ['ม.ค.', 'ก.พ', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.']
  $(function() {
    list()
  })

  function date(date) {
    date = date.replace(' ', 'T').split(/[^0-9]/);
    date = new Date(date[0], date[1] - 1, date[2], date[3], date[4], date[5]);
    return date.getDate() + ' ' + month[date.getMonth()] + ' ' + (parseInt(date.getFullYear()) + 543 - 2500) + ' | ' + date.getHours() + ':' + (date.getMinutes() < 10 ? '0' : '') + date.getMinutes();
  }

  function list() {
    $('#list').DataTable({
      language: {
        url: '<?php echo site_url('index/datatableTH'); ?>'
      },
      processing: true,
      ajax: {
        type: "POST",
        url: '<?php echo site_url('annual/list_student'); ?>',
        data: (d) => {
          d.registration_id = '<?php echo $registration_id; ?>';
          d.apply = $('#apply').val();
        },
        dataSrc: ''
      },
      autoWidth: false,
      paging: false,
      order: [
        [4, 'desc']
      ],
      searching: true,
      columns: [{
          data: null,
          searchable: false,
          orderable: false,
          className: 'text-right nowrap'
        },
        {
          data: 'student_id',
          className: 'nowrap',
          render: function(data, type, full) {
            return (type == 'display' ? '<a href="<?php echo site_url('annual/register/' . $registration_id . '/'); ?>' + data + '<?php echo $get['apply'] != '' ? "/?apply={$get['apply']}" : ''; ?>" target="_blank">' + data + '</a>' : data);
          }
        },
        {
          data: 'student_name',
          className: 'nowrap'
        },
        {
          data: 'fac_name',
          className: 'nowrap'
        },
        {
          data: 'modify',
          className: 'text-center nowrap',
          render: function(data, type, full) {
            return (type == 'display' ? date(data) : data);
          }
        },
        {
          data: null,
          className: 'text-right nowrap',
          render: function(data, type, full) {
            return (data['googledrive'] != null ? '<a href="' + data['googledrive'] + '" target="_blank">GoogleDrive</a> | ' : '') +
              '<button class="btn btn-sm btn-link text-info" onclick="modalCer(' + data['registration_id'] + ', ' + data['student_id'] + ')">' +
              (8 - data['total'] > 0 ? 'ขาดเอกสาร ' + (8 - data['total']) + ' ฉบับ' : 'เอกสารครบแล้ว') + '</button>'
          }
        },
        {
          data: null,
          className: 'text-center nowrap',
          render: function(data, type, full) {
            return data['interview'] != null ?
              date(data['start']) :
              data['register'] != null ?
              'ส่งใบสมัครแล้ว<br/><span class="text-danger">ยังไม่จองวันสัมภาษณ์</span>' :
              '<span class="text-danger">ยังไม่ส่งใบสมัคร</span>'
          }
        },
        {
          data: null,
          className: 'nowrap',
          render: function(data, type, full) {
            return `<button class="btn btn-sm btn-link text-primary" onclick="modalEdit('${data['student_id']}','${data['interview']}','${data['start']}',${!!data['register']})"><i class="fas fa-user-edit"></i></button>`
          }
        },
      ],
    })
    $('#list').DataTable().on('order.dt search.dt', function() {
      $('#list').DataTable().column(0, {
        search: 'applied',
        order: 'applied'
      }).nodes().each(function(cell, i) {
        cell.innerHTML = (i + 1).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
      })
    }).draw()
  }

  function modalEdit(student_id, interview, start, register) {
    $('.student_id').html(student_id)
    $('[name="student_id"]').val(student_id)
    $('#form-edit #registered').prop('checked', register)
    $('#form-edit #interview_id_' + interview).prop('checked', true)
    onRegisterChange(register)
    $('#modalEdit').modal('show')
  }

  function formEditSubmit() {
    const registration_id = $('#form-edit [name="registration_id"]').val()
    const student_id = $('#form-edit [name="student_id"]').val()
    const register = !!$('#form-edit [name="register"]:checked').val()
    const interview = $('#form-edit [name="interview"]:checked').val()
    data = {
      registration_id,
      student_id,
      register,
      interview,
    }
    $.ajax({
      method: 'POST',
      url: '<?php echo site_url('annual/edit_register'); ?>',
      data,
      success: function(result) {
        $('#list').DataTable().ajax.reload()
        $('#modalEdit').modal('hide')
      }
    })
  }

  function onRegisterChange(checked) {
    if (checked) {
      $('#interviews').removeClass('d-none')
    } else {
      $('#interviews').addClass('d-none');
      $('#interview_id_none').prop('checked', true)
    }
  }

  function modalCer(registration_id, student_id) {
    $.ajax({
      method: 'POST',
      url: '<?php echo site_url('annual/load_certificate'); ?>',
      data: {
        registration_id,
        student_id,
      },
      success: function(result) {
        result = JSON.parse(result)
        console.log(result)
        $('#modalCerLabel').html(student_id + (result[1].length > 0 ? ' | <a href="' + result[1][0]['googledrive'] + '" target="_blank">GoogleDrive</a>' : ''))
        $('[name="student_id"]').val(student_id)
        $('.certificate').prop('checked', true)
        $('.cer').prop('checked', false)
        if (result[0].length) {
          $.each(result[0], function(i, ar) {
            console.log(ar)
            $('#certificate' + ar['certificate_id']).prop('checked', ar['status'] == 2 ? false : true)
            $('#cer' + ar['certificate_id']).prop('disabled', ar['status'] == 2 ? true : false)
            $('#cer' + ar['certificate_id']).prop('checked', ar['status'] == 1 ? true : false)
          })
        }
        $('#modalCer').modal('show')
      }
    })
  }
</script>