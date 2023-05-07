<div class="container-fluid mt-1">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Form Harian</h5>
        </div>
        <div class="card-body">
            <form action="">
                <h5>Informasi Pekerjaan</h5>
                <div class="mb-1">
                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                    <select class="form-control" id="pekerjaan" name="pekerjaan">
                    </select>
                </div>
                <div class="mb-1">
                    <label for="lokasi_pekerjaan" class="form-label">Lokasi Pekerjaan</label>
                    <input type="text" class="form-control" id="lokasi_pekerjaan" placeholder="Lokasi Pekerjaan" readonly>
                </div>
                <div class="mb-1">
                    <label for="tahun_anggaran" class="form-label">Tahun Anggaran</label>
                    <input type="text" class="form-control" id="tahun_anggaran" placeholder="Tahun Anggaran" readonly>
                </div>
                <div class="mb-1">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" placeholder="Tanggal" name="tanggal">
                </div>
                <div class="mb-1">
                    <label for="hari_ke" class="form-label">Hari ke</label>
                    <input type="number" class="form-control" id="hari_ke" placeholder="Hari ke" name="hari_ke">
                </div>
                <div class="mb-1">
                    <label for="minggu_ke" class="form-label">Minggu ke</label>
                    <input type="number" class="form-control" id="minggu_ke" placeholder="Minggu ke" name="minggu_ke">
                </div>
                <hr>
                <h5>Tenaga Kerja</h5>
                <div class="mb-1">
                    <label for="no_tenaga_kerja" class="form-label">No Tenaga Kerja</label>
                    <input type="text" class="form-control" id="no_tenaga_kerja" placeholder="No Tenaga Kerja">
                </div>
                <div class="mb-1">
                    <label for="keahlian" class="form-label">Keahlian</label>
                    <input type="text" class="form-control" id="keahlian" placeholder="Keahlian">
                </div>
                <div class="mb-1">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="text" class="form-control" id="jumlah" placeholder="Jumlah">
                </div>
                <hr>
                <h5>Material</h5>
                <div class="mb-1">
                    <label for="no_material" class="form-label">No Material</label>
                    <input type="text" class="form-control" id="no_material" placeholder="No Material">
                </div>
                <div class="mb-1">
                    <label for="uraian_material" class="form-label">Uraian Material</label>
                    <input type="text" class="form-control" id="uraian_material" placeholder="Uraian Material">
                </div>
                <div class="mb-1">
                    <label for="satuan_material" class="form-label">Satuan Material</label>
                    <input type="text" class="form-control" id="satuan_material" placeholder="Satuan Material">
                </div>
                <div class="mb-1">
                    <label for="jumlah_material" class="form-label">Jumlah Material</label>
                    <input type="text" class="form-control" id="jumlah_material" placeholder="Jumlah Material">
                </div>
                <hr>
                <h5>Peralatan</h5>
                <div class="mb-1">
                    <label for="no_alat" class="form-label">No Alat</label>
                    <input type="text" class="form-control" id="no_alat" placeholder="No Alat">
                </div>
                <div class="mb-1">
                    <label for="alat" class="form-label">Alat</label>
                    <input type="text" class="form-control" id="alat" placeholder="Alat">
                </div>
                <div class="mb-1">
                    <label for="satuan_alat" class="form-label">Satuan Alat</label>
                    <input type="text" class="form-control" id="satuan_alat" placeholder="Satuan Alat">
                </div>
                <div class="mb-1">
                    <label for="jumlah_alat" class="form-label">Jumlah Alat</label>
                    <input type="text" class="form-control" id="jumlah_alat" placeholder="Jumlah Alat">
                </div>
                <hr>
                <h5>Uraian Pekerjaan</h5>
                <div class="mb-1">
                    <label for="no_uraian_pekerjaan" class="form-label">No Uraian Pekerjaan</label>
                    <input type="text" class="form-control" id="no_uraian_pekerjaan" placeholder="No Uraian Pekerjaan">
                </div>
                <div class="mb-1">
                    <label for="uraian_pekerjaan" class="form-label">Uraian Pekerjaan</label>
                    <input type="text" class="form-control" id="uraian_pekerjaan" placeholder="Uraian Pekerjaan">
                </div>
                <div class="mb-1">
                    <label for="satuan_uraian_pekerjaan" class="form-label">Satuan Uraian Pekerjaan</label>
                    <input type="text" class="form-control" id="satuan_uraian_pekerjaan" placeholder="Satuan Uraian Pekerjaan">
                </div>
                <div class="mb-1">
                    <label for="volume_uraian_pekerjaan" class="form-label">Volume_uraian_pekerjaan</label>
                    <input type="text" class="form-control" id="volume_uraian_pekerjaan" placeholder="Volume_uraian_pekerjaan">
                </div>
                <hr>
                <h5>Cuaca</h5>
                <div class="mb-1">
                    <label for="jam_mulai_cuaca" class="form-label">Jam Mulai</label>
                    <input type="time" class="form-control" id="jam_mulai_cuaca" placeholder="Jam Mulai">
                </div>
                s/d
                <div class="mb-1">
                    <label for="jam_selesai_cuaca" class="form-label">Jam Selesai</label>
                    <input type="time" class="form-control" id="jam_selesai_cuaca" placeholder="Jam Selesai">
                </div>
                <div class="mb-1">
                    <label for="cuaca" class="form-label">Cuaca</label>
                    <select class="form-select">
                        <option value="">.: Pilih :.</option>
                    </select>
                </div>
                <hr>
                <h5>Jam Kerja</h5>
                <div class="mb-1">
                    <label for="jam_mulai_kerja" class="form-label">Jam Mulai</label>
                    <input type="time" class="form-control" id="jam_mulai_kerja" placeholder="Jam Mulai">
                </div>
                <div class="mb-1">
                    <label for="jam_selesai_kerja" class="form-label">Jam Selesai</label>
                    <input type="time" class="form-control" id="jam_selesai_kerja" placeholder="Jam Selesai">
                </div>
                <div class="mb-1">
                    <label for="catatan_pekerjaan" class="form-label">Catatan Pekerjaan</label>
                    <textarea class="form-control" id="catatan_pekerjaan" name="catatan_pekerjaan" cols="30" rows="10"></textarea>
                </div>
                <div class="mb-1">
                    <label for="foto_pekerjaan" class="form-label">Foto Pekerjaan</label>
                </div>
                <div class="mb-1">
                    <input type="file" class="form-control" accept="image/*" capture>
                </div>
                <hr>
                <div class="mb-1 text-center">
                    <button type="submit" class="btn btn-info">Simpan</button>
                </div>
                <div id="my_camera"></div>
                <input type=button value="Take Snapshot" onClick="take_snapshot()">

                <div id="results"></div>
            </form>
        </div>
    </div>
</div>