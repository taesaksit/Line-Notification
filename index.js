var notiLine = angular.module("notiLineApp", []);
notiLine.controller('notiLine_ctrl', ($scope, $http) => {

    $scope.form = {
        email: '',
        user: '',
        password: ''
    }
    $scope.alert = false
    $scope.textAlert = 'Null';



    $scope.sendLine = function () {

        $http({
            method: "post",
            url: 'sendLine.php',
            data: $scope.form
        }).then((response) => {
            if (response.status == 200) {
                $scope.form = {}

                $scope.alert = true;
                $scope.textAlert = 'ส่งการแจ้งเตือนสำเร็จ';

                console.log($scope.alert)
                console.log($scope.textAlert)

            }
        }, (err) => {

        })

    }

})