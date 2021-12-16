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
    <form id="family" class="card-body" action="javascript:void(0);" method="post" onsubmit="return submitFrom(this);">
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
              <?php if (!$family[0]['FNAME'] || !$family[0]['SNAME']) { ?>
                <small class="text-danger">(ไม่ต้องใส่คำนำหน้าชื่อ)</small>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text form-control-sm">ชื่อ</div>
                  </div>
                  <input name="ffname" class="form-control form-control-sm input-block">
                  <div class="input-group-prepend">
                    <div class="input-group-text form-control-sm">สกุล</div>
                  </div>
                  <input name="fsname" class="form-control form-control-sm input-block">
                </div>
              <?php } else { ?>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text form-control-sm">ชื่อ</div>
                  </div>
                  <input name="ffname" type="hidden" value="<?php echo $family[0]['FNAME']; ?>">
                  <input name="fsname" type="hidden" value="<?php echo $family[0]['SNAME']; ?>">
                  <div class="form-control form-control-sm input-block overflow-auto nowrap"><?php echo $family[0]['FULL_NAME']; ?></div>
                </div>
              <?php }
              if (!$family[0]['BIRTH_DATE']) { ?>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text form-control-sm">ปีเกิด</div>
                  </div>
                  <input name="fyear" class="form-control form-control-sm" type="text" pattern="\d*" minlength="4" maxlength="4" onkeyup="age('f');">
                  <div class="input-group-prepend">
                    <div class="input-group-text form-control-sm">อายุ</div>
                  </div>
                  <div id="f-age" class="form-control form-control-sm input-block"></div>
                  <div class="input-group-prepend">
                    <div class="input-group-text form-control-sm">ปี</div>
                  </div>
                </div>
              <?php } else { ?>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text form-control-sm">อายุ</div>
                  </div>
                  <input name="fyear" type="hidden" value="<?php echo substr($family[0]['BIRTH_DATE'], -4) + 543; ?>">
                  <div class="form-control form-control-sm input-block"><?php echo date('Y') - substr($family[0]['BIRTH_DATE'], -4); ?></div>
                  <div class="input-group-prepend">
                    <div class="input-group-text form-control-sm">ปี</div>
                  </div>
                </div>
              <?php } ?>
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
              <?php if (!$family[1]['FNAME'] || !$family[1]['SNAME']) { ?>
                <small class="text-danger">(ไม่ต้องใส่คำนำหน้าชื่อ)</small>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text form-control-sm">ชื่อ</div>
                  </div>
                  <input name="mfname" class="form-control form-control-sm input-block">
                  <div class="input-group-prepend">
                    <div class="input-group-text form-control-sm">สกุล</div>
                  </div>
                  <input name="msname" class="form-control form-control-sm input-block">
                </div>
              <?php } else { ?>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text form-control-sm">ชื่อ</div>
                  </div>
                  <input name="mfname" type="hidden" value="<?php echo $family[1]['FNAME']; ?>">
                  <input name="msname" type="hidden" value="<?php echo $family[1]['SNAME']; ?>">
                  <div class="form-control form-control-sm input-block overflow-auto nowrap"><?php echo $family[1]['FULL_NAME']; ?></div>
                </div>
              <?php }
              if (!$family[1]['BIRTH_DATE']) { ?>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text form-control-sm">ปีเกิด</div>
                  </div>
                  <input name="myear" class="form-control form-control-sm" type="text" pattern="\d*" minlength="4" maxlength="4" onkeyup="age('m');">
                  <div class="input-group-prepend">
                    <div class="input-group-text form-control-sm">อายุ</div>
                  </div>
                  <div id="m-age" class="form-control form-control-sm input-block"></div>
                  <div class="input-group-prepend">
                    <div class="input-group-text form-control-sm">ปี</div>
                  </div>
                </div>
              <?php } else { ?>
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
              <?php } ?>
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
              <div class="search-box">
                <input class="form-control form-control-sm" id="addrSearch" placeholder="กรอก ตำบล, อำเภอ, จังหวัด หรือ รหัสไปรษณีย์" autocomplete="off" />
                <div class="result"></div>
              </div>
              <input type="hidden" name="address-district_id" />
      </div>
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
  <button type="submit" class="btn btn-info btn-block">บันทึก</button>
  </form>
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
    <form id="sibling" class="card-body" action="javascript:void(0);" method="post" onsubmit="return submitFrom(this);">
      <div class="card-body">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="nosibling" value="0" onclick="
						if($(this).is(':checked')) {
							if(confirm('ไม่มีบุคคลในครอบครัว?')) {
								$('#sibling .study').html('');
								$('#sibling .working').html('');
								$('#sibling .relative').html('');
								$('#sibling [name=nosibling]').val(1);
							} else {
								$(this).prop('checked', false)
							}
						} else {
							$('#sibling [name=nosibling]').val(0);
						}
						check_sibling();
					">
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
        <button type="submit" class="btn btn-info btn-block">บันทึก</button>
      </div>
    </form>
  </div>
  <div class="m-0 p-0 pl-2 card-footer text-left btn btn-link" data-toggle="collapse" data-target="#sec2Col2" aria-expanded="false" aria-controls="sec2Col2" onclick="toggleCollapseIcon('#sec2Col2', '#sec2Icon2');"><i id="sec2Icon2" class="fas fa-chevron-down"></i></div>
</div>

<style type="text/css">
  .search-box {
    position: relative;
    width: 100%;
  }

  .result {
    top: 100%;
    left: 0;
    width: 100%;
    background-color: white;
    position: absolute;
    z-index: 999;
  }

  /* Formatting result items */
  .result p {
    margin: 0;
    padding: 7px 10px;
    border: 1px solid #CCCCCC;
    border-top: none;
    cursor: pointer;
  }

  .result p:hover {
    background: #f2f2f2;
  }
</style>
<script type="text/javascript">
  var afterClick = false;
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

  $(document).ready(function() {
    $('#addrSearch').on('keyup', function(e) {
      afterClick ? $('#addrSearch').val('') : '';
      $('#addrSearch').addClass('is-invalid')
      afterClick = false;
      $('[name="address-district_id"]').val('')
      var addr = $(this).val();
      var resultDropdown = $(this).siblings('.result');
      if (addr.length) {
        $.get('<?php echo site_url('scholarship/addrSearch'); ?>', {
          addr: addr,
        }).done(function(data) {
          // Display the returned data in browser
          resultDropdown.html(data);
        });
      } else {
        resultDropdown.empty();
      }
    });
    // Set search input value on click of result item
    $(document).on('click', '.result p', function() {
      afterClick = true;
      $('#addrSearch').removeClass('is-invalid')
      var str = $(this).text()
      var addr = $.trim(str.substring(0, str.lastIndexOf('('))).split(' >> ')
      $('#addrSearch').val('ตำบล' + addr[0] + ' อำเภอ' + addr[1] + ' จังหวัด' + addr[2] + (addr[3] != '-' ? ' ' + addr[3] : ''));
      $(this).parent('.result').empty();
      $('[name="address-district_id"]').val(str.substring(str.lastIndexOf('(') + 1, str.lastIndexOf(')')))
    })
  })

  function family() {
    $.ajax({
      method: 'POST',
      url: '<?php echo site_url('scholarship/get_family'); ?>',
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
          $('#family [name="address-district_id"]').val(result[0]['district_id'])
          afterClick = true;

          $('#family [name="fstatus"]').val(result[0]['fstatus']);
          result[0]['fstatus'] == 3 ? $('#father').addClass('d-none') : $('#father').removeClass('d-none');
          $('#family [name="mstatus"]').val(result[0]['mstatus']);
          result[0]['mstatus'] == 3 ? $('#mother').addClass('d-none') : $('#mother').removeClass('d-none');
          $('#family [name="pstatus"]').val(result[0]['pstatus']);
          result[0]['pstatus'] != 2 ? $('#patron').addClass('d-none') : $('#patron').removeClass('d-none');
          fn_status()

          parent = ['f', 'm', 'p', 'c']
          $.each(result[1], function(i, ar) {
            p = parent[ar['parent']];
            $('#family [name="' + p + 'fname"]').val(ar['fname']);
            $('#family [name="' + p + 'sname"]').val(ar['sname']);
            $('#family [name="' + p + 'year"]').val(+ar['year'] + 543);
            age(p)
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

          if (result[3].length) {
            $('#family [name=pchild]').val(0)
            $('#child').removeClass('d-none')
            $('#family [name=pchild]').val(+result[3][0]['study'] + +result[3][0]['working'] + +result[3][0]['noworking'])
            $('#family [name=pchild-study]').val(+result[3][0]['study'])
            $('#family [name=pchild-working]').val(+result[3][0]['working'])
            $('#family [name=pchild-noworking]').val(+result[3][0]['noworking'])
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
            checkall['family'] = true;
          });
        }
      }
    })
  }

  function sibling() {
    $.ajax({
      method: 'POST',
      url: '<?php echo site_url('scholarship/get_sibling'); ?>',
      data: {
        registration_id: <?php echo $registration['registration_id']; ?>
      },
      success: function(result) {
        result = JSON.parse(result)
        console.log(result)
        if (result) {
          if (result == 'nosibling') {
            $('#nosibling').prop('checked', true);
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
            check_sibling();
          }
          $(function() {
            $('#sec2Id2').html(statusCard[1])
            checkall['sibling'] = true;
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
    var pchild = +$('#family [name=pchild]').val()
    var study = +$('#family [name=pchild-study]').val()
    var working = +$('#family [name=pchild-working]').val()
    var noworking = +$('#family [name=pchild-noworking]').val()
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
      ageCal = $('#family [name=' + p + 'year]').val().length == 4 ? (543 + <?php echo date('Y'); ?> - $('#family [name=' + p + 'year]').val()) : ''
      $('#' + p + '-age').html(ageCal)
      if ($('#family [name=' + p + 'year]').val().length == 4 && (ageCal < 15 || ageCal > 120)) {
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
</script>