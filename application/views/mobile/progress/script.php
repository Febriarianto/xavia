<script>
    $(document).ready(function() {
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
                        501: function(resp) {
                            $('#form-unsur button[type="submit"]').html("Simpan");
                            $('#form-unsur button[type="submit"]').removeAttr('disabled');
                            Swal.fire(
                                'Gagal',
                                'Lokasi Anda Jauh Dari Titik Pekerjaan',
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
        $("#photoFile").change(function() {
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

        $('#addPekerja').click(function() {
            if ($("#listPekerja tbody").length == 0) {
                $("#listPekerja").append("<tbody></tbody>");
            }

            // Append product to the table
            $("#listPekerja tbody").append(
                "<tr>" +
                "<td><input name='pekerja[keahlian][]' class='form-control' readonly value='" + $("#pekerjaKeahlain").val() + "'></td>" +
                "<td><input name='pekerja[jumlah][]' class='form-control' readonly value='" + $("#pekerjaJumlah").val() + "'></td>" +
                "<td>" +
                "<button type='button' onclick='deletePekerja(this);'class = 'btn btn-danger' > " +
                "<i class='fa-solid fa-xmark'></i>" +
                "</button>" +
                "</td>" +
                "</tr>");

            $('#pekerjaModal').modal('hide');
            $("#pekerjaKeahlain").val('');
            $("#pekerjaJumlah").val('')
        });

        $('#addMaterial').click(function() {
            if ($("#listMaterial tbody").length == 0) {
                $("#listMaterial").append("<tbody></tbody>");
            }

            // Append product to the table
            $("#listMaterial tbody").append(
                "<tr>" +
                "<td><input name='material[uraian][]' class='form-control' readonly value='" + $("#materialUraian").val() + "'></td>" +
                "<td><input name='material[satuan][]' class='form-control' readonly value='" + $("#materialSatuan").val() + "'></td>" +
                "<td><input name='material[jumlah][]' class='form-control' readonly value='" + $("#materialJumlah").val() + "'></td>" +
                "<td>" +
                "<button type='button' onclick='deleteMaterial(this);'class = 'btn btn-danger' > " +
                "<i class='fa-solid fa-xmark'></i>" +
                "</button>" +
                "</td>" +
                "</tr>");

            $('#materialModal').modal('hide');
            $("#materialUraian").val('');
            $("#materialSatuan").val('');
            $("#materialJumlah").val('')
        })
        $('#addAlat').click(function() {
            if ($("#listAlat tbody").length == 0) {
                $("#listAlat").append("<tbody></tbody>");
            }

            // Append product to the table
            $("#listAlat tbody").append(
                "<tr>" +
                "<td><input name='peralatan[alat][]' class='form-control' readonly value='" + $("#alat").val() + "'></td>" +
                "<td><input name='peralatan[satuan][]' class='form-control' readonly value='" + $("#alatSatuan").val() + "'></td>" +
                "<td><input name='peralatan[jumlah][]' class='form-control' readonly value='" + $("#alatJumlah").val() + "'></td>" +
                "<td>" +
                "<button type='button' onclick='deleteAlat(this);'class = 'btn btn-danger' > " +
                "<i class='fa-solid fa-xmark'></i>" +
                "</button>" +
                "</td>" +
                "</tr>");

            $('#alatModal').modal('hide');
            $("#alat").val('');
            $("#alatSatuan").val('');
            $("#alatJumlah").val('')
        })
        $('#addUraianPekerjaan').click(function() {
            if ($("#listUraianPekerjaan tbody").length == 0) {
                $("#listUraianPekerjaan").append("<tbody></tbody>");
            }

            // Append product to the table
            $("#listUraianPekerjaan tbody").append(
                "<tr>" +
                "<td><input name='uraian[pekerjaan][]' class='form-control' readonly value='" + $("#uraianPekerjaan").val() + "'></td>" +
                "<td><input name='uraian[satuan][]' class='form-control' readonly value='" + $("#uraianPekerjaanSatuan").val() + "'></td>" +
                "<td><input name='uraian[volume][]' class='form-control' readonly value='" + $("#uraianPekerjaanVolume").val() + "'></td>" +
                "<td>" +
                "<button type='button' onclick='deleteUraianPekerjaan(this);'class = 'btn btn-danger' > " +
                "<i class='fa-solid fa-xmark'></i>" +
                "</button>" +
                "</td>" +
                "</tr>");

            $('#uraianPekerjaanModal').modal('hide');
            $("#uraianPekerjaan").val('');
            $("#uraianPekerjaanSatuan").val('');
            $("#uraianPekerjaanVolume").val('')
        })
    });
</script>
<script>
    getLocation();

    function deletePekerja(ctl) {
        $(ctl).parents("tr").remove();
    }

    function deleteMaterial(ctl) {
        $(ctl).parents("tr").remove();
    }

    function deleteAlat(ctl) {
        $(ctl).parents("tr").remove();
    }

    function deleteUraianPekerjaan(ctl) {
        $(ctl).parents("tr").remove();
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {

        }

        function showPosition(position) {
            $('#location').val(position.coords.latitude + "," + position.coords.longitude);
        }
    }
</script>