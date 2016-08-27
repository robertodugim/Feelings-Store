app.controller("ProductController",[ "$scope", "$timeout", "$location", "$routeParams", "API", function($scope, $timeout, $location, $routeParams, API){
    $scope.loadingCart = true;
    $scope.cartDetail = function(data){
        $timeout(function() {
            $scope.products = data;
            $scope.loadingCart = false;
        }, 0);
    };
    
    API.getProduct($routeParams.prodID,$scope.productDetail);
}]);

