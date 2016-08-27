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
                    alert(error);
                }else{
                    alert(self.defaultErrorMessage);
                }

            };
            self.getCountInCart = function(callback){
                self.processRequest('cart/get_total',{},callback);
            };
            self.getProductsList = function(callback){
                self.processRequest('products/get_list',{},callback);
            };
            self.getProduct = function(product,callback){
                self.processRequest('products/get_product',{
                    'product':product
                },callback);
            };
            self.addProductToCart = function(product,quantity,callback){

                self.processRequest('cart/add_product',{
                    'product':product,
                    'quantity':quantity
                },callback);
            };
            self.getCart = function(callback){
                self.processRequest('cart/get_cart',{},callback);
            };

            self.changeProductInCart = function(product,quantity,callback){
                
                self.processRequest('cart/change_product',{
                    'product':product,
                    'quantity':quantity
                },callback);
            };
            self.removeProductInCart = function(product,callback){
                self.processRequest('cart/remove_product',{
                    'product':product
                },callback);
            };
        };
    }
})(jQuery,this);
