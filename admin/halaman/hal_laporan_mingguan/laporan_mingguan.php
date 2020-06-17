<?php


include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/fungsi_indotgl.php";



date_default_timezone_set("Asia/Makassar");

?>

<script type="text/javascript">

window.print()

</script>

<style type="text/css">

#print {

  margin:auto;
  border:1px solid #2A9FAA;
  text-align:center;
  font-family:"Courier New", Courier, monospace;
  width:900px;
  font-size:14px;
}

#print .title {

  margin:auto;
  text-align:right;
  font-family:"Courier New", Courier, monospace;
  font-size:12px;

}

#print span {

  text-align:center;
  font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
  font-size:18px;

}

#print table {

  border-collapse:collapse;
  width:95%;
  margin:20px;

}

#print .table1 {

  border-collapse:collapse;
  width:100%;
  text-align:center;

}

#print .table2 {

  margin:20px;
  border-collapse:collapse;
  width:auto;

}

#print table hr {

  border:1px dashed #A0A0A4;

}

#print .ttd {

  margin-left: 550px;

}

#print table th {

  background:#A0A0A4;
  color:#000;
  font-family:Verdana, Geneva, sans-serif;
  font-size:10px;
  font:normal;
  text-transform:uppercase;
  height:30px;

}

#print table tr {

  font-family:Verdana, Geneva, sans-serif;
  font-size:10px

}


#print .grand {

  width:700px;
  padding:10px;
  text-align:left;

}

#print .grand table {

  margin-left:-90px;

}

#logo{

  width:111px;
  height:90px;
  padding-top:10px;
  margin-left:10px;

}

.admin {
  font-weight: bold;
  margin-left: 550px;
}

.nama {
  text-decoration: underline;
  margin-left: 555px;
}

</style>


<title>Sitem Informasi Catering Sahabat</title>

<?php

  $tanggal = tgl_indo(date("Y-m-d"));
  $tglm = $_POST['tglm'];
  $tgls = $_POST['tgls'];
  // $id = isset($_POST['idkategori']) ? $_POST['idkategori'] : '';

?>

  <div id="print">

    <table class='table1'>

    <tr>

        <td valign='middle'>



                <H1> </H1>

          <h2>RESTORSN SAHABAT</H2>

        </td>

    </tr>

        </table>

      <hr><strong>Data Pesanan Katering</strong><hr>

            <?php

      echo "<div class='title'>Tolitoli, $tanggal</div>";

      echo "<h3>LAPORAN PESANAN MINGGUAN</h3>";

      echo "<h3>Periode ".tgl_indo($tglm)."</h3>";

      echo "<table border='1'>

        <tr>

          <th width='5%'>NO</th>

          <th width='10%'>ID ORDER</th>

          <th width='20%'>NAMA KUSTOMER</th>

          <th width='10%'>ALAMAT</th>

          <th width='20%'>TLPN</th>

          <th width='20%'>EMAIL</th>

          <th width='15%'>STATUS ORDER</th>

          <th width='15%'>TGL ORDER</th>

          <th width='15%'>JAM ORDER</th>

        </tr>";



        $no=1;

        $sql="SELECT * from orders WHERE tgl_order>='$_POST[tglm]' AND tgl_order<='$_POST[tgls]'";
        $hasil=mysqli_query($koneksi, $sql) or die(mysqli_error().$sql);
        while($s=mysqli_fetch_object($hasil)){

          echo "<tr>

              <td align='center'>$no</td>

              <td align='center'>$s->id_orders</td>

                  <td align='center'>$s->nama_kustomer</td>

                  <td align='center'>$s->alamat</td>

                  <td align='center'>$s->telpon</td>

                  <td align='center'>$s->email</td>

                  <td align='center'>$s->status_order</td>

                  <td align='center'>$s->tgl_order</td>

                  <td align='center'>$s->jam_order</td>

             </tr>";
             $no++;

        }

      echo "</table>";

?>

<p class="ttd">Yang bertanda tangan dibawah ini :</p>
<p class="admin">Administrator</p>
<br>
<br>
<br>
<p class="nama">Administrator</p>
