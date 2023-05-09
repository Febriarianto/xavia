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

        $('#addPekerja').click(function() {
            if ($("#listPekerja tbody").length == 0) {
                $("#listPekerja").append("<tbody></tbody>");
            }

            // Append product to the table
            $("#listPekerja tbody").append(
                "<tr>" +
                "<td>" + $("#pekerjaKeahlain").val() + "</td>" +
                "<td>" + $("#pekerjaJumlah").val() + "</td>" +
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
                "<td>" + $("#materialUraian").val() + "</td>" +
                "<td>" + $("#materialSatuan").val() + "</td>" +
                "<td>" + $("#materialJumlah").val() + "</td>" +
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
                "<td>" + $("#alat").val() + "</td>" +
                "<td>" + $("#alatSatuan").val() + "</td>" +
                "<td>" + $("#alatJumlah").val() + "</td>" +
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
    });
</script>
<script>
    function deletePekerja(ctl) {
        $(ctl).parents("tr").remove();
    }

    function deleteMaterial(ctl) {
        $(ctl).parents("tr").remove();
    }

    function deleteAlat(ctl) {
        $(ctl).parents("tr").remove();
    }
</script>