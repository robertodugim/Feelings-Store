app.controller("ProductsController",[ "$scope", "$timeout", "API", function($scope, $timeout, API){
    $scope.loadingProducts = true;
    $scope.productsList = function(data){
        $timeout(function() {
            $scope.products = data;
            $scope.loadingProducts = false;
        }, 0);
    };
    API.getProductsList($scope.productsList);
}]);
