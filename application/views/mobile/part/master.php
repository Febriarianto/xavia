<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="CSS/mobile.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>Document</title>
</head>

<body style="background-color: #508bfc;">
    <section class="pb-2">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">6Xavia</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><i class="fa-solid fa-user"></i></span>
                                Profile
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?php echo base_url('index.php/auth/logout'); ?>"><i class="fa-solid fa-right-from-bracket"></i>
                                        Logout</a></li>
                            </ul>
                        </li>
                </div>
            </div>
        </nav>
        <?php
        $this->load->view($content);
        ?>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
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
                                    'Data tidak berhasil disimpan',
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
            })
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>