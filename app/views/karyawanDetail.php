<div ng-controller="karyawanDetailCtrl">
  <!-- panel -->
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">Detail Karyawan</h3>
    </div>
    <div class="panel-body">
      <div class="container">
        <div clas="row">
            <div class="col-sm-2 col-md-2"></div>
            <div class="col-sm-9 col-md-6">
                <div class="thumbnail">
                    <a href="#/karyawan/{{ detail_karyawan.nik }}" class="thumbnail">
                       <img src="foto/{{ detail_karyawan.foto }}" alt="..">
                    </a>
                    <div class="caption">
                        <h3>{{ detail_karyawan.nm_karyawan }}</h3>
                    </div>
                    <p>
                    <table class="table">
                        <tr>
                            <td>NIK</td><td>:</td><td>{{ detail_karyawan.nik }}</td>
                        </tr>
                        <tr>
                            <td>Nama</td><td>:</td><td>{{ detail_karyawan.nm_karyawan }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td><td>:</td><td>{{ detail_karyawan.alamat }}</td>
                        </tr>
                        <tr>
                            <td>Telepon</td><td>:</td><td>{{ detail_karyawan.telp }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Masuk</td><td>:</td><td>{{ detail_karyawan.msk_krj }}</td>
                        </tr>
                        <tr>
                            <td colspan="3"><button class="btn btn-danger btn-xs" ng-click="hapus(detail_karyawan.nik)"><span class="glyphicon glyphicon-trash"></span> Hapus</button></td>
                        </tr>
                    </table>
                    </p>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div> <!-- eof panel info -->
</div>
