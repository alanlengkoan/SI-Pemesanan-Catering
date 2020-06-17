<div id="content">                   
    <div class="row-fluid">
        <!-- block --> 
            <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left"> Laporan Pemesanan Katering </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">  
   
                        <form class="form-horizontal" method="post" action="halaman/hal_laporan_bulanan/laporan_bulanan.php" target="_blank">
                          <fieldset>
                            <legend>Form Laporan Pemesanan Bulanan</legend>
                            <input type='hidden' name='id' value='<?=$id?>'> 
                             

                            <div class="control-group">
                              <label class="control-label" for="idkategori">Kategori </label>
                              <div class="controls">
                                <select id="select01"  name="bulan">
                                  <option value="">PILIH BULAN</option> 
                                            <option value='01'>Januari</option>
                                            <option value='02'>Februari</option>
                                            <option value='03'>Maret</option>
                                            <option value='04'>April</option>
                                            <option value='05'>Mei</option>
                                            <option value='06'>Juni</option>
                                            <option value='07'>Juli</option>
                                            <option value='08'>Agustus</option>
                                            <option value='09'>September</option>
                                            <option value='10'>Oktober</option>
                                            <option value='11'>November</option>
                                            <option value='12'>Desember</option>
                                 
                                </select>
                              </div>
                            </div>

                            <div class="control-group">
                              <label class="control-label" for="tglm">Dari Tanggal </label>
                              <div class="controls">
                                  <select id="select01" name="tahun">
                                  <option value="">PILIH TAHUN</option> 
                                  <?php
                                         for($ta=2015; $ta<=2030; $ta++) {
                                           echo"<option>$ta</option>";
        
}
                                  ?>
                                </select>
                              </div>
                            </div>

                           
 

                            <div class="control-group">
                              <label class="control-label" for="pass"> </label>
                              <div class="controls">
                                    <button type="submit" class="btn btn-primary"> Lihat Laporan </button>
                                    <button type="reset" class="btn btn-danger" onclick=self.history.back() >Batal</button> 
                              </div>
                            </div>                         
                          </fieldset>
                        </form> 
                </div>
            </div>
        </div> 
        <!-- /block -->
    </div>
</div>
