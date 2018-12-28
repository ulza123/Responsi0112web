<?php if(isset($ok)):?><div class="alert alert-info"><?php echo $ok?></div><?php endif;?>
<?php if(isset($error)):?><div class="alert alert-danger"><?php echo $error?></div><?php endif;?>
<div class="container">
<div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div> 
<?php if($this->session->flashdata('flash')): ?>
<!-- <div class="row mt-3">
<div class="col-md-6">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    Data Mahasiswa<strong> berhasil</strong> <?= $this->session->flashdata('flash'); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>

</div>

</div> -->
<?php endif; ?>
<div class="row mt-4">

</div>

	<div class="row mt-4">
		<div class="col-md-3">
			<a href="<?=base_url(); ?>members/tambah" class="btn btn-success">Tambah Data</a>
		</div>
    <div class="col-md-6 float-right">
    <form action="" method="post" enctype="multipart/form-data" class="form-inline">
    <label>File Csv</label> 
    <div class="form-group">
      <input type="file" class="form-control" name="csv">
    </div>
    <button id="save" class="btn btn-primary">Import Csv</button>
    </form>
  </div>
	</div>

	<div class="row mt-2">
		<div class="col-md-12">
			<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Fullname</th>
      <th scope="col">Email</th>
      <th scope="col">Company</th>
      <th scope="col">City</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	<?php $i=1; ?>
  	<?php foreach($members as $mbr) : ?>
    <tr>
      <th><?= $i; ?></th> 
      <td><?= $mbr['fullname']; ?></td>
      <td><?= $mbr['email']; ?></td>
      <td><?= $mbr['name']; ?></td>
      <td><?= $mbr['cityname']; ?>, <?= $mbr['country']; ?></td>
      <td>
      	<a href="<?= base_url(); ?>members/edit/<?= $mbr['id']; ?>" class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
    	<a href="<?=base_url(); ?>members/detail/<?= $mbr['id']; ?>" class="btn btn-primary"><i class="fas fa-eye"></i></a>
      	<a href="<?= base_url(); ?>members/hapus/<?= $mbr['id']; ?>" class="btn btn-danger tombol-hapus"><i class="far fa-trash-alt"></i></a>
      </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
  </tbody>
</table>
		</div>
	</div>
</div>