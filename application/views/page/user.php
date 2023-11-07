<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h6 mb-0 text-gray-900">User Manajemen<span style="font-size: 10px !important; margin-left:5px; color: grey;">Pengguna</span></h1>
        <a href="<?= base_url() . 'user/adduser'; ?>" class="d-sm-inline-block btn btn-sm btn-danger shadow-sm font-kecil text-white"><i class="fas fa-file-alt fa-sm"></i> Add User</a>
    </div>
    <hr class="small">
    <div class="mt-2">
        <div class="table-responsive tabler">
            <table class="table table-bordered table-striped table-hover responsive nowrap datatableasli">
                <thead class="bg-info">
                    <th>Nama</th>
                    <th>Bagian</th>
                    <th>Jabatan</th>
                    <th>Level</th>
                    <th>Ket</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    <?php foreach ($profil->result_array() as $user) {
                        $lvl = '';
                        switch ($user['level']) {
                            case 1:
                                $lvl = 'User Maker';
                                break;
                            case 2:
                                $lvl = 'User Validator';
                                break;
                            case 3:
                                $lvl = 'Super User';
                                break;
                            case 4:
                                $lvl = 'Administrator';
                                break;
                            default:
                                $lvl = 'No Level';
                        }
                    ?>
                        <tr class="tabel-bodi">
                            <td style="vertical-align: middle !important;" class="headerdatabawah">
                                <div class="headerdata"><?= $user['noinduk'] . ' # ' . $user['person_id'] ?></div>
                                <?= $user['nama_user'] ?>
                            </td>
                            <td><?= $user['bagian']; ?></td>
                            <td><?= $user['jabatan']; ?></td>
                            <td><?= $lvl; ?></td>
                            <td></td>
                            <td style="text-align: center;">
                                <a href="<?= base_url() . 'User/viewuser/' . $user['person_id'] ?>" class="btn-circle btn-sm btn-success tombol-di-grid-bulat text-gray-900 shadow-sm" title="View" id="viewuser" data-target="#modalBox-lg" data-remote="false" data-toggle="modal" data-title="View Data"><i class="fa fa-eye"></i></a>
                                <a href="<?= base_url() . 'User/Edituser/' . $user['id'] ?>" class="btn-circle btn-sm btn-info tombol-di-grid-bulat text-gray-900 shadow-sm" title="Edit" id="edituser" rel="<?= $user['id'] ?>"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn-circle btn-sm btn-danger tombol-di-grid-bulat text-gray-900 shadow-sm" data-href="<?= base_url() . 'user/hapus/' . $user['id'] ?>" data-news="Yakin anda akan menghapus data ini ?" data-target="#confirm-task" data-remote="false" data-toggle="modal" data-title="Hapus"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->