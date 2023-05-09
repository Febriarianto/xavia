<form action="">
    <div class="card m-1">
        <div class="card-header">
            <h6 class="card-title">Progress</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <td>Kegiatan</td>
                    <td>:</td>
                    <td><?= $kegiatan->keg_Nama_Paket ?></td>
                </tr>
                <tr>
                    <td>No Kontrak</td>
                    <td>:</td>
                    <td><?= $kegiatan->keg_No_Kontrak ?></td>
                </tr>
                <tr>
                    <td>Tahun Anggaran</td>
                    <td>:</td>
                    <td><?= $kegiatan->keg_Tahun_Anggaran ?></td>
                </tr>
            </table>
            <hr>
            <h5>Tenaga Kerja</h5>
            <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#pekerjaModal">Tambah Pekerja</button>
            <table class="table table-bordered" id="listPekerja">
                <thead>
                    <tr>
                        <th>Keahlian</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <hr>
            <h5>Material</h5>
            <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#materialModal">Tambah Material</button>
            <table class="table table-bordered" id="listMaterial">
                <thead>
                    <tr>
                        <th>Uraian Material</th>
                        <th>Satuan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <hr>
            <h5>Peralatan</h5>
            <button type="button" class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#alatModal">Tambah Alat</button>
            <table class="table table-bordered" id="listAlat">
                <thead>
                    <tr>
                        <th>Alat</th>
                        <th>Satuan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <hr>
            <h5>Cuaca</h5>
            <div class="mb-1">
                <label for="jam_mulai_cuaca" class="form-label">Jam Mulai</label>
                <input type="time" class="form-control" id="jam_mulai_cuaca" placeholder="Jam Mulai" name="jam_mulai_cuaca">
            </div>
            s/d
            <div class="mb-1">
                <label for="jam_selesai_cuaca" class="form-label">Jam Selesai</label>
                <input type="time" class="form-control" id="jam_selesai_cuaca" placeholder="Jam Selesai" name="jam_selesai_cuaca">
            </div>
            <div class="mb-1">
                <label for="cuaca" class="form-label">Cuaca</label>
                <select class="form-select" name="cuaca">
                    <option value="">.: Pilih :.</option>
                    <option value="cerah">Cerah</option>
                    <option value="hujan">Hujan</option>
                    <option value="gerimis">Gerimis</option>
                </select>
            </div>
            <hr>
            <h5>Jam Kerja</h5>
            <div class="mb-1">
                <label for="jam_mulai_kerja" class="form-label">Jam Mulai</label>
                <input type="time" class="form-control" id="jam_mulai_kerja" placeholder="Jam Mulai" name="jam_mulai_kerja">
            </div>
            <div class="mb-1">
                <label for="jam_selesai_kerja" class="form-label">Jam Selesai</label>
                <input type="time" class="form-control" id="jam_selesai_kerja" placeholder="Jam Selesai" name="jam_selesai_kerja">
            </div>
            <div class="mb-1">
                <label for="catatan_pekerjaan" class="form-label">Catatan Pekerjaan</label>
                <textarea class="form-control" id="catatan_pekerjaan" name="catatan_pekerjaan" cols="30" rows="3"></textarea>
            </div>
            <div class="mb-1">
                <label for="foto_pekerjaan" class="form-label">Foto Pekerjaan</label>
            </div>
            <div class="mb-1">
                <div class="holder">
                    <img id="imgPreview" src="#" alt="pic" />
                </div>
            </div>
            <div class="mb-1">
                <input type="file" class="form-control" accept="image/*" capture="camera" name="foto_pekerjaan" id="photo">
            </div>
            <hr>
            <div class="mb-1 text-center">
                <button class="btn btn-info">Simpan</button>
            </div>
        </div>
    </div>
</form>
<div class="modal fade" id="pekerjaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pekerja</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label for="" class="form-label">Keahlian</label>
                    <input type="text" class="form-control" id="pekerjaKeahlain" placeholder="Keahlian">
                </div>
                <div class="mb-1">
                    <label for="" class="form-label">Jumlah</label>
                    <input type="text" class="form-control" id="pekerjaJumlah" placeholder="Jumlah">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="addPekerja">Tambah</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="materialModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label for="" class="form-label">Uraian Material</label>
                    <input type="text" class="form-control" id="materialUraian" placeholder="Uraian Material">
                </div>
                <div class="mb-1">
                    <label for="" class="form-label">Satuan</label>
                    <input type="text" class="form-control" id="materialSatuan" placeholder="Satuan Material">
                </div>
                <div class="mb-1">
                    <label for="" class="form-label">Jumlah</label>
                    <input type="text" class="form-control" id="materialJumlah" placeholder="Jumlah">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="addMaterial">Tambah</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="alatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Alat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label for="" class="form-label">Alat</label>
                    <input type="text" class="form-control" id="alat" placeholder="Alat">
                </div>
                <div class="mb-1">
                    <label for="" class="form-label">Satuan</label>
                    <input type="text" class="form-control" id="alatSatuan" placeholder="Satuan Alat">
                </div>
                <div class="mb-1">
                    <label for="" class="form-label">Jumlah</label>
                    <input type="text" class="form-control" id="alatJumlah" placeholder="Jumlah">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" id="addAlat">Tambah</button>
            </div>
        </div>
    </div>
</div>