var app = angular.module("feelling-app",["ngRoute","nav-section"]);

app.factory('API', function clientIdFactory() {
    return new FeelingsApi();
});

app.config(function ($routeProvider,$locationProvider) {
    $routeProvider.when("/product/:prodID", {
        templateUrl: "src/product.html",
        controller: "ProductController"
    })
        .when("/cart", {
            templateUrl: "src/cart.html",
            controller: "CartController"
        })
        .otherwise({
            templateUrl: "src/products.html",
            controller: "ProductsController"
        });
    $locationProvider.html5Mode(true);
});
