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
                            <th>Jumlah Record <br>Stok Opname <br>ter-Verifikasi 1</th>
                            <th>Jumlah Record <br>Stok Opname <br>ter-Verifikasi 2</th>
                            <th>%</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $totjmlsublok=0;$totjmlsublokverifikasi=0;$totjmrekord=0;$totjmrekordverifikasi=0;$totjmrekordverifikasi2=0;
                            $no=1; $jmlpersenso=0; foreach ($datacekso->result_array() as $data) { 
                            $jmlsublok = $data['jmlsublok']==0 ? 1 : $data['jmlsublok'];
                            $persensublok = rupiah(($data['jmlsublokverifikasi']/$jmlsublok)*100,2);
                            $jmlrekord = $data['jmrekord']==0 ? 1 : $data['jmrekord'];
                            $persenrekord = rupiah(($data['jmrekordverifikasi2']/$jmlrekord)*100,2);
                            $ix=0;$iy=0;
                            if($persensublok <= 25){
                                $warnapersen = 'bg-danger';
                            }else if($persensublok > 25 && $persensublok < 100){
                                $warnapersen = 'bg-warning';
                            }else{
                                $warnapersen = 'bg-success';
                                $ix+=1;
                            }
                            if($persenrekord <= $data['persen_so']/2){
                                $warna = 'bg-danger';
                            }else if($persenrekord > $data['persen_so']/2 && $persenrekord < $data['persen_so']){
                                $warna = 'bg-warning';
                            }else{
                                $warna = 'bg-success';
                                $iy += 1;
                            }
                            $pesan = (($ix+$iy) >= 2) ? 'DONE' : 'In Progress';
                            $warnapesan = (($ix+$iy) >= 2) ? 'text-success' : 'text-black';
                            $totjmlsublok += $data['jmlsublok'];
                            $totjmlsublokverifikasi += $data['jmlsublokverifikasi'];
                            $totjmrekord += $data['jmrekord'];
                            $totjmrekordverifikasi += $data['jmrekordverifikasi'];
                            $jmlpersenso += $data['persen_so'];
                            $totjmrekordverifikasi2 += $data['jmrekordverifikasi2'];
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
                                <td  class="text-right"><?= rupiah($data['jmrekordverifikasi2'],0); ?></td>
                                <td class="text-center" style="line-height:10px;">
                                    <div class="progress">
                                        <div class="progress-bar <?= $warna; ?>" role="progressbar" style="width: <?= $persenrekord ?>%" aria-valuenow="<?= $persenrekord ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span style="font-size: 10px;"><?= $persenrekord ?>%</span>
                                </td>
                                <td class="text-center <?= $warnapesan; ?>"><?= $pesan; ?></td>
                            </tr>
                        <?php } ?>
                        <div>
                        <!-- Total Data  -->
                        <tr>
                            <td colspan="2" class="text-center font-tebal align-middle">TOTAL</td>
                            <td class="text-right"><?= rupiah($totjmlsublok,0); ?></td>
                            <td class="text-right"><?= rupiah($totjmlsublokverifikasi,0); ?></td>
                            <?php 
                                $ix=0;$iy=0;
                                $xtotjmlsublok = $totjmlsublok==0 ? 1 : $totjmlsublok;
                                $xmm = rupiah(($totjmlsublokverifikasi/$xtotjmlsublok)*100,2);
                                $xwarnapersen = '';
                                if($xmm < 25){
                                    $xwarnapersen = 'bg-danger';
                                }else if($xmm > 25 && $xmm < 100){
                                    $xwarnapersen = 'bg-warning';
                                }else{
                                    $xwarnapersen = 'bg-success';
                                    $ix+=1;
                                }
                            ?>
                            <td class="text-center" style="line-height:10px;">
                                <div class="progress">
                                    <div class="progress-bar <?= $xwarnapersen; ?>" role="progressbar" style="width: <?= rupiah(($totjmlsublokverifikasi/$xtotjmlsublok)*100,2); ?>%" aria-valuenow="<?= rupiah(($totjmlsublokverifikasi/$xtotjmlsublok)*100,2); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span style="font-size: 10px;"><?= rupiah(($totjmlsublokverifikasi/$xtotjmlsublok)*100,2); ?>%</span>
                            </td>
                            <td class="text-right"><?= rupiah($totjmrekord,0); ?></td>
                            <td class="text-right"><?= rupiah($totjmrekordverifikasi,0); ?></td>
                            <td class="text-right"><?= rupiah($totjmrekordverifikasi2,0); ?></td>
                            <?php 
                                $totalpersen = $jmlpersenso/$no;
                                $xtotjmlrek = $totjmrekord==0 ? 1 : $totjmrekord;
                                $xrr = rupiah(($totjmrekordverifikasi2/$xtotjmlrek)*100,2);
                                $xwarnapersena = '';
                                if($xrr < $totalpersen/2){
                                    $xwarnapersena = 'bg-danger';
                                }else if($xrr > $totalpersen/2 && $xrr < $totalpersen){
                                    $xwarnapersena = 'bg-warning';
                                }else{
                                    $xwarnapersena = 'bg-success';
                                    $iy+=1;
                                }
                                $pesan = (($ix+$iy) >= 2) ? 'DONE' : 'In Progress';
                                $warnapesan = (($ix+$iy) >= 2) ? 'text-success' : 'text-black';
                            ?>
                            <td class="text-center" style="line-height:10px;">
                                <div class="progress">
                                    <div class="progress-bar <?= $xwarnapersena; ?>" role="progressbar" style="width: <?= $xrr ?>%" aria-valuenow="<?= $xrr ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <span style="font-size: 10px;"><?= $xrr ?>%</span>
                            </td>
                            <td class="text-center font-tebal <?= $warnapesan; ?>"><?= $pesan; ?></td>
                        </tr>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->