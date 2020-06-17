<div class="container">
    <ul id="breadcrumbs">
        <li><a href="javascript:void(0)"><i class="icon-home"></i></a></li>
        <li><a href="javascript:void(0)">Home</a></li>
        <li><a href="javascript:void(0)">Laporan Service Kendaraan</a></li>
    </ul>
</div>
<div class="container">
                <div class="row-fluid">
                    <div class="span12">

                        <div class="w-box w-box-green">
                            <div class="w-box-header">
                                <h4>Lapoan Daftar Service Kendaraan</h4>
                            </div>
                            <div class="w-box-content">
                                <table id="dt_table_tools" class="table table-striped table-condensed">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Service</th>
                                        <th>Nomor Polisi</th>
                                        <th>Tanggal Service</th>
                                        <th>Service Berikutnya</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // untuk koneksi
                                    include_once '../../../config/koneksi.php';

                                        //$sql=mysql_query("SELECT a.*,b.nama_jenis from service as a left join jenis as b on a.jenis_inventaris=b.id_jenis where tanggal1>='$_POST[tglm]' AND tanggal1<='$_POST[tgls]'");
                                        $sql=mysqli_query($koneksi, "SELECT * from skendaraan");
                                        $no=1;
                                        while ($qr=mysqli_fetch_array($sql)) {
                                            $tot=$qr['jumlah']*$qr['harga'];
                                    ?>
                                    <tr>
                                         <td><?=$no++;?></td>
                                        <td><?=$qr['service'];?></td>
                                        <td><?=$qr['kode_kendaraan'];?></td>
                                        <td><?=$qr['tanggal1'];?></td>
                                        <td><?=$qr['tanggal2'];?></td>
                                        <td><?=$qr['harga'];?></td>
                                        <td><?=$qr['jumlah'];?></td>
                                        <td><?=$tot;?></td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
function del() {
    if (confirm("Yakin Hapus Data ?")){
        return true;
    }else{
        return false;
    }
}
</script>
