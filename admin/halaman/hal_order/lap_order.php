<?php

// session_start();

// error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";


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

  margin-right:500px;

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

</style>


<title>Sitem Informasi Perpustakaan</title>



  <div id="print">

    <table class='table1'>

    <tr>

        <!-- <td><img src='../../images/logo.png'></td> -->

        <td valign='middle'>

          <H3>Sistem Informasi Perpustakaan</H3>

                <H1> </H1>

          <h2>Pemerintah Provinsi Sulawesi Selatan</H2>

        </td>

    </tr>

        </table>

      <hr><strong>Sistem Informasi Perpustakaan</strong><hr>

            <?php

     // echo "<div class='title'>Makassar, $tanggal</div>";

      echo "<h3>LAPORAN BUKU</h3>";

      //echo "<h3>Periode ".tgl_indo($tglm)." - ".tgl_indo($tgls)."</h3>";

      echo "<table border='1'>

        <tr>

          <th align='center' width='5%'>NO</th>

          <th align='center' width='15%'>KODE BUKU</th>

          <th align='center' width='20%'>JUDUL</th>



        </tr>";


        $no=1;
        $tampil=mysqli_query($koneksi, "SELECT * FROM kategori");
    $no=1;
    while ($r=mysqli_fetch_array($tampil)){
          echo "<tr>

              <td align='center'>$no</td>

              <td align='center'>$r[nama_kategori]</td>

              <td>$r->kategori_seo</td>





             </tr>";
             $no++;

        }

      echo "</table>";

?>
