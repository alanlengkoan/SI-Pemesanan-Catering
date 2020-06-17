<!-- main content -->
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
			<div class="w-box" id="n_regular_elements">
				<!-- <div class="w-box-header">
					<h4>Form controls</h4>
				</div> -->
				<div class="w-box-content cnt_a">
					<form class="form-horizontal" method="post" action="?page=lservice">
						<fieldset>
							<legend>Laporan Service Kendaraan</legend>							 

							<div class="control-group">
								<label class="control-label" for="tanggal">Tanggal Mulai</label>
								<div class="controls">  
									<div class="input-append date" id="dpStart" data-date="" data-date-format="yyyy-mm-dd">
										<input class="span10" size="16" type="text" name="tglm">
										<span class="add-on"><i class="icon-calendar"></i></span>
									</div> 
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="tanggal">Tanggal Selesai</label>
								<div class="controls">  
									<div class="input-append date" id="dpEnd" data-date="" data-date-format="yyyy-mm-dd">
										<input class="span10" size="16" type="text" name="tgls">
										<span class="add-on"><i class="icon-calendar"></i></span>
									</div> 
								</div>
							</div> 

							<div class="control-group">
								<label class="control-label" for="ket"></label>
								<div class="controls">
									<button type="submit" class="btn" name="simpan">Lihat Data</button>
								</div>
							</div> 
						</fieldset>
					</form> 
				</div>
			</div>
		</div>
	</div>
</div>
<div class="footer_space"></div> 
