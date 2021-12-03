<?php //print_r($registration); 
?>
<div class="container-fluid">
  <section class="pt-5">
    <div class="row mb-4">
      <div class="col mb-4">
        <div class="card">
          <div class="card-header text-center">
            <h2 class="mb-0">ใบสมัครขอรับทุนการศึกษา มหาวิทยาลัยสงขลานครินทร์ ประจำปีการศึกษา <?php echo $registration['year'] + 543; ?></h2>
            <!-- <small class="text-muted"><?php //echo 'เปิดรับสมัครตั้งแต่'.$this->Prepare_model->displayDate($registration['registration_start']).' <u>ถึง</u> '.$this->Prepare_model->displayDate($registration['registration_stop']); 
                                            ?></small> -->
            <?php echo $this->Prepare_model->displayDate(strtotime($registration['registration_start']), strtotime($registration['registration_stop'])); ?>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 font-italic pt-3 bg-primary text-white shadow">
                <h5 class="text-uppercase"><i class="fas fa-user"></i> ข้อมูลนักศึกษา<span class="float-right">1 / 4</span></h5>
              </div>
            </div>
            <div class="row pt-2 py-md-3">
              <div class="col-md-4 text-md-right text-center text-md-right">
                <img src="<?php echo 'https://regist.psu.ac.th/Stud_Pics/' . substr($student_id, 0, 2) . '/' . $student_id . '.jpg'; ?>" alt="Profile Picture" class="img-fluid shadow">
              </div>
              <div class="col-md-8 pt-4">
                <table class="table-sm">
                  <tr>
                    <td class="nowrap" align="right"><b>รหัสนักศึกษา</b></td>
                    <td><?php echo $profile[0]['STUDENT_ID']; ?></td>
                  </tr>
                  <tr>
                    <td align="right"><b>ชื่อ</b></td>
                    <td><?php echo $profile[0]['TITLE'] . $profile[0]['FNAME'] . ' ' . $profile[0]['SNAME']; ?></td>
                  </tr>
                  <tr>
                    <td align="right"><b>คณะ</b></td>
                    <td><?php echo $profile[0]['FAC_NAME']; ?></td>
                  </tr>
                  <tr>
                    <td align="right"><b>ภาควิชา</b></td>
                    <td><?php echo $profile[0]['DEPT_NAME']; ?></td>
                  </tr>
                  <tr>
                    <td align="right"><b>สาขาวิชา</b></td>
                    <td><?php echo $profile[0]['MAJOR_NAME']; ?></td>
                  </tr>
                  <tr>
                    <td align="right"><b>วิทยาเขต</b></td>
                    <td>
                      <?php $campus  = $this->Prepare_model->load_data('campus', ['campus_id'], [$profile[0]['CAMPUS_ID']]);
                      echo $campus[0]['campus_name']; ?>
                    </td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="row pt-2 p-xl-3">
              <div class="accordion" id="section1">
                <div class="card">
                  <div class="card-header" id="sec1Head1">
                    <h2 class="mb-0">
                      <span id="sec1Id1" class="confirmSubmit"><i class="fas fa-times-circle text-danger"></i></span>
                      <button class="btn btn-link collapsed text-primary" type="button" data-toggle="collapse" data-target="#sec1Col1" aria-expanded="false" aria-controls="sec1Col1" onclick="toggleCollapseIcon('#sec1Col1', '#sec1Icon1');">
                        ข้อมูลนักศึกษา
                      </button>
                    </h2>
                  </div>
                  <div id="sec1Col1" class="collapse" aria-labelledby="sec1Head1" data-parent="#section1">
                    <div id="profile" class="card-body">

                      <div class="row">
                        <div class="px-2 col-md-6 mb-3">
                          <select name="mobile" class="custom-select custom-select-sm input-block" onchange="$(this).val() != 0 ? $('#profile #mobile-specify-area').addClass('d-none') : $('#profile #mobile-specify-area').removeClass('d-none')">
                            <option disabled value="" selected class="d-none">-ยี่ห้อมือถือ-</option>
                            <?php foreach ($mobile as $ar) { ?>
                              <option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                            <?php } ?>
                            <option disabled></option>
                            <option value="0">อื่นๆ (ระบุ)</option>
                          </select>
                          <div id="mobile-specify-area" class="input-group d-none">
                            <div class="input-group-prepend">
                              <div class="input-group-text form-control-sm">ระบุ</div>
                            </div>
                            <input name="mobile-specify" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ระบุยี่ห้อมือถือ">
                          </div>
                        </div>
                        <div class="px-2 col-md-6">
                          <div class="form-group-material">
                            <input name="number" id="profile-number" type="text" class="input-material" minlength="10" maxlength="10" pattern="\d*">
                            <label for="profile-number" class="label-material active"><i class="fas fa-mobile-alt"></i> เบอร์มือถือ</label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="px-2 col-md-6 mb-3">
                          <select name="bank" class="custom-select custom-select-sm input-block" onchange="$(this).val() != 0 ? $('#profile #bank-specify-area').addClass('d-none') : $('#profile #bank-specify-area').removeClass('d-none')">
                            <option disabled value="" selected class="d-none">-ธนาคาร-</option>
                            <?php foreach ($bank as $ar) { ?>
                              <option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                            <?php } ?>
                            <option disabled></option>
                            <option value="0">อื่นๆ (ระบุ)</option>
                          </select>
                          <div id="bank-specify-area" class="input-group d-none">
                            <div class="input-group-prepend">
                              <div class="input-group-text form-control-sm">ระบุ</div>
                            </div>
                            <input name="bank-specify" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ระบุธนาคาร">
                          </div>
                        </div>
                        <div class="px-2 col-md-6">
                          <div class="form-group-material">
                            <input name="account" id="profile-account" type="text" class="input-material" minlength="10" pattern="\d*">
                            <label for="profile-account" class="label-material active"><i class="fas fa-money-check-alt"></i> เลขบัญชี</label>
                          </div>
                        </div>
                      </div>
                      <div class="row border-bottom border-3">
                        <div class="px-2 col-md-6">
                          <div class="form-group-material">
                            <input name="email" id="profile-email" type="email" class="input-material">
                            <label for="profile-email" class="label-material active"><i class="far fa-envelope"></i> อีเมล</label>
                          </div>
                        </div>
                        <div class="px-2 col-md-6">
                          <div class="form-group-material">
                            <input name="line" id="profile-line" type="text" class="input-material" autocapitalize="none">
                            <label for="profile-line" class="label-material active"><i class="fab fa-line"></i> ไอดีไลน์</label>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <table class="table">
                          <tr>
                            <td>1.</td>
                            <td><b>นับถือศาสนา</b><br />
                              <select name="religion" class="custom-select custom-select-sm input-block" onchange="$(this).val() != 0 ? $('#profile #religion-specify-area').addClass('d-none') : $('#profile #religion-specify-area').removeClass('d-none')">
                                <option disabled value="" selected class="d-none">-เลือก-</option>
                                <?php $group  = $religion[0]['selectdata_group'];
                                foreach ($religion as $ar) {
                                  if ($group  != $ar['selectdata_group']) {
                                    $group  = $ar['selectdata_group']; ?>
                                    <option disabled></option>
                                  <?php } ?>
                                  <option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                                <?php } ?>
                                <option disabled></option>
                                <option value="0">อื่นๆ (ระบุ)</option>
                              </select>
                              <div id="religion-specify-area" class="input-group d-none">
                                <div class="input-group-prepend">
                                  <div class="input-group-text form-control-sm">ระบุ</div>
                                </div>
                                <input name="religion-specify" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ระบุศาสนา">
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>2.</td>
                            <td><b>ที่พักอาศัย</b><br />
                              <select name="address" class="custom-select custom-select-sm input-block" onchange="$(this).val() != 0 ? $('#profile #address-specify-area').addClass('d-none') : $('#profile #address-specify-area').removeClass('d-none'); $(this).children(':selected').hasClass('group2') ? $('#profile #address-area').removeClass('d-none') : $('#profile #address-area').addClass('d-none');">
                                <option disabled value="" selected class="d-none">-เลือก-</option>
                                <?php $group  = $address[0]['selectdata_group'];
                                foreach ($address as $ar) {
                                  if ($group  != $ar['selectdata_group']) {
                                    $group  = $ar['selectdata_group']; ?>
                                    <option disabled></option>
                                  <?php } ?>
                                  <option class="<?php echo "group{$group}"; ?>" value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                                <?php } ?>
                                <option disabled></option>
                                <option value="0">อื่นๆ (ระบุ)</option>
                              </select>
                              <div id="address-specify-area" class="input-group d-none">
                                <div class="input-group-prepend">
                                  <div class="input-group-text form-control-sm">ระบุ</div>
                                </div>
                                <input name="address-specify" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ระบุที่พักอาศัย">
                              </div>
                              <div id="address-area" class="d-none">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ชื่อหอพัก</div>
                                  </div>
                                  <input name="address-name" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ชื่อหอพัก">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">เลขห้อง</div>
                                  </div>
                                  <input name="address-room" class="form-control form-control-sm input-block" type="text" maxlength="10" placeholder="เลขห้อง">
                                </div>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">บ้านเลขที่</div>
                                  </div>
                                  <input name="address-number" class="form-control form-control-sm input-block" type="text" maxlength="10" placeholder="บ้านเลขที่">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ตรอก/ซอย</div>
                                  </div>
                                  <input name="address-alley" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ตรอก/ซอย">
                                </div>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ถนน</div>
                                  </div>
                                  <input name="address-road" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ถนน">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">เบอร์โทร</div>
                                  </div>
                                  <input name="address-tel" class="form-control form-control-sm input-block" type="text" pattern="\d*" minlength="10" maxlength="10" placeholder="เบอร์โทร">
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>3.</td>
                            <td><b>การเดินทางไปเรียน</b><br />
                              <select name="tostudy[]" class="custom-select custom-select-sm input-block" multiple="multiple" size="<?php echo count($tostudy); ?>">
                                <?php foreach ($tostudy as $ar) { ?>
                                  <option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                                <?php } ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>4.</td>
                            <td><b>เครื่องใช้ส่วนตัว</b><br />
                              <select name="accessories[]" class="custom-select custom-select-sm input-block" multiple="multiple" size="<?php echo count($accessories); ?>">
                                <?php foreach ($accessories as $ar) { ?>
                                  <option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                                <?php } ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>5.</td>
                            <td><b>เพื่อนสนิท</b>
                              <div class="form-group-material pt-3">
                                <input name="fnumber" id="friend-number" type="text" class="input-material" minlength="10" maxlength="10" pattern="\d*">
                                <label for="friend-number" class="label-material active pt-3"><i class="fas fa-mobile-alt"></i> เบอร์มือถือ</label>
                              </div>
                              <div class="form-group-material">
                                <input name="fstudent_id" id="friend-studentID" type="text" class="input-material" minlength="10" maxlength="10" pattern="\d*" onkeyup="find_name();">
                                <label for="friend-studentID" class="label-material active"><i class="far fa-address-card"></i> รหัสนักศึกษา</label>
                                <div id="friend-name" class="form-control form-control-sm input-block mt-1"></div>
                              </div>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="m-0 p-0 pl-2 card-footer text-left btn btn-link" data-toggle="collapse" data-target="#sec1Col1" aria-expanded="false" aria-controls="sec1Col1" onclick="toggleCollapseIcon('#sec1Col1', '#sec1Icon1');"><i id="sec1Icon1" class="fas fa-chevron-down"></i></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 font-italic pt-3 bg-primary text-white shadow">
                <h5 class="text-uppercase"><i class="fas fa-user-friends"></i> ข้อมูลครัวเรือน<span class="float-right">2 / 4</span></h5>
              </div>
            </div>
            <div class="row py-3 p-xl-3">
              <div class="accordion" id="section2">
                <div class="card">
                  <div class="card-header" id="sec2Head1">
                    <h2 class="mb-0">
                      <span id="sec2Id1" class="confirmSubmit"><i class="fas fa-times-circle text-danger"></i></span>
                      <button class="btn btn-link collapsed text-primary" type="button" data-toggle="collapse" data-target="#sec2Col1" aria-expanded="false" aria-controls="sec2Col1" onclick="toggleCollapseIcon('#sec2Col1', '#sec2Icon1');">
                        ข้อมูลบิดา-มารดา/ผู้อุปการะ
                      </button>
                    </h2>
                  </div>
                  <div id="sec2Col1" class="collapse" aria-labelledby="sec2Head1" data-parent="#section2">
                    <div id="family" class="card-body">
                      <div class="row">
                        <table class="table">
                          <tr>
                            <td>1.</td>
                            <td><b>สถานภาพพ่อ-แม่</b><br />
                              <select name="fmstatus" class="custom-select custom-select-sm input-block" onchange="fn_status()">
                                <option disabled value="" selected class="d-none">-เลือก-</option>
                                <?php foreach ($status as $ar) { ?>
                                  <option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                                <?php } ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>2.</td>
                            <td><b>สถานภาพนักศึกษา<br />กับพ่อ-แม่ และผู้อุปการะ</b><br />
                              <select name="fstatus" class="custom-select custom-select-sm input-block d-none overflow-auto nowrap" onchange="$(this).val() == 3 ? $('#father').addClass('d-none') : $('#father').removeClass('d-none');">
                                <option disabled value="" selected class="d-none">-พ่อ-</option>
                                <?php foreach ($statusFather as $ar) { ?>
                                  <option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                                <?php } ?>
                              </select>
                              <select name="mstatus" class="custom-select custom-select-sm mt-1 input-block d-none overflow-auto nowrap" onchange="$(this).val() == 3 ? $('#mother').addClass('d-none') : $('#mother').removeClass('d-none');">
                                <option disabled value="" selected class="d-none">-แม่-</option>
                                <?php foreach ($statusMother as $ar) { ?>
                                  <option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                                <?php } ?>
                              </select>
                              <select name="pstatus" class="custom-select custom-select-sm mt-1 input-block overflow-auto nowrap" onchange="$(this).val() != 2 ? $('#patron').addClass('d-none') : $('#patron').removeClass('d-none');">
                                <option disabled value="" selected class="d-none">-ผู้อุปการะ-</option>
                                <?php foreach ($statusPatron as $ar) { ?>
                                  <option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                                <?php } ?>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <td>3.</td>
                            <td><b>ข้อมูลบิดา</b>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text form-control-sm">ชื่อ</div>
                                </div>
                                <input name="ffname" type="hidden" value="<?php echo $family[0]['FNAME']; ?>">
                                <input name="fsname" type="hidden" value="<?php echo $family[0]['SNAME']; ?>">
                                <div class="form-control form-control-sm input-block overflow-auto nowrap"><?php echo $family[0]['FULL_NAME']; ?></div>
                              </div>
                              <div class="input-group mt-1">
                                <div class="input-group-prepend">
                                  <div class="input-group-text form-control-sm">อายุ</div>
                                </div>
                                <input name="fyear" type="hidden" value="<?php echo substr($family[0]['BIRTH_DATE'], -4) + 543; ?>">
                                <div class="form-control form-control-sm input-block"><?php echo date('Y') - substr($family[0]['BIRTH_DATE'], -4); ?></div>
                                <div class="input-group-prepend">
                                  <div class="input-group-text form-control-sm">ปี</div>
                                </div>
                              </div>
                              <div id="father" class="d-none">
                                <div class="input-group mt-1">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">เบอร์มือถือ</div>
                                  </div>
                                  <input name="fnumber" class="form-control form-control-sm input-block w-50" type="text" minlength="10" maxlength="10" pattern="\d*">
                                </div>
                                <div class="input-group mt-1">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">อาชีพ</div>
                                  </div>
                                  <select name="fjob" class="custom-select custom-select-sm input-block" onchange="job('f');">
                                    <option disabled value="" selected class="d-none">-เลือก-</option>
                                    <?php $group  = $job[0]['selectdata_group'];
                                    foreach ($job as $ar) {
                                      if ($group  != $ar['selectdata_group']) {
                                        $group  = $ar['selectdata_group']; ?>
                                        <option disabled></option>
                                      <?php } ?>
                                      <option class="<?php echo "group{$group}"; ?>" value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                                    <?php } ?>
                                    <option disabled></option>
                                    <option value="0">อื่นๆ (ระบุ)</option>
                                  </select>
                                </div>
                                <div id="fposition-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ตำแหน่ง</div>
                                  </div>
                                  <input name="fposition" class="form-control form-control-sm input-block" type="text">
                                </div>
                                <div id="fjob-specify-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ระบุอาชีพ</div>
                                  </div>
                                  <input name="fjob-specify" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ระบุอาชีพ">
                                </div>
                                <div id="fincome-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">รายได้</div>
                                  </div>
                                  <input name="fincome" class="form-control form-control-sm text-right" type="text" min="0" maxlength="6" pattern="\d*" placeholder="0">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">บาท/เดือน</div>
                                  </div>
                                </div>
                                <div id="fdetail-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ละเอียดของอาชีพ</div>
                                  </div>
                                  <input name="fdetail" class="form-control form-control-sm" placeholder="อธิบายรายละเอียดของอาชีพ(โดยสังเขป)" maxlength="255">
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td></td>
                            <td><b>ข้อมูลมารดา</b>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text form-control-sm">ชื่อ</div>
                                </div>
                                <input name="mfname" type="hidden" value="<?php echo $family[1]['FNAME']; ?>">
                                <input name="msname" type="hidden" value="<?php echo $family[1]['SNAME']; ?>">
                                <div class="form-control form-control-sm input-block overflow-auto nowrap"><?php echo $family[1]['FULL_NAME']; ?></div>
                              </div>
                              <div class="input-group mt-1">
                                <div class="input-group-prepend">
                                  <div class="input-group-text form-control-sm">อายุ</div>
                                </div>
                                <input name="myear" type="hidden" value="<?php echo substr($family[1]['BIRTH_DATE'], -4) + 543; ?>">
                                <div class="form-control form-control-sm input-block"><?php echo date('Y') - substr($family[1]['BIRTH_DATE'], -4); ?></div>
                                <div class="input-group-prepend">
                                  <div class="input-group-text form-control-sm">ปี</div>
                                </div>
                              </div>
                              <div id="mother" class="d-none">
                                <div class="input-group mt-1">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">เบอร์มือถือ</div>
                                  </div>
                                  <input name="mnumber" class="form-control form-control-sm input-block" type="text" minlength="10" maxlength="10" pattern="\d*">
                                </div>
                                <div class="input-group mt-1">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">อาชีพ</div>
                                  </div>
                                  <select name="mjob" class="custom-select custom-select-sm input-block" onchange="job('m');">
                                    <option disabled value="" selected class="d-none">-เลือก-</option>
                                    <?php $group  = $job[0]['selectdata_group'];
                                    foreach ($job as $ar) {
                                      if ($group  != $ar['selectdata_group']) {
                                        $group  = $ar['selectdata_group']; ?>
                                        <option disabled></option>
                                      <?php } ?>
                                      <option class="<?php echo "group{$group}"; ?>" value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                                    <?php } ?>
                                    <option disabled></option>
                                    <option value="0">อื่นๆ (ระบุ)</option>
                                  </select>
                                </div>
                                <div id="mposition-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ตำแหน่ง</div>
                                  </div>
                                  <input name="mposition" class="form-control form-control-sm input-block" type="text">
                                </div>
                                <div id="mjob-specify-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ระบุอาชีพ</div>
                                  </div>
                                  <input name="mjob-specify" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ระบุอาชีพ">
                                </div>
                                <div id="mincome-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">รายได้</div>
                                  </div>
                                  <input name="mincome" class="form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="6" placeholder="0">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">บาท/เดือน</div>
                                  </div>
                                </div>
                                <div id="mdetail-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ละเอียดของอาชีพ</div>
                                  </div>
                                  <input name="mdetail" class="form-control form-control-sm" placeholder="อธิบายรายละเอียดของอาชีพ(โดยสังเขป)" maxlength="255">
                                </div>
                              </div>
                            </td>
                          </tr>
                          <tbody id="patron" class="d-none">
                            <tr>
                              <td></td>
                              <td><b>ผู้อุปการะ</b>
                                <small class="text-danger float-right">*ไม่ต้องใส่คำนำหน้าชื่อ</small>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ชื่อ</div>
                                  </div>
                                  <input name="pfname" class="form-control form-control-sm" type="text">
                                </div>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">สกุล</div>
                                  </div>
                                  <input name="psname" class="form-control form-control-sm" type="text">
                                </div>
                                <div class="input-group mt-1">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ปี พ.ศ.เกิด</div>
                                  </div>
                                  <input name="pyear" class="form-control form-control-sm" type="text" pattern="\d*" minlength="4" maxlength="4" onkeyup="age('p');">
                                </div>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">อายุ</div>
                                  </div>
                                  <div id="p-age" class="form-control form-control-sm"></div>
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ปี</div>
                                  </div>
                                </div>
                                <div class="input-group mt-1">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">เบอร์มือถือ</div>
                                  </div>
                                  <input name="pnumber" class="form-control form-control-sm input-block" type="text" minlength="10" maxlength="10" pattern="\d*">
                                </div>
                                <div class="input-group mt-1">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">อาชีพ</div>
                                  </div>
                                  <select name="pjob" class="custom-select custom-select-sm input-block" onchange="job('p');">
                                    <option disabled value="" selected class="d-none">-เลือก-</option>
                                    <?php $group  = $job[0]['selectdata_group'];
                                    foreach ($job as $ar) {
                                      if ($group  != $ar['selectdata_group']) {
                                        $group  = $ar['selectdata_group']; ?>
                                        <option disabled></option>
                                      <?php } ?>
                                      <option class="<?php echo "group{$group}"; ?>" value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                                    <?php } ?>
                                    <option disabled></option>
                                    <option value="0">อื่นๆ (ระบุ)</option>
                                  </select>
                                </div>
                                <div id="pposition-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ตำแหน่ง</div>
                                  </div>
                                  <input name="pposition" class="form-control form-control-sm input-block" type="text">
                                </div>
                                <div id="pjob-specify-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ระบุอาชีพ</div>
                                  </div>
                                  <input name="pjob-specify" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ระบุอาชีพ">
                                </div>
                                <div id="pincome-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">รายได้</div>
                                  </div>
                                  <input name="pincome" class="form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="6" placeholder="0">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">บาท/เดือน</div>
                                  </div>
                                </div>
                                <div id="pdetail-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">รายละเอียดของอาชีพ</div>
                                  </div>
                                  <input name="pdetail" class="form-control form-control-sm" placeholder="อธิบายรายละเอียดของอาชีพ(โดยสังเขป)" maxlength="255">
                                </div>
                                <div id="pchild-area" class="input-group mt-1">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">จำนวนบุตรของผู้อุปการะ</div>
                                  </div>
                                  <input name="pchild" class="form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="2" placeholder="0" onkeyup="$(this).val() > 0 ? $('#child').removeClass('d-none') : $('#child').addClass('d-none'); $('#family [name=pchild-study]').val(''); $('#family [name=pchild-working]').val(''); $('#family [name=pchild-noworking]').val(''); ">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">คน</div>
                                  </div>
                                </div>
                                <div id="child" class="d-none">
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text form-control-sm">กำลังศึกษา</div>
                                    </div>
                                    <input name="pchild-study" class="form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="2" placeholder="0" onkeyup="child('study');">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text form-control-sm">คน</div>
                                    </div>
                                  </div>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text form-control-sm">ประกอบอาชีพแล้ว</div>
                                    </div>
                                    <input name="pchild-working" class="form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="2" placeholder="0" onkeyup="child('working');">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text form-control-sm">คน</div>
                                    </div>
                                  </div>
                                  <div class="input-group">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text form-control-sm">ไม่ประกอบอาชีพ</div>
                                    </div>
                                    <input id="pchild-noworking" name="pchild-noworking" class="form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="2" placeholder="0" onkeyup="child('noworking');">
                                    <div class="input-group-prepend">
                                      <div class="input-group-text form-control-sm">คน</div>
                                    </div>
                                  </div>
                                </div>
                                <div class="input-group mt-1">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">สถานภาพสมรส</div>
                                  </div>
                                  <select name="pmarital" class="custom-select custom-select-sm input-block" onchange="$(this).val() == 1 ? $('#couple').removeClass('d-none') : $('#couple').addClass('d-none');">
                                    <option disabled value="" selected class="d-none">-เลือก-</option>
                                    <?php foreach ($marital as $ar) { ?>
                                      <option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </td>
                            </tr>
                            <tr id="couple" class="d-none">
                              <td></td>
                              <td><b>คู่สมรสผู้อุปการะ</b>
                                <small class="text-danger float-right">*ไม่ต้องใส่คำนำหน้าชื่อ</small>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ชื่อ</div>
                                  </div>
                                  <input name="cfname" class="form-control form-control-sm" type="text">
                                </div>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">สกุล</div>
                                  </div>
                                  <input name="csname" class="form-control form-control-sm" type="text">
                                </div>
                                <div class="input-group mt-1">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ปี พ.ศ.เกิด</div>
                                  </div>
                                  <input name="cyear" class="form-control form-control-sm" type="text" pattern="\d*" minlength="4" maxlength="4" onkeyup="age('c');">
                                </div>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">อายุ</div>
                                  </div>
                                  <div id="c-age" class="form-control form-control-sm"></div>
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ปี</div>
                                  </div>
                                </div>
                                <div class="input-group mt-1">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">เบอร์มือถือ</div>
                                  </div>
                                  <input name="cnumber" class="form-control form-control-sm input-block" type="text" minlength="10" maxlength="10" pattern="\d*">
                                </div>
                                <div class="input-group mt-1">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">อาชีพ</div>
                                  </div>
                                  <select name="cjob" class="custom-select custom-select-sm input-block" onchange="job('c');">
                                    <option disabled value="" selected class="d-none">-เลือก-</option>
                                    <?php $group  = $job[0]['selectdata_group'];
                                    foreach ($job as $ar) {
                                      if ($group  != $ar['selectdata_group']) {
                                        $group  = $ar['selectdata_group']; ?>
                                        <option disabled></option>
                                      <?php } ?>
                                      <option class="<?php echo "group{$group}"; ?>" value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>
                                    <?php } ?>
                                    <option disabled></option>
                                    <option value="0">อื่นๆ (ระบุ)</option>
                                  </select>
                                </div>
                                <div id="cposition-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ตำแหน่ง</div>
                                  </div>
                                  <input name="cposition" class="form-control form-control-sm input-block" type="text">
                                </div>
                                <div id="cjob-specify-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">ระบุอาชีพ</div>
                                  </div>
                                  <input name="cjob-specify" class="form-control form-control-sm input-block" type="text" maxlength="255" placeholder="ระบุอาชีพ">
                                </div>
                                <div id="cincome-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">รายได้</div>
                                  </div>
                                  <input name="cincome" class="form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="6" placeholder="0">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">บาท/เดือน</div>
                                  </div>
                                </div>
                                <div id="cdetail-area" class="input-group d-none">
                                  <div class="input-group-prepend">
                                    <div class="input-group-text form-control-sm">รายละเอียดของอาชีพ</div>
                                  </div>
                                  <input name="cdetail" class="form-control form-control-sm" placeholder="อธิบายรายละเอียดของอาชีพ(โดยสังเขป)" maxlength="255">
                                </div>
                              </td>
                            </tr>
                          </tbody>
                          <tr>
                            <td>4.</td>
                            <td><b>ที่อยู่อาศัยของ พ่อ-แม่ และผู้อุปการะ</b>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text form-control-sm">บ้านเลขที่</div>
                                </div>
                                <input name="address-number" class="form-control form-control-sm" placeholder="บ้านเลขที่" maxlength="10">
                                <div class="input-group-prepend">
                                  <div class="input-group-text form-control-sm">ตรอก/ซอย</div>
                                </div>
                                <input name="address-alley" class="form-control form-control-sm" placeholder="ตรอก/ซอย" maxlength="255">
                              </div>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text form-control-sm">ถนน</div>
                                </div>
                                <input name="address-road" class="form-control form-control-sm" placeholder="ถนน" maxlength="255">
                                <div class="input-group-prepend">
                                  <div class="input-group-text form-control-sm">หมู่ที่</div>
                                </div>
                                <input name="address-village" class="form-control form-control-sm" placeholder="หมู่ที่" maxlength="3">
                              </div>
                              <input class="form-control form-control-sm" id="addrSearch" placeholder="กรอก ตำบล, อำเภอ, จังหวัด หรือ รหัสไปรษณีย์" autocomplete="off" />
                              <!-- <div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text form-control-sm">ตำบล</div>
																</div>
																<input name="address-subdistrict" class="form-control form-control-sm" placeholder="ตำบล" maxlength="255">
																<div class="input-group-prepend">
																	<div class="input-group-text form-control-sm">อำเภอ</div>
																</div>
																<input name="address-district" class="form-control form-control-sm" placeholder="อำเภอ" maxlength="255">
															</div>
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text form-control-sm">จังหวัด</div>
																</div>
																<input name="address-province" class="form-control form-control-sm" placeholder="จังหวัด" maxlength="255">
																<div class="input-group-prepend">
																	<div class="input-group-text form-control-sm">รหัสไปรษณี</div>
																</div>
																<input name="address-postcode" class="form-control form-control-sm" placeholder="รหัสไปรษณี" pattern="\d*" minlength="5" maxlength="5">
															</div> -->
                            </td>
                          </tr>
                          <tr>
                            <td>5.</td>
                            <td><b>ทรัพย์สิน/ภาระหนี้สิน/</b></td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;5.1 <b>เงินกู้</b>
                              <table class="table table-bordered table-sm">
                                <thead>
                                  <tr>
                                    <td width="1"><button type="button" class="badge badge-light text-primary" onclick="add('loan');"><i class="fas fa-plus"></i></button></td>
                                    <td width="50%">กู้จาก</td>
                                    <td width="25%">จำนวน(บาท)</td>
                                    <td width="25%">ผ่อน(บาท/เดือน)</td>
                                  </tr>
                                </thead>
                                <tbody class="loan"></tbody>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;5.2 <b>ทรัพย์สินครอบครัว</b>
                              <table class="table table-bordered table-sm">
                                <thead>
                                  <tr>
                                    <td width="1"></td>
                                    <td colspan="3">ประเภท</td>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td width="1"><button type="button" class="badge badge-light text-primary" onclick="add('motocycle');"><i class="fas fa-plus"></i></button></td>
                                    <td colspan="3">รถจักรยานยนต์</td>
                                  </tr>
                                </tbody>
                                <tbody class="motocycle"></tbody>
                                <tr>
                                  <td width="1"><button type="button" class="badge badge-light text-primary" onclick="add('car');"><i class="fas fa-plus"></i></button></td>
                                  <td colspan="3">รถยนต์</td>
                                </tr>
                                <tbody class="car"></tbody>
                                <tbody>
                                  <?php foreach ($asset as $ar) {
                                    $id  = $ar['selectdata_type'] . $ar['selectdata_id']; ?>
                                    <tr>
                                      <td align="center">
                                        <div class="custom-control custom-checkbox">
                                          <input id="<?php echo $id; ?>" type="checkbox" class="custom-control-input" onchange="$('.<?php echo $id; ?>').prop('disabled', !this.checked); $('.<?php echo $id; ?>').val('')">
                                          <label class="custom-control-label" for="<?php echo $id; ?>"></label>
                                        </div>
                                      </td>
                                      <td colspan="2" width="50%"><?php echo $ar['selectdata_title']; ?></td>
                                      <td width="50%">
                                        <div class="input-group">
                                          <input name="asset[number][<?php echo $ar['selectdata_id']; ?>]" class="property <?php echo $id; ?> form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="2" placeholder="0" disabled>
                                          <div class="input-group-prepend">
                                            <div class="input-group-text form-control-sm"><?php echo $ar['selectdata_group']; ?></div>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                  <tr>
                                    <td align="center">
                                      <div class="custom-control custom-checkbox">
                                        <input id="asset0" type="checkbox" class="custom-control-input" onchange="$('.asset0').prop('disabled', !this.checked); $('.asset0').val('')">
                                        <label class="custom-control-label" for="asset0"></label>
                                      </div>
                                    </td>
                                    <td>อื่นๆ</td>
                                    <td colspan="2" width="100%">
                                      <input name="asset[number][0]" class="property asset0 form-control form-control-sm" placeholder="รายละเอียด และจำนวน" disabled maxlength="255">
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;5.3 <b>เช่าทรัพย์สิน</b>
                              <table class="table table-bordered table-sm">
                                <thead>
                                  <tr>
                                    <td width="1"></td>
                                    <td colspan="2">ประเภท</td>
                                    <td width="30%">จำนวน</td>
                                    <td width="30%">เช่า(บาท/เดือน)</td>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($rent as $ar) {
                                    $id  = $ar['selectdata_type'] . $ar['selectdata_id']; ?>
                                    <tr>
                                      <td align="center">
                                        <div class="custom-control custom-checkbox">
                                          <input id="<?php echo $id; ?>" type="checkbox" class="custom-control-input" onchange="$('.<?php echo $id; ?>').prop('disabled', !this.checked); $('.<?php echo $id; ?>').val('')">
                                          <label class="custom-control-label" for="<?php echo $id; ?>"></label>
                                        </div>
                                      </td>
                                      <td colspan="2"><?php echo $ar['selectdata_title']; ?></td>
                                      <td>
                                        <div class="input-group">
                                          <input name="rent[number][<?php echo $ar['selectdata_id']; ?>]" class="property <?php echo $id; ?> form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="2" placeholder="0" disabled>
                                          <div class="input-group-prepend">
                                            <div class="input-group-text form-control-sm"><?php echo $ar['selectdata_group']; ?></div>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <input name="rent[budget][<?php echo $ar['selectdata_id']; ?>]" class="property <?php echo $id; ?> form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="6" placeholder="0" disabled>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                  <tr>
                                    <td align="center">
                                      <div class="custom-control custom-checkbox">
                                        <input id="rent0" type="checkbox" class="custom-control-input" onchange="$('.rent0').prop('disabled', !this.checked); $('.rent0').val('')">
                                        <label class="custom-control-label" for="rent0"></label>
                                      </div>
                                    </td>
                                    <td width="1">อื่นๆ</td>
                                    <td colspan="2">
                                      <input name="rent[number][0]" class="property rent0 form-control form-control-sm" placeholder="รายละเอียด และจำนวน" disabled maxlength="255">
                                    </td>
                                    <td>
                                      <input name="rent[budget][0]" class="property rent0 form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="6" placeholder="0" disabled>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">5.4 <b>ผ่อนทรัพย์สิน</b>
                              <table class="table table-bordered table-sm">
                                <thead>
                                  <tr>
                                    <td width="1"></td>
                                    <td colspan="2">ประเภท</td>
                                    <td width="30%">จำนวน</td>
                                    <td width="30%">ผ่อน(บาท/เดือน)</td>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($installment as $ar) {
                                    $id  = $ar['selectdata_type'] . $ar['selectdata_id']; ?>
                                    <tr>
                                      <td align="center">
                                        <div class="custom-control custom-checkbox">
                                          <input id="<?php echo $id; ?>" type="checkbox" class="custom-control-input" onchange="$('.<?php echo $id; ?>').prop('disabled', !this.checked); $('.<?php echo $id; ?>').val('')">
                                          <label class="custom-control-label" for="<?php echo $id; ?>"></label>
                                        </div>
                                      </td>
                                      <td colspan="2"><?php echo $ar['selectdata_title']; ?></td>
                                      <td>
                                        <div class="input-group">
                                          <input name="installment[number][<?php echo $ar['selectdata_id']; ?>]" class="property <?php echo $id; ?> form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="2" placeholder="0" disabled>
                                          <div class="input-group-prepend">
                                            <div class="input-group-text form-control-sm"><?php echo $ar['selectdata_group']; ?></div>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <input name="installment[budget][<?php echo $ar['selectdata_id']; ?>]" class="property <?php echo $id; ?> form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="6" placeholder="0" disabled>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                  <tr>
                                    <td align="center">
                                      <div class="custom-control custom-checkbox">
                                        <input id="installment0" type="checkbox" class="custom-control-input" onchange="$('.installment0').prop('disabled', !this.checked); $('.installment0').val('')">
                                        <label class="custom-control-label" for="installment0"></label>
                                      </div>
                                    </td>
                                    <td width="1">อื่นๆ</td>
                                    <td colspan="2">
                                      <input name="installment[number][0]" class="property installment0 form-control form-control-sm" placeholder="รายละเอียด และจำนวน" disabled maxlength="255">
                                    </td>
                                    <td>
                                      <input name="installment[budget][0]" class="property installment0 form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="6" placeholder="0" disabled>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="m-0 p-0 pl-2 card-footer text-left btn btn-link" data-toggle="collapse" data-target="#sec2Col1" aria-expanded="false" aria-controls="sec2Col1" onclick="toggleCollapseIcon('#sec2Col1', '#sec2Icon1');"><i id="sec2Icon1" class="fas fa-chevron-down"></i></div>
                </div>
                <div class="card">
                  <div class="card-header" id="sec2Head2">
                    <h2 class="mb-0">
                      <span id="sec2Id2" class="confirmSubmit"><i class="fas fa-times-circle text-danger"></i></span>
                      <button class="btn btn-link collapsed text-primary" type="button" data-toggle="collapse" data-target="#sec2Col2" aria-expanded="false" aria-controls="sec2Col2" onclick="toggleCollapseIcon('#sec2Col2', '#sec2Icon2');">
                        ข้อมูลเกี่ยวกับบุคคลในครอบครัว
                      </button>
                    </h2>
                  </div>
                  <div id="sec2Col2" class="collapse" aria-labelledby="sec2Head2" data-parent="#section2">
                    <div id="sibling" class="card-body">
                      <div class="card-body">
                        <div class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input" id="nosibling" value="0" onclick="if($(this).is(':checked')) { if(confirm('ไม่มีบุคคลในครอบครัว?')) { $('#sibling .study').html(''); $('#sibling .working').html(''); $('#sibling .relative').html(''); $('#sibling [name=nosibling]').val(1); }} else { $('#sibling [name=nosibling]').val(0); } check_sibling()">
                          <label class="custom-control-label" for="nosibling">ไม่มีบุคคลในครอบครัว</label>
                        </div>
                        <input type="hidden" class="is-invalid" name="nosibling" value="0">1. <b>บุคคลในครอบครัวที่กำลังศึกษา</b> (ไม่รวมตัวเอง)
                        <div class="table-responsive">
                          <table class="table table-bordered table-sm">
                            <thead>
                              <tr>

                                <td width="1"><button type="button" class="badge badge-light text-primary" onclick="if($('#nosibling').is(':checked')) { alert_modal('ทำเครื่องหมายที่ ไม่มีบุคคลในครอบครัว ออกก่อน', 'orange', true); } else { add('study'); check_sibling(); }"><i class="fas fa-plus"></i></button></td>
                                <td width="20%">เกี่ยวข้องเป็น</td>
                                <td width="10%">ปีเกิด</td>
                                <td width="20%">กำลังศึกษา</td>
                                <td width="10%">สถาบัน</td>
                                <td width="10%">กยศ./กรอ.</td>
                                <td width="30%">ที่พัก</td>
                              </tr>
                            </thead>
                            <tbody class="study"></tbody>
                          </table>
                        </div>
                        <div class="table-responsive">2. <b>บุคคลในครอบครัวที่ประกอบอาชีพหรืออื่นๆ</b>
                          <table class="table table-bordered table-sm">
                            <thead>
                              <tr>
                                <td width="1"><button type="button" class="badge badge-light text-primary" onclick="if($('#nosibling').is(':checked')) { alert_modal('ทำเครื่องหมายที่ ไม่มีบุคคลในครอบครัว ออกก่อน', 'orange', true); } else { add('working'); check_sibling(); }"><i class="fas fa-plus"></i></button></td>
                                <td width="20%">เกี่ยวข้องเป็น</td>
                                <td width="10%">ปีเกิด</td>
                                <td width="20%">ระดับการศึกษา</td>
                                <td width="10%">สถานภาพ</td>
                                <td width="10%">บุตร (คน)</td>
                                <td width="30%">อาชีพ</td>
                              </tr>
                            </thead>
                            <tbody class="working"></tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="m-0 p-0 pl-2 card-footer text-left btn btn-link" data-toggle="collapse" data-target="#sec2Col2" aria-expanded="false" aria-controls="sec2Col2" onclick="toggleCollapseIcon('#sec2Col2', '#sec2Icon2');"><i id="sec2Icon2" class="fas fa-chevron-down"></i></div>
                </div>

              </div>
            </div>
            <div class="row">
              <div class="col-12 font-italic pt-3 bg-primary text-white shadow">
                <h5 class="text-uppercase"><i class="fas fa-money-check-alt"></i> ข้อมูลการเงิน<span class="float-right">3 / 4</span></h5>
              </div>
            </div>
            <div class="row py-3 p-xl-3">
              <div class="accordion" id="section3">
                <div class="card">
                  <div class="card-header" id="sec3Head1">
                    <h2 class="mb-0">
                      <span id="sec3Id1"><i class="fas fa-times-circle text-danger"></i></span>
                      <button class="btn btn-link collapsed text-primary" type="button" data-toggle="collapse" data-target="#sec3Col1" aria-expanded="false" aria-controls="sec3Col1" onclick="toggleCollapseIcon('#sec3Col1', '#sec3Icon1');">
                        สถานภาพการเงินของนักศึกษา
                      </button>
                    </h2>
                  </div>
                  <div id="sec3Col1" class="collapse" aria-labelledby="sec3Head1" data-parent="#section3">
                    <div id="finance" class="card-body">
                      <div class="row">
                        <table class="table">
                          <tr>
                            <td width="1">1.</td>
                            <td><b>รายรับ</b>ของนักศึกษา<br />
                              <table class="table table-sm">
                                <tbody>
                                  <?php foreach ($income as $ar) {
                                    $id  = $ar['selectdata_type'] . $ar['selectdata_id']; ?>
                                    <tr>
                                      <td width="50%"><?php echo $ar['selectdata_title']; ?></td>
                                      <td width="50%">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <div class="input-group-text form-control-sm">เดือนละ</div>
                                          </div>
                                          <input name="income[<?php echo $ar['selectdata_id']; ?>]" class="property <?php echo $id; ?> form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="5" placeholder="0">
                                          <div class="input-group-prepend">
                                            <div class="input-group-text form-control-sm">บาท</div>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td>2.</td>
                            <td><b>รายจ่าย</b>ของนักศึกษา<br />
                              <table class="table table-sm">
                                <tbody>
                                  <?php foreach ($outcome as $ar) {
                                    $id  = $ar['selectdata_type'] . $ar['selectdata_id']; ?>
                                    <tr>
                                      <td colspan="2" width="50%"><?php echo $ar['selectdata_title']; ?></td>
                                      <td width="50%">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <div class="input-group-text form-control-sm">เดือนละ</div>
                                          </div>
                                          <input name="outcome[<?php echo $ar['selectdata_id']; ?>]" class="property <?php echo $id; ?> form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="5" placeholder="0">
                                          <div class="input-group-prepend">
                                            <div class="input-group-text form-control-sm">บาท</div>
                                          </div>
                                        </div>
                                      </td>
                                    </tr>
                                  <?php } ?>
                                  <tr>
                                    <td width="1">อื่นๆ</td>
                                    <td width="50%">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text form-control-sm">ระบุ</div>
                                        </div>
                                        <input name="outcome[specify]" class="property <?php echo $id; ?> form-control form-control-sm" type="text" maxlength="255" placeholder="ระบุ">
                                      </div>
                                    </td>
                                    <td width="50%">
                                      <div class="input-group">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text form-control-sm">เดือนละ</div>
                                        </div>
                                        <input name="outcome[0]" class="property <?php echo $id; ?> form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="5" placeholder="0">
                                        <div class="input-group-prepend">
                                          <div class="input-group-text form-control-sm">บาท</div>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td>3.</td>
                            <td><b>ประมาณการค่าใช้จ่ายทั้งหมดที่นักศึกษาคาดว่าจะเพียงพอสำหรับตนเอง</b><br />
                              <div class="input-group form-inline">
                                <div class="input-group-prepend">
                                  <div class="input-group-text form-control-sm">เดือนละ</div>
                                </div>
                                <input name="outcome[total]" class="property <?php echo $id; ?> form-control form-control-sm text-right" type="text" min="0" pattern="\d*" maxlength="5" placeholder="0">
                                <div class="input-group-prepend">
                                  <div class="input-group-text form-control-sm">บาท</div>
                                </div>
                                <small class="pl-2 pt-2">(ไม่รวมค่าหน่วยกิต และค่าบำรุงการศึกษา)</small>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>4.</td>
                            <td><b>ประวัติการรับทุน และการทำงาน</b></td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;4.1 <b>ประวัติทุนทำงานแลกเปลี่ยนในมหาวิทยาลัย</b>
                              <table class="table table-bordered table-sm">
                                <thead>
                                  <tr>
                                    <td width="1"><button type="button" class="badge badge-light text-primary" onclick="finance_add('fund');"><i class="fas fa-plus"></i></button></td>
                                    <td width="50%">ปีการศึกษา</td>
                                    <td width="50%">เทอม</td>
                                  </tr>
                                </thead>
                                <tbody class="fund"></tbody>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;4.2 <b>ทุนการศึกษา ที่เคยได้รับในมหาวิทยาลัย</b> <small>(ไม่รวม กยศ./กรอ.)</small>
                              <table class="table table-bordered table-sm">
                                <thead>
                                  <tr>
                                    <td width="1"><button type="button" class="badge badge-light text-primary" onclick="finance_add('scholarship');"><i class="fas fa-plus"></i></button></td>
                                    <td width="35%">ปีการศึกษา</td>
                                    <td width="40%">ชื่อทุน</td>
                                    <td width="25%">จำนวนเงินทุน/ปี</td>
                                  </tr>
                                </thead>
                                <tbody class="scholarship"></tbody>
                              </table>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">&nbsp;&nbsp;&nbsp;4.3 <b>ทำงานพิเศษ</b> <small>(ย้อนหลัง 2 ปี)</small>
                              <table class="table table-bordered table-sm">
                                <thead>
                                  <tr>
                                    <td width="1"><button type="button" class="badge badge-light text-primary" onclick="finance_add('job');"><i class="fas fa-plus"></i></button></td>
                                    <td width="20%">เริ่ม</td>
                                    <td width="20%">สิ้นสุด</td>
                                    <td width="20%">จำนวนเงิน/เดือน</td>
                                    <td width="40%">ลักษณะงาน</td>
                                  </tr>
                                </thead>
                                <tbody class="job"></tbody>
                              </table>
                            </td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <div class="m-0 p-0 pl-2 card-footer text-left btn btn-link" data-toggle="collapse" data-target="#sec3Col1" aria-expanded="false" aria-controls="sec3Col1" onclick="toggleCollapseIcon('#sec3Col1', '#sec3Icon1');"><i id="sec3Icon1" class="fas fa-chevron-down"></i></div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 font-italic pt-3 bg-primary text-white shadow">
                <h5 class="text-uppercase"><i class="fas fa-clipboard-check"></i> หนังสือรับรอง<span class="float-right">4 / 4</span></h5>
              </div>
            </div>
            <div class="row py-3 p-xl-3">
              <div class="accordion" id="section4">
                <div class="card">
                  <div class="card-header" id="sec4Head1">
                    <h2 class="mb-0">
                      <span id="sec4Id1"><i class="fas fa-times-circle text-danger"></i></span>
                      <button class="btn btn-link collapsed text-primary" type="button" data-toggle="collapse" data-target="#sec4Col1" aria-expanded="false" aria-controls="sec4Col1" onclick="toggleCollapseIcon('#sec4Col1', '#sec4Icon1');">
                        เหตุผลความจำเป็นที่ขอรับทุน
                      </button>
                    </h2>
                  </div>
                  <div id="sec4Col1" class="collapse" aria-labelledby="sec4Head1" data-parent="#section4" style="width: 100%;">
                    <div id="explain" class="card-body">
                      <table class="table">
                        <tr>
                          <td>อธิบายความเป็นอยู่ของครอบครัวที่แสดงให้เห็นความจำเป็นที่ต้องขอรับทุน</td>
                        </tr>
                        <tr>
                          <td><textarea class="form-control" name="explain" style="width: 100%; height: 300px;"></textarea></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <div class="m-0 p-0 pl-2 card-footer text-left btn btn-link" data-toggle="collapse" data-target="#sec4Col1" aria-expanded="false" aria-controls="sec4Col1" onclick="toggleCollapseIcon('#sec4Col1', '#sec4Icon1');"><i id="sec4Icon1" class="fas fa-chevron-down"></i></div>
                </div>
                <div class="card">
                  <div class="card-header" id="sec4Head2">
                    <h2 class="mb-0">
                      <span id="sec4Id2"><i class="fas fa-times-circle text-danger"></i></span>
                      <button class="btn btn-link collapsed text-primary" type="button" data-toggle="collapse" data-target="#sec4Col2" aria-expanded="false" aria-controls="sec4Col2" onclick="toggleCollapseIcon('#sec4Col2', '#sec4Icon2');">
                        ส่งเอกสารเพิ่มเติม (ส่งลิงก์ + รอเจ้าหน้าที่ตรวจเอกสาร)
                      </button>
                    </h2>
                  </div>
                  <div id="sec4Col2" class="collapse" aria-labelledby="sec4Head2" data-parent="#section4">
                    <div class="card-body">
                      <ul class="list-group">
                        <a id="googledrive" class="text-danger" target="_blank">ไม่มี ลิงก์เอกสารออนไลน์ผ่าน Google Drive</a>
                        <?php foreach ($certificate as $ar) { ?>
                          <li class="list-group-item">
                            <span id="<?php echo "certificate{$ar['selectdata_id']}"; ?>"><i class="fas fa-times-circle text-danger"></i></span>
                            <?php echo "{$ar['selectdata_id']}. {$ar['selectdata_title']}"; ?>
                          </li>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
                  <div class="m-0 p-0 pl-2 card-footer text-left btn btn-link" data-toggle="collapse" data-target="#sec4Col2" aria-expanded="false" aria-controls="sec4Col2" onclick="toggleCollapseIcon('#sec4Col2', '#sec4Icon2');"><i id="sec4Icon2" class="fas fa-chevron-down"></i></div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script type="text/javascript">
  var statusCard = [
    '<i class="fas fa-times-circle text-danger"></i>',
    '<i class="fas fa-check-circle text-success"></i>',
    '<i class="fas fa-minus-circle text-warning"></i>'
  ];

  function toggleCollapseIcon(collapse, id) {
    $(collapse).on('shown.bs.collapse', function() {
      $(id).removeClass('fa-chevron-down')
      $(id).addClass('fa-chevron-up')
    });
    $(collapse).on('hidden.bs.collapse', function() {
      $(id).removeClass('fa-chevron-up')
      $(id).addClass('fa-chevron-down')
    });
  }

  profile()

  function profile() {
    $.ajax({
      method: 'POST',
      url: '<?php echo site_url('annual/get_profile/' . $student_id); ?>',
      data: {
        registration_id: <?php echo $registration['registration_id']; ?>
      },
      success: function(result) {
        result = JSON.parse(result)
        console.log(result)
        if (result) {
          $('#profile #profile-number').val(result['number']);
          $('#profile #profile-account').val(result['account']);
          $('#profile #profile-email').val(result['email']);
          $('#profile #profile-line').val(result['line']);
          $('#profile #friend-number').val(result['fnumber']);
          $('#profile #friend-studentID').val(result['fstudent_id']);
          find_student_name()
          if ($.isNumeric(result['mobile'])) {
            $('#profile [name="mobile"]').val(result['mobile'])
          } else {
            $('#profile [name="mobile"]').val(0);
            $('#profile #mobile-specify-area').removeClass('d-none');
            $('#profile [name="mobile-specify"]').val(result['mobile']);
          }
          if ($.isNumeric(result['bank'])) {
            $('#profile [name="bank"]').val(result['bank'])
          } else {
            $('#profile [name="bank"]').val(0);
            $('#profile #bank-specify-area').removeClass('d-none');
            $('#profile [name="bank-specify"]').val(result['bank']);
          }
          if ($.isNumeric(result['religion'])) {
            $('#profile [name="religion"]').val(result['religion'])
          } else {
            $('#profile [name="religion"]').val(0);
            $('#profile #religion-specify-area').removeClass('d-none');
            $('#profile [name="religion-specify"]').val(result['religion']);
          }
          if ($.isNumeric(result['address'])) {
            $('#profile [name="address"]').val(result['address'])
            if (result['address'] == 4) {
              $('#profile #address-area').removeClass('d-none')
              $('#profile [name="address-name"]').val(result['address-name'])
              $('#profile [name="address-room"]').val(result['address-room'])
              $('#profile [name="address-number"]').val(result['address-number'])
              $('#profile [name="address-alley"]').val(result['address-alley'])
              $('#profile [name="address-road"]').val(result['address-road'])
              $('#profile [name="address-tel"]').val(result['address-tel'])
            }
          } else {
            $('#profile [name="address"]').val(0);
            $('#profile #address-specify-area').removeClass('d-none');
            $('#profile [name="address-specify"]').val(result['address']);
          }
          $('#profile [name="tostudy[]"]').val(JSON.parse(result['tostudy']))
          $('#profile [name="accessories[]"]').val(JSON.parse(result['accessories']))
          $(function() {
            $('#sec1Id1').html(statusCard[1])
          });
        }
      }
    })
  }

  function find_student_name() {
    $.ajax({
      method: 'POST',
      url: '<?php echo site_url('annual/find_student_name'); ?>',
      data: {
        student_id: $('#friend-studentID').val()
      },
      success: function(result) {
        if (result) {
          $('#friend-name').html(result)
        } else {
          $('#friend-name').html('-ไม่มีรหัสนี้ในระบบ-')
        }
      }
    })
  }
  $('select[multiple="multiple"] option').mousedown(function(e) {
    e.preventDefault();
    var originalScrollTop = $(this).parent().scrollTop();
    $(this).prop('selected', $(this).prop('selected') ? false : true);
    var self = this;
    $(this).parent().focus();
    setTimeout(function() {
      $(self).parent().scrollTop(originalScrollTop);
    }, 0);
    return false;
  })

  var ar_num = {
    'loan': 0,
    'motocycle': 0,
    'car': 0,
    'study': 0,
    'working': 0,
    'relative': 0
  }
  family()
  sibling()
  check_sibling()

  function family() {
    $.ajax({
      method: 'POST',
      url: '<?php echo site_url('annual/get_family/' . $student_id); ?>',
      data: {
        registration_id: <?php echo $registration['registration_id']; ?>
      },
      success: function(result) {
        result = JSON.parse(result)
        console.log(result)
        if (result) {
          $('#family [name="fmstatus"]').val(result[0]['fmstatus']);
          $('#family [name="address-number"]').val(result[0]['number'])
          $('#family [name="address-alley"]').val(result[0]['alley'])
          $('#family [name="address-road"]').val(result[0]['road'])
          $('#family [name="address-village"]').val(result[0]['village'])
          $('#family #addrSearch').val('ตำบล' + result[0]['district_name'] + ' อำเภอ' + result[0]['amphure_name'] + ' จังหวัด' + result[0]['province_name'] + (result[0]['zip_code'] !== null ? ' ' + result[0]['zip_code'] : ''))

          // $('#family [name="address-subdistrict"]').val(result[0]['subdistrict'])
          // $('#family [name="address-district"]').val(result[0]['district'])
          // $('#family [name="address-province"]').val(result[0]['province'])
          // $('#family [name="address-postcode"]').val(result[0]['postcode'])
          fn_status()
          $('#family [name="fstatus"]').val(result[0]['fstatus']);
          result[0]['fstatus'] == 3 ? $('#father').addClass('d-none') : $('#father').removeClass('d-none');
          $('#family [name="mstatus"]').val(result[0]['mstatus']);
          result[0]['mstatus'] == 3 ? $('#mother').addClass('d-none') : $('#mother').removeClass('d-none');
          $('#family [name="pstatus"]').val(result[0]['pstatus']);
          result[0]['pstatus'] != 2 ? $('#patron').addClass('d-none') : $('#patron').removeClass('d-none');

          parent = ['f', 'm', 'p', 'c']
          $.each(result[1], function(i, ar) {
            p = parent[ar['parent']];
            if (p != 'f' && p != 'm') {
              $('#family [name="' + p + 'fname"]').val(ar['fname']);
              $('#family [name="' + p + 'sname"]').val(ar['sname']);
              $('#family [name="' + p + 'year"]').val(parseInt(ar['year']) + 543);
              age(p)
            }
            $('#family [name="' + p + 'number"]').val(ar['number']);
          })

          $.each(result[2], function(i, ar) {
            p = parent[ar['parent']];
            $('#family [name="pmarital"]').val(2)
            if (p == 'c') {
              $('#family [name="pmarital"]').val(1)
              $('#family #couple').removeClass('d-none');
            }
            if ($.isNumeric(ar['job'])) {
              $('#family [name="' + p + 'job"]').val(ar['job'])
            } else {
              $('#family [name="' + p + 'job"]').val(0);
              $('#family #' + p + 'job-specify-area').removeClass('d-none');
              $('#family [name="' + p + 'job-specify"]').val(ar['job']);
            }
            job(p)
            ar['position'] != null ? $('#family #' + p + 'position-area').removeClass('d-none') : '';
            $('#family [name="' + p + 'position"]').val(ar['position'])
            ar['income'] != null ? $('#family #' + p + 'income-area').removeClass('d-none') : '';
            $('#family [name="' + p + 'income"]').val(ar['income'])
            ar['detail'] != null ? $('#family #' + p + 'detail-area').removeClass('d-none') : '';
            $('#family [name="' + p + 'detail"]').val(ar['detail'])
          })

          $('#family [name=pchild]').val(0)
          if (result[3]) {
            $('#child').removeClass('d-none')
            $('#family [name=pchild]').val(parseInt(result[3]['study']) + parseInt(result[3]['working']) + parseInt(result[3]['noworking']))
            $('#family [name=pchild-study]').val(result[3]['study'])
            $('#family [name=pchild-working]').val(result[3]['working'])
            $('#family [name=pchild-noworking]').val(result[3]['noworking'])
          }

          $('.loan').html('');
          $.each(result[4], function(i, ar) {
            add('loan')
            $('#family [name="loan[from][' + ar_num['loan'] + ']"]').val(ar['from'])
            $('#family [name="loan[budget][' + ar_num['loan'] + ']"]').val(ar['budget'])
            $('#family [name="loan[installment][' + ar_num['loan'] + ']"]').val(ar['installment'])
            $('#family [name="loan[detail][' + ar_num['loan'] + ']"]').val(ar['detail'])
          })

          $('.motocycle').html('');
          $('.car').html('');
          var temp = ['motocycle', 'car'];
          $.each(result[5], function(i, ar) {
            add(temp[ar['type']]);
            $('#family [name="' + temp[ar['type']] + '[band][' + ar_num[temp[ar['type']]] + ']"]').val(ar['band'])
            $('#family [name="' + temp[ar['type']] + '[model][' + ar_num[temp[ar['type']]] + ']"]').val(ar['model'])
          })

          $('.asset').html('');
          $('.rent').html('');
          $('.installment').html('');
          var temp = ['asset', 'rent', 'installment'];
          $.each(result[6], function(i, ar) {
            $('#family #' + temp[ar['type']] + ar['id']).prop('checked', true)
            $('#family .' + temp[ar['type']] + ar['id']).prop('disabled', false)
            $('#family [name="' + temp[ar['type']] + '[number][' + ar['id'] + ']"]').val(ar['number'])
            $('#family [name="' + temp[ar['type']] + '[budget][' + ar['id'] + ']"]').val(ar['budget'])
          })
          $(function() {
            $('#sec2Id1').html(statusCard[1])
          });
        }
      }
    })
  }

  function sibling() {
    $.ajax({
      method: 'POST',
      url: '<?php echo site_url('annual/get_sibling/' . $student_id); ?>',
      data: {
        registration_id: <?php echo $registration['registration_id']; ?>
      },
      success: function(result) {
        result = JSON.parse(result)
        console.log(result)
        if (result) {
          if (result == 'nosibling') {
            $('#nosibling').prop('checked', true);
            check_sibling();
          } else {
            $('.study').html('');
            $.each(result[0], function(i, ar) {
              add('study');
              $('#sibling [name="study[relative][' + ar_num['study'] + ']"]').val(ar['relative'])
              $('#sibling [name="study[sex][' + ar_num['study'] + ']"][value=' + ar['sex'] + ']').prop('checked', true);
              $('#sibling [name="study[year][' + ar_num['study'] + ']"]').val(parseInt(ar['year']) + 543)
              age('study', ar_num['study'])
              $('#sibling [name="study[education][' + ar_num['study'] + ']"]').val(ar['education'])
              $('#sibling [name="study[study][' + ar_num['study'] + ']"]').val(ar['study'])
              $('#sibling [name="study[institution][' + ar_num['study'] + ']"][value=' + ar['institution'] + ']').prop('checked', true);
              $('#sibling [name="study[loan][' + ar_num['study'] + ']"][value=' + ar['loan'] + ']').prop('checked', true);
              $('#sibling [name="study[address][' + ar_num['study'] + ']"]').val(ar['address'])
              $('#sibling [name="study[rental][' + ar_num['study'] + ']"]').val(ar['rental'])
            })

            $('.working').html('');
            $.each(result[1], function(i, ar) {
              add('working');
              $('#sibling [name="working[relative][' + ar_num['working'] + ']"]').val(ar['relative'])
              $('#sibling [name="working[sex][' + ar_num['working'] + ']"][value=' + ar['sex'] + ']').prop('checked', true);
              $('#sibling [name="working[year][' + ar_num['working'] + ']"]').val(parseInt(ar['year']) + 543)
              age('working', ar_num['working'])
              $('#sibling [name="working[education][' + ar_num['working'] + ']"]').val(ar['education'])
              $('#sibling [name="working[status][' + ar_num['working'] + ']"][value=' + ar['status'] + ']').prop('checked', true);
              $('#sibling [name="working[child][' + ar_num['working'] + ']"]').val(ar['child'])
              $('#sibling [name="working[job][' + ar_num['working'] + ']"]').val(ar['job'])
              $('#sibling [name="working[income][' + ar_num['working'] + ']"]').val(ar['income'])
            })

          }
          $(function() {
            $('#sec2Id2').html(statusCard[1])
          });
        }
      }
    })
  }

  function job(p) {
    $('#family [name=' + p + 'job]').val() != 0 ? $('#family #' + p + 'job-specify-area').addClass('d-none') : $('#family #' + p + 'job-specify-area').removeClass('d-none');
    $('#family [name=' + p + 'job]').children(':selected').hasClass('group1') || $('#family [name=' + p + 'job]').val() == 0 ? $('#family #' + p + 'detail-area').removeClass('d-none') : $('#family #' + p + 'detail-area').addClass('d-none');
    $('#family [name=' + p + 'job]').children(':selected').hasClass('group2') ? $('#' + p + 'position-area').removeClass('d-none') : $('#' + p + 'position-area').addClass('d-none');
    $('#family [name=' + p + 'job]').children(':selected').hasClass('group4') ? $('#' + p + 'income-area').addClass('d-none') : $('#' + p + 'income-area').removeClass('d-none');
  }

  function child(type) {
    var pchild = parseInt($('#family [name=pchild]').val() || 0)
    var study = parseInt($('#family [name=pchild-study]').val() || 0)
    var working = parseInt($('#family [name=pchild-working]').val() || 0)
    var noworking = parseInt($('#family [name=pchild-noworking]').val() || 0)
    if (((study + working + noworking) > pchild) || ($('#family [name=pchild-study]').val() != '' && $('#family [name=pchild-working]').val() != '' && $('#family [name=pchild-noworking]').val() != '' && (study + working + noworking) < pchild)) {
      alert_modal('จำนวนบุตรของผู้อุปการะ ไม่ตรงตามจำนวน', 'orange', false)
      $('#family [name=pchild-' + type + ']').val('')
    }
  }

  function age(p, i = false) {
    if (i != false) {
      $('#sibling [name="' + p + '[age][' + i + ']"]').html($('#sibling [name="' + p + '[year][' + i + ']"]').val().length == 4 ? (543 + <?php echo date('Y'); ?> - $('#sibling [name="' + p + '[year][' + i + ']"]').val()) : '')
      if ($('#sibling [name="' + p + '[year][' + i + ']"]').val().length == 4 && ($('#sibling [name="' + p + '[age][' + i + ']"]').text() < 0 || $('#sibling [name="' + p + '[age][' + i + ']"]').text() > 120)) {
        alert_modal('อายุไม่ควรน้อยกว่า 0 ปี หรือมากกว่า 120 ปี', 'orange', true)
        $('#sibling [name="' + p + '[age][' + i + ']"]').html('')
        $('#sibling [name="' + p + '[year][' + i + ']"]').val('')
      }
    } else {
      $('#' + p + '-age').html($('#family [name=' + p + 'year]').val().length == 4 ? (543 + <?php echo date('Y'); ?> - $('#family [name=' + p + 'year]').val()) : '')
      if ($('#family [name=' + p + 'year]').val().length == 4 && ($('#' + p + '-age').text() < 15 || $('#' + p + '-age').text() > 120)) {
        alert_modal('อายุไม่ควรน้อยกว่า 15 ปี หรือมากกว่า 120 ปี', 'orange', true)
        $('#' + p + '-age').html('')
        $('#family [name=' + p + 'year]').val('')
      }
    }
  }

  function fn_status() {
    $('#family [name=fstatus]').removeClass('d-none')
    $('#family [name=mstatus]').removeClass('d-none')
    if ($('#family [name=fmstatus]').val() == 5) {
      $('#family [name=fstatus]').val('')
      $('#family [name=fstatus]').addClass('d-none')
      $('#father').addClass('d-none')
    } else if ($('#family [name=fmstatus]').val() == 6) {
      $('#family [name=mstatus]').val('')
      $('#family [name=mstatus]').addClass('d-none')
      $('#mother').addClass('d-none')
    } else if ($('#family [name=fmstatus]').val() == 7) {
      $('#family [name=fstatus]').val('')
      $('#family [name=mstatus]').val('')
      $('#father').addClass('d-none')
      $('#mother').addClass('d-none')
      $('#family [name=fstatus]').addClass('d-none')
      $('#family [name=mstatus]').addClass('d-none')
    }
  }

  function add(type) {
    ar_num[type]++;
    var text = '';
    text += '<tr class="' + type + ar_num[type] + '">';
    if (type == 'motocycle' || type == 'car') {
      text += '<td width="1"><button type="button" class="badge badge-light text-danger" onclick="$(\'.' + type + ar_num[type] + '\').remove();"><i class="fas fa-minus"></i></button></td>';
      text += '<td colspan="2">';
      text += '<div class="input-group">';
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">ยี่ห้อ</div>';
      text += '</div>';
      text += '<input name="' + type + '[band][' + ar_num[type] + ']" class="form-control form-control-sm" type="text" placeholder="ระบุ" maxlength="255">';
      text += '</div>';
      text += '</td>';
      text += '<td>';
      text += '<div class="input-group">';
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">รุ่น</div>';
      text += '</div>';
      text += '<input name="' + type + '[model][' + ar_num[type] + ']"  class="form-control form-control-sm" type="text" placeholder="ระบุ" maxlength="255">';
      text += '</div>';
      text += '</td>';

    } else if (type == 'loan') {
      text += '<td rowspan="2"><button type="button" class="badge badge-light text-danger" onclick="$(\'.' + type + ar_num[type] + '\').remove();"><i class="fas fa-minus"></i></button></td>';
      text += '<td><input name="loan[from][' + ar_num[type] + ']" class="form-control form-control-sm" type="text" placeholder="กู้จาก" maxlength="255"></td>';
      text += '<td><input name="loan[budget][' + ar_num[type] + ']" class="form-control form-control-sm text-right" type="text" min="0" maxlength="8" pattern="\\d*" placeholder="0" onkeyup="numberformat(this);"></td>';
      text += '<td><input name="loan[installment][' + ar_num[type] + ']" class="form-control form-control-sm text-right" type="text" min="0" maxlength="6" pattern="\\d*" placeholder="0" onkeyup="numberformat(this);"></td>';
      text += '</tr><tr class="' + type + ar_num[type] + '">';
      text += '<td colspan="3">';
      text += '<div class="input-group">';
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">สาเหตุการกู้</div>';
      text += '</div>';
      text += '<input name="loan[detail][' + ar_num[type] + ']" class="form-control form-control-sm" placeholder="สาเหตุการกู้" maxlength="255">';
      text += '</div>';
      text += '</td>';

    } else if (type == 'study') {
      text += '<td><button type="button" class="badge badge-light text-danger" onclick="$(\'.' + type + ar_num[type] + '\').remove(); check_sibling();"><i class="fas fa-minus"></i></button></td>';
      text += '<td>';
      text += '<select name="study[relative][' + ar_num[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
      text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
      <?php $group  = $relative[0]['selectdata_group'];
      foreach ($relative as $ar) {
        if ($group  != $ar['selectdata_group']) {
          $group  = $ar['selectdata_group']; ?>
          text += '<option disabled></option>';
        <?php } ?>
        text += '<option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>';
      <?php } ?>
      text += '</select><br/>'
      text += '<div class="form-inline">';
      text += '<div class="custom-control custom-radio">';
      text += '<input type="radio" id="study[sex][M][' + ar_num[type] + ']" name="study[sex][' + ar_num[type] + ']" value="M" class="relative_institution_' + ar_num[type] + ' custom-control-input" checked>';
      text += '<label class="custom-control-label" for="study[sex][M][' + ar_num[type] + ']">ชาย</label>';
      text += '</div>&nbsp;';
      text += '<div class="custom-control custom-radio">';
      text += '<input type="radio" id="study[sex][F][' + ar_num[type] + ']" name="study[sex][' + ar_num[type] + ']" value="F" class="relative_institution_' + ar_num[type] + ' custom-control-input">';
      text += '<label class="custom-control-label" for="study[sex][F][' + ar_num[type] + ']">หญิง</label>';
      text += '</div>';
      text += '</div>';
      text += '</td>';
      text += '<td>';
      text += '<input name="study[year][' + ar_num[type] + ']" class="form-control form-control-sm" type="text" pattern="\\d*" minlength="4" maxlength="4" placeholder="ปี พ.ศ.เกิด" onkeyup="age(\'study\', ' + ar_num[type] + '); numberformat(this);">';
      text += '<div class="input-group">';
      text += '<div name="study[age][' + ar_num[type] + ']" class="form-control form-control-sm"></div>';
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">ปี</div>';
      text += '</div>';
      text += '</div>';
      text += '</td>';
      text += '<td>';
      text += '<select name="study[education][' + ar_num[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
      text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
      <?php $group  = $education[0]['selectdata_group'];
      foreach ($education as $ar) {
        if ($group  != $ar['selectdata_group']) {
          $group  = $ar['selectdata_group']; ?>
          text += '<option disabled></option>';
        <?php } ?>
        text += '<option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>';
      <?php } ?>
      text += '</select><br/>';
      text += '<div class="input-group">';
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">ชั้นปี</div>';
      text += '</div>';
      text += '<input name="study[study][' + ar_num[type] + ']" class="form-control form-control-sm" type="text" min="1" maxlength="1" pattern="\\d*" onkeyup="numberformat(this);"></td>';
      text += '</div>';
      text += '</td>';
      text += '<td>';
      text += '<div class="custom-control custom-radio">';
      text += '<input type="radio" id="study[institution][0][' + ar_num[type] + ']" name="study[institution][' + ar_num[type] + ']" value="0" class="custom-control-input" checked>';
      text += '<label class="custom-control-label" for="study[institution][0][' + ar_num[type] + ']">รัฐบาล</label>';
      text += '</div>';
      text += '<div class="custom-control custom-radio">';
      text += '<input type="radio" id="study[institution][1][' + ar_num[type] + ']" name="study[institution][' + ar_num[type] + ']" value="1" class="custom-control-input">';
      text += '<label class="custom-control-label" for="study[institution][1][' + ar_num[type] + ']">เอกชน</label>';
      text += '</div>';
      text += '</td>';
      text += '<td>';
      text += '<div class="custom-control custom-radio">';
      text += '<input type="radio" id="study[loan][0][' + ar_num[type] + ']" name="study[loan][' + ar_num[type] + ']" value="0" class="custom-control-input" checked>';
      text += '<label class="custom-control-label" for="study[loan][0][' + ar_num[type] + ']">ไม่กู้</label>';
      text += '</div>';
      text += '<div class="custom-control custom-radio">';
      text += '<input type="radio" id="study[loan][1][' + ar_num[type] + ']" name="study[loan][' + ar_num[type] + ']" value="1" class="custom-control-input">';
      text += '<label class="custom-control-label" for="study[loan][1][' + ar_num[type] + ']">กู้</label>';
      text += '</div>';
      text += '</td>';
      text += '<td>';
      text += '<select name="study[address][' + ar_num[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
      text += '<option disabled value="" selected class="d-none">-เลือก-</option>'
      <?php $group  = $siblingAddr[0]['selectdata_group'];
      foreach ($siblingAddr as $ar) {
        if ($group  != $ar['selectdata_group']) {
          $group  = $ar['selectdata_group']; ?>
          text += '<option disabled></option>';
        <?php } ?>
        text += '<option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>';
      <?php } ?>
      text += '<option disabled></option>';
      text += '<option value="0">อื่นๆ</option>';
      text += '</select><br/>';
      text += '<div id="study-rental-area' + ar_num[type] + '" class="input-group">';
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">ค่าเช่า</div>';
      text += '</div>';
      text += '<input name="study[rental][' + ar_num[type] + ']" class="form-control form-control-sm text-right" type="text" min="0" maxlength="5" pattern="\\d*" placeholder="0" onkeyup="numberformat(this);">';
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">บาท/เดือน</div>';
      text += '</div>';
      text += '</div>';
      text += '</td>';

    } else if (type == 'working') {

      text += '<td><button type="button" class="badge badge-light text-danger" onclick="$(\'.' + type + ar_num[type] + '\').remove(); check_sibling();"><i class="fas fa-minus"></i></button></td>';
      text += '<td>';
      text += '<select name="working[relative][' + ar_num[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
      text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
      <?php $group  = $relative[0]['selectdata_group'];
      foreach ($relative as $ar) {
        if ($group  != $ar['selectdata_group']) {
          $group  = $ar['selectdata_group']; ?>
          text += '<option disabled></option>';
        <?php } ?>
        text += '<option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>';
      <?php } ?>
      text += '</select><br/>'
      text += '<div class="form-inline">';
      text += '<div class="custom-control custom-radio">';
      text += '<input type="radio" id="working[sex][M][' + ar_num[type] + ']" name="working[sex][' + ar_num[type] + ']" value="M" class="relative_institution_' + ar_num[type] + ' custom-control-input" checked>';
      text += '<label class="custom-control-label" for="working[sex][M][' + ar_num[type] + ']">ชาย</label>';
      text += '</div>&nbsp;';
      text += '<div class="custom-control custom-radio">';
      text += '<input type="radio" id="working[sex][F][' + ar_num[type] + ']" name="working[sex][' + ar_num[type] + ']" value="F" class="relative_institution_' + ar_num[type] + ' custom-control-input">';
      text += '<label class="custom-control-label" for="working[sex][F][' + ar_num[type] + ']">หญิง</label>';
      text += '</div>';
      text += '</div>';
      text += '</td>';
      text += '<td>';
      text += '<input name="working[year][' + ar_num[type] + ']" class="form-control form-control-sm" type="text" pattern="\\d*" minlength="4" maxlength="4" placeholder="ปี พ.ศ.เกิด" onkeyup="age(\'working\', ' + ar_num[type] + '); numberformat(this);">';
      text += '<div class="input-group">';
      text += '<div name="working[age][' + ar_num[type] + ']" class="form-control form-control-sm"></div>';
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">ปี</div>';
      text += '</div>';
      text += '</div>';
      text += '</td>';
      text += '<td>';
      text += '<select name="working[education][' + ar_num[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
      text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
      text += '<option value="0">ยังไม่ถึงวัยศึกษา/ไม่รับการศึกษา</option>';
      text += '<option disabled></option>';
      <?php $group  = $education[0]['selectdata_group'];
      foreach ($education as $ar) {
        if ($group  != $ar['selectdata_group']) {
          $group  = $ar['selectdata_group']; ?>
          text += '<option disabled></option>';
        <?php } ?>
        text += '<option value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>';
      <?php } ?>
      text += '</select>';
      text += '</td>';
      text += '<td>';
      text += '<div class="custom-control custom-radio">';
      text += '<input type="radio" id="working[status][0][' + ar_num[type] + ']" name="working[status][' + ar_num[type] + ']" value="0" class="custom-control-input" checked>';
      text += '<label class="custom-control-label" for="working[status][0][' + ar_num[type] + ']">โสด</label>';
      text += '</div>';
      text += '<div class="custom-control custom-radio">';
      text += '<input type="radio" id="working[status][1][' + ar_num[type] + ']" name="working[status][' + ar_num[type] + ']" value="1" class="custom-control-input">';
      text += '<label class="custom-control-label" for="working[status][1][' + ar_num[type] + ']">สมรส</label>';
      text += '</div>';
      text += '</td>';
      text += '<td><input name="working[child][' + ar_num[type] + ']" class="form-control form-control-sm" type="text" min="0" maxlength="2" pattern="\\d*" placeholder="จำนวน" onkeyup="numberformat(this);"></td>';
      text += '<td>';
      text += '<select name="working[job][' + ar_num[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
      text += '<option disabled value="" selected class="d-none">-เลือก-</option>'
      <?php $group  = $job[0]['selectdata_group'];
      foreach ($job as $ar) {
        if ($group  != $ar['selectdata_group']) {
          $group  = $ar['selectdata_group']; ?>
          text += '<option disabled></option>';
        <?php } ?>
        text += '<option class="<?php echo "group{$group}"; ?>" value="<?php echo $ar['selectdata_id']; ?>"><?php echo $ar['selectdata_title']; ?></option>';
      <?php } ?>
      text += '<option disabled></option>';
      text += '<option value="0">อื่นๆ</option>';
      text += '</select><br/>'
      text += '<div class="input-group">';
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">รายได้</div>';
      text += '</div>';
      text += '<input name="working[income][' + ar_num[type] + ']" class="form-control form-control-sm text-right" type="text" min="0" maxlength="5" pattern="\\d*" placeholder="0" onkeyup="numberformat(this);">';
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">บาท/เดือน</div>';
      text += '</div>';
      text += '</div>';
      text += '</td>';

    }
    text += '</tr>';
    $('.' + type).append(text);
  }

  function check_sibling() {
    if ($('#sibling [name="nosibling"]').val() != '0' || $('#sibling .study').text() != '' || $('#sibling .working').text() != '' || $('#sibling .relative').text() != '') {
      $('#sibling [name=nosibling]').removeClass('is-invalid')
    } else {
      $('#sibling [name=nosibling]').addClass('is-invalid')
    }
  }

  var num_finance = {
    'fund': 0,
    'scholarship': 0,
    'job': 0
  }
  finance()

  function finance() {
    $.ajax({
      method: 'POST',
      url: '<?php echo site_url('annual/get_finance/' . $student_id); ?>',
      data: {
        registration_id: <?php echo $registration['registration_id']; ?>
      },
      success: function(result) {
        result = JSON.parse(result)
        console.log(result)
        if (result) {
          $('#finance [name="income[1]"]').val(result[0]['income_parent']);
          $('#finance [name="income[2]"]').val(result[0]['income_loan']);
          $('#finance [name="income[3]"]').val(result[0]['income_job']);
          $('#finance [name="outcome[1]"]').val(result[0]['outcome_rest']);
          $('#finance [name="outcome[2]"]').val(result[0]['outcome_food']);
          $('#finance [name="outcome[3]"]').val(result[0]['outcome_equipment']);
          $('#finance [name="outcome[4]"]').val(result[0]['outcome_travel']);
          $('#finance [name="outcome[0]"]').val(result[0]['outcome_other']);
          $('#finance [name="outcome[specify]"]').val(result[0]['outcome_specify']);
          $('#finance [name="outcome[total]"]').val(result[0]['outcome_total']);

          $('.fund').html('');
          $.each(result[1], function(i, ar) {
            finance_add('fund');
            $('#finance [name="fund[year][' + num_finance['fund'] + ']"]').val(ar['year']);
            $('#finance [name="fund[term][' + num_finance['fund'] + ']"]').val(ar['term']);
          })

          $('.scholarship').html('');
          $.each(result[2], function(i, ar) {
            finance_add('scholarship');
            $('#finance [name="scholarship[start_year][' + num_finance['scholarship'] + ']"]').val(ar['start_year']);
            $('#finance [name="scholarship[stop_year][' + num_finance['scholarship'] + ']"]').val(ar['stop_year']);
            $('#finance [name="scholarship[name][' + num_finance['scholarship'] + ']"]').val(ar['name']);
            $('#finance [name="scholarship[income][' + num_finance['scholarship'] + ']"]').val(ar['income']);
          })

          $('.job').html('');
          $.each(result[3], function(i, ar) {
            finance_add('job');
            $('#finance [name="job[start_term][' + num_finance['job'] + ']"]').val(ar['start_term']);
            $('#finance [name="job[start_year][' + num_finance['job'] + ']"]').val(ar['start_year']);
            $('#finance [name="job[stop_term][' + num_finance['job'] + ']"]').val(ar['stop_term']);
            $('#finance [name="job[stop_year][' + num_finance['job'] + ']"]').val(ar['stop_year']);
            $('#finance [name="job[income][' + num_finance['job'] + ']"]').val(ar['income']);
            $('#finance [name="job[description][' + num_finance['job'] + ']"]').val(ar['description']);
          })
          $(function() {
            $('#sec3Id1').html(statusCard[1])
          });
        }
      }
    })
  }

  function finance_add(type) {
    num_finance[type]++;
    var text = '';
    text += '<tr class="' + type + num_finance[type] + '">';
    text += '<td width="1"><button type="button" class="badge badge-light text-danger" onclick="$(\'.' + type + num_finance[type] + '\').remove();"><i class="fas fa-minus"></i></button></td>';
    if (type == 'fund') {

      text += '<td>';
      text += '<select name="fund[year][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
      text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
      <?php for ($i = (date('Y') + 543); $i >= (substr($student_id, 0, 2) + 2500 + 1); $i--) { ?>
        text += '<option value="<?php echo ($i - 543); ?>"><?php echo $i; ?></option>';
      <?php } ?>
      text += '</select>'
      text += '</td>';
      text += '<td>';
      text += '<select name="fund[term][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
      text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
      <?php for ($i = 1; $i <= 3; $i++) { ?>
        text += '<option value="<?php echo $i; ?>"><?php echo $i; ?></option>';
      <?php } ?>
      text += '</select>'
      text += '</td>';

    } else if (type == 'scholarship') {

      text += '<td>';
      text += '<div class="input-group">';
      text += '<select name="scholarship[start_year][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
      text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
      <?php for ($i = (date('Y') + 543); $i >= (substr($student_id, 0, 2) + 2500); $i--) { ?>
        text += '<option value="<?php echo ($i - 543); ?>"><?php echo $i; ?></option>';
      <?php } ?>
      text += '</select>'
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">ถึง</div>';
      text += '</div>';
      text += '<select name="scholarship[stop_year][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
      text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
      <?php for ($i = (substr($student_id, 0, 2) + 2500 + 5); $i >= (substr($student_id, 0, 2) + 2500); $i--) { ?>
        text += '<option value="<?php echo ($i - 543); ?>"><?php echo $i; ?></option>';
      <?php } ?>
      text += '</select>'
      text += '</div>';
      text += '</td>';
      text += '<td><input name="scholarship[name][' + num_finance[type] + ']" class="form-control form-control-sm" type="text" placeholder="ชื่อทุน" maxlength="255"></td>';
      text += '<td><input name="scholarship[income][' + num_finance[type] + ']" class="form-control form-control-sm text-right" type="text" min="1" maxlength="6" pattern="\\d*" placeholder="0" onkeyup="numberformat(this);"></td>';

    } else if (type == 'job') {

      text += '<td>';
      text += '<div class="input-group">';
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">เทอม</div>';
      text += '</div>';
      text += '<select name="job[start_term][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
      text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
      <?php for ($i = 1; $i <= 3; $i++) { ?>
        text += '<option value="<?php echo $i; ?>"><?php echo $i; ?></option>';
      <?php } ?>
      text += '</select>'
      text += '</div>';
      text += '<div class="input-group">';
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">ปี</div>';
      text += '</div>';
      text += '<select name="job[start_year][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
      text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
      <?php for ($i = (date('Y') + 543); $i >= (date('Y') + 543 - 2); $i--) { ?>
        text += '<option value="<?php echo ($i - 543); ?>"><?php echo $i; ?></option>';
      <?php } ?>
      text += '</select>'
      text += '</div>';
      text += '</td>';
      text += '<td>';
      text += '<div class="input-group">';
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">เทอม</div>';
      text += '</div>';
      text += '<select name="job[stop_term][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
      text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
      <?php for ($i = 1; $i <= 3; $i++) { ?>
        text += '<option value="<?php echo $i; ?>"><?php echo $i; ?></option>';
      <?php } ?>
      text += '</select>'
      text += '</div>';
      text += '<div class="input-group">';
      text += '<div class="input-group-prepend">';
      text += '<div class="input-group-text form-control-sm">ปี</div>';
      text += '</div>';
      text += '<select name="job[stop_year][' + num_finance[type] + ']" class="custom-select custom-select-sm input-block overflow-auto nowrap">';
      text += '<option disabled value="" selected class="d-none">-เลือก-</option>';
      <?php for ($i = (date('Y') + 543); $i >= (date('Y') + 543 - 2); $i--) { ?>
        text += '<option value="<?php echo ($i - 543); ?>"><?php echo $i; ?></option>';
      <?php } ?>
      text += '</select>'
      text += '</div>';
      text += '</td>';
      text += '<td><input name="job[income][' + num_finance[type] + ']" class="form-control form-control-sm text-right" type="text" min="1" maxlength="6" pattern="\\d*" placeholder="0" onkeyup="numberformat(this);"></td>';
      text += '<td><input name="job[description][' + num_finance[type] + ']" class="form-control form-control-sm" type="text" placeholder="ลักษณะงาน" maxlength="255"></td>';

    }
    text += '</tr>';
    $('.' + type).append(text);
  }

  explain()

  function explain() {
    $.ajax({
      method: 'POST',
      url: '<?php echo site_url('annual/get_explain/' . $student_id); ?>',
      data: {
        registration_id: <?php echo $registration['registration_id']; ?>
      },
      success: function(result) {
        result = JSON.parse(result)
        console.log(result)
        if (result) {
          $('#explain [name="explain"]').val(result[0]['explain']);
          $(function() {
            $('#sec4Id1').html(statusCard[1])
          });
        }
      }
    })
  }
  certificate()

  function certificate() {
    $.ajax({
      method: 'POST',
      url: '<?php echo site_url('annual/get_certificate/' . $student_id); ?>',
      data: {
        registration_id: <?php echo $registration['registration_id']; ?>
      },
      success: function(result) {
        result = JSON.parse(result)
        console.log(result)
        var check = false;
        if (result[0].length > 0) {
          check = true;
          $.each(result[0], function(i, ar) {
            $('#certificate' + ar['certificate_id']).html(statusCard[ar['status'] != 2 ? (ar['status'] == 0 ? 0 : 1) : 2])
            check = check && ar['status'] != 0 ? true : false
          })
        }
        if (result[1].length > 0) {
          $('#googledrive').removeClass('text-danger')
          $('#googledrive').addClass('text-primary')
          $('#googledrive').prop('href', result[1][0]['googledrive'])
          $('#googledrive').html('ลิงก์เอกสารออนไลน์ผ่าน Google Drive')
        }
        $(function() {
          if (check) {
            $('#sec4Id2').html(statusCard[1])
          }
        });
      }
    })
  }
</script>