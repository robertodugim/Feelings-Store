(function(angular){
    'use strict';
    if(typeof angular !== 'undefined'){

        angular.module("nav-section",[])
            .directive("navBar",[ "$window", "$timeout", function($window, $timeout){
            return {
                restrict:"E",
                templateUrl:"src/navbar.html",
                link: function(scope, element, attrs){
                    var api = new FeelingsApi();
                    scope.cartReturn = function(data){
                        $timeout(function() {
                            scope.productsInCart = data;
                        }, 0);
                    };
                    api.getCountInCart(scope.cartReturn);
                },
                controllerAs:"CtrlNavBar"
            };
        }]);
    }
})(window.angular);
