<div id="content">                   
    <div class="row-fluid">
        <!-- block --> 
            <div class="block">
            <div class="navbar navbar-inner block-header">
                <div class="muted pull-left"> Laporan Pemesanan Katering </div>
            </div>
            <div class="block-content collapse in">
                <div class="span12">  
   
                  <form class="form-horizontal" method="post" action="halaman/hal_laporan_harian/laporan_harian.php" target="_blank">
                          <fieldset>
                            <legend>Form Laporan Pemesanan Harian</legend>
                            <input type='hidden' name='id' value='<?=$id?>'> 
                             

                           <!--  <div class="control-group">
                              <label class="control-label" for="idkategori">Kategori </label>
                              <div class="controls">
                                <select id="select01" class="chzn-select" name="idkategori">
                                  <option value="">Semua Kategori</option> 
                                  <?php
                                        // $sq = "select * from kategori";
                                        // $kt = mysql_query($sq) or die(mysql_error());
                                        // while ($d = mysql_fetch_object($kt)) { 
                                        //     echo "<option value='$d->idkategori' >$d->kategori</option>";                                            
                                        // } 
                                  ?>
                                </select>
                              </div>
                            </div> -->

                            <div class="control-group">
                              <label class="control-label" for="tglm">Dari Tanggal </label>
                              <div class="controls">
                                    <input type="text" class="input-medium datepicker" name="tglm" id="tglm" required>
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
