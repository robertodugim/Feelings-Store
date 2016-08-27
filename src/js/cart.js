app.controller("CartController",[ "$scope", "$timeout", "$location", "$routeParams", "API", function($scope, $timeout, $location, $routeParams, API){
    $scope.loadingCart = true;
    $scope.billing = {};
    $scope.shipping = {};
    $scope.cartDetail = function(data){
        $timeout(function() {
            $scope.products = data.cart;
            if(!$.isArray(data.billing)){
                $scope.billing = data.billing;
            }
            if(!$.isArray(data.shipping)){
                $scope.shipping = data.shipping;
            }
            $scope.total = data.all_products_amount;
            $scope.loadingCart = false;
            $scope.GetCartCount();
        }, 0);
    };


    $scope.changeProductInCart = function(prodID,quantity){
        if(typeof quantity === 'undefined'){
            alert('The quantity must bigger than 0(zero)!');
        }else{
            $scope.loadingCart = true;
            API.changeProductInCart(prodID,quantity,$scope.cartDetail);
        }

    };
    
    $scope.RemoveProduct = function(prodID){
        API.removeProductInCart(prodID,$scope.cartDetail);
    };

    $scope.AddressReturn = function(resp){
        alert("Address Saved!");
    };

    $scope.SaveBilling = function(){
        API.SaveBilling($scope.billing,$scope.AddressReturn);
    };

    $scope.SaveShipping = function(){
        API.SaveShipping($scope.shipping,$scope.AddressReturn);
    };

    $scope.CopyShipping = function(){
        angular.copy($scope.shipping, $scope.billing);
    };

    $scope.removeShipping = function(){
        API.removeShipping(function(){
            $timeout(function() {
                $scope.shipping = {};
            }, 0);
        });
    };

    $scope.removeBilling = function(){
        API.removeBilling(function(){
            $timeout(function() {
                $scope.billing = {};
            }, 0);
        });
    };
    
    API.getCart($scope.cartDetail);
}]);

