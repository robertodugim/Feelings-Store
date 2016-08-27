var app = angular.module("feelling-app",["ngRoute","nav-section"]);

app.factory('API', function clientIdFactory() {
    return new FeelingsApi();
});

app.controller("IndexController",[ "API",function($scope){
    $scope.samething="index";
}]);
