app.controller("ProductController",[ "$scope", "$timeout", "$location", "$routeParams", "API", function($scope, $timeout, $location, $routeParams, API){
    $scope.loadingProduct = true;
    $scope.productDetail = function(data){
        $scope.prodID = $routeParams.prodID;
        $scope.productQuantity = 1;
        $timeout(function() {
            $scope.product = data;
            $scope.loadingProduct = false;
        }, 0);
    };

    $scope.addedToCart = function(data){
        $timeout(function() {
            $scope.GetCartCount();
            $location.path('home');
        }, 1);
    };
    $scope.addToCart = function(){
        if(typeof $scope.productQuantity === 'undefined'){
            alert('The quantity must bigger than 0(zero)!');
        }else{
            API.addProductToCart($scope.prodID,$scope.productQuantity,$scope.addedToCart);
        }

    };
    API.getProduct($routeParams.prodID,$scope.productDetail);
}]);
