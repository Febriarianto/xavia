<?php foreach ($list as $key => $listview) { ?>
    <div class="card m-1">
        <div class="card-header">
            <h6 class="card-title"><?php echo $listview['tanggal']; ?></h6>
        </div>
        <div class="card-body">
            <div class="mb-1">
                <?php echo $listview['keg_Nama_Paket']; ?>
            </div>
            <div class="float-end mb-1">
                <button class="btn btn-info">Lihat</button>
            </div>
        </div>
    </div>
<?php }; ?>