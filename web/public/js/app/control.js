(function() {
    'use strict';
    angular.module('App').controller('MainCtrl', ['$scope', function($scope) {
        var locale = $scope;
        locale.main = "Sisterm run all!";
        console.log(locale.main);
    }]);
})();