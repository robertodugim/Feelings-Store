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
                            self.displayError(resp.error);
                        }
                    },
                    error:function(xhr,txtError){
                        self.displayError(txtError);
                    }
                });
            };
            self.displayError = function(error){
                if(typeof error !== 'undefined' && error !== null && error !== 'none'){
                    alert(error);
                }else{
                    alert(self.defaultErrorMessage);
                }

            };
            self.getCountInCart = function(callback){
                self.processRequest('cart/get_total',{},callback);
            };
        };
    }
})(jQuery,this);
