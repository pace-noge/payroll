var payrollApp = angular.module('payrollApp',
 ['ngRoute', 'angularFileUpload']);

payrollApp.config(function($routeProvider, $locationProvider) {
    //$locationProvider.html5Mode(true);
    $routeProvider.when("/karyawan", {
        templateUrl: "views/karyawanList.php",
        controller: "karyawanListCtrl"
    }).when("/karyawan/:nik", {
        templateUrl : "views/karyawanDetail.php",
        controller: "karyawanDetailCtrl"
    }).when("/lembur", {
        templateUrl: "views/lemburList.php",
        controller: "lemburListCtrl"
    });
});

payrollApp.controller('karyawanListCtrl', function($scope, $http) {

    $postData = {'action': 'list_karyawan', 'tracker': 'karyawan'};
    $http.post('php/proses.php', $postData).success(function(data) {
        $scope.daftar_karyawan = data;
    });
});

//detail karyawan
payrollApp.controller('karyawanDetailCtrl', ['$scope', '$routeParams', '$http', '$location', function($scope, $routeParams, $http, $location) {
  $postData = {'action': 'detail_karyawan', 'nik': $routeParams.nik};
  $http.post('php/proses.php', $postData).success(function(data) {
    $scope.detail_karyawan = data;
  });
  $scope.nik = $routeParams.nik;

  $scope.hapus = function(nik) {
    $postData = {'action': 'hapus_karyawan', 'nik': nik};
    $http.post('php/proses.php', $postData).success(function(data) {
      console.log('Karyawan dengan nik ' + nik + ' telah dihapus');
    });
    $location.path('/karyawan');
  };

}]);

payrollApp.controller('tmbhKaryawanCtrl', function($scope, $http, $upload) {

   $postData = {'action': 'select_jabatan_sub'};
   $http.post('php/proses.php', $postData).success(function(data) {
      $scope.select_jabatan_sub = data;
   });

   $postData = {'action': 'get_last_nik'};
   $http.post('php/proses.php', $postData).success(function(data) {
     var nik = parseInt(data.nik) + 1;
     var nikStr = nik.toString();

     $scope.nik_baru = ulang_string('0', 3 - nikStr.length) + nikStr;

   })

   ulang_string = function(str, num) {
     return new Array(parseInt(num) + 1).join(str);
   };

   $scope.tambah = function(karyawan) {
     var data_karyawan = [];
     data_karyawan['action'] = 'tambah_karyawan';
     $scope.data_karyawan = karyawan;



};
});


// form lembur

payrollApp.controller('lemburListCtrl', function($scope, $http,$location) {
    $postData = {'action': 'list_lembur'};
    $http.post('php/proses.php', $postData).success(function(data) {
        $scope.daftar_lembur = data;
    });

    $scope.kd_lembur = '';
    $scope.jam_mulai = '';
    $scope.jam_akhir = '';
    $scope.f_kali = '';
    $scope.sts_hari = '';

    console.log($scope.kd_lembur + ' ' + $scope.jam_mulai + ' ' + $scope.jam_akhir);

    $scope.hapus = function(kd_lembur) {
       $postData = {'action': 'hapus_lembur', 'kd_lembur': kd_lembur};
       $http.post('php/proses.php', $postData).success(function(data){
         $postData = {'action': 'list_lembur'};
         $http.post('php/proses.php', $postData).success(function(data) {
            $scope.daftar_lembur = data;

         });
         $location.path('/lembur');

       });
    };
});

payrollApp.directive('fileUpload', function () {
    return {
        scope: true,        //create a new scope
        link: function (scope, el, attrs) {
            el.bind('change', function (event) {
                var files = event.target.files;
                //iterate files since 'multiple' may be specified on the element
                for (var i = 0;i<files.length;i++) {
                    //emit event upward
                    scope.$emit("fileSelected", { file: files[i] });
                }
            });
        }
    };
});
