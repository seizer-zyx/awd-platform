
define(['jquery', 'core'], function($, core) {

    var core = {
        //默认配置
        default_options: {
            baseUrl: '',
            siteUrl: '',
            staticUrl: window.resource_url+'/eshop/static/'
        },
        options: {},
    };

    //初始化
    core.init = function(options) {
        this.options = $.extend({}, this.default_options, options);
    }
    core.toQueryPair = function(key, value) { 
        if (typeof value == 'undefined'){ 
        return key; 
        }  
        return key + '=' + encodeURIComponent(value === null ? '' : String(value)); 
    } 
    core.toQueryString = function(obj) { 
      
                var ret = []; 
                for(var key in obj){ 
                    key = encodeURIComponent(key); 
                    var values = obj[key]; 
                    if(values && values.constructor == Array){//数组 
                         var queryValues = []; 
                          for (var i = 0, len = values.length, value; i < len; i++) { 
                             value = values[i]; 
                             queryValues.push(toQueryPair(key, value)); 
                           } 
                          ret = concat(queryValues); 
                         }else{ //字符串 
                         ret.push(this.toQueryPair(key, values)); 
                    } 
               } 
           return ret.join('&'); 
    } 
    //获取连接
    core.getUrl = function(routes,params,full) {

        routes = routes.split('/');
        var todo = routes[0];
       
        var p = routes.length >= 2 ? routes[1] : '';
        var url = this.options.baseUrl.replace('ROUTES', todo) + '&act=' + p;
        var method =  routes.length >= 3 ? routes[2] : '';
        if(method!=''){
            url+='&method=' + method;
        }
        if(params ){
            if(typeof(params)=='object') {
                  url+="&" + this.toQueryString(params);
            }  else if(typeof(params)=='string'){
                url+="&" + params
            }
        }
      
        return full ? this.options.siteUrl + 'app/' +url : url;
    }
  
    //获取json
    core.json = function(routes, args, callback, hasloading,ispost) {

       var url = ispost? this.getUrl(routes): this.getUrl(routes,args);
       var op = {
            url: url,
            type:ispost?'post':'get',
            dataType: 'json',cache:false,
            beforeSend:function(){
                  if (hasloading) {
                      core.loading();
                  }
            },
            error:function(){
                core.removeLoading();
                //core.tip.show('请刷新重试');
            }
        }

        if (args && ispost) {
            op.data = args;
        }
        
        if (callback) {
           
            op.success = function(data) {
                core.removeLoading();
                callback(data);
            }
        }
   

        $.ajax(op);

    }
    //获取插件 json
    core.pjson = function(routes, args, callback, hasloading,ispost) {
        routes = "plugin/" +routes;   
        this.json(routes,args,callback,hasloading,ispost);
    }
    //获取文本
    core.html = function(routes, args, callback, hasloading) {
        var op = {
            url: this.getUrl(routes,args),
            type: 'get',
            cache: false,
            dataType: 'html',
            beforeSend:function(){
                  if (hasloading) {
                      core.loading();
                  }
            },
            error:function(){
                core.removeLoading();
                core.tip.show('服务器错误');
            }
        }
        if (callback) {
           
            op.success = function(html) {
                core.removeLoading();
                callback(html);
            }
        }
      
        $.ajax(op);
    }
      //获取插件 html
     core.phtml = function(routes, args, callback, hasloading) {
        routes = "plugin/" + routes;
 
        this.html(routes,args,callback,hasloading);
     }

      core.loading =  function() {
          var u = navigator.userAgent, app = navigator.appVersion;
           if ($('#core_loading').length <= 0) {
                $('body').append('<div id="core_loading" style="top:50%;left:50%;margin-left:-35px;margin-top:-30px;position:absolute;width:80px;z-index:999999"><img src="'+window.resource_url+'eshop/static/images/loading.svg" width="80" /></div>')
            }
            else{
                $('#core_loading').show();
            }
      }
      core.removeLoading =  function() {
           $('#core_loading').hide();
      }
        
        
    //弹出提示
    core.tip = {
     
        
        show: function(msg, position, duration) {

            if(!msg){
                var m=document.getElementById('core_show_div');
                    var d = 0.2;
                    m.style.webkitTransition = '-webkit-transform ' + d + 's ease-in, opacity ' + d + 's ease-in';
                    m.style.opacity = '0';
                    setTimeout(function() {
                        document.body.removeChild(m)
                    }, d * 1000);
                    return;
            }
           if(position!='bottom' && position!='middle' && position!='top'){
               position ='bottom';
           }
           
            duration = isNaN(duration) ? 1000 : duration;
            var m = document.createElement('div');
            m.id = 'core_show_div';
            m.innerHTML = msg;
            var css = "width:60%; font-size:14px;min-width:150px; background:#000; opacity:0.7; min-height:35px; overflow:hidden; color:#fff; line-height:35px; text-align:center; border-radius:5px; position:fixed; left:20%; z-index:999999;box-shadow:3px 3px 4px #d9d9d9;-webkit-box-shadow: 3px 3px 4px #d9d9d9;-moz-box-shadow: 3px 3px 4px #d9d9d9;";
            if(position=='top'){
                css+="top:10%; ";
            } else if(position=='bottom'){
                 css+="bottom:10%; ";
            } else if(position=='middle'){
                 css+="top:50%;margin-top:-18px;";
            }
            m.style.cssText = css;
            document.body.appendChild(m);
            if(duration!=0){
                setTimeout(function() {
                    var d = 0.2;
                    m.style.webkitTransition = '-webkit-transform ' + d + 's ease-in, opacity ' + d + 's ease-in';
                    m.style.opacity = '0';
                    setTimeout(function() {
                        document.body.removeChild(m)
                    }, d * 1000);
                }, duration);
            }

        },confirm:function(msg,callback){
            
            var html = '<div id="core_alert"><div class="layer"></div><div class="tips"><div class="title">';
            html+=msg;
            html+='</div><div class="sub"><nav data-action="cancel">取消</nav><nav data-action="ok">确定</nav>';
            html+='</div></div></div>';
            if($('#core_tip').length>0){
                $('#core_tip').remove();
            }
            var div =$(html);
           $(document.body).append(div);
            $('.layer',div).fadeIn(100);$('.tips',div).fadeIn(100);
            div.find('nav').unbind('click').click(function(){
                
                var action=$(this).data('action');
                if(action=='ok'){
                    if(callback){
                        callback();
                    }
                }
                div.remove();
            });
            
        },alert:function(msg,callback){
          
            var html = '<div id="core_alert"><div class="layer"></div><div class="tips"><div class="title">';
            html+=msg;
            html+='</div><div class="sub"><nav data-action="ok">确定</nav>';
            html+='</div></div></div>';

            if($('#core_tip').length>0){
                $('#core_tip').remove();
            }
            var div =$(html);
            $(document.body).append(div);
            $('.layer',div).fadeIn(100);$('.tips',div).fadeIn(100);
           
            div.find('nav').unbind('click').click(function(){
               
                var action=$(this).data('action');
                if(action=='ok'){
                    if(callback){
                        callback();
                    }
                     div.remove();
                }
            });
        }
    }
    //页面提示
    core.message =function(message,url,type,js) {
        
        if(!type) { type='success'; }
        if(!url) { url=''; }
        if(!js) { js=''; }
        require(['tpl'],function(tpl){
               document.title = "系统提醒";
               $('body').html( tpl('tpl_show_message',
                {
                  message:message,
                  type:type,
                  url:url,
                  js:js
                 }) );
                 if(url){
                       setTimeout(function () {location.href =url}, 1500);
                 }
         });        
    }
    return core;
});
