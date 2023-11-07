<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h6 mb-0 text-gray-900">Data Sublok</h1>
        <a href="<?= base_url() . 'opname'; ?>" class="d-sm-inline-block btn btn-sm btn-success shadow-sm font-kecil text-gray-900"><i class="fas fa-arrow-left fa-sm"></i> Kembali</a>
    </div>
    <hr class="small">
    <div class="font-kecil text-black">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-12">
                <div class="form-horizontal">
                    <form method="POST" action="" name="formsublok" id="formsublok">
                        <div class="row font-kecil text-black">
                            <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Nama Sublok </label>
                            <div class="col-md-8">
                                <select class="form-control input-sm input-form text-gray-800 text-black" id="deptsublok" name="deptsublok" disabled>
                                    <option value="">--Pilih Departemen--</option>
                                    <?php foreach ($departemen as $dept) : ?>
                                        <option value="<?= $dept['dept_id'] ?>"><?= $dept['departemen']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="text" class="hilang" id="deptt" name="deptt">
                            </div>
                        </div>
                        <div class="row font-kecil text-black">
                            <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Kode Sublok </label>
                            <div class="col-md-8">
                                <input type="text" class="hilang" id="idsublok" name="idsublok">
                                <input type="text" class="form-control input-sm input-form text-gray-800 text-black" name="kdsublok" id="kdsublok" readonly>
                            </div>
                        </div>
                        <div class="row font-kecil text-black">
                            <label class="col-md-4 col-6 col-sm-6" style="text-align: left;margin-top:5px;" for="inputDefault">Nama Sublok </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control input-sm input-form text-gray-800 text-black" name="nmsublok" id="nmsublok" style="text-transform: uppercase;">
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="small">
                <div class="tombolformstok" style="text-align: center;">
                    <div class="row">
                        <div class="col-sm-6 col-6">
                            <a href="#">
                                <div class="bg-success text-black py-2 shadow-sm" style="height:35px;border-radius:3px;" id="tambahdatasublok">
                                    Tambah
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-6">
                            <a href="#">
                                <div class="bg-danger text-black py-2 shadow-sm" style="height:35px;border-radius:3px;" id="resetdatasublok">
                                    Batal
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-12">
                <div class="table-responsive tabler">
                    <table class="table table-bordered table-striped table-hover responsive nowrap datatableasli">
                        <thead class="bg-info">
                            <th>Departemen</th>
                            <th>Kode</th>
                            <th>Sublok</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php foreach ($datasublok->result_array() as $sublok) : ?>
                                <tr>
                                    <td><?= $sublok['departemen']; ?></td>
                                    <td><?= $sublok['kode']; ?></td>
                                    <td><?= $sublok['sublok']; ?></td>
                                    <td style="text-align: center;">
                                        <a href="#" class="btn-circle btn-sm btn-info tombol-di-grid-bulat text-gray-900 shadow-sm" title="Edit" id="editdatasublok" rel="<?= $sublok['id'] ?>"><i class="fa fa-edit"></i></a>
                                        <?php if($this->session->userdata('leveluser') >= 3): ?>
                                            <a href="#" class="btn-circle btn-sm btn-danger tombol-di-grid-bulat text-gray-900 shadow-sm" data-href="<?= base_url() . 'sublok/hapussublok/' . $sublok['id']  ?>" data-news="Yakin anda akan menghapus data ini ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Hapus"><i class="fa fa-times"></i></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->