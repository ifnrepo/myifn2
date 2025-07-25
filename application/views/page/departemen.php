<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h6 mb-0 text-gray-900">Departemen<span style="font-size: 10px !important; margin-left:5px; color: grey;"></span></h1>
        <a href="<?= $kembali; ?>" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm font-kecil text-white"><?= $kembalinama; ?></a>
    </div>
    <hr class="small">
    <div class="mt-2">
        <div class="table-responsive tabler">
            <table class="table table-bordered table-hover responsive nowrap datatableasli">
                <thead class="bg-info">
                    <th class="text-center align-middle">No</th>
                    <th class="text-center align-middle">Kode</th>
                    <th class="text-center align-middle">Departemen</th>
                    <th class="text-center align-middle">Dept INV</th>
                    <th class="text-center align-middle">Persen <br> Internal</th>
                    <th class="text-center align-middle">Persen <br> Verifikator</th>
                    <th class="text-center align-middle">Aksi</th>
                </thead>
                <tbody>
                    <?php $no=0; foreach ($dep->result_array() as $dept) { $no++; $ceklis = $dept['inv']==0 ? 'fa-times text-danger' : 'fa-check text-success'; ?>
                        <tr>
                            <td class="text-center"><?= $no; ?></td>
                            <td class="text-center" style="font-weight: 600"><?= $dept['dept_id']; ?></td>
                            <td><?= $dept['departemen']; ?></td>
                            <td class="text-center"><i class="fa <?= $ceklis ?>"></i></td>
                            <td class="text-right text-blue"><?= rupiah($dept['persen_verif'],2); ?></td>
                            <td class="text-right text-blue"><?= rupiah($dept['persen_so'],2); ?></td>
                            <td class="text-center">
                                <a href="<?= base_url().'departemen/editdepartemen/'.$dept['dept_id'] ?>" class="btn btn-sm btn-info shadow-sm font-kecil" id="editdepartemen" data-toggle="modal" data-target="#modalBox-lg" data-title="Edit Persentase SO Departemen"><i class="fa fa-edit text-black font-kecil-xs"></i> Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->