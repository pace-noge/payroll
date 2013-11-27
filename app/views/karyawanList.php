<div ng-controller="karyawanListCtrl">
  <div class="well well-sm">
     <div class="row">
        <div class="col-xs-4 pull-right">
          <input ng-model="filter" class="form-control input-sm" placeholder="filter data karyawan&hellip;">
        </div>
     </div>
  </div>
  <table class="table table-striped table-bordered table-hover">
     <tr class="success">
       <th>NIK</th>
       <th>Nama</th>
       <th>Alamat</th>
       <th>Telp</th>
       <th><a class="btn btn-primary btn-xs" data-toggle="modal" data-target="#tambahKaryawan">
         <span class="glyphicon glyphicon-plus">Tambah</span></a></th>
     </tr>
     <tr ng-repeat="karyawan in daftar_karyawan | filter:filter">
       <td>{{ karyawan.nik }}</td>
       <td>{{ karyawan.nm_karyawan }}</td>
       <td>{{ karyawan.alamat }}</td>
       <td>{{ karyawan.telp }}</td>
       <td><a href="#/karyawan/{{ karyawan.nik }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span> Detail</a>&nbsp;</td>
     </tr>
  </table>

  <!-- modal nambah karyawan -->
  <div class="modal fade" id="tambahKaryawan">
    <div class="modal-dialog">
      <div class="modal-content">
        <div ng-controller="tmbhKaryawanCtrl">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Tambah Karyawan</h4>
        </div>
        <div class="modal-body">
          <div class="container">
             <form class="form-inline" role="form" method="post" action="php/tambah_karyawan.php" enctype="multipart/form-data">
               <table class="col-md-10">
                 <tr>
                   <td>Nik</td><td>:</td><td><input type="text" size="5" name="nik" class="form-control" readonly="" value="{{ nik_baru }}"/></td>
                 </tr>
                 <tr>
                   <td>Nama</td><td>:</td><td><input type="text" name="nama" class="form-control"/></td>
                 </tr>
                 <tr>
                   <td>Telepon</td><td>:</td><td><input type="text" name="tlp" class="form-control"/></td>
                 </tr>
                 <tr>
                   <td>Alamat</td><td>:</td><td><textarea name="alamat" class="form-control"></textarea></td>
                 </tr>
                 <tr>
                   <td>Jabatan</td><td>:</td>
                   <td>
                      <select ng-model="karyawan.jabatan" class="form-control" name="jabatan">
                       <option value="">-- Pilih Jabatan --</option>
                       <option ng-repeat="jabatan in select_jabatan_sub.jabatan" value="{{ jabatan.kd_jbt }}">{{ jabatan.nm_jbt }}</option>
                      </select>
                   </td>
                 </tr>

                <tr>
                   <td>Sub Golongan</td><td>:</td>
                   <td>
                      <select ng-model="karyawan.gol_sub" class="form-control" name="gol_sub">
                       <option value="">Pilih Sub Golongan</option>
                       <option ng-repeat="sub in select_jabatan_sub.golongan_sub" value="{{ sub.kd_sub }}">{{ sub.nm_sub }}</option>
                      </select>
                   </td>
                 </tr>

                  <tr>
                   <td>Tanggal Masuk</td><td>:</td><td>
                    <div class="input-group date" id="dp3" data-date-format="yyyy-mm-dd">
                      <input class="form-control" type="text" value="12-02-2012" name="tgl_masuk" id="datepicker">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                    </div>

                   </td>
                  </tr>

                 <tr>
                   <td>Foto</td><td>:</td><td> <input type="file" id="select_file" name="foto" class="form-control"></td>
                 </tr>
                 <tr>

               </table>

            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button><br /><br />
            </form> <!-- eof form -->
        </div>

        </div> <!-- ng-controller buat simpan -->
      </div>
    </div>
  </div>

<script>
    $('#dp3').datepicker({
        calendarWeeks: true,
        startDate: '-3d'
    });
</script>

</div>
