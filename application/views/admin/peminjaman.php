<div class="page-header">
	<h3>Data Transaksi</h3>
</div>
<a href="<?php echo base_url().'admin/tambah_peminjaman';?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span>Transaksi Baru</a>
<br/><br/>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover" id="table-datatble">
		<thead>
			<tr>
				<th>No</th>
				<th>Anggota</th>
				<th>Buku</th>
				<th>Tgl. Pinjam</th>
				<th>Tgl. Kembali</th>
				<th>Denda/Hari</th>
				<th>Tgl. Dikembalikan</th>
				<th>Total Denda</th>
				<th>Status Buku</th>
				<th>Status Pinjam</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$no =1;
				foreach($peminjaman as $p){
			?>
			<tr>
				<td><?php echo $no++;?></td>
				<td><?php echo $p->id_anggota;?></td>
				<td><?php echo $p->id_buku;?></td>
				<td><?php echo date ('d/m/Y',strtotime($p->tgl_pinjam));?></td>
				<td><?php echo date ('d/m/Y',strtotime($p->tgl_kembali));?></td>
				<td><?php echo "Rp. ".number_format($p->denda);?></td>
				<td>
					<?php
					if ($p->tgl_pengembalian=="0000-00-00"){
						echo "-";	
					}else{
						echo date('d/m/Y',strtotime($p->tgl_pengembalian));
					}
					?>
				</td>
				<td><?php echo "Rp. ". number_format($p->total_denda).",-"; ?></td>
				<td>
					<?php
					if ($p->status_buku =="1"){
						echo "selesai";
					}else if($p->status_buku =="0"){
						echo "-";
					}
					?>
				</td>
				<td>
					<?php
					if($p->status_peminjaman =="1"){
						echo "-";
					}else{
					?>
					<a class="btn btn-sm btn-success" href="<?php echo base_url().'admin/transaksi_selesai/'.$p->id_pinjam; ?>"><span class="glyphicon glyphicon-ok"></span>Transaksi Selesai</a>
					<br/>
					<a class="btn btn-sm btn-danger " href="<?php echo base_url().'admin/hapus_peminjaman/'.$p->id_pinjam; ?>"><span class="glyphicon glyphicon-remove"></span>Batalkan Transaksi</a>
				<?php } ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>