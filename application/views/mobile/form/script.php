<script>
    $(document).ready(function() {
        $('#pekerjaan').on('change', function() {
            var id = $(this).val();
            $.ajax({
                url: '<?php echo site_url('form/setPekerjaan/'); ?>' + id,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#lokasi_pekerjaan').val(data[0].keg_Lokasi);
                    $('#tahun_anggaran').val(data[0].keg_Tahun_Anggaran);
                }
            })
        })

        $('#pekerjaan').select2({
            // allowClear: true,
            ajax: {
                url: '<?php echo site_url('form/getPekerjaan'); ?>',
                dataType: 'json',
                type: 'POST',
            }
        });
        $('#form-unsur').validate({
            submitHandler: function(form, e) {
                e.preventDefault();
                $('#form-unsur button[type="submit"]').html("<i class='fa fa-spinner fa-spin'></i> Menyimpan");
                $('#form-unsur button[type="submit"]').attr('disabled', 'disabled');

                $.ajax({
                    url: $('#form-unsur').attr('action'),
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: 'JSON',
                    statusCode: {
                        201: function(resp) {
                            $('#form-unsur button[type="submit"]').html("Simpan");
                            $('#form-unsur button[type="submit"]').removeAttr('disabled');
                            Swal.fire({
                                icon: 'success',
                                title: 'Your work has been saved',
                                showConfirmButton: true,
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    location.href = '<?= site_url('dashboard') ?>'
                                }
                            })

                        },
                        403: function(resp) {
                            $('#form-unsur button[type="submit"]').html("Simpan");
                            $('#form-unsur button[type="submit"]').removeAttr('disabled');
                            Swal.fire(
                                'Gagal',
                                'Data Kurang Lengkap',
                                'error'
                            )

                        },
                        500: function(resp) {
                            $('#form-unsur button[type="submit"]').html("Simpan");
                            $('#form-unsur button[type="submit"]').removeAttr('disabled');
                            Swal.fire(
                                'Gagal',
                                'Data tidak berhasil disimpan',
                                'error'
                            )

                        }
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(() => {
        $("#photo").change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $("#imgPreview")
                        .attr("src", event.target.result);
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>