(function($,root){
    'use strict';
    if(typeof $ !== 'undefined'){
        root.FeelingsApi = function(){
            var self = this;
            self.url = "http://localhost/Feelings-Store/api/";
            self.defaultErrorMessage = "Undefined Error!";
            self.processRequest = function(action,data,callback){
                $.ajax({
                    url:self.url+action,
                    data:data,
                    dataType:"json",
                    async:true,
                    success:function(resp){
                        if(resp.result == 'success'){
                            callback(resp.data);
                        }else{
                            self.displayError(resp.error,action);
                        }
                    },
                    error:function(xhr,txtError){
                        self.displayError(txtError,action);
                    }
                });
            };
            self.displayError = function(error,action){
                if(typeof error !== 'undefined' && error !== null && error !== 'none'){
                    alert("API Error in the action "+action+': '+error);
                }else{
                    alert("API Error in the action "+action+': '+self.defaultErrorMessage);
                }

            };
            self.getCountInCart = function(callback){
                self.processRequest('cart/get_total',{},callback);
            };
            self.getProductsList = function(callback){
                self.processRequest('products/get_list',{},callback);
            };
        };
    }
})(jQuery,this);
