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
            $scope.GetCartCount();
        }, 0);
    };


    $scope.changeProductInCart = function(prodID,quantity){
        $scope.loadingCart = true;
        API.changeProductInCart(prodID,quantity,$scope.cartDetail);
    };
    
    $scope.RemoveProduct = function(prodID){
        API.removeProductInCart(prodID,$scope.cartDetail);
    };
    
    API.getCart($scope.cartDetail);
}]);

