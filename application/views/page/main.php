<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h1 class="h5 mb-0 text-gray-900">Apps Menu</h1>
    </div>
    <div class="font-kecil text-black">
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-150 flat item-menu">
                    <div class="card-body">
                        <a href="<?= base_url() . 'opname' ?>">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs text-success mb-1">
                                        Modul</div>
                                    <div class="h6 mb-0 text-black">Stok Opname</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-wave-square fa-2x text-gray-400"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6>Monitoring Stok Opname </h6>
                <table class="table table-bordered table-hover" style="font-size: 12px !important;">
                    <thead>
                        <tr class="bg-warning text-center" style="color: black;line-height:12px;font-weight: normal !important;">
                            <th class="text-center">No</th>
                            <th class="text-center">Departemen</th>
                            <th>Jml <br> Sublok</th>
                            <th>Jml Sublok <br>ter-Verifikasi</th>
                            <th>%</th>
                            <th>Jumlah Record <br> Stok Opname</th>
                            <th>Jumlah Record <br>Stok Opname <br>ter-Verifikasi</th>
                            <th>%</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no=1; foreach ($datacekso->result_array() as $data) { 
                            $jmlsublok = $data['jmlsublok']==0 ? 1 : $data['jmlsublok'];
                            $persensublok = rupiah(($data['jmlsublokverifikasi']/$jmlsublok)*100,2);
                            $jmlrekord = $data['jmrekord']==0 ? 1 : $data['jmrekord'];
                            $persenrekord = rupiah(($data['jmrekordverifikasi']/$jmlrekord)*100,2);
                            $ix=0;$iy=0;
                            if($persensublok <= 25){
                                $warnapersen = 'bg-danger';
                            }else if($persensublok > 25 && $persensublok < 100){
                                $warnapersen = 'bg-warning';
                            }else{
                                $warnapersen = 'bg-success';
                                $ix+=1;
                            }
                            if($persenrekord <= 10){
                                $warna = 'bg-danger';
                            }else if($persenrekord > 10 && $persenrekord < 30){
                                $warna = 'bg-warning';
                                $iy += 1;
                            }else{
                                $warna = 'bg-success';
                                $iy += 1;
                            }
                            $pesan = (($ix+$iy) >= 2) ? 'DONE' : 'In Progress';
                            $warnapesan = (($ix+$iy) >= 2) ? 'text-success' : 'text-black';
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $data['departemen']; ?></td>
                                <td class="text-right"><?= rupiah($data['jmlsublok'],0); ?></td>
                                <td  class="text-right"><?= rupiah($data['jmlsublokverifikasi'],0); ?></td>
                                <td class="text-center" style="line-height:10px;">
                                    <div class="progress">
                                        <div class="progress-bar <?= $warnapersen; ?>" role="progressbar" style="width: <?= $persensublok ?>%" aria-valuenow="<?= $persensublok ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span style="font-size: 10px;"><?= $persensublok ?>%</span>
                                </td>
                                <td  class="text-right"><?= rupiah($data['jmrekord'],0); ?></td>
                                <td  class="text-right"><?= rupiah($data['jmrekordverifikasi'],0); ?></td>
                                <td class="text-center" style="line-height:10px;">
                                    <div class="progress">
                                        <div class="progress-bar <?= $warna; ?>" role="progressbar" style="width: <?= $persenrekord ?>%" aria-valuenow="<?= $persenrekord ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span style="font-size: 10px;"><?= $persenrekord ?>%</span>
                                </td>
                                <td class="text-center <?= $warnapesan; ?>"><?= $pesan; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->