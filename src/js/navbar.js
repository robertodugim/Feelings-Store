(function(angular){
    'use strict';
    if(typeof angular !== 'undefined'){

        angular.module("nav-section",[])
            .directive("navBar",[ "$window", "$timeout", function($window, $timeout){
            return {
                restrict:"E",
                templateUrl:"src/navbar.html",
                link: function(scope, element, attrs){
                    
                },
                controllerAs:"CtrlNavBar"
            };
        }]);
    }
})(window.angular);
