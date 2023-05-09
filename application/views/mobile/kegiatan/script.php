<script>
    $(document).ready(function() {
        getData();

        function getData() {
            var name = $('#search').val();
            $.ajax({
                url: "<?php echo site_url('kegiatan/getList'); ?>",
                type: "POST",
                data: {
                    nama: name,
                },
                success: function(response) {
                    for (var i = 0; i < response.length; i++) {
                        $("#list").append('<div class="card m-1"><div class="card-header"><h6 class="card-title">Tahun Anggaran ' + response[i].keg_Tahun_Anggaran + '</h6></div><div class="card-body"><div class="mb-1">' + response[i].keg_Nama_Paket + '</div><mb-1>' + response[i].keg_No_Kontrak + '</mb-1><div class="float-end mb-1"><a href="<?php echo site_url('kegiatan/progress/'); ?>' + response[i].keg_Id + '" class="btn btn-info"><i class="fa-solid fa-bars-progress"></i> Progres</a></div></div></div>')
                    }
                }
            })
        }

        $('#btn-cari').click(function() {
            $("#list").html('')
            getData();
        });
    });
</script>