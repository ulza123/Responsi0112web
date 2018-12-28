<div class="container">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div> 
<?php if($this->session->flashdata('flash')): ?>
<!-- <div class="row mt-3">
<div class="col-md-6">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    Data Company<strong> berhasil</strong> <?= $this->session->flashdata('flash'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>

</div>

</div> -->
<?php endif; ?>

	<div class="row mt-4">
		<div class="col-md-3">
			<a href="<?=base_url(); ?>company/tambah" class="btn btn-success">Tambah Data</a>
		</div>
	</div>

	<div class="row mt-2">
		<div class="col-md-12">
			<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Company Name</th>
 
    </tr>
  </thead>
  <tbody>
  	<?php $i=1; ?>
  	<?php foreach($company as $cp) : ?>
    <tr>
      <th><?= $i; ?></th> 
      <td><?= $cp['name']; ?></td>


      <td>
      	<a href="<?= base_url(); ?>company/edit/<?= $cp['idcompany']; ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
      	<a href="<?= base_url(); ?>company/hapus/<?= $cp['idcompany']; ?>" class="btn btn-danger tombol-hapus"><i class="far fa-trash-alt"></i></a>
      </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
  </tbody>
</table>
		</div>
	</div>
</div>