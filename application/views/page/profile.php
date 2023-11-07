<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h6 mb-0 text-gray-900">Profile<span style="font-size: 10px !important; margin-left:5px; color: grey;">Pengguna Aplikasi</span></h1>
        <a href="<?= $kembali; ?>" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm font-kecil text-white"><?= $kembalinama; ?></a>
    </div>
    <hr class="small">
    <div class="mt-2">
        <div class="row">
            <div class="col-sm-5 col-12">
                <div class="profile-img font-kecil py-4" style="text-align:center !important;">
                    <?php $gb = $person['jenkel'] == 'P' ? 'undraw_profile_3.svg' : 'undraw_profile.svg'; ?>
                    <img class="img-circle" src="<?= base_url() . 'assets/images/' . $gb ?>" style="width:150px; height:auto;">
                    <div class="text-black font-kecil mt-2"><?= $person['nama_user']; ?></div>
                </div>
            </div>
            <?php $disbl = $this->session->userdata('leveluser') != 4 ? '' : 'disabled'; ?>
            <div class="col-sm-7 col-12">
                <span class="text-black font-kecil">Identitas</span>
                <hr class="small">
                <input type="text" class="hilang" id="idprofil" value="<?= $person['id'] ?>">
                <div class="row font-kecil text-black">
                    <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">No Induk</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control input-sm input-form text-gray-800" name="noinduk" id="noinduk" value="<?= $person['noinduk'] ?>">
                    </div>
                </div>
                <div class="row font-kecil text-black">
                    <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Nama</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control input-sm input-form text-gray-800" name="nama" id="nama" value="<?= $person['nama_user'] ?>">
                    </div>
                </div>
                <div class="row font-kecil text-black">
                    <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Bagian</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control input-sm input-form text-gray-800" name="bagian" id="bagian" value="<?= $person['bagian'] ?>">
                    </div>
                </div>
                <div class="row font-kecil text-black">
                    <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Jabatan</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control input-sm input-form text-gray-800" name="jabatan" id="jabatan" value="<?= $person['jabatan'] ?>">
                    </div>
                </div>
                <div class="row font-kecil text-black">
                    <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Level user</label>
                    <div class="col-md-8">
                        <!-- <input type="text" class="form-control input-sm input-form text-gray-800" name="level" id="level"> -->
                        <select class="form-control input-sm input-form" name="levelid" id="levelid" >
                            <option value="0" <?php if ($person['level'] == 0) {
                                                    echo "selected";
                                                } ?>>No Level</option>
                            <option value="1" <?php if ($person['level'] == 1) {
                                                    echo "selected";
                                                } ?>>User Maker</option>
                            <option value="2" <?php if ($person['level'] == 2) {
                                                    echo "selected";
                                                } ?>>User Validator</option>
                            <option value="3" <?php if ($person['level'] == 3) {
                                                    echo "selected";
                                                } ?>>Super User</option>
                            <option value="4" <?php if ($person['level'] == 4) {
                                                    echo "selected";
                                                } ?>>Administrator</option>
                        </select>
                    </div>
                </div>
                <div class="row font-kecil text-black">
                    <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Kelamin</label>
                    <div class="col-md-8">
                        <!-- <input type="text" class="form-control input-sm input-form text-gray-800" name="level" id="level"> -->
                        <select class="form-control input-sm input-form" name="jenkel" id="jenkel">
                            <option value="" <?php if ($person['jenkel'] == null) {
                                                    echo "selected";
                                                } ?>>Pilih</option>
                            <option value="L" <?php if ($person['jenkel'] == 'L') {
                                                    echo "selected";
                                                } ?>>Laki - Laki</option>
                            <option value="P" <?php if ($person['jenkel'] == 'P') {
                                                    echo "selected";
                                                } ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row font-kecil text-black">
                    <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Login</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control input-sm input-form text-gray-800" name="login" id="login" value="<?= $person['login'] ?>">
                    </div>
                </div>
                <div class="row font-kecil text-black">
                    <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Password</label>
                    <div class="col-md-8 input-group">
                        <input type="password" class="form-control input-sm input-form text-gray-800" name="password" id="password" value="<?= decrypto($person['password']) ?>">
                        <div class="input-group-append">
                            <a class="btn btn-success input-sm form-control" id="cekpass"><i class="fas fa-eye"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row font-kecil text-black">
                    <label class="col-md-4" style="text-align: left;margin-top:5px;" for="inputDefault">Akses Dept</label>
                    <div class="col-md-8">
                        <div style="border-color: 1px solid green;min-height: 120px;" class="mt-1">
                            <?php $no = 1;
                            foreach ($dep->result_array() as $dept) {
                                $ke = 'cek' . $no++; ?>
                                <?php if ($mode == 'ubah') { ?>
                                    <input type="checkbox" class="input-sm mt-1" rel="<?= $dept['dept_id'] ?>" id="<?= $ke ?>" <?= cekceked($dept['dept_id'] . ',', $person['person_id']) ?>> <?= $dept['departemen'] ?> <br>
                                <?php } else { ?>
                                    <input type="checkbox" class="input-sm mt-1" rel="<?= $dept['dept_id'] ?>" id="<?= $ke ?>"> <?= $dept['departemen'] ?><br>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <hr class="small">
                <div class="tombolform mt-2 mb-2" style="text-align: center;">
                    <a href="#" class="btn btn-sm btn-success input-form <?php if ($mode == 'simpan') {
                                                                                echo 'hilang';
                                                                            } ?>" id="updateprofile">Update</a>
                    <a href="#" class="btn btn-sm btn-success input-form <?php if ($mode == 'ubah') {
                                                                                echo 'hilang';
                                                                            } ?>" id="simpanprofile">Simpan</a>
                    <a href="<?= $kembali ?>" id="kembaliprofil" class="btn btn-sm btn-danger input-form"><?= $kembalinama; ?></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->