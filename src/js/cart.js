app.controller("CartController",[ "$scope", "$timeout", "$location", "$routeParams", "API", function($scope, $timeout, $location, $routeParams, API){
    $scope.loadingCart = true;
    $scope.cartDetail = function(data){
        console.log(data);
        $timeout(function() {
            $scope.products = data.cart;
            $scope.billing = data.billing;
            $scope.shipping = data.shipping;
            $scope.total = data.all_products_amount;
            $scope.loadingCart = false;
        }, 0);
    };
    
    API.getCart($scope.cartDetail);
}]);

