<div ng-controller="karyawanListCtrl" id="lemburWrap">
  <div class="well well-sm">
     <div class="row">
        <div class="col-xs-4 pull-right">
          <input ng-model="filter" class="form-control input-sm" placeholder="filter data lembur&hellip;">
        </div>
     </div>
  </div> <!-- well filter -->

  <table class="table table-striped table-bordered table-hover" id="tabel_lembur">
     <tr class="success">
       <th>Kode Lembur</th>
       <th>Jam Mulai</th>
       <th>Jam Akhir</th>
       <th>Faktor Kali</th>
       <th>Status Hari</th>
       <th>&nbsp;</th>
     </tr>
     <tr ng-repeat="lembur in daftar_lembur | filter:filter">
       <td>{{ lembur.kd_lembur }}</td>
       <td>{{ lembur.jam_mulai }}</td>
       <td>{{ lembur.jam_akhir }}</td>
       <td>{{ lembur.f_kali }}</td>
       <td>{{ lembur.sts_hari }}</td>
       <td><button class="btn btn-danger btn-xs" ng-click="hapus(lembur.kd_lembur)"><span class="glyphicon glyphicon-trash"></span> Hapus</button></td>
     </tr>
  </table>
  <a class="btn btn-primary btn-xs" id="btnTmbhLembur">
         <span class="glyphicon glyphicon-plus">Tambah</span></a>
</div>


<script>
    $('#btnTmbhLembur').click(function() {
        $html = '<tr>' +
            '<td><input type="text" name="kd_lembur" ng-model="kd_lembur" class="form-control input-sm" size="3"></td>' +
            '<td><input type="text" name="jam_mulai" ng-model="jam_mulai" class="form-control input-sm" size="3"></td>' +
            '<td><input type="text" name="jam_akhir" ng-model="jam_akhir" class="form-control input-sm" size="3"></td>' +
            '<td><input type="text" name="f_kali" ng-model="f_kali" class="form-control input-sm" size="3"></td>' +
            '<td><input type="text" name="sts_hari" ng-model="sts_hari" class="form-control input-sm" size="3"></td>' +
            '<td><button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-save"></span> Simpan</button>' +
            '&nbsp;<button class="btn btn-danger btn-xs" id="btnLemburCancel"><span class="glyphicon glyphicon-remove-circle"></span> Cancel</button></td>' +
            '</tr>';
        $('#tabel_lembur').append($html);
        $('#btnLemburCancel').click(function() {
            $(this).closest('tr').remove();
        });
    });
</script>



