var $ = jQuery.noConflict();

//Easing
jQuery.easing['jswing']=jQuery.easing['swing'];jQuery.extend(jQuery.easing,{def:'easeOutQuad',swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d)},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b},easeOutQuad:function(x,t,b,c,d){return-c*(t/=d)*(t-2)+b},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t+b;return-c/2*((--t)*(t-2)-1)+b},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b},easeOutQuart:function(x,t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b},easeInSine:function(x,t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b},easeInExpo:function(x,t,b,c,d){return(t==0)?b:c*Math.pow(2,10*(t/d-1))+b},easeOutExpo:function(x,t,b,c,d){return(t==d)?b+c:c*(-Math.pow(2,-10*t/d)+1)+b},easeInOutExpo:function(x,t,b,c,d){if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b},easeInCirc:function(x,t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b},easeInBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b},easeOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=(1.525))+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=(1.525))+1)*t+s)+2)+b},easeInBounce:function(x,t,b,c,d){return c-jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b},easeOutBounce:function(x,t,b,c,d){if((t/=d)<(1/2.75)){return c*(7.5625*t*t)+b}else if(t<(2/2.75)){return c*(7.5625*(t-=(1.5/2.75))*t+.75)+b}else if(t<(2.5/2.75)){return c*(7.5625*(t-=(2.25/2.75))*t+.9375)+b}else{return c*(7.5625*(t-=(2.625/2.75))*t+.984375)+b}},easeInOutBounce:function(x,t,b,c,d){if(t<d/2)return jQuery.easing.easeInBounce(x,t*2,0,c,d)*.5+b;return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*.5+c*.5+b}});

//Fitvids
(function( $ ){

  "use strict";

  $.fn.fitVids = function( options ) {
    var settings = {
      customSelector: null,
      ignore: null
    };

    if(!document.getElementById('fit-vids-style')) {
      // appendStyles: https://github.com/toddmotto/fluidvids/blob/master/dist/fluidvids.js
      var head = document.head || document.getElementsByTagName('head')[0];
      var css = '.fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}';
      var div = document.createElement('div');
      div.innerHTML = '<p>x</p><style id="fit-vids-style">' + css + '</style>';
      head.appendChild(div.childNodes[1]);
    }

    if ( options ) {
      $.extend( settings, options );
    }

    return this.each(function(){
      var selectors = [
        "iframe[src*='player.vimeo.com']",
        "iframe[src*='youtube.com']",
        "iframe[src*='youtube-nocookie.com']",
        "iframe[src*='kickstarter.com'][src*='video.html']",
        "object",
        "embed"
      ];

      if (settings.customSelector) {
        selectors.push(settings.customSelector);
      }

      var ignoreList = '.fitvidsignore';

      if(settings.ignore) {
        ignoreList = ignoreList + ', ' + settings.ignore;
      }

      var $allVideos = $(this).find(selectors.join(','));
      $allVideos = $allVideos.not("object object"); // SwfObj conflict patch
      $allVideos = $allVideos.not(ignoreList); // Disable FitVids on this video.

      $allVideos.each(function(){
        var $this = $(this);
        if($this.parents(ignoreList).length > 0) {
          return; // Disable FitVids on this video.
        }
        if (this.tagName.toLowerCase() === 'embed' && $this.parent('object').length || $this.parent('.fluid-width-video-wrapper').length) { return; }
        if ((!$this.css('height') && !$this.css('width')) && (isNaN($this.attr('height')) || isNaN($this.attr('width'))))
        {
          $this.attr('height', 9);
          $this.attr('width', 16);
        }
        var height = ( this.tagName.toLowerCase() === 'object' || ($this.attr('height') && !isNaN(parseInt($this.attr('height'), 10))) ) ? parseInt($this.attr('height'), 10) : $this.height(),
            width = !isNaN(parseInt($this.attr('width'), 10)) ? parseInt($this.attr('width'), 10) : $this.width(),
            aspectRatio = height / width;
        if(!$this.attr('id')){
          var videoID = 'fitvid' + Math.floor(Math.random()*999999);
          $this.attr('id', videoID);
        }
        $this.wrap('<div class="fluid-width-video-wrapper"></div>').parent('.fluid-width-video-wrapper').css('padding-top', (aspectRatio * 100)+"%");
        $this.removeAttr('height').removeAttr('width');
      });
    });
  };
// Works with either jQuery or Zepto
})( window.jQuery || window.Zepto );

//Froogaloop
var Froogaloop = function() {
 
    var
 
    _this = {
 
        hasWindowEvent: false,
 
        PLAYER_DOMAIN: '',
 
        eventCallbacks: {},
 
        iframe_pattern: /player\.(([a-zA-Z0-9_\.]+)\.)?vimeo(ws)?\.com\/video\/([0-9]+)/i
 
    },
 

 
    /**
 
     * Attaches itself to all vimeo iframes.
 
     * 
 
     * @param iframes (NodeList): List of HTML nodes/elements that should be matched against
 
     * to check to see if they're a vimeo embed iframe.
 
     */
 
    init = function(iframes) {
 
        if (!iframes) {
 
            iframes = document.getElementsByTagName('iframe');
 
        }
 
        
 
        var cur_frame,
 
        i = 0,
 
        length = iframes.length,
 
        is_embed_iframe;
 

 
        for(i; i<length; i++) {
 
            cur_frame = iframes[i];
 
            is_embed_iframe = _this.iframe_pattern.test(cur_frame.getAttribute('src'));
 

 
            if(is_embed_iframe) {
 
                cur_frame.api = _that.api;
 
                cur_frame.get = _that.get;
 
                cur_frame.addEvent = _that.addEvent;
 
            }
 
        }
 
    },
 

 
    //////////////////////////////////////
 
    //              API                 //
 
    //////////////////////////////////////
 
    _that = {
 
        /*
 
         * Calls a function to act upon the player.
 
         *
 
         * @param functionName (String): Name of the Javascript API function to call. Eg: "api_play".
 
         * @param params (Array): List of parameters to pass when calling above function.
 
         */
 
        api: function( functionName, params )
 
        {
 
            postMessage( functionName, params, this );
 
        },
 
        
 
        get: function(functionName, callback )
 
        {
 
            var target_id = this.id != '' ? this.id : null;
 
            storeCallback(functionName, callback, target_id);
 
            
 
            postMessage( functionName, null, this );
 
        },
 

 
        /*
 
         * Registers an event listener and a callback function that gets called when the event fires.
 
         *
 
         * @param eventName (String): Name of the event to listen for.
 
         * @param callback (Function): Function that should be called when the event fires.
 
         * @param target (HTML Element): Reference to the <iframe> containing the player. Optional if a
 
         * target has been set by the Froogaloop.setTarget method.
 
         */
 
        addEvent: function( eventName, callback )
 
        {
 
            var target_id = this.id != '' ? this.id : null;
 
            storeCallback(eventName, callback, target_id);
 

 
            //The onLoad event is not passed to the SWF
 
            if(eventName != 'onLoad') {
 
                postMessage( 'api_addEventListener', [eventName, callback.name], this );
 
            }
 

 
            //Register message event listeners
 
            if( _this.hasWindowEvent ) {return false;}
 
            _this.PLAYER_DOMAIN = _utils.getDomainFromUrl(this.getAttribute('src'));
 

 
            // Listens for the message event.
 
            //W3C
 
            if( window.addEventListener ) {
 
                window.addEventListener('message', onMessageReceived, false);
 
            }
 
            //IE
 
            else {
 
                window.attachEvent('onmessage', onMessageReceived, false);
 
            }
 

 
            _this.hasWindowEvent = true;
 
        }
 
    },
 

 
    //////////////////////////////////////
 
    //    INTERNAL MESSAGE HANDLERS     //
 
    //    Do not wander down here.      //
 
    //    Thar be monsters.             //
 
    //////////////////////////////////////
 

 
    /**
 
     * Handles posting a message to the parent window.
 
     *
 
     * @param method (String): name of the method to call inside the player. For api calls
 
     * this is the name of the api method (api_play or api_pause) while for events this method
 
     * is api_addEventListener.
 
     * @param params (Object or Array): List of parameters to submit to the method. Can be either
 
     * a single param or an array list of parameters.
 
     * @param target (HTMLElement): Target iframe to post the message to.
 
     */
 
    postMessage = function( method, params, target )
 
    {
 
        if(!target.contentWindow.postMessage) {return false;}
 

 
        if( params === undefined || params === null ){ params = ''; }
 
        var
 
        url = target.getAttribute('src').split('?')[0],
 
        p = _utils.serialize({
 
            'method': method,
 
            'params': params,
 
            'id'    : target.getAttribute('id')
 
        });
 

 
        target.contentWindow.postMessage(p, url);
 
    },
 

 
    /**
 
     * Stores submitted callbacks for each iframe being tracked and each
 
     * event for that iframe.
 
     *
 
     * @param eventName (String): Name of the event. Eg. api_onPlay
 
     * @param callback (Function): Function that should get executed when the
 
     * event is fired.
 
     * @param target_id (String) [Optional]: If handling more than one iframe then
 
     * it stores the different callbacks for different iframes based on the iframe's
 
     * id.
 
     */
 
    storeCallback = function(eventName, callback, target_id)
 
    {
 
        
 
        if(target_id) {
 
            if(!_this.eventCallbacks[target_id]){ _this.eventCallbacks[target_id] = {}; }
 
            _this.eventCallbacks[target_id][eventName] = callback;
 
        }
 
        else {
 
            _this.eventCallbacks[eventName] = callback;
 
        }
 
    },
 

 
    /**
 
     * Retrieves stored callbacks.
 
     */
 
    getCallback = function(eventName, target_id)
 
    {
 
        
 
        if(target_id) {
 
            return _this.eventCallbacks[target_id][eventName];
 
        }
 
        else {
 
            return _this.eventCallbacks[eventName];
 
        }
 
    },
 

 
    /**
 
     * Event that fires whenever the window receives a message from its parent
 
     * via window.postMessage.
 
     */
 
    onMessageReceived = function(event)
 
    {
 
        // Handles messages from moogaloop only
 
        if(event.origin != _this.PLAYER_DOMAIN) {return false;}
 

 
        // Un-serialize the data and turn it into an object,
 
        // then send it to the message handler
 
                if (window.hasOwnProperty('onVimeoMessageReceived')) {
 
                        window.onVimeoMessageReceived(event);
 
                }
 
        onMoogEvent( _utils.unserialize(event.data) );
 
    },
 

 
    onMoogEvent = function(data)
 
    {
 
        var
 
        params = data.params ? data.params.split('"').join('').split(",") : "",
 
        eventName = data.method,
 
        target_id = params[params.length-1]; 
 
        if(target_id == ''){ target_id = null; }
 
        
 
        var callback = getCallback(eventName, target_id);
 
        if(!callback) return false;
 

 
        if(params.length > 0 ) callback.apply(null, params);
 
        else callback.call();
 
    },
 

 

 

 
    //////////////////////////////////////
 
    //        UTILITY FUNCTIONS         //
 
    //////////////////////////////////////
 
    _utils = {
 
        r20: /%20/g,
 

 
        isArray: function(obj)
 
        {
 
            return Object.prototype.toString.call(obj) === "[object Array]";
 
        },
 

 
        isFunction: function(obj)
 
        {
 
            return Object.prototype.toString.call(obj) === "[object Function]";
 
        },
 

 
        unserialize: function(str)
 
        {
 
            if(!str) {return false;}
 

 
            var vars = {},
 
            arr = str.split("&"),
 
            key, value,
 
            i = 0;
 

 
            for(i; i<arr.length; i++) {
 
                key = unescape(arr[i].split("=")[0]);
 
                value = unescape(arr[i].split("=")[1]);
 

 
                //recursively unserialize
 
                if( value.indexOf("=") > -1 ) {value = _utils.unserialize(value);}
 

 
                vars[key] = value;
 
            }
 

 
            return vars;
 
        },
 

 
        // Serialize an array of form elements or a set of
 
        // key/values into a query string
 
        // Shamelessly stolen and modified from jQuery 1.4 http://jquery.com
 
        s: false,
 
        serialize: function( a )
 
        {
 
            _utils.s = [];
 

 
            for ( var prefix in a )
 
            {
 
                _utils.buildParams( prefix, a[prefix] );
 
            }
 

 
            // Return the resulting serialization
 
            return _utils.s.join("&").replace(_utils.r20, "+");
 
        },
 

 
        buildParams: function( prefix, obj )
 
        {
 
            var v, i=0, k=0;
 
            if ( _utils.isArray(obj) )
 
            {
 
                // Serialize array item.
 
                for( i; i<obj.length; i++ )
 
                {
 
                    obj[i] = encodeURIComponent( obj[i] );
 
                }
 
                _utils.addToParam( encodeURIComponent(prefix), obj.join(',') );
 
            }
 
            else {
 
                // Serialize scalar item.
 
                _utils.addToParam( encodeURIComponent(prefix), encodeURIComponent(obj) );
 
            }
 
        },
 

 
        addToParam: function( key, value ) {
 
            // If value is a function, invoke it and return its value
 
            value = _utils.isFunction(value) ? value() : value;
 
            _utils.s[ _utils.s.length ] = key + "=" + value;
 
        },
 

 
        /**
 
         * Returns a domain's root domain.
 
         * Eg. returns http://vimeo.com when http://vimeo.com/channels is sbumitted
 
         *
 
         * @param url (String): Url to test against.
 
         * @return url (String): Root domain of submitted url
 
         */
 
        getDomainFromUrl: function(url)
 
        {
 
            var url_pieces = url.split('/'),
 
            domain_str = '',
 
            i = 0;
 

 
            for(i; i<url_pieces.length; i++)
 
            {
 
                if(i<3) {domain_str += url_pieces[i];}
 
                else {break;}
 
                if( i<2 ) {domain_str += '/';}
 
            }
 

 
            return domain_str;
 
        }
 
    }
 
    ;//end of Methods list
 
    
 
    init();
 
    return {
 
        init: init
 
    };
 
}();
 


!function(e){function t(){var e=location.href;return hashtag=-1!==e.indexOf("#prettyPhoto")?decodeURI(e.substring(e.indexOf("#prettyPhoto")+1,e.length)):!1,hashtag&&(hashtag=hashtag.replace(/<|>/g,"")),hashtag}function i(){"undefined"!=typeof theRel&&(location.hash=theRel+"/"+rel_index+"/")}function p(){-1!==location.href.indexOf("#prettyPhoto")&&(location.hash="prettyPhoto")}function o(e,t){e=e.replace(/[\[]/,"\\[").replace(/[\]]/,"\\]");var i="[\\?&]"+e+"=([^&#]*)",p=new RegExp(i),o=p.exec(t);return null==o?"":o[1]}e.prettyPhoto={version:"3.1.6"},e.fn.prettyPhoto=function(a){function s(){e(".pp_loaderIcon").hide(),projectedTop=scroll_pos.scrollTop+(I/2-f.containerHeight/2),projectedTop<0&&(projectedTop=0),$ppt.fadeTo(settings.animation_speed,1),$pp_pic_holder.find(".pp_content").animate({height:f.contentHeight,width:f.contentWidth},settings.animation_speed),$pp_pic_holder.animate({top:projectedTop,left:j/2-f.containerWidth/2<0?0:j/2-f.containerWidth/2,width:f.containerWidth},settings.animation_speed,function(){$pp_pic_holder.find(".pp_hoverContainer,#fullResImage").height(f.height).width(f.width),$pp_pic_holder.find(".pp_fade").fadeIn(settings.animation_speed),isSet&&"image"==h(pp_images[set_position])?$pp_pic_holder.find(".pp_hoverContainer").show():$pp_pic_holder.find(".pp_hoverContainer").hide(),settings.allow_expand&&(f.resized?e("a.pp_expand,a.pp_contract").show():e("a.pp_expand").hide()),!settings.autoplay_slideshow||P||v||e.prettyPhoto.startSlideshow(),settings.changepicturecallback(),v=!0}),m(),a.ajaxcallback()}function n(t){$pp_pic_holder.find("#pp_full_res object,#pp_full_res embed").css("visibility","hidden"),$pp_pic_holder.find(".pp_fade").fadeOut(settings.animation_speed,function(){e(".pp_loaderIcon").show(),t()})}function r(t){t>1?e(".pp_nav").show():e(".pp_nav").hide()}function l(e,t){if(resized=!1,d(e,t),imageWidth=e,imageHeight=t,(k>j||b>I)&&doresize&&settings.allow_resize&&!$){for(resized=!0,fitting=!1;!fitting;)k>j?(imageWidth=j-200,imageHeight=t/e*imageWidth):b>I?(imageHeight=I-200,imageWidth=e/t*imageHeight):fitting=!0,b=imageHeight,k=imageWidth;(k>j||b>I)&&l(k,b),d(imageWidth,imageHeight)}return{width:Math.floor(imageWidth),height:Math.floor(imageHeight),containerHeight:Math.floor(b),containerWidth:Math.floor(k)+2*settings.horizontal_padding,contentHeight:Math.floor(y),contentWidth:Math.floor(w),resized:resized}}function d(t,i){t=parseFloat(t),i=parseFloat(i),$pp_details=$pp_pic_holder.find(".pp_details"),$pp_details.width(t),detailsHeight=parseFloat($pp_details.css("marginTop"))+parseFloat($pp_details.css("marginBottom")),$pp_details=$pp_details.clone().addClass(settings.theme).width(t).appendTo(e("body")).css({position:"absolute",top:-1e4}),detailsHeight+=$pp_details.height(),detailsHeight=detailsHeight<=34?36:detailsHeight,$pp_details.remove(),$pp_title=$pp_pic_holder.find(".ppt"),$pp_title.width(t),titleHeight=parseFloat($pp_title.css("marginTop"))+parseFloat($pp_title.css("marginBottom")),$pp_title=$pp_title.clone().appendTo(e("body")).css({position:"absolute",top:-1e4}),titleHeight+=$pp_title.height(),$pp_title.remove(),y=i+detailsHeight,w=t,b=y+titleHeight+$pp_pic_holder.find(".pp_top").height()+$pp_pic_holder.find(".pp_bottom").height(),k=t}function h(e){return e.match(/youtube\.com\/watch/i)||e.match(/youtu\.be/i)?"youtube":e.match(/vimeo\.com/i)?"vimeo":e.match(/\b.mov\b/i)?"quicktime":e.match(/\b.swf\b/i)?"flash":e.match(/\biframe=true\b/i)?"iframe":e.match(/\bajax=true\b/i)?"ajax":e.match(/\bcustom=true\b/i)?"custom":"#"==e.substr(0,1)?"inline":"image"}function c(){if(doresize&&"undefined"!=typeof $pp_pic_holder){if(scroll_pos=_(),contentHeight=$pp_pic_holder.height(),contentwidth=$pp_pic_holder.width(),projectedTop=I/2+scroll_pos.scrollTop-contentHeight/2,projectedTop<0&&(projectedTop=0),contentHeight>I)return;$pp_pic_holder.css({top:projectedTop,left:j/2+scroll_pos.scrollLeft-contentwidth/2})}}function _(){return self.pageYOffset?{scrollTop:self.pageYOffset,scrollLeft:self.pageXOffset}:document.documentElement&&document.documentElement.scrollTop?{scrollTop:document.documentElement.scrollTop,scrollLeft:document.documentElement.scrollLeft}:document.body?{scrollTop:document.body.scrollTop,scrollLeft:document.body.scrollLeft}:void 0}function g(){I=e(window).height(),j=e(window).width(),"undefined"!=typeof $pp_overlay&&$pp_overlay.height(e(document).height()).width(j)}function m(){isSet&&settings.overlay_gallery&&"image"==h(pp_images[set_position])?(itemWidth=57,navWidth="facebook"==settings.theme||"pp_default"==settings.theme?50:30,itemsPerPage=Math.floor((f.containerWidth-100-navWidth)/itemWidth),itemsPerPage=itemsPerPage<pp_images.length?itemsPerPage:pp_images.length,totalPage=Math.ceil(pp_images.length/itemsPerPage)-1,0==totalPage?(navWidth=0,$pp_gallery.find(".pp_arrow_next,.pp_arrow_previous").hide()):$pp_gallery.find(".pp_arrow_next,.pp_arrow_previous").show(),galleryWidth=itemsPerPage*itemWidth,fullGalleryWidth=pp_images.length*itemWidth,$pp_gallery.css("margin-left",-(galleryWidth/2+navWidth/2)).find("div:first").width(galleryWidth+5).find("ul").width(fullGalleryWidth).find("li.selected").removeClass("selected"),goToPage=Math.floor(set_position/itemsPerPage)<totalPage?Math.floor(set_position/itemsPerPage):totalPage,e.prettyPhoto.changeGalleryPage(goToPage),$pp_gallery_li.filter(":eq("+set_position+")").addClass("selected")):$pp_pic_holder.find(".pp_content").unbind("mouseenter mouseleave")}function u(){if(settings.social_tools&&(facebook_like_link=settings.social_tools.replace("{location_href}",encodeURIComponent(location.href))),settings.markup=settings.markup.replace("{pp_social}",""),e("body").append(settings.markup),$pp_pic_holder=e(".pp_pic_holder"),$ppt=e(".ppt"),$pp_overlay=e("div.pp_overlay"),isSet&&settings.overlay_gallery){currentGalleryPage=0,toInject="";for(var t=0;t<pp_images.length;t++)pp_images[t].match(/\b(jpg|jpeg|png|gif)\b/gi)?(classname="",img_src=pp_images[t]):(classname="default",img_src=""),toInject+="<li class='"+classname+"'><a href='#'><img src='"+img_src+"' width='50' alt='' /></a></li>";toInject=settings.gallery_markup.replace(/{gallery}/g,toInject),$pp_pic_holder.find("#pp_full_res").after(toInject),$pp_gallery=e(".pp_pic_holder .pp_gallery"),$pp_gallery_li=$pp_gallery.find("li"),$pp_gallery.find(".pp_arrow_next").click(function(){return e.prettyPhoto.changeGalleryPage("next"),e.prettyPhoto.stopSlideshow(),!1}),$pp_gallery.find(".pp_arrow_previous").click(function(){return e.prettyPhoto.changeGalleryPage("previous"),e.prettyPhoto.stopSlideshow(),!1}),$pp_pic_holder.find(".pp_content").hover(function(){$pp_pic_holder.find(".pp_gallery:not(.disabled)").fadeIn()},function(){$pp_pic_holder.find(".pp_gallery:not(.disabled)").fadeOut()}),itemWidth=57,$pp_gallery_li.each(function(t){e(this).find("a").click(function(){return e.prettyPhoto.changePage(t),e.prettyPhoto.stopSlideshow(),!1})})}settings.slideshow&&($pp_pic_holder.find(".pp_nav").prepend('<a href="#" class="pp_play">Play</a>'),$pp_pic_holder.find(".pp_nav .pp_play").click(function(){return e.prettyPhoto.startSlideshow(),!1})),$pp_pic_holder.attr("class","pp_pic_holder "+settings.theme),$pp_overlay.css({opacity:0,height:e(document).height(),width:e(window).width()}).bind("click",function(){settings.modal||e.prettyPhoto.close()}),e("a.pp_close").bind("click",function(){return e.prettyPhoto.close(),!1}),settings.allow_expand&&e("a.pp_expand").bind("click",function(){return e(this).hasClass("pp_expand")?(e(this).removeClass("pp_expand").addClass("pp_contract"),doresize=!1):(e(this).removeClass("pp_contract").addClass("pp_expand"),doresize=!0),n(function(){e.prettyPhoto.open()}),!1}),$pp_pic_holder.find(".pp_previous, .pp_nav .pp_arrow_previous").bind("click",function(){return e.prettyPhoto.changePage("previous"),e.prettyPhoto.stopSlideshow(),!1}),$pp_pic_holder.find(".pp_next, .pp_nav .pp_arrow_next").bind("click",function(){return e.prettyPhoto.changePage("next"),e.prettyPhoto.stopSlideshow(),!1}),c()}a=jQuery.extend({hook:"rel",animation_speed:"fast",ajaxcallback:function(){},slideshow:5e3,autoplay_slideshow:!1,opacity:.8,show_title:!0,allow_resize:!0,allow_expand:!0,default_width:500,default_height:344,counter_separator_label:"/",theme:"pp_default",horizontal_padding:20,hideflash:!1,wmode:"opaque",autoplay:!0,modal:!1,deeplinking:!0,overlay_gallery:!0,overlay_gallery_max:30,keyboard_shortcuts:!0,changepicturecallback:function(){},callback:function(){},ie6_fallback:!0,markup:'<div class="pp_pic_holder"> 						<div class="ppt">&nbsp;</div> 						<div class="pp_top"> 							<div class="pp_left"></div> 							<div class="pp_middle"></div> 							<div class="pp_right"></div> 						</div> 						<div class="pp_content_container"> 							<div class="pp_left"> 							<div class="pp_right"> 								<div class="pp_content"> 									<div class="pp_loaderIcon"></div> 									<div class="pp_fade"> 										<a href="#" class="pp_expand" title="Expand the image">Expand</a> 										<div class="pp_hoverContainer"> 											<a class="pp_next" href="#">next</a> 											<a class="pp_previous" href="#">previous</a> 										</div> 										<div id="pp_full_res"></div> 										<div class="pp_details"> 											<div class="pp_nav"> 												<a href="#" class="pp_arrow_previous">Previous</a> 												<p class="currentTextHolder">0/0</p> 												<a href="#" class="pp_arrow_next">Next</a> 											</div> 											<p class="pp_description"></p> 											<div class="pp_social">{pp_social}</div> 											<a class="pp_close" href="#">Close</a> 										</div> 									</div> 								</div> 							</div> 							</div> 						</div> 						<div class="pp_bottom"> 							<div class="pp_left"></div> 							<div class="pp_middle"></div> 							<div class="pp_right"></div> 						</div> 					</div> 					<div class="pp_overlay"></div>',gallery_markup:'<div class="pp_gallery"> 								<a href="#" class="pp_arrow_previous">Previous</a> 								<div> 									<ul> 										{gallery} 									</ul> 								</div> 								<a href="#" class="pp_arrow_next">Next</a> 							</div>',image_markup:'<img id="fullResImage" src="{path}" />',flash_markup:'<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{width}" height="{height}"><param name="wmode" value="{wmode}" /><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="{path}" /><embed src="{path}" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="{width}" height="{height}" wmode="{wmode}"></embed></object>',quicktime_markup:'<object classid="clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B" codebase="http://www.apple.com/qtactivex/qtplugin.cab" height="{height}" width="{width}"><param name="src" value="{path}"><param name="autoplay" value="{autoplay}"><param name="type" value="video/quicktime"><embed src="{path}" height="{height}" width="{width}" autoplay="{autoplay}" type="video/quicktime" pluginspage="http://www.apple.com/quicktime/download/"></embed></object>',iframe_markup:'<iframe src ="{path}" width="{width}" height="{height}" frameborder="no"></iframe>',inline_markup:'<div class="pp_inline">{content}</div>',custom_markup:"",social_tools:'<div class="twitter"><a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div><div class="facebook"><iframe src="//www.facebook.com/plugins/like.php?locale=en_US&href={location_href}&layout=button_count&show_faces=true&width=500&action=like&font&colorscheme=light&height=23" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:500px; height:23px;" allowTransparency="true"></iframe></div>'},a);var f,v,y,w,b,k,P,x=this,$=!1,I=e(window).height(),j=e(window).width();return doresize=!0,scroll_pos=_(),e(window).unbind("resize.prettyphoto").bind("resize.prettyphoto",function(){c(),g()}),a.keyboard_shortcuts&&e(document).unbind("keydown.prettyphoto").bind("keydown.prettyphoto",function(t){if("undefined"!=typeof $pp_pic_holder&&$pp_pic_holder.is(":visible"))switch(t.keyCode){case 37:e.prettyPhoto.changePage("previous"),t.preventDefault();break;case 39:e.prettyPhoto.changePage("next"),t.preventDefault();break;case 27:settings.modal||e.prettyPhoto.close(),t.preventDefault()}}),e.prettyPhoto.initialize=function(){return settings=a,"pp_default"==settings.theme&&(settings.horizontal_padding=16),theRel=e(this).attr(settings.hook),galleryRegExp=/\[(?:.*)\]/,isSet=galleryRegExp.exec(theRel)?!0:!1,pp_images=isSet?jQuery.map(x,function(t){return-1!=e(t).attr(settings.hook).indexOf(theRel)?e(t).attr("href"):void 0}):e.makeArray(e(this).attr("href")),pp_titles=isSet?jQuery.map(x,function(t){return-1!=e(t).attr(settings.hook).indexOf(theRel)?e(t).find("img").attr("alt")?e(t).find("img").attr("alt"):"":void 0}):e.makeArray(e(this).find("img").attr("alt")),pp_descriptions=isSet?jQuery.map(x,function(t){return-1!=e(t).attr(settings.hook).indexOf(theRel)?e(t).attr("title")?e(t).attr("title"):"":void 0}):e.makeArray(e(this).attr("title")),pp_images.length>settings.overlay_gallery_max&&(settings.overlay_gallery=!1),set_position=jQuery.inArray(e(this).attr("href"),pp_images),rel_index=isSet?set_position:e("a["+settings.hook+"^='"+theRel+"']").index(e(this)),u(this),settings.allow_resize&&e(window).bind("scroll.prettyphoto",function(){c()}),e.prettyPhoto.open(),!1},e.prettyPhoto.open=function(t){return"undefined"==typeof settings&&(settings=a,pp_images=e.makeArray(arguments[0]),pp_titles=e.makeArray(arguments[1]?arguments[1]:""),pp_descriptions=e.makeArray(arguments[2]?arguments[2]:""),isSet=pp_images.length>1?!0:!1,set_position=arguments[3]?arguments[3]:0,u(t.target)),settings.hideflash&&e("object,embed,iframe[src*=youtube],iframe[src*=vimeo]").css("visibility","hidden"),r(e(pp_images).size()),e(".pp_loaderIcon").show(),settings.deeplinking&&i(),settings.social_tools&&(facebook_like_link=settings.social_tools.replace("{location_href}",encodeURIComponent(location.href)),$pp_pic_holder.find(".pp_social").html(facebook_like_link)),$ppt.is(":hidden")&&$ppt.css("opacity",0).show(),$pp_overlay.show().fadeTo(settings.animation_speed,settings.opacity),$pp_pic_holder.find(".currentTextHolder").text(set_position+1+settings.counter_separator_label+e(pp_images).size()),"undefined"!=typeof pp_descriptions[set_position]&&""!=pp_descriptions[set_position]?$pp_pic_holder.find(".pp_description").show().html(unescape(pp_descriptions[set_position])):$pp_pic_holder.find(".pp_description").hide(),movie_width=parseFloat(o("width",pp_images[set_position]))?o("width",pp_images[set_position]):settings.default_width.toString(),movie_height=parseFloat(o("height",pp_images[set_position]))?o("height",pp_images[set_position]):settings.default_height.toString(),$=!1,-1!=movie_height.indexOf("%")&&(movie_height=parseFloat(e(window).height()*parseFloat(movie_height)/100-150),$=!0),-1!=movie_width.indexOf("%")&&(movie_width=parseFloat(e(window).width()*parseFloat(movie_width)/100-150),$=!0),$pp_pic_holder.fadeIn(function(){switch($ppt.html(settings.show_title&&""!=pp_titles[set_position]&&"undefined"!=typeof pp_titles[set_position]?unescape(pp_titles[set_position]):"&nbsp;"),imgPreloader="",skipInjection=!1,h(pp_images[set_position])){case"image":imgPreloader=new Image,nextImage=new Image,isSet&&set_position<e(pp_images).size()-1&&(nextImage.src=pp_images[set_position+1]),prevImage=new Image,isSet&&pp_images[set_position-1]&&(prevImage.src=pp_images[set_position-1]),$pp_pic_holder.find("#pp_full_res")[0].innerHTML=settings.image_markup.replace(/{path}/g,pp_images[set_position]),imgPreloader.onload=function(){f=l(imgPreloader.width,imgPreloader.height),s()},imgPreloader.onerror=function(){alert("Image cannot be loaded. Make sure the path is correct and image exist."),e.prettyPhoto.close()},imgPreloader.src=pp_images[set_position];break;case"youtube":f=l(movie_width,movie_height),movie_id=o("v",pp_images[set_position]),""==movie_id&&(movie_id=pp_images[set_position].split("youtu.be/"),movie_id=movie_id[1],movie_id.indexOf("?")>0&&(movie_id=movie_id.substr(0,movie_id.indexOf("?"))),movie_id.indexOf("&")>0&&(movie_id=movie_id.substr(0,movie_id.indexOf("&")))),movie="http://www.youtube.com/embed/"+movie_id,movie+=o("rel",pp_images[set_position])?"?rel="+o("rel",pp_images[set_position]):"?rel=1",settings.autoplay&&(movie+="&autoplay=1"),toInject=settings.iframe_markup.replace(/{width}/g,f.width).replace(/{height}/g,f.height).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,movie);break;case"vimeo":f=l(movie_width,movie_height),movie_id=pp_images[set_position];var t=/http(s?):\/\/(www\.)?vimeo.com\/(\d+)/,i=movie_id.match(t);movie="http://player.vimeo.com/video/"+i[3]+"?title=0&byline=0&portrait=0",settings.autoplay&&(movie+="&autoplay=1;"),vimeo_width=f.width+"/embed/?moog_width="+f.width,toInject=settings.iframe_markup.replace(/{width}/g,vimeo_width).replace(/{height}/g,f.height).replace(/{path}/g,movie);break;case"quicktime":f=l(movie_width,movie_height),f.height+=15,f.contentHeight+=15,f.containerHeight+=15,toInject=settings.quicktime_markup.replace(/{width}/g,f.width).replace(/{height}/g,f.height).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,pp_images[set_position]).replace(/{autoplay}/g,settings.autoplay);break;case"flash":f=l(movie_width,movie_height),flash_vars=pp_images[set_position],flash_vars=flash_vars.substring(pp_images[set_position].indexOf("flashvars")+10,pp_images[set_position].length),filename=pp_images[set_position],filename=filename.substring(0,filename.indexOf("?")),toInject=settings.flash_markup.replace(/{width}/g,f.width).replace(/{height}/g,f.height).replace(/{wmode}/g,settings.wmode).replace(/{path}/g,filename+"?"+flash_vars);break;case"iframe":f=l(movie_width,movie_height),frame_url=pp_images[set_position],frame_url=frame_url.substr(0,frame_url.indexOf("iframe")-1),toInject=settings.iframe_markup.replace(/{width}/g,f.width).replace(/{height}/g,f.height).replace(/{path}/g,frame_url);break;case"ajax":doresize=!1,f=l(movie_width,movie_height),doresize=!0,skipInjection=!0,e.get(pp_images[set_position],function(e){toInject=settings.inline_markup.replace(/{content}/g,e),$pp_pic_holder.find("#pp_full_res")[0].innerHTML=toInject,s()});break;case"custom":f=l(movie_width,movie_height),toInject=settings.custom_markup;break;case"inline":myClone=e(pp_images[set_position]).clone().append('<br clear="all" />').css({width:settings.default_width}).wrapInner('<div id="pp_full_res"><div class="pp_inline"></div></div>').appendTo(e("body")).show(),doresize=!1,f=l(e(myClone).width(),e(myClone).height()),doresize=!0,e(myClone).remove(),toInject=settings.inline_markup.replace(/{content}/g,e(pp_images[set_position]).html())}imgPreloader||skipInjection||($pp_pic_holder.find("#pp_full_res")[0].innerHTML=toInject,s())}),!1},e.prettyPhoto.changePage=function(t){currentGalleryPage=0,"previous"==t?(set_position--,set_position<0&&(set_position=e(pp_images).size()-1)):"next"==t?(set_position++,set_position>e(pp_images).size()-1&&(set_position=0)):set_position=t,rel_index=set_position,doresize||(doresize=!0),settings.allow_expand&&e(".pp_contract").removeClass("pp_contract").addClass("pp_expand"),n(function(){e.prettyPhoto.open()})},e.prettyPhoto.changeGalleryPage=function(e){"next"==e?(currentGalleryPage++,currentGalleryPage>totalPage&&(currentGalleryPage=0)):"previous"==e?(currentGalleryPage--,currentGalleryPage<0&&(currentGalleryPage=totalPage)):currentGalleryPage=e,slide_speed="next"==e||"previous"==e?settings.animation_speed:0,slide_to=currentGalleryPage*itemsPerPage*itemWidth,$pp_gallery.find("ul").animate({left:-slide_to},slide_speed)},e.prettyPhoto.startSlideshow=function(){"undefined"==typeof P?($pp_pic_holder.find(".pp_play").unbind("click").removeClass("pp_play").addClass("pp_pause").click(function(){return e.prettyPhoto.stopSlideshow(),!1}),P=setInterval(e.prettyPhoto.startSlideshow,settings.slideshow)):e.prettyPhoto.changePage("next")},e.prettyPhoto.stopSlideshow=function(){$pp_pic_holder.find(".pp_pause").unbind("click").removeClass("pp_pause").addClass("pp_play").click(function(){return e.prettyPhoto.startSlideshow(),!1}),clearInterval(P),P=void 0},e.prettyPhoto.close=function(){$pp_overlay.is(":animated")||(e.prettyPhoto.stopSlideshow(),$pp_pic_holder.stop().find("object,embed").css("visibility","hidden"),e("div.pp_pic_holder,div.ppt,.pp_fade").fadeOut(settings.animation_speed,function(){e(this).remove()}),$pp_overlay.fadeOut(settings.animation_speed,function(){settings.hideflash&&e("object,embed,iframe[src*=youtube],iframe[src*=vimeo]").css("visibility","visible"),e(this).remove(),e(window).unbind("scroll.prettyphoto"),p(),settings.callback(),doresize=!0,v=!1,delete settings}))},!pp_alreadyInitialized&&t()&&(pp_alreadyInitialized=!0,hashIndex=t(),hashRel=hashIndex,hashIndex=hashIndex.substring(hashIndex.indexOf("/")+1,hashIndex.length-1),hashRel=hashRel.substring(0,hashRel.indexOf("/")),setTimeout(function(){e("a["+a.hook+"^='"+hashRel+"']:eq("+hashIndex+")").trigger("click")},50)),this.unbind("click.prettyphoto").bind("click.prettyphoto",e.prettyPhoto.initialize)}}(jQuery);var pp_alreadyInitialized=!1;

//YTB Player
var ytp = ytp || {};

function onYouTubePlayerAPIReady() {
	if(ytp.YTAPIReady)
		return;

	ytp.YTAPIReady=true;
	jQuery(document).trigger("YTAPIReady");
}

(function (jQuery, ytp) {

	ytp.isDevice = 'ontouchstart' in window;

	/*Browser detection patch*/
	var nAgt = navigator.userAgent;
	if (!jQuery.browser) {
		jQuery.browser = {};
		jQuery.browser.mozilla = !1;
		jQuery.browser.webkit = !1;
		jQuery.browser.opera = !1;
		jQuery.browser.safari = !1;
		jQuery.browser.chrome = !1;
		jQuery.browser.msie = !1;
		jQuery.browser.ua = nAgt;
		jQuery.browser.name = navigator.appName;
		jQuery.browser.fullVersion = "" + parseFloat(navigator.appVersion);
		jQuery.browser.majorVersion = parseInt(navigator.appVersion, 10);
		var nameOffset, verOffset, ix;
		if (-1 != (verOffset = nAgt.indexOf("Opera")))jQuery.browser.opera = !0, jQuery.browser.name = "Opera", jQuery.browser.fullVersion = nAgt.substring(verOffset + 6), -1 != (verOffset = nAgt.indexOf("Version")) && (jQuery.browser.fullVersion = nAgt.substring(verOffset + 8)); else if (-1 != (verOffset = nAgt.indexOf("MSIE")))jQuery.browser.msie = !0, jQuery.browser.name = "Microsoft Internet Explorer", jQuery.browser.fullVersion = nAgt.substring(verOffset + 5); else if (-1 != nAgt.indexOf("Trident")) {
			jQuery.browser.msie = !0;
			jQuery.browser.name = "Microsoft Internet Explorer";
			var start = nAgt.indexOf("rv:") + 3, end = start + 4;
			jQuery.browser.fullVersion = nAgt.substring(start, end)
		} else-1 != (verOffset = nAgt.indexOf("Chrome")) ? (jQuery.browser.webkit = !0, jQuery.browser.chrome = !0, jQuery.browser.name = "Chrome", jQuery.browser.fullVersion = nAgt.substring(verOffset + 7)) : -1 != (verOffset = nAgt.indexOf("Safari")) ? (jQuery.browser.webkit = !0, jQuery.browser.safari = !0, jQuery.browser.name = "Safari", jQuery.browser.fullVersion = nAgt.substring(verOffset + 7), -1 != (verOffset = nAgt.indexOf("Version")) && (jQuery.browser.fullVersion = nAgt.substring(verOffset + 8))) : -1 != (verOffset = nAgt.indexOf("AppleWebkit")) ? (jQuery.browser.webkit = !0, jQuery.browser.name = "Safari", jQuery.browser.fullVersion = nAgt.substring(verOffset + 7), -1 != (verOffset = nAgt.indexOf("Version")) && (jQuery.browser.fullVersion = nAgt.substring(verOffset + 8))) : -1 != (verOffset = nAgt.indexOf("Firefox")) ? (jQuery.browser.mozilla = !0, jQuery.browser.name = "Firefox", jQuery.browser.fullVersion = nAgt.substring(verOffset + 8)) : (nameOffset = nAgt.lastIndexOf(" ") + 1) < (verOffset = nAgt.lastIndexOf("/")) && (jQuery.browser.name = nAgt.substring(nameOffset, verOffset), jQuery.browser.fullVersion = nAgt.substring(verOffset + 1), jQuery.browser.name.toLowerCase() == jQuery.browser.name.toUpperCase() && (jQuery.browser.name = navigator.appName));
		-1 != (ix = jQuery.browser.fullVersion.indexOf(";")) && (jQuery.browser.fullVersion = jQuery.browser.fullVersion.substring(0, ix));
		-1 != (ix = jQuery.browser.fullVersion.indexOf(" ")) && (jQuery.browser.fullVersion = jQuery.browser.fullVersion.substring(0, ix));
		jQuery.browser.majorVersion = parseInt("" + jQuery.browser.fullVersion, 10);
		isNaN(jQuery.browser.majorVersion) && (jQuery.browser.fullVersion = "" + parseFloat(navigator.appVersion), jQuery.browser.majorVersion = parseInt(navigator.appVersion, 10));
		jQuery.browser.version = jQuery.browser.majorVersion
	}
	jQuery.browser.android = /Android/i.test(nAgt);
	jQuery.browser.blackberry = /BlackBerry/i.test(nAgt);
	jQuery.browser.ios = /iPhone|iPad|iPod/i.test(nAgt);
	jQuery.browser.operaMobile = /Opera Mini/i.test(nAgt);
	jQuery.browser.windowsMobile = /IEMobile/i.test(nAgt);
	jQuery.browser.mobile = jQuery.browser.android || jQuery.browser.blackberry || jQuery.browser.ios || jQuery.browser.windowsMobile || jQuery.browser.operaMobile;

	/*******************************************************************************
	 * jQuery.mb.components: jquery.mb.CSSAnimate
	 ******************************************************************************/

	jQuery.fn.CSSAnimate=function(a,b,c,d,e){function f(a){return a.replace(/([A-Z])/g,function(a){return"-"+a.toLowerCase()})}function g(a,b){return"string"!=typeof a||a.match(/^[\-0-9\.]+$/)?""+a+b:a}return jQuery.support.transition=function(){var a=document.body||document.documentElement,b=a.style;return void 0!==b.transition||void 0!==b.WebkitTransition||void 0!==b.MozTransition||void 0!==b.MsTransition||void 0!==b.OTransition}(),this.each(function(){var h=this,i=jQuery(this);h.id=h.id||"CSSA_"+(new Date).getTime();var j=j||{type:"noEvent"};if(h.CSSAIsRunning&&h.eventType==j.type)return h.CSSqueue=function(){i.CSSAnimate(a,b,c,d,e)},void 0;if(h.CSSqueue=null,h.eventType=j.type,0!==i.length&&a){if(h.CSSAIsRunning=!0,"function"==typeof b&&(e=b,b=jQuery.fx.speeds._default),"function"==typeof c&&(e=c,c=0),"function"==typeof d&&(e=d,d="cubic-bezier(0.65,0.03,0.36,0.72)"),"string"==typeof b)for(var k in jQuery.fx.speeds){if(b==k){b=jQuery.fx.speeds[k];break}b=jQuery.fx.speeds._default}if(b||(b=jQuery.fx.speeds._default),!jQuery.support.transition){for(var l in a)"transform"===l&&delete a[l],"filter"===l&&delete a[l],"transform-origin"===l&&delete a[l],"auto"===a[l]&&delete a[l];return e&&"string"!=typeof e||(e="linear"),i.animate(a,b,e),void 0}var m={"default":"ease","in":"ease-in",out:"ease-out","in-out":"ease-in-out",snap:"cubic-bezier(0,1,.5,1)",easeOutCubic:"cubic-bezier(.215,.61,.355,1)",easeInOutCubic:"cubic-bezier(.645,.045,.355,1)",easeInCirc:"cubic-bezier(.6,.04,.98,.335)",easeOutCirc:"cubic-bezier(.075,.82,.165,1)",easeInOutCirc:"cubic-bezier(.785,.135,.15,.86)",easeInExpo:"cubic-bezier(.95,.05,.795,.035)",easeOutExpo:"cubic-bezier(.19,1,.22,1)",easeInOutExpo:"cubic-bezier(1,0,0,1)",easeInQuad:"cubic-bezier(.55,.085,.68,.53)",easeOutQuad:"cubic-bezier(.25,.46,.45,.94)",easeInOutQuad:"cubic-bezier(.455,.03,.515,.955)",easeInQuart:"cubic-bezier(.895,.03,.685,.22)",easeOutQuart:"cubic-bezier(.165,.84,.44,1)",easeInOutQuart:"cubic-bezier(.77,0,.175,1)",easeInQuint:"cubic-bezier(.755,.05,.855,.06)",easeOutQuint:"cubic-bezier(.23,1,.32,1)",easeInOutQuint:"cubic-bezier(.86,0,.07,1)",easeInSine:"cubic-bezier(.47,0,.745,.715)",easeOutSine:"cubic-bezier(.39,.575,.565,1)",easeInOutSine:"cubic-bezier(.445,.05,.55,.95)",easeInBack:"cubic-bezier(.6,-.28,.735,.045)",easeOutBack:"cubic-bezier(.175, .885,.32,1.275)",easeInOutBack:"cubic-bezier(.68,-.55,.265,1.55)"};m[d]&&(d=m[d]);var n="",o="transitionEnd";jQuery.browser.webkit?(n="-webkit-",o="webkitTransitionEnd"):jQuery.browser.mozilla?(n="-moz-",o="transitionend"):jQuery.browser.opera?(n="-o-",o="otransitionend"):jQuery.browser.msie&&(n="-ms-",o="msTransitionEnd");var p=[];for(var l in a){var q=l;"transform"===q&&(q=n+"transform",a[q]=a[l],delete a[l]),"filter"===q&&(q=n+"filter",a[q]=a[l],delete a[l]),("transform-origin"===q||"origin"===q)&&(q=n+"transform-origin",a[q]=a[l],delete a[l]),"x"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" translateX("+g(a[l],"px")+")",delete a[l]),"y"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" translateY("+g(a[l],"px")+")",delete a[l]),"z"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" translateZ("+g(a[l],"px")+")",delete a[l]),"rotate"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" rotate("+g(a[l],"deg")+")",delete a[l]),"rotateX"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" rotateX("+g(a[l],"deg")+")",delete a[l]),"rotateY"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" rotateY("+g(a[l],"deg")+")",delete a[l]),"rotateZ"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" rotateZ("+g(a[l],"deg")+")",delete a[l]),"scale"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" scale("+g(a[l],"")+")",delete a[l]),"scaleX"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" scaleX("+g(a[l],"")+")",delete a[l]),"scaleY"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" scaleY("+g(a[l],"")+")",delete a[l]),"scaleZ"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" scaleZ("+g(a[l],"")+")",delete a[l]),"skew"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" skew("+g(a[l],"deg")+")",delete a[l]),"skewX"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" skewX("+g(a[l],"deg")+")",delete a[l]),"skewY"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" skewY("+g(a[l],"deg")+")",delete a[l]),"perspective"===q&&(q=n+"transform",a[q]=a[q]||"",a[q]+=" perspective("+g(a[l],"px")+")",delete a[l]),p.indexOf(q)<0&&p.push(f(q))}var r=p.join(","),s=function(){i.off(o+"."+h.id),clearTimeout(h.timeout),i.css(n+"transition",""),"function"==typeof e&&e(i),h.called=!0,h.CSSAIsRunning=!1,"function"==typeof h.CSSqueue&&(h.CSSqueue(),h.CSSqueue=null)},t={};jQuery.extend(t,a),t[n+"transition-property"]=r,t[n+"transition-duration"]=b+"ms",t[n+"transition-delay"]=c+"ms",t[n+"transition-style"]="preserve-3d",t[n+"transition-timing-function"]=d,setTimeout(function(){i.one(o+"."+h.id,s),i.css(t)},1),h.timeout=setTimeout(function(){return i.called||!e?(i.called=!1,h.CSSAIsRunning=!1,void 0):(i.css(n+"transition",""),e(i),h.CSSAIsRunning=!1,"function"==typeof h.CSSqueue&&(h.CSSqueue(),h.CSSqueue=null),void 0)},b+c+100)}})},jQuery.fn.css3=function(a){return this.each(function(){jQuery(this).CSSAnimate(a,1,0,null)})};

	var getYTPVideoID=function(url){
		var movieURL;
		if(url.substr(0,16)=="http://youtu.be/"){
			movieURL= url.replace("http://youtu.be/","");
		}else if(url.indexOf("http")>-1){
			movieURL = url.match(/[\\?&]v=([^&#]*)/)[1];
		}else{
			movieURL = url
		}
		return movieURL;
	};


	jQuery.mbYTPlayer = {
		name            : "jquery.mb.YTPlayer",
		version         : "2.7.0",
		author          : "Matteo Bicocchi",
		defaults        : {
			containment            : "body",
			ratio                  : "16/9",
			videoURL               : null,
			startAt                : 0,
			stopAt                 : 0,
			autoPlay               : true,
			vol                    : 100, // 1 to 100
			addRaster              : false,
			opacity                : 1,
			quality                : "default", //or “small”, “medium”, “large”, “hd720”, “hd1080”, “highres”
			mute                   : false,
			loop                   : true,
			showControls           : true,
			showAnnotations        : false,
			showYTLogo             : true,
			stopMovieOnClick       : false,
			realfullscreen         : true,
			gaTrack                : true,
			onReady                : function (player) {},
			onStateChange          : function (player) {},
			onPlaybackQualityChange: function (player) {},
			onError                : function (player) {}
		},

		/*@fontface icons*/
		controls        : {
			play    : "P",
			pause   : "p",
			mute    : "M",
			unmute  : "A",
			onlyYT  : "O",
			showSite: "R",
			ytLogo  : "Y"
		},
		rasterImg       : "images/raster.png",
		rasterImgRetina : "images/raster@2x.png",
		locationProtocol: "https:",

		buildPlayer: function (options) {
			return this.each(function () {
				var YTPlayer = this;
				var $YTPlayer = jQuery(YTPlayer);

				YTPlayer.loop = 0;
				YTPlayer.opt = {};

				$YTPlayer.addClass("mb_YTVPlayer");

				var property = $YTPlayer.data("property") && typeof $YTPlayer.data("property") == "string" ? eval('(' + $YTPlayer.data("property") + ')') : $YTPlayer.data("property");

				if(typeof property.vol != "undefined")
					property.vol = property.vol == 0 ? property.vol = 1: property.vol;

				jQuery.extend(YTPlayer.opt, jQuery.mbYTPlayer.defaults, options, property);

				var canGoFullscreen = !(jQuery.browser.msie || jQuery.browser.opera || self.location.href != top.location.href);

				if (!canGoFullscreen)
					YTPlayer.opt.realfullscreen = false;

				if (!$YTPlayer.attr("id"))
					$YTPlayer.attr("id", "YTP_" + new Date().getTime());

				YTPlayer.opt.id = YTPlayer.id;
				YTPlayer.isAlone = false;

				var playerID = "mbYTP_" + YTPlayer.id;
				var videoID = this.opt.videoURL ? getYTPVideoID(this.opt.videoURL) : $YTPlayer.attr("href") ? getYTPVideoID($YTPlayer.attr("href")) : false;
				YTPlayer.videoID = videoID;

				YTPlayer.opt.showAnnotations = (YTPlayer.opt.showAnnotations) ? '0' : '3';
				var playerVars = { 'autoplay': 0, 'modestbranding': 1, 'controls': 0, 'showinfo': 0, 'rel': 0, 'enablejsapi': 1, 'version': 3, 'playerapiid': playerID, 'origin': '*', 'allowfullscreen': true, 'wmode': 'transparent', 'iv_load_policy': YTPlayer.opt.showAnnotations};

				var canPlayHTML5 = false;
				var v = document.createElement('video');
				if (v.canPlayType) {
					canPlayHTML5 = true;
				}

				if (canPlayHTML5)
					jQuery.extend(playerVars, {'html5': 1});

				if (jQuery.browser.msie && jQuery.browser.version < 9) {
					this.opt.opacity = 1;
				}

				var playerBox = jQuery("<div/>").attr("id", playerID).addClass("playerBox");
				var overlay = jQuery("<div/>").css({position: "absolute", top: 0, left: 0, width: "100%", height: "100%"}).addClass("YTPOverlay"); //YTPlayer.isBackground ? "fixed" :

				YTPlayer.isSelf = YTPlayer.opt.containment == "self";
				YTPlayer.opt.containment = YTPlayer.opt.containment == "self" ? jQuery(this) : jQuery(YTPlayer.opt.containment);
				YTPlayer.isBackground = YTPlayer.opt.containment.get(0).tagName.toLowerCase() == "body";

				if (YTPlayer.isBackground && ytp.backgroundIsInited)
					return;

				if (!YTPlayer.opt.containment.is(jQuery(this))) {
					$YTPlayer.hide();
				} else {
					YTPlayer.isPlayer = true;
				}

				if (ytp.isDevice && YTPlayer.isBackground) {
					$YTPlayer.remove();
					return;
				}

				if (YTPlayer.opt.addRaster) {
					var retina = (window.retina || window.devicePixelRatio > 1);
					overlay.addClass(retina ? "raster retina" : "raster");
				} else {
					overlay.removeClass("raster retina");
				}

				var wrapper = jQuery("<div/>").addClass("mbYTP_wrapper").attr("id", "wrapper_" + playerID);
				wrapper.css({position: "absolute", zIndex: 0, minWidth: "100%", minHeight: "100%", left: 0, top: 0, overflow: "hidden", opacity: 0});
				playerBox.css({position: "absolute", zIndex: 0, width: "100%", height: "100%", top: 0, left: 0, overflow: "hidden", opacity: this.opt.opacity});
				wrapper.append(playerBox);


				YTPlayer.opt.containment.children().not("script, style").each(function () {
					if (jQuery(this).css("position") == "static")
						jQuery(this).css("position", "relative");
				});

				if (YTPlayer.isBackground) {
					jQuery("body").css({position: "relative", minWidth: "100%", minHeight: "100%", zIndex: 1, boxSizing: "border-box"});
					wrapper.css({position: "fixed", top: 0, left: 0, zIndex: 0});
					$YTPlayer.hide();
					YTPlayer.opt.containment.prepend(wrapper);
				} else {

					if (YTPlayer.opt.containment.css("position") == "static")
						YTPlayer.opt.containment.css({position: "relative"});

					YTPlayer.opt.containment.prepend(wrapper);
				}

				YTPlayer.wrapper = wrapper;

				playerBox.css({opacity: 1});

				if (!ytp.isDevice) {
					playerBox.after(overlay);
					YTPlayer.overlay = overlay;
				}

				if (!YTPlayer.isBackground) {
					overlay.on("mouseenter", function () {
						$YTPlayer.find(".mb_YTVPBar").addClass("visible");
					}).on("mouseleave", function () {
						$YTPlayer.find(".mb_YTVPBar").removeClass("visible");
					})
				}

				if (!ytp.YTAPIReady) {

					jQuery("#YTAPI").remove();
					var tag = jQuery("<script></script>").attr({"src": jQuery.mbYTPlayer.locationProtocol + "//www.youtube.com/player_api?v=" + jQuery.mbYTPlayer.version, "id": "YTAPI"});
					jQuery("head title").after(tag);

				} else {

					setTimeout(function () {
						jQuery(document).trigger("YTAPIReady");
					}, 100)

				}

				jQuery(document).on("YTAPIReady", function () {

					if ((YTPlayer.isBackground && ytp.backgroundIsInited) || YTPlayer.isInit)
						return;

					if (YTPlayer.isBackground && YTPlayer.opt.stopMovieOnClick)
						jQuery(document).off("mousedown.ytplayer").on("mousedown,.ytplayer", function (e) {
							var target = jQuery(e.target);
							if (target.is("a") || target.parents().is("a")) {
								$YTPlayer.pauseYTP();
							}
						});

					if (YTPlayer.isBackground){
						ytp.backgroundIsInited = true;

					}

					YTPlayer.opt.autoPlay = typeof YTPlayer.opt.autoPlay == "undefined" ? (YTPlayer.isBackground ? true : false) : YTPlayer.opt.autoPlay;

					YTPlayer.opt.vol = YTPlayer.opt.vol ? YTPlayer.opt.vol : 100;

					jQuery.mbYTPlayer.getDataFromFeed(YTPlayer.videoID, YTPlayer);

					jQuery(YTPlayer).on("YTPChanged", function () {

						if (YTPlayer.isInit)
							return;

						YTPlayer.isInit = true;


						if (ytp.isDevice && !YTPlayer.isBackground) {
							new YT.Player(playerID, {
								videoId: YTPlayer.videoID.toString(),
								height : '100%',
								width  : '100%',
								videoId: YTPlayer.videoID,
								events : {
									'onReady'      : function (event) {
										YTPlayer.player = event.target;
										playerBox.css({opacity: 1});
										YTPlayer.wrapper.css({opacity: 1});
										$YTPlayer.optimizeDisplay();
									},
									'onStateChange': function () {}
								}
							});
							return;
						}

						new YT.Player(playerID, {
							videoId   : YTPlayer.videoID.toString(),
							playerVars: playerVars,
							events    : {
								'onReady': function (event) {

									YTPlayer.player = event.target;

									if (YTPlayer.isReady)
										return;

									YTPlayer.isReady = true;

									YTPlayer.playerEl = YTPlayer.player.getIframe();
									$YTPlayer.optimizeDisplay();

									YTPlayer.videoID = videoID;

									jQuery(window).on("resize.YTP", function () {
										$YTPlayer.optimizeDisplay();
									});

									if (YTPlayer.opt.showControls)
										jQuery(YTPlayer).buildYTPControls();

									var startAt = YTPlayer.opt.startAt ? YTPlayer.opt.startAt : 1;

									YTPlayer.player.stopVideo();
									jQuery.mbYTPlayer.checkForState(YTPlayer);

									YTPlayer.checkForStartAt = setInterval(function () {

										YTPlayer.player.seekTo(startAt, true);

										if (YTPlayer.player.getCurrentTime() >= startAt && YTPlayer.player.getDuration() > 0) {

											YTPlayer.player.setVolume(0);

											jQuery(YTPlayer).muteYTPVolume();

											YTPlayer.player.pauseVideo();

											clearInterval(YTPlayer.checkForStartAt);

											if (typeof YTPlayer.opt.onReady == "function")
												YTPlayer.opt.onReady($YTPlayer);

											if (YTPlayer.opt.autoPlay)
												$YTPlayer.playYTP();

											setTimeout(function () {

												if (YTPlayer.opt.autoPlay)
													$YTPlayer.playYTP();
												else
													YTPlayer.player.pauseVideo();

												if (!YTPlayer.opt.mute)
													jQuery(YTPlayer).unmuteYTPVolume();

												$YTPlayer.css("background-image", "none");
												YTPlayer.wrapper.CSSAnimate({opacity: YTPlayer.isAlone ? 1 : YTPlayer.opt.opacity}, 2000);
											}, 1000);

											jQuery.mbYTPlayer.checkForState(YTPlayer);
										}
									}, 100);
								},

								'onStateChange'          : function (event) {

									/*
									 -1 (unstarted)
									 0 (ended)
									 1 (playing)
									 2 (paused)
									 3 (buffering)
									 5 (video cued).
									 */

									if (typeof event.target.getPlayerState != "function")
										return;
									var state = event.target.getPlayerState();

									if (typeof YTPlayer.opt.onStateChange == "function")
										YTPlayer.opt.onStateChange($YTPlayer, state);

									var controls = jQuery("#controlBar_" + YTPlayer.id);

									var data = YTPlayer.opt;
//------------------------------------------------------------------ ended
									if (state == 0) {
										if (YTPlayer.state == state)
											return;

										YTPlayer.state = state;
										YTPlayer.player.pauseVideo();
										var startAt = YTPlayer.opt.startAt ? YTPlayer.opt.startAt : 1;

										if (data.loop) {
											YTPlayer.wrapper.css({opacity: 0});
											$YTPlayer.playYTP();
											YTPlayer.player.seekTo(startAt, true);

										} else if (!YTPlayer.isBackground) {
											YTPlayer.player.seekTo(startAt, true);
											$YTPlayer.playYTP();
											setTimeout(function () {
												$YTPlayer.pauseYTP();
											}, 10);
										}

										if (!data.loop && YTPlayer.isBackground)
											YTPlayer.wrapper.CSSAnimate({opacity: 0}, 2000);
										else if (data.loop) {
											YTPlayer.wrapper.css({opacity: 0});
											YTPlayer.loop++;
										}

										controls.find(".mb_YTVPPlaypause").html(jQuery.mbYTPlayer.controls.play);
										jQuery(YTPlayer).trigger("YTPEnd");
									}
//------------------------------------------------------------------ buffering
									if (state == 3) {
										if (YTPlayer.state == state)
											return;

										YTPlayer.state = state;
										YTPlayer.player.setPlaybackQuality(YTPlayer.opt.quality);
										controls.find(".mb_YTVPPlaypause").html(jQuery.mbYTPlayer.controls.play);
										jQuery(YTPlayer).trigger("YTPBuffering");
									}
//------------------------------------------------------------------ unstarted
									if (state == -1) {
										if (YTPlayer.state == state)
											return;
										YTPlayer.state = state;

										YTPlayer.wrapper.css({opacity: 0});

										jQuery(YTPlayer).trigger("YTPUnstarted");
									}
//------------------------------------------------------------------ playing
									if (state == 1) {
										if (YTPlayer.state == state)
											return;
										YTPlayer.state = state;
/*

										if (YTPlayer.opt.mute) {
											$YTPlayer.muteYTPVolume();
											YTPlayer.opt.mute = false;
										}
*/

										YTPlayer.player.setPlaybackQuality(YTPlayer.opt.quality);

										controls.find(".mb_YTVPPlaypause").html(jQuery.mbYTPlayer.controls.pause);

										jQuery(YTPlayer).trigger("YTPStart");

										if (typeof _gaq != "undefined" && eval(YTPlayer.opt.gaTrack))
											_gaq.push(['_trackEvent', 'YTPlayer', 'Play', (YTPlayer.title || YTPlayer.videoID.toString())]);

										if (typeof ga != "undefined" && eval(YTPlayer.opt.gaTrack))
											ga('send', 'event', 'YTPlayer', 'play', (YTPlayer.title || YTPlayer.videoID.toString()));
									}
//------------------------------------------------------------------ paused
									if (state == 2) {
										if (YTPlayer.state == state)
											return;
										YTPlayer.state = state;
										controls.find(".mb_YTVPPlaypause").html(jQuery.mbYTPlayer.controls.play);
										jQuery(YTPlayer).trigger("YTPPause");
									}

								},
								'onPlaybackQualityChange': function (e) {
									if (typeof YTPlayer.opt.onPlaybackQualityChange == "function")
										YTPlayer.opt.onPlaybackQualityChange($YTPlayer);
								},
								'onError'                : function (err) {

									if (err.data == 2 && YTPlayer.isPlayList)
										jQuery(YTPlayer).playNext();

									if (typeof YTPlayer.opt.onError == "function")
										YTPlayer.opt.onError($YTPlayer, err);
								}
							}
						});
					});
				})
			});
		},

		getDataFromFeed: function (videoID, YTPlayer) {
			//Get video info from FEEDS API

			YTPlayer.videoID = videoID;
			if (!jQuery.browser.msie) { //!(jQuery.browser.msie && jQuery.browser.version<9)

				jQuery.getJSON(jQuery.mbYTPlayer.locationProtocol + '//gdata.youtube.com/feeds/api/videos/' + videoID + '?v=2&alt=jsonc', function (data, status, xhr) {

					YTPlayer.dataReceived = true;

					var videoData = data.data;

					YTPlayer.title = videoData.title;
					YTPlayer.videoData = videoData;

					if (YTPlayer.opt.ratio == "auto")
						if (videoData.aspectRatio && videoData.aspectRatio === "widescreen")
							YTPlayer.opt.ratio = "16/9";
						else
							YTPlayer.opt.ratio = "4/3";

					if (!YTPlayer.hasData) {
						YTPlayer.hasData = true;

						if (YTPlayer.isPlayer) {
							var bgndURL = YTPlayer.videoData.thumbnail.hqDefault;
							YTPlayer.opt.containment.css({background: "rgba(0,0,0,0.5) url(" + bgndURL + ") center center", backgroundSize: "cover"});
						}
					}
					jQuery(YTPlayer).trigger("YTPChanged");

				});

				setTimeout(function () {
					if (!YTPlayer.dataReceived && !YTPlayer.hasData) {
						YTPlayer.hasData = true;
						jQuery(YTPlayer).trigger("YTPChanged");
					}
				}, 1500)

			} else {
				YTPlayer.opt.ratio == "auto" ? YTPlayer.opt.ratio = "16/9" : YTPlayer.opt.ratio;

				if (!YTPlayer.hasData) {
					YTPlayer.hasData = true;
					setTimeout(function () {
						jQuery(YTPlayer).trigger("YTPChanged");
					}, 100)
				}
			}
		},

		getVideoID: function () {
			var YTPlayer = this.get(0);
			return YTPlayer.videoID || false;
		},

		setVideoQuality: function (quality) {
			var YTPlayer = this.get(0);
			YTPlayer.player.setPlaybackQuality(quality);
		},

		YTPlaylist: function (videos, shuffle, callback) {
			var YTPlayer = this.get(0);

			YTPlayer.isPlayList = true;

			if (shuffle)
				videos = jQuery.shuffle(videos);

			if (!YTPlayer.videoID) {
				YTPlayer.videos = videos;
				YTPlayer.videoCounter = 0;
				YTPlayer.videoLength = videos.length;

				jQuery(YTPlayer).data("property", videos[0]);
				jQuery(YTPlayer).mb_YTPlayer();
			}

			if (typeof callback == "function")
				jQuery(YTPlayer).on("YTPChanged", function () {
					callback(YTPlayer);
				});

			jQuery(YTPlayer).on("YTPEnd", function () {
				jQuery(YTPlayer).playNext();
			});
		},

		playNext: function () {
			var YTPlayer = this.get(0);
			YTPlayer.videoCounter++;
			if (YTPlayer.videoCounter >= YTPlayer.videoLength)
				YTPlayer.videoCounter = 0;
			jQuery(YTPlayer.playerEl).css({opacity: 0});
			jQuery(YTPlayer).changeMovie(YTPlayer.videos[YTPlayer.videoCounter]);
		},

		playPrev: function () {
			var YTPlayer = this.get(0);
			YTPlayer.videoCounter--;
			if (YTPlayer.videoCounter < 0)
				YTPlayer.videoCounter = YTPlayer.videoLength - 1;
			jQuery(YTPlayer.playerEl).css({opacity: 0});
			jQuery(YTPlayer).changeMovie(YTPlayer.videos[YTPlayer.videoCounter]);
		},

		changeMovie: function (opt) {
			var YTPlayer = this.get(0);

			YTPlayer.opt.startAt = 0;
			YTPlayer.opt.stopAt = 0;
			YTPlayer.opt.mute = true;

			if (opt) {
				jQuery.extend(YTPlayer.opt, opt);
			}

			YTPlayer.videoID = getYTPVideoID(YTPlayer.opt.videoURL);

			jQuery(YTPlayer).pauseYTP();
			var timer = jQuery.browser.msie ? 1000 : 0;
			jQuery(YTPlayer.playerEl).CSSAnimate({opacity: 0}, timer);


			setTimeout(function () {
				jQuery(YTPlayer).getPlayer().cueVideoByUrl(encodeURI(jQuery.mbYTPlayer.locationProtocol + "//www.youtube.com/v/" + YTPlayer.videoID), 1, YTPlayer.opt.quality);

				jQuery(YTPlayer).playYTP();


				jQuery(YTPlayer).one("YTPStart", function () {
					YTPlayer.wrapper.CSSAnimate({opacity: YTPlayer.isAlone ? 1 : YTPlayer.opt.opacity}, 1000);
					jQuery(YTPlayer.playerEl).CSSAnimate({opacity: 1}, timer);

					if (YTPlayer.opt.startAt) {
						YTPlayer.player.seekTo(YTPlayer.opt.startAt);
					}
					jQuery.mbYTPlayer.checkForState(YTPlayer);

					if(!YTPlayer.opt.autoPlay)
						jQuery(YTPlayer).pauseYTP();

				});



				if (YTPlayer.opt.mute) {
					jQuery(YTPlayer).muteYTPVolume();
				} else {
					jQuery(YTPlayer).unmuteYTPVolume();
				}

			}, timer);

			if (YTPlayer.opt.addRaster) {
				var retina = (window.retina || window.devicePixelRatio > 1);
				YTPlayer.overlay.addClass(retina ? "raster retina" : "raster");
			} else {
				YTPlayer.overlay.removeClass("raster");
				YTPlayer.overlay.removeClass("retina");
			}

			jQuery("#controlBar_" + YTPlayer.id).remove();

			if (YTPlayer.opt.showControls)
				jQuery(YTPlayer).buildYTPControls();

			jQuery.mbYTPlayer.getDataFromFeed(YTPlayer.videoID, YTPlayer);
			jQuery(YTPlayer).optimizeDisplay();
		},

		getPlayer: function () {
			return jQuery(this).get(0).player;
		},

		playerDestroy: function () {
			var YTPlayer = this.get(0);
			ytp.YTAPIReady = false;
			ytp.backgroundIsInited = false;
			YTPlayer.isInit = false;
			YTPlayer.videoID = null;

			var playerBox = YTPlayer.wrapper;
			playerBox.remove();
			jQuery("#controlBar_" + YTPlayer.id).remove();
		},

		fullscreen: function (real) {

			var YTPlayer = this.get(0);

			if (typeof real == "undefined")
				real = YTPlayer.opt.realfullscreen;

			real = eval(real);

			var controls = jQuery("#controlBar_" + YTPlayer.id);
			var fullScreenBtn = controls.find(".mb_OnlyYT");
			var videoWrapper = YTPlayer.isSelf ? YTPlayer.opt.containment : YTPlayer.wrapper;
			//var videoWrapper = YTPlayer.wrapper;

			if (real) {
				var fullscreenchange = jQuery.browser.mozilla ? "mozfullscreenchange" : jQuery.browser.webkit ? "webkitfullscreenchange" : "fullscreenchange";
				jQuery(document).off(fullscreenchange).on(fullscreenchange, function () {
					var isFullScreen = RunPrefixMethod(document, "IsFullScreen") || RunPrefixMethod(document, "FullScreen");

					if (!isFullScreen) {
						YTPlayer.isAlone = false;
						fullScreenBtn.html(jQuery.mbYTPlayer.controls.onlyYT);
						jQuery(YTPlayer).setVideoQuality(YTPlayer.opt.quality);
						videoWrapper.removeClass("fullscreen");

						videoWrapper.CSSAnimate({opacity: YTPlayer.opt.opacity}, 500);
						videoWrapper.css({zIndex: 0});

						if (YTPlayer.isBackground) {
							jQuery("body").after(controls);
						} else {
							YTPlayer.wrapper.before(controls);
						}
						jQuery(window).resize();
						jQuery(YTPlayer).trigger("YTPFullScreenEnd");

					} else {
						jQuery(YTPlayer).setVideoQuality("default");
						jQuery(YTPlayer).trigger("YTPFullScreenStart");
					}
				});
			}

			if (!YTPlayer.isAlone) {

				if (real) {

					var playerState = YTPlayer.player.getPlayerState();
					videoWrapper.css({opacity: 0});
					videoWrapper.addClass("fullscreen");
					launchFullscreen(videoWrapper.get(0));
					setTimeout(function () {
						videoWrapper.CSSAnimate({opacity: 1}, 1000);
						YTPlayer.wrapper.append(controls);
						jQuery(YTPlayer).optimizeDisplay();

						YTPlayer.player.seekTo(YTPlayer.player.getCurrentTime() + .1, true);
					}, 500)
				} else
					videoWrapper.css({zIndex: 10000}).CSSAnimate({opacity: 1}, 1000);


				fullScreenBtn.html(jQuery.mbYTPlayer.controls.showSite);
				YTPlayer.isAlone = true;

			} else {

				if (real) {
					cancelFullscreen();
				} else {
					videoWrapper.CSSAnimate({opacity: YTPlayer.opt.opacity}, 500);
					videoWrapper.css({zIndex: 0});
				}


				fullScreenBtn.html(jQuery.mbYTPlayer.controls.onlyYT)
				YTPlayer.isAlone = false;
			}

			function RunPrefixMethod(obj, method) {
				var pfx = ["webkit", "moz", "ms", "o", ""];
				var p = 0, m, t;
				while (p < pfx.length && !obj[m]) {
					m = method;
					if (pfx[p] == "") {
						m = m.substr(0, 1).toLowerCase() + m.substr(1);
					}
					m = pfx[p] + m;
					t = typeof obj[m];
					if (t != "undefined") {
						pfx = [pfx[p]];
						return (t == "function" ? obj[m]() : obj[m]);
					}
					p++;
				}
			}

			function launchFullscreen(element) {
				RunPrefixMethod(element, "RequestFullScreen");
			}

			function cancelFullscreen() {
				if (RunPrefixMethod(document, "FullScreen") || RunPrefixMethod(document, "IsFullScreen")) {
					RunPrefixMethod(document, "CancelFullScreen");
				}
			}
		},

		playYTP: function () {
			var YTPlayer = this.get(0);

			if (typeof YTPlayer.player === "undefined")
				return;

			var controls = jQuery("#controlBar_" + YTPlayer.id);
			var playBtn = controls.find(".mb_YTVPPlaypause");
			playBtn.html(jQuery.mbYTPlayer.controls.pause);
			YTPlayer.player.playVideo();

			YTPlayer.wrapper.CSSAnimate({opacity: YTPlayer.isAlone ? 1 : YTPlayer.opt.opacity}, 2000);
			jQuery(YTPlayer).on("YTPStart", function () {
				jQuery(YTPlayer).css("background-image", "none");
			})
		},

		toggleLoops: function () {
			var YTPlayer = this.get(0);
			var data = YTPlayer.opt;
			if (data.loop == 1) {
				data.loop = 0;
			} else {
				if (data.startAt) {
					YTPlayer.player.seekTo(data.startAt);
				} else {
					YTPlayer.player.playVideo();
				}
				data.loop = 1;
			}
		},

		stopYTP: function () {
			var YTPlayer = this.get(0);
			var controls = jQuery("#controlBar_" + YTPlayer.id);
			var playBtn = controls.find(".mb_YTVPPlaypause");
			playBtn.html(jQuery.mbYTPlayer.controls.play);
			YTPlayer.player.stopVideo();
		},

		pauseYTP: function () {
			var YTPlayer = this.get(0);
			var data = YTPlayer.opt;
			var controls = jQuery("#controlBar_" + YTPlayer.id);
			var playBtn = controls.find(".mb_YTVPPlaypause");
			playBtn.html(jQuery.mbYTPlayer.controls.play);
			YTPlayer.player.pauseVideo();
		},

		seekToYTP: function (val) {
			var YTPlayer = this.get(0);
			YTPlayer.player.seekTo(val, true);
		},

		setYTPVolume: function (val) {
			var YTPlayer = this.get(0);
			if (!val && !YTPlayer.opt.vol && YTPlayer.player.getVolume() == 0)
				jQuery(YTPlayer).unmuteYTPVolume();
			else if ((!val && YTPlayer.player.getVolume() > 0) || (val && YTPlayer.player.getVolume() == val))
				jQuery(YTPlayer).muteYTPVolume();
			else
				YTPlayer.opt.vol = val;
			YTPlayer.player.setVolume(YTPlayer.opt.vol);
		},

		muteYTPVolume: function () {
			var YTPlayer = this.get(0);
			YTPlayer.player.mute();
			YTPlayer.player.setVolume(0);

			var controls = jQuery("#controlBar_" + YTPlayer.id);
			var muteBtn = controls.find(".mb_YTVPMuteUnmute");
			muteBtn.html(jQuery.mbYTPlayer.controls.unmute);
			jQuery(YTPlayer).addClass("isMuted");
			jQuery(YTPlayer).trigger("YTPMuted");
		},

		unmuteYTPVolume: function () {
			var YTPlayer = this.get(0);

			YTPlayer.player.unMute();
			YTPlayer.player.setVolume(YTPlayer.opt.vol);

			var controls = jQuery("#controlBar_" + YTPlayer.id);
			var muteBtn = controls.find(".mb_YTVPMuteUnmute");
			muteBtn.html(jQuery.mbYTPlayer.controls.mute);

			jQuery(YTPlayer).removeClass("isMuted");
			jQuery(YTPlayer).trigger("YTPUnmuted");

		},

		manageYTPProgress: function () {

			var YTPlayer = this.get(0);
			var controls = jQuery("#controlBar_" + YTPlayer.id);
			var progressBar = controls.find(".mb_YTVPProgress");
			var loadedBar = controls.find(".mb_YTVPLoaded");
			var timeBar = controls.find(".mb_YTVTime");
			var totW = progressBar.outerWidth();

			var currentTime = Math.floor(YTPlayer.player.getCurrentTime());
			var totalTime = Math.floor(YTPlayer.player.getDuration());
			var timeW = (currentTime * totW) / totalTime;
			var startLeft = 0;

			var loadedW = YTPlayer.player.getVideoLoadedFraction() * 100;

			loadedBar.css({left: startLeft, width: loadedW + "%"});
			timeBar.css({left: 0, width: timeW});
			return {totalTime: totalTime, currentTime: currentTime};
		},

		buildYTPControls: function () {
			var YTPlayer = this.get(0);
			var data = YTPlayer.opt;

			/** @data.printUrl is deprecated; use data.showYTLogo */
			data.showYTLogo = data.showYTLogo || data.printUrl;

			if (jQuery("#controlBar_" + YTPlayer.id).length)
				return;

			var controlBar = jQuery("<span/>").attr("id", "controlBar_" + YTPlayer.id).addClass("mb_YTVPBar").css({whiteSpace: "noWrap", position: YTPlayer.isBackground ? "fixed" : "absolute", zIndex: YTPlayer.isBackground ? 10000 : 1000}).hide();
			var buttonBar = jQuery("<div/>").addClass("buttonBar");

			var playpause = jQuery("<span>" + jQuery.mbYTPlayer.controls.play + "</span>").addClass("mb_YTVPPlaypause ytpicon").click(function () {
				if (YTPlayer.player.getPlayerState() == 1)
					jQuery(YTPlayer).pauseYTP();
				else
					jQuery(YTPlayer).playYTP();
			});

			var MuteUnmute = jQuery("<span>" + jQuery.mbYTPlayer.controls.mute + "</span>").addClass("mb_YTVPMuteUnmute ytpicon").click(function () {
				if (YTPlayer.player.getVolume() == 0) {
					jQuery(YTPlayer).unmuteYTPVolume();
				} else {
					jQuery(YTPlayer).muteYTPVolume();
				}
			});

			var idx = jQuery("<span/>").addClass("mb_YTVPTime");

			var vURL = data.videoURL;
			if (vURL.indexOf("http") < 0)
				vURL = jQuery.mbYTPlayer.locationProtocol + "//www.youtube.com/watch?v=" + data.videoURL;
			var movieUrl = jQuery("<span/>").html(jQuery.mbYTPlayer.controls.ytLogo).addClass("mb_YTVPUrl ytpicon").attr("title", "view on YouTube").on("click", function () {window.open(vURL, "viewOnYT")});
			var onlyVideo = jQuery("<span/>").html(jQuery.mbYTPlayer.controls.onlyYT).addClass("mb_OnlyYT ytpicon").on("click", function () {jQuery(YTPlayer).fullscreen(data.realfullscreen);});

			var progressBar = jQuery("<div/>").addClass("mb_YTVPProgress").css("position", "absolute").click(function (e) {
				timeBar.css({width: (e.clientX - timeBar.offset().left)});
				YTPlayer.timeW = e.clientX - timeBar.offset().left;
				controlBar.find(".mb_YTVPLoaded").css({width: 0});
				var totalTime = Math.floor(YTPlayer.player.getDuration());
				YTPlayer.goto = (timeBar.outerWidth() * totalTime) / progressBar.outerWidth();

				YTPlayer.player.seekTo(parseFloat(YTPlayer.goto), true);
				controlBar.find(".mb_YTVPLoaded").css({width: 0});
			});

			var loadedBar = jQuery("<div/>").addClass("mb_YTVPLoaded").css("position", "absolute");
			var timeBar = jQuery("<div/>").addClass("mb_YTVTime").css("position", "absolute");

			progressBar.append(loadedBar).append(timeBar);
			buttonBar.append(playpause).append(MuteUnmute).append(idx);

			if (data.showYTLogo) {
				buttonBar.append(movieUrl);
			}

			if (YTPlayer.isBackground || (eval(YTPlayer.opt.realfullscreen) && !YTPlayer.isBackground))
				buttonBar.append(onlyVideo);

			controlBar.append(buttonBar).append(progressBar);

			if (!YTPlayer.isBackground) {
				controlBar.addClass("inlinePlayer");
				YTPlayer.wrapper.before(controlBar);
			} else {
				jQuery("body").after(controlBar);
			}
			controlBar.fadeIn();
		},

		checkForState: function (YTPlayer) {
			clearInterval(YTPlayer.getState);
			YTPlayer.getState = setInterval(function () {
				var prog = jQuery(YTPlayer).manageYTPProgress();
				var $YTPlayer = jQuery(YTPlayer);
				var controlBar = jQuery("#controlBar_" + YTPlayer.id);
				var data = YTPlayer.opt;
				var startAt = YTPlayer.opt.startAt ? YTPlayer.opt.startAt : 1;
				var stopAt = YTPlayer.opt.stopAt > YTPlayer.opt.startAt ? YTPlayer.opt.stopAt : 0;
				stopAt = stopAt < YTPlayer.player.getDuration() ? stopAt : 0;

				if (YTPlayer.player.getVolume() == 0)
					$YTPlayer.addClass("isMuted");
				else
					$YTPlayer.removeClass("isMuted");

				if (prog.totalTime) {
					controlBar.find(".mb_YTVPTime").html(jQuery.mbYTPlayer.formatTime(prog.currentTime) + " / " + jQuery.mbYTPlayer.formatTime(prog.totalTime));
				} else {
//					clearInterval(YTPlayer.getState);
					controlBar.find(".mb_YTVPTime").html("-- : -- / -- : --");
				}

				if (YTPlayer.player.getPlayerState() == 1 && (parseFloat(YTPlayer.player.getDuration() - 3) < YTPlayer.player.getCurrentTime() || (stopAt > 0 && parseFloat(YTPlayer.player.getCurrentTime()) > stopAt))) {

					if(YTPlayer.isEnded)
						return;

					YTPlayer.isEnded = true;
					setTimeout(function(){YTPlayer.isEnded = false},2000);

					if (YTPlayer.isPlayList) {
						clearInterval(YTPlayer.getState);
						jQuery(YTPlayer).trigger("YTPEnd");
						return;
					} else if (!data.loop) {
						YTPlayer.player.pauseVideo();
						YTPlayer.wrapper.CSSAnimate({opacity: 0}, 1000, function () {
							jQuery(YTPlayer).trigger("YTPEnd");
							YTPlayer.player.seekTo(startAt, true);

							if (!YTPlayer.isBackground) {
								var bgndURL = YTPlayer.videoData.thumbnail.hqDefault;
								jQuery(YTPlayer).css({background: "rgba(0,0,0,0.5) url(" + bgndURL + ") center center", backgroundSize: "cover"});
							}

						});
					} else
						YTPlayer.player.seekTo(startAt, true);

				}
			}, 1);
		},

		formatTime: function (s) {
			var min = Math.floor(s / 60);
			var sec = Math.floor(s - (60 * min));
			return (min <= 9 ? "0" + min : min) + " : " + (sec <= 9 ? "0" + sec : sec);
		}
	};

	jQuery.fn.toggleVolume = function () {
		var YTPlayer = this.get(0);
		if (!YTPlayer)
			return;

		if (YTPlayer.player.isMuted()) {
			jQuery(YTPlayer).unmuteYTPVolume();
			return true;
		} else {
			jQuery(YTPlayer).muteYTPVolume();
			return false;
		}
	};

	jQuery.fn.optimizeDisplay = function () {

		var YTPlayer = this.get(0);
		var data = YTPlayer.opt;
		var playerBox = jQuery(YTPlayer.playerEl);
		var win = {};
//		var el = !YTPlayer.isBackground ? data.containment : jQuery(window);
		var el = YTPlayer.wrapper;

		win.width = el.outerWidth();
		win.height = el.outerHeight();

		var margin = 24;
		var overprint = 100;
		var vid = {};
		vid.width = win.width + ((win.width * margin) / 100);
		vid.height = data.ratio == "16/9" ? Math.ceil((9 * win.width) / 16) : Math.ceil((3 * win.width) / 4);
		vid.marginTop = -((vid.height - win.height) / 2);
		vid.marginLeft = -((win.width * (margin / 2)) / 100);

		if (vid.height < win.height) {
			vid.height = win.height + ((win.height * margin) / 100);
			vid.width = data.ratio == "16/9" ? Math.floor((16 * win.height) / 9) : Math.floor((4 * win.height) / 3);
			vid.marginTop = -((win.height * (margin / 2)) / 100);
			vid.marginLeft = -((vid.width - win.width) / 2);
		}

		vid.width += overprint;
		vid.height += overprint;
		vid.marginTop -= overprint / 2;
		vid.marginLeft -= overprint / 2;

		playerBox.css({width: vid.width, height: vid.height, marginTop: vid.marginTop, marginLeft: vid.marginLeft});
	};

	jQuery.shuffle = function (arr) {
		var newArray = arr.slice();
		var len = newArray.length;
		var i = len;
		while (i--) {
			var p = parseInt(Math.random() * len);
			var t = newArray[i];
			newArray[i] = newArray[p];
			newArray[p] = t;
		}
		return newArray;
	};

	/*Exposed method for external use*/
	jQuery.fn.mb_YTPlayer = jQuery.mbYTPlayer.buildPlayer;
	jQuery.fn.YTPlaylist = jQuery.mbYTPlayer.YTPlaylist;
	jQuery.fn.playNext = jQuery.mbYTPlayer.playNext;
	jQuery.fn.playPrev = jQuery.mbYTPlayer.playPrev;
	jQuery.fn.changeMovie = jQuery.mbYTPlayer.changeMovie;
	jQuery.fn.getVideoID = jQuery.mbYTPlayer.getVideoID;
	jQuery.fn.getPlayer = jQuery.mbYTPlayer.getPlayer;
	jQuery.fn.playerDestroy = jQuery.mbYTPlayer.playerDestroy;
	jQuery.fn.fullscreen = jQuery.mbYTPlayer.fullscreen;
	jQuery.fn.buildYTPControls = jQuery.mbYTPlayer.buildYTPControls;
	jQuery.fn.playYTP = jQuery.mbYTPlayer.playYTP;
	jQuery.fn.toggleLoops = jQuery.mbYTPlayer.toggleLoops;
	jQuery.fn.stopYTP = jQuery.mbYTPlayer.stopYTP;
	jQuery.fn.pauseYTP = jQuery.mbYTPlayer.pauseYTP;
	jQuery.fn.seekToYTP = jQuery.mbYTPlayer.seekToYTP;
	jQuery.fn.muteYTPVolume = jQuery.mbYTPlayer.muteYTPVolume;
	jQuery.fn.unmuteYTPVolume = jQuery.mbYTPlayer.unmuteYTPVolume;
	jQuery.fn.setYTPVolume = jQuery.mbYTPlayer.setYTPVolume;
	jQuery.fn.setVideoQuality = jQuery.mbYTPlayer.setVideoQuality;
	jQuery.fn.manageYTPProgress = jQuery.mbYTPlayer.manageYTPProgress;

})(jQuery, ytp);

// Appear JS

(function(e){"use strict";function u(){r=false;for(var n=0;n<t.length;n++){var i=e(t[n]).filter(function(){return e(this).is(":appeared")});i.trigger("appear",[i]);if(o){var s=o.not(i);s.trigger("disappear",[s])}o=i}}var t=[];var n=false;var r=false;var i={interval:250,force_process:false};var s=e(window);var o;e.expr[":"]["appeared"]=function(t){var n=e(t);if(!n.is(":visible")){return false}var r=s.scrollLeft();var i=s.scrollTop();var o=n.offset();var u=o.left;var a=o.top;if(a+n.height()>=i&&a-(n.data("appear-top-offset")||0)<=i+s.height()&&u+n.width()>=r&&u-(n.data("appear-left-offset")||0)<=r+s.width()){return true}else{return false}};e.fn.extend({appear:function(s){var o=e.extend({},i,s||{});var a=this.selector||this;if(!n){var f=function(){if(r){return}r=true;setTimeout(u,o.interval)};e(window).scroll(f).resize(f);n=true}if(o.force_process){setTimeout(u,o.interval)}t.push(a);return e(a)}});e.extend({force_appear:function(){if(n){u();return true}return false}})})(jQuery);(function(e){e.fn.appear1=function(t,n){var r=e.extend({data:undefined,one:true,accX:0,accY:0},n);return this.each(function(){var n=e(this);n.appeared=false;if(!t){n.trigger("appear1",r.data);return}var i=e(window);var s=function(){if(!n.is(":visible")){n.appeared=false;return}var e=i.scrollLeft();var t=i.scrollTop();var s=n.offset();var o=s.left;var u=s.top;var a=r.accX;var f=r.accY;var l=n.height();var c=i.height();var h=n.width();var p=i.width();if(u+l+f>=t&&u<=t+c+f&&o+h+a>=e&&o<=e+p+a){if(!n.appeared)n.trigger("appear1",r.data)}else{n.appeared=false}};var o=function(){n.appeared=true;if(r.one){i.unbind("scroll",s);var o=e.inArray(s,e.fn.appear.checks);if(o>=0)e.fn.appear.checks.splice(o,1)}t.apply(this,arguments)};if(r.one)n.one("appear1",r.data,o);else n.bind("appear1",r.data,o);i.scroll(s);e.fn.appear1.checks.push(s);s()})};e.extend(e.fn.appear1,{checks:[],timeout:null,checkAll:function(){var t=e.fn.appear1.checks.length;if(t>0)while(t--)e.fn.appear1.checks[t]()},run:function(){if(e.fn.appear1.timeout)clearTimeout(e.fn.appear1.timeout);e.fn.appear1.timeout=setTimeout(e.fn.appear1.checkAll,20)}})})(jQuery)

//Piechart JS

!function(a,b){"object"==typeof exports?module.exports=b(require("jquery")):"function"==typeof define&&define.amd?define("EasyPieChart",["jquery"],b):b(a.jQuery)}(this,function(a){var b=function(a,b){var c,d=document.createElement("canvas");a.appendChild(d),"undefined"!=typeof G_vmlCanvasManager&&G_vmlCanvasManager.initElement(d);var e=d.getContext("2d");d.width=d.height=b.size;var f=1;window.devicePixelRatio>1&&(f=window.devicePixelRatio,d.style.width=d.style.height=[b.size,"px"].join(""),d.width=d.height=b.size*f,e.scale(f,f)),e.translate(b.size/2,b.size/2),e.rotate((-0.5+b.rotate/180)*Math.PI);var g=(b.size-b.lineWidth)/2;b.scaleColor&&b.scaleLength&&(g-=b.scaleLength+2),Date.now=Date.now||function(){return+new Date};var h=function(a,b,c){c=Math.min(Math.max(-1,c||0),1);var d=0>=c?!0:!1;e.beginPath(),e.arc(0,0,g,0,2*Math.PI*c,d),e.strokeStyle=a,e.lineWidth=b,e.stroke()},i=function(){var a,c;e.lineWidth=1,e.fillStyle=b.scaleColor,e.save();for(var d=24;d>0;--d)d%6===0?(c=b.scaleLength,a=0):(c=.6*b.scaleLength,a=b.scaleLength-c),e.fillRect(-b.size/2+a,0,c,1),e.rotate(Math.PI/12);e.restore()},j=function(){return window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||function(a){window.setTimeout(a,1e3/60)}}(),k=function(){b.scaleColor&&i(),b.trackColor&&h(b.trackColor,b.lineWidth,1)};this.clear=function(){e.clearRect(b.size/-2,b.size/-2,b.size,b.size)},this.draw=function(a){b.scaleColor||b.trackColor?e.getImageData&&e.putImageData?c?e.putImageData(c,0,0):(k(),c=e.getImageData(0,0,b.size*f,b.size*f)):(this.clear(),k()):this.clear(),e.lineCap=b.lineCap;var d;d="function"==typeof b.barColor?b.barColor(a):b.barColor,h(d,b.lineWidth,a/100)}.bind(this),this.animate=function(a,c){var d=Date.now();b.onStart(a,c);var e=function(){var f=Math.min(Date.now()-d,b.animate.duration),g=b.easing(this,f,a,c-a,b.animate.duration);this.draw(g),b.onStep(a,c,g),f>=b.animate.duration?b.onStop(a,c):j(e)}.bind(this);j(e)}.bind(this)},c=function(a,c){var d={barColor:"#ef1e25",trackColor:"#f9f9f9",scaleColor:"#dfe0e0",scaleLength:5,lineCap:"round",lineWidth:3,size:110,rotate:0,animate:{duration:1e3,enabled:!0},easing:function(a,b,c,d,e){return b/=e/2,1>b?d/2*b*b+c:-d/2*(--b*(b-2)-1)+c},onStart:function(){},onStep:function(){},onStop:function(){}};if("undefined"!=typeof b)d.renderer=b;else{if("undefined"==typeof SVGRenderer)throw new Error("Please load either the SVG- or the CanvasRenderer");d.renderer=SVGRenderer}var e={},f=0,g=function(){this.el=a,this.options=e;for(var b in d)d.hasOwnProperty(b)&&(e[b]=c&&"undefined"!=typeof c[b]?c[b]:d[b],"function"==typeof e[b]&&(e[b]=e[b].bind(this)));e.easing="string"==typeof e.easing&&"undefined"!=typeof jQuery&&jQuery.isFunction(jQuery.easing[e.easing])?jQuery.easing[e.easing]:d.easing,"number"==typeof e.animate&&(e.animate={duration:e.animate,enabled:!0}),"boolean"!=typeof e.animate||e.animate||(e.animate={duration:1e3,enabled:e.animate}),this.renderer=new e.renderer(a,e),this.renderer.draw(f),a.dataset&&a.dataset.percent?this.update(parseFloat(a.dataset.percent)):a.getAttribute&&a.getAttribute("data-percent")&&this.update(parseFloat(a.getAttribute("data-percent")))}.bind(this);this.update=function(a){return a=parseFloat(a),e.animate.enabled?this.renderer.animate(f,a):this.renderer.draw(a),f=a,this}.bind(this),this.disableAnimation=function(){return e.animate.enabled=!1,this},this.enableAnimation=function(){return e.animate.enabled=!0,this},g()};a.fn.easyPieChart=function(b){return this.each(function(){var d;a.data(this,"easyPieChart")||(d=a.extend({},b,a(this).data()),a.data(this,"easyPieChart",new c(this,d)))})}});

// Flickr JS

(function($) {
    $.fn.flickrfeed = function(userid, tags, options) {
        var defaults = {
            limit: 10,
			thumbsize: 70,
            imagesize: 'square',
            titletag: 'h4',
            title: true,
            date: true
        };
        var options = $.extend(defaults, options);
        return this.each(function(i, e) {
            var $e = $(e);
            var api = 'http://api.flickr.com/services/feeds/photos_public.gne?lang=en-us&format=json&jsoncallback=?';
            if (userid != '') api += '&id=' + userid;
            if (tags != '') api += '&tags=' + tags;
            $.getJSON(api, function(data) {
                _callback(e, data, options);
            });
        });
    };
    var _callback = function(e, data, options) {
        if (!data) {
            return false;
        }
        var html = '';
        html += '<ul>';
        var feeds = data.items;
        var count = feeds.length;
        if (count > options.limit) count = options.limit;
        for (var i = 0; i < count; i++) {
            var photo = feeds[i];
            var link = '<a href="' + photo.link + '">';
            html += '<li>';
            var src = photo.media.m;
            if (options.imagesize == 'square') src = src.replace('_m', '_s');
            if (options.imagesize == 'thumbnail') src = src.replace('_m', '_t');
            if (options.imagesize == 'medium') src = src.replace('_m', '');
            html += link + '<span class="icn-more"></span><img src="' + src + '" alt="' + photo.title + '" style="width:'+ options.thumbsize +'px"/></a>'
            if (options.title) html += '<' + options.titletag + '>' + photo.title + '</' + options.titletag + '>';
            if (options.date) {
                var photoDate = new Date(photo.date_taken);
                photoDate = photoDate.toLocaleDateString() + ' ' + photoDate.toLocaleTimeString();
                html += '<div>' + photoDate + '</div>';
            }
            html += '</li>';
        }
        html += '</ul>'
        $(e).html(html);
    };
})(jQuery);

//Tipsy JS

//waypoints

(function() {
  var __indexOf = [].indexOf || function(item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; },
    __slice = [].slice;

  (function(root, factory) {
    if (typeof define === 'function' && define.amd) {
      return define('waypoints', ['jquery'], function($) {
        return factory($, root);
      });
    } else {
      return factory(root.jQuery, root);
    }
  })(window, function($, window) {
    var $w, Context, Waypoint, allWaypoints, contextCounter, contextKey, contexts, isTouch, jQMethods, methods, resizeEvent, scrollEvent, waypointCounter, waypointKey, wp, wps;

    $w = $(window);
    isTouch = __indexOf.call(window, 'ontouchstart') >= 0;
    allWaypoints = {
      horizontal: {},
      vertical: {}
    };
    contextCounter = 1;
    contexts = {};
    contextKey = 'waypoints-context-id';
    resizeEvent = 'resize.waypoints';
    scrollEvent = 'scroll.waypoints';
    waypointCounter = 1;
    waypointKey = 'waypoints-waypoint-ids';
    wp = 'waypoint';
    wps = 'waypoints';
    Context = (function() {
      function Context($element) {
        var _this = this;

        this.$element = $element;
        this.element = $element[0];
        this.didResize = false;
        this.didScroll = false;
        this.id = 'context' + contextCounter++;
        this.oldScroll = {
          x: $element.scrollLeft(),
          y: $element.scrollTop()
        };
        this.waypoints = {
          horizontal: {},
          vertical: {}
        };
        this.element[contextKey] = this.id;
        contexts[this.id] = this;
        $element.bind(scrollEvent, function() {
          var scrollHandler;

          if (!(_this.didScroll || isTouch)) {
            _this.didScroll = true;
            scrollHandler = function() {
              _this.doScroll();
              return _this.didScroll = false;
            };
            return window.setTimeout(scrollHandler, $[wps].settings.scrollThrottle);
          }
        });
        $element.bind(resizeEvent, function() {
          var resizeHandler;

          if (!_this.didResize) {
            _this.didResize = true;
            resizeHandler = function() {
              $[wps]('refresh');
              return _this.didResize = false;
            };
            return window.setTimeout(resizeHandler, $[wps].settings.resizeThrottle);
          }
        });
      }

      Context.prototype.doScroll = function() {
        var axes,
          _this = this;

        axes = {
          horizontal: {
            newScroll: this.$element.scrollLeft(),
            oldScroll: this.oldScroll.x,
            forward: 'right',
            backward: 'left'
          },
          vertical: {
            newScroll: this.$element.scrollTop(),
            oldScroll: this.oldScroll.y,
            forward: 'down',
            backward: 'up'
          }
        };
        if (isTouch && (!axes.vertical.oldScroll || !axes.vertical.newScroll)) {
          $[wps]('refresh');
        }
        $.each(axes, function(aKey, axis) {
          var direction, isForward, triggered;

          triggered = [];
          isForward = axis.newScroll > axis.oldScroll;
          direction = isForward ? axis.forward : axis.backward;
          $.each(_this.waypoints[aKey], function(wKey, waypoint) {
            var _ref, _ref1;

            if ((axis.oldScroll < (_ref = waypoint.offset) && _ref <= axis.newScroll)) {
              return triggered.push(waypoint);
            } else if ((axis.newScroll < (_ref1 = waypoint.offset) && _ref1 <= axis.oldScroll)) {
              return triggered.push(waypoint);
            }
          });
          triggered.sort(function(a, b) {
            return a.offset - b.offset;
          });
          if (!isForward) {
            triggered.reverse();
          }
          return $.each(triggered, function(i, waypoint) {
            if (waypoint.options.continuous || i === triggered.length - 1) {
              return waypoint.trigger([direction]);
            }
          });
        });
        return this.oldScroll = {
          x: axes.horizontal.newScroll,
          y: axes.vertical.newScroll
        };
      };

      Context.prototype.refresh = function() {
        var axes, cOffset, isWin,
          _this = this;

        isWin = $.isWindow(this.element);
        cOffset = this.$element.offset();
        this.doScroll();
        axes = {
          horizontal: {
            contextOffset: isWin ? 0 : cOffset.left,
            contextScroll: isWin ? 0 : this.oldScroll.x,
            contextDimension: this.$element.width(),
            oldScroll: this.oldScroll.x,
            forward: 'right',
            backward: 'left',
            offsetProp: 'left'
          },
          vertical: {
            contextOffset: isWin ? 0 : cOffset.top,
            contextScroll: isWin ? 0 : this.oldScroll.y,
            contextDimension: isWin ? $[wps]('viewportHeight') : this.$element.height(),
            oldScroll: this.oldScroll.y,
            forward: 'down',
            backward: 'up',
            offsetProp: 'top'
          }
        };
        return $.each(axes, function(aKey, axis) {
          return $.each(_this.waypoints[aKey], function(i, waypoint) {
            var adjustment, elementOffset, oldOffset, _ref, _ref1;

            adjustment = waypoint.options.offset;
            oldOffset = waypoint.offset;
            elementOffset = $.isWindow(waypoint.element) ? 0 : waypoint.$element.offset()[axis.offsetProp];
            if ($.isFunction(adjustment)) {
              adjustment = adjustment.apply(waypoint.element);
            } else if (typeof adjustment === 'string') {
              adjustment = parseFloat(adjustment);
              if (waypoint.options.offset.indexOf('%') > -1) {
                adjustment = Math.ceil(axis.contextDimension * adjustment / 100);
              }
            }
            waypoint.offset = elementOffset - axis.contextOffset + axis.contextScroll - adjustment;
            if ((waypoint.options.onlyOnScroll && (oldOffset != null)) || !waypoint.enabled) {
              return;
            }
            if (oldOffset !== null && (oldOffset < (_ref = axis.oldScroll) && _ref <= waypoint.offset)) {
              return waypoint.trigger([axis.backward]);
            } else if (oldOffset !== null && (oldOffset > (_ref1 = axis.oldScroll) && _ref1 >= waypoint.offset)) {
              return waypoint.trigger([axis.forward]);
            } else if (oldOffset === null && axis.oldScroll >= waypoint.offset) {
              return waypoint.trigger([axis.forward]);
            }
          });
        });
      };

      Context.prototype.checkEmpty = function() {
        if ($.isEmptyObject(this.waypoints.horizontal) && $.isEmptyObject(this.waypoints.vertical)) {
          this.$element.unbind([resizeEvent, scrollEvent].join(' '));
          return delete contexts[this.id];
        }
      };

      return Context;

    })();
    Waypoint = (function() {
      function Waypoint($element, context, options) {
        var idList, _ref;

        if (options.offset === 'bottom-in-view') {
          options.offset = function() {
            var contextHeight;

            contextHeight = $[wps]('viewportHeight');
            if (!$.isWindow(context.element)) {
              contextHeight = context.$element.height();
            }
            return contextHeight - $(this).outerHeight();
          };
        }
        this.$element = $element;
        this.element = $element[0];
        this.axis = options.horizontal ? 'horizontal' : 'vertical';
        this.callback = options.handler;
        this.context = context;
        this.enabled = options.enabled;
        this.id = 'waypoints' + waypointCounter++;
        this.offset = null;
        this.options = options;
        context.waypoints[this.axis][this.id] = this;
        allWaypoints[this.axis][this.id] = this;
        idList = (_ref = this.element[waypointKey]) != null ? _ref : [];
        idList.push(this.id);
        this.element[waypointKey] = idList;
      }

      Waypoint.prototype.trigger = function(args) {
        if (!this.enabled) {
          return;
        }
        if (this.callback != null) {
          this.callback.apply(this.element, args);
        }
        if (this.options.triggerOnce) {
          return this.destroy();
        }
      };

      Waypoint.prototype.disable = function() {
        return this.enabled = false;
      };

      Waypoint.prototype.enable = function() {
        this.context.refresh();
        return this.enabled = true;
      };

      Waypoint.prototype.destroy = function() {
        delete allWaypoints[this.axis][this.id];
        delete this.context.waypoints[this.axis][this.id];
        return this.context.checkEmpty();
      };

      Waypoint.getWaypointsByElement = function(element) {
        var all, ids;

        ids = element[waypointKey];
        if (!ids) {
          return [];
        }
        all = $.extend({}, allWaypoints.horizontal, allWaypoints.vertical);
        return $.map(ids, function(id) {
          return all[id];
        });
      };

      return Waypoint;

    })();
    methods = {
      init: function(f, options) {
        var _ref;

        options = $.extend({}, $.fn[wp].defaults, options);
        if ((_ref = options.handler) == null) {
          options.handler = f;
        }
        this.each(function() {
          var $this, context, contextElement, _ref1;

          $this = $(this);
          contextElement = (_ref1 = options.context) != null ? _ref1 : $.fn[wp].defaults.context;
          if (!$.isWindow(contextElement)) {
            contextElement = $this.closest(contextElement);
          }
          contextElement = $(contextElement);
          context = contexts[contextElement[0][contextKey]];
          if (!context) {
            context = new Context(contextElement);
          }
          return new Waypoint($this, context, options);
        });
        $[wps]('refresh');
        return this;
      },
      disable: function() {
        return methods._invoke.call(this, 'disable');
      },
      enable: function() {
        return methods._invoke.call(this, 'enable');
      },
      destroy: function() {
        return methods._invoke.call(this, 'destroy');
      },
      prev: function(axis, selector) {
        return methods._traverse.call(this, axis, selector, function(stack, index, waypoints) {
          if (index > 0) {
            return stack.push(waypoints[index - 1]);
          }
        });
      },
      next: function(axis, selector) {
        return methods._traverse.call(this, axis, selector, function(stack, index, waypoints) {
          if (index < waypoints.length - 1) {
            return stack.push(waypoints[index + 1]);
          }
        });
      },
      _traverse: function(axis, selector, push) {
        var stack, waypoints;

        if (axis == null) {
          axis = 'vertical';
        }
        if (selector == null) {
          selector = window;
        }
        waypoints = jQMethods.aggregate(selector);
        stack = [];
        this.each(function() {
          var index;

          index = $.inArray(this, waypoints[axis]);
          return push(stack, index, waypoints[axis]);
        });
        return this.pushStack(stack);
      },
      _invoke: function(method) {
        this.each(function() {
          var waypoints;

          waypoints = Waypoint.getWaypointsByElement(this);
          return $.each(waypoints, function(i, waypoint) {
            waypoint[method]();
            return true;
          });
        });
        return this;
      }
    };
    $.fn[wp] = function() {
      var args, method;

      method = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      if (methods[method]) {
        return methods[method].apply(this, args);
      } else if ($.isFunction(method)) {
        return methods.init.apply(this, arguments);
      } else if ($.isPlainObject(method)) {
        return methods.init.apply(this, [null, method]);
      } else if (!method) {
        return $.error("jQuery Waypoints needs a callback function or handler option.");
      } else {
        return $.error("The " + method + " method does not exist in jQuery Waypoints.");
      }
    };
    $.fn[wp].defaults = {
      context: window,
      continuous: true,
      enabled: true,
      horizontal: false,
      offset: 0,
      triggerOnce: false
    };
    jQMethods = {
      refresh: function() {
        return $.each(contexts, function(i, context) {
          return context.refresh();
        });
      },
      viewportHeight: function() {
        var _ref;

        return (_ref = window.innerHeight) != null ? _ref : $w.height();
      },
      aggregate: function(contextSelector) {
        var collection, waypoints, _ref;

        collection = allWaypoints;
        if (contextSelector) {
          collection = (_ref = contexts[$(contextSelector)[0][contextKey]]) != null ? _ref.waypoints : void 0;
        }
        if (!collection) {
          return [];
        }
        waypoints = {
          horizontal: [],
          vertical: []
        };
        $.each(waypoints, function(axis, arr) {
          $.each(collection[axis], function(key, waypoint) {
            return arr.push(waypoint);
          });
          arr.sort(function(a, b) {
            return a.offset - b.offset;
          });
          waypoints[axis] = $.map(arr, function(waypoint) {
            return waypoint.element;
          });
          return waypoints[axis] = $.unique(waypoints[axis]);
        });
        return waypoints;
      },
      above: function(contextSelector) {
        if (contextSelector == null) {
          contextSelector = window;
        }
        return jQMethods._filter(contextSelector, 'vertical', function(context, waypoint) {
          return waypoint.offset <= context.oldScroll.y;
        });
      },
      below: function(contextSelector) {
        if (contextSelector == null) {
          contextSelector = window;
        }
        return jQMethods._filter(contextSelector, 'vertical', function(context, waypoint) {
          return waypoint.offset > context.oldScroll.y;
        });
      },
      left: function(contextSelector) {
        if (contextSelector == null) {
          contextSelector = window;
        }
        return jQMethods._filter(contextSelector, 'horizontal', function(context, waypoint) {
          return waypoint.offset <= context.oldScroll.x;
        });
      },
      right: function(contextSelector) {
        if (contextSelector == null) {
          contextSelector = window;
        }
        return jQMethods._filter(contextSelector, 'horizontal', function(context, waypoint) {
          return waypoint.offset > context.oldScroll.x;
        });
      },
      enable: function() {
        return jQMethods._invoke('enable');
      },
      disable: function() {
        return jQMethods._invoke('disable');
      },
      destroy: function() {
        return jQMethods._invoke('destroy');
      },
      extendFn: function(methodName, f) {
        return methods[methodName] = f;
      },
      _invoke: function(method) {
        var waypoints;

        waypoints = $.extend({}, allWaypoints.vertical, allWaypoints.horizontal);
        return $.each(waypoints, function(key, waypoint) {
          waypoint[method]();
          return true;
        });
      },
      _filter: function(selector, axis, test) {
        var context, waypoints;

        context = contexts[$(selector)[0][contextKey]];
        if (!context) {
          return [];
        }
        waypoints = [];
        $.each(context.waypoints[axis], function(i, waypoint) {
          if (test(context, waypoint)) {
            return waypoints.push(waypoint);
          }
        });
        waypoints.sort(function(a, b) {
          return a.offset - b.offset;
        });
        return $.map(waypoints, function(waypoint) {
          return waypoint.element;
        });
      }
    };
    $[wps] = function() {
      var args, method;

      method = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      if (jQMethods[method]) {
        return jQMethods[method].apply(null, args);
      } else {
        return jQMethods.aggregate.call(null, method);
      }
    };
    $[wps].settings = {
      resizeThrottle: 100,
      scrollThrottle: 30
    };
    return $w.on('load.waypoints', function() {
      return $[wps]('refresh');
    });
  });

}).call(this);

//Nice scroll

(function(a){function d(b){var c=b||window.event,d=[].slice.call(arguments,1),e=0,f=!0,g=0,h=0;return b=a.event.fix(c),b.type="mousewheel",c.wheelDelta&&(e=c.wheelDelta/120),c.detail&&(e=-c.detail/3),h=e,c.axis!==undefined&&c.axis===c.HORIZONTAL_AXIS&&(h=0,g=-1*e),c.wheelDeltaY!==undefined&&(h=c.wheelDeltaY/120),c.wheelDeltaX!==undefined&&(g=-1*c.wheelDeltaX/120),d.unshift(b,e,g,h),(a.event.dispatch||a.event.handle).apply(this,d)}var b=["DOMMouseScroll","mousewheel"];if(a.event.fixHooks)for(var c=b.length;c;)a.event.fixHooks[b[--c]]=a.event.mouseHooks;a.event.special.mousewheel={setup:function(){if(this.addEventListener)for(var a=b.length;a;)this.addEventListener(b[--a],d,!1);else this.onmousewheel=d},teardown:function(){if(this.removeEventListener)for(var a=b.length;a;)this.removeEventListener(b[--a],d,!1);else this.onmousewheel=null}},a.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}})})(jQuery);
/*custom scrollbar*/
(function(c){var b={init:function(e){var f={set_width:false,set_height:false,horizontalScroll:false,scrollInertia:950,mouseWheel:true,mouseWheelPixels:"auto",autoDraggerLength:true,autoHideScrollbar:false,alwaysShowScrollbar:false,snapAmount:null,snapOffset:0,scrollButtons:{enable:false,scrollType:"continuous",scrollSpeed:"auto",scrollAmount:40},advanced:{updateOnBrowserResize:true,updateOnContentResize:false,autoExpandHorizontalScroll:false,autoScrollOnFocus:true,normalizeMouseWheelDelta:false},contentTouchScroll:true,callbacks:{onScrollStart:function(){},onScroll:function(){},onTotalScroll:function(){},onTotalScrollBack:function(){},onTotalScrollOffset:0,onTotalScrollBackOffset:0,whileScrolling:function(){}},theme:"light"},e=c.extend(true,f,e);return this.each(function(){var m=c(this);if(e.set_width){m.css("width",e.set_width)}if(e.set_height){m.css("height",e.set_height)}if(!c(document).data("mCustomScrollbar-index")){c(document).data("mCustomScrollbar-index","1")}else{var t=parseInt(c(document).data("mCustomScrollbar-index"));c(document).data("mCustomScrollbar-index",t+1)}m.wrapInner("<div class='mCustomScrollBox mCS-"+e.theme+"' id='mCSB_"+c(document).data("mCustomScrollbar-index")+"' style='position:relative; height:100%; overflow:hidden; max-width:100%;' />").addClass("mCustomScrollbar _mCS_"+c(document).data("mCustomScrollbar-index"));var g=m.children(".mCustomScrollBox");if(e.horizontalScroll){g.addClass("mCSB_horizontal").wrapInner("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />");var k=g.children(".mCSB_h_wrapper");k.wrapInner("<div class='mCSB_container' style='position:absolute; left:0;' />").children(".mCSB_container").css({width:k.children().outerWidth(),position:"relative"}).unwrap()}else{g.wrapInner("<div class='mCSB_container' style='position:relative; top:0;' />")}var o=g.children(".mCSB_container");if(c.support.touch){o.addClass("mCS_touch")}o.after("<div class='mCSB_scrollTools' style='position:absolute;'><div class='mCSB_draggerContainer'><div class='mCSB_dragger' style='position:absolute;' oncontextmenu='return false;'><div class='mCSB_dragger_bar' style='position:relative;'></div></div><div class='mCSB_draggerRail'></div></div></div>");var l=g.children(".mCSB_scrollTools"),h=l.children(".mCSB_draggerContainer"),q=h.children(".mCSB_dragger");if(e.horizontalScroll){q.data("minDraggerWidth",q.width())}else{q.data("minDraggerHeight",q.height())}if(e.scrollButtons.enable){if(e.horizontalScroll){l.prepend("<a class='mCSB_buttonLeft' oncontextmenu='return false;'></a>").append("<a class='mCSB_buttonRight' oncontextmenu='return false;'></a>")}else{l.prepend("<a class='mCSB_buttonUp' oncontextmenu='return false;'></a>").append("<a class='mCSB_buttonDown' oncontextmenu='return false;'></a>")}}g.bind("scroll",function(){if(!m.is(".mCS_disabled")){g.scrollTop(0).scrollLeft(0)}});m.data({mCS_Init:true,mCustomScrollbarIndex:c(document).data("mCustomScrollbar-index"),horizontalScroll:e.horizontalScroll,scrollInertia:e.scrollInertia,scrollEasing:"mcsEaseOut",mouseWheel:e.mouseWheel,mouseWheelPixels:e.mouseWheelPixels,autoDraggerLength:e.autoDraggerLength,autoHideScrollbar:e.autoHideScrollbar,alwaysShowScrollbar:e.alwaysShowScrollbar,snapAmount:e.snapAmount,snapOffset:e.snapOffset,scrollButtons_enable:e.scrollButtons.enable,scrollButtons_scrollType:e.scrollButtons.scrollType,scrollButtons_scrollSpeed:e.scrollButtons.scrollSpeed,scrollButtons_scrollAmount:e.scrollButtons.scrollAmount,autoExpandHorizontalScroll:e.advanced.autoExpandHorizontalScroll,autoScrollOnFocus:e.advanced.autoScrollOnFocus,normalizeMouseWheelDelta:e.advanced.normalizeMouseWheelDelta,contentTouchScroll:e.contentTouchScroll,onScrollStart_Callback:e.callbacks.onScrollStart,onScroll_Callback:e.callbacks.onScroll,onTotalScroll_Callback:e.callbacks.onTotalScroll,onTotalScrollBack_Callback:e.callbacks.onTotalScrollBack,onTotalScroll_Offset:e.callbacks.onTotalScrollOffset,onTotalScrollBack_Offset:e.callbacks.onTotalScrollBackOffset,whileScrolling_Callback:e.callbacks.whileScrolling,bindEvent_scrollbar_drag:false,bindEvent_content_touch:false,bindEvent_scrollbar_click:false,bindEvent_mousewheel:false,bindEvent_buttonsContinuous_y:false,bindEvent_buttonsContinuous_x:false,bindEvent_buttonsPixels_y:false,bindEvent_buttonsPixels_x:false,bindEvent_focusin:false,bindEvent_autoHideScrollbar:false,mCSB_buttonScrollRight:false,mCSB_buttonScrollLeft:false,mCSB_buttonScrollDown:false,mCSB_buttonScrollUp:false});if(e.horizontalScroll){if(m.css("max-width")!=="none"){if(!e.advanced.updateOnContentResize){e.advanced.updateOnContentResize=true}}}else{if(m.css("max-height")!=="none"){var s=false,r=parseInt(m.css("max-height"));if(m.css("max-height").indexOf("%")>=0){s=r,r=m.parent().height()*s/100}m.css("overflow","hidden");g.css("max-height",r)}}m.mCustomScrollbar("update");if(e.advanced.updateOnBrowserResize){var i,j=c(window).width(),u=c(window).height();c(window).bind("resize."+m.data("mCustomScrollbarIndex"),function(){if(i){clearTimeout(i)}i=setTimeout(function(){if(!m.is(".mCS_disabled")&&!m.is(".mCS_destroyed")){var w=c(window).width(),v=c(window).height();if(j!==w||u!==v){if(m.css("max-height")!=="none"&&s){g.css("max-height",m.parent().height()*s/100)}m.mCustomScrollbar("update");j=w;u=v}}},150)})}if(e.advanced.updateOnContentResize){var p;if(e.horizontalScroll){var n=o.outerWidth()}else{var n=o.outerHeight()}p=setInterval(function(){if(e.horizontalScroll){if(e.advanced.autoExpandHorizontalScroll){o.css({position:"absolute",width:"auto"}).wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />").css({width:o.outerWidth(),position:"relative"}).unwrap()}var v=o.outerWidth()}else{var v=o.outerHeight()}if(v!=n){m.mCustomScrollbar("update");n=v}},300)}})},update:function(){var n=c(this),k=n.children(".mCustomScrollBox"),q=k.children(".mCSB_container");q.removeClass("mCS_no_scrollbar");n.removeClass("mCS_disabled mCS_destroyed");k.scrollTop(0).scrollLeft(0);var y=k.children(".mCSB_scrollTools"),o=y.children(".mCSB_draggerContainer"),m=o.children(".mCSB_dragger");if(n.data("horizontalScroll")){var A=y.children(".mCSB_buttonLeft"),t=y.children(".mCSB_buttonRight"),f=k.width();if(n.data("autoExpandHorizontalScroll")){q.css({position:"absolute",width:"auto"}).wrap("<div class='mCSB_h_wrapper' style='position:relative; left:0; width:999999px;' />").css({width:q.outerWidth(),position:"relative"}).unwrap()}var z=q.outerWidth()}else{var w=y.children(".mCSB_buttonUp"),g=y.children(".mCSB_buttonDown"),r=k.height(),i=q.outerHeight()}if(i>r&&!n.data("horizontalScroll")){y.css("display","block");var s=o.height();if(n.data("autoDraggerLength")){var u=Math.round(r/i*s),l=m.data("minDraggerHeight");if(u<=l){m.css({height:l})}else{if(u>=s-10){var p=s-10;m.css({height:p})}else{m.css({height:u})}}m.children(".mCSB_dragger_bar").css({"line-height":m.height()+"px"})}var B=m.height(),x=(i-r)/(s-B);n.data("scrollAmount",x).mCustomScrollbar("scrolling",k,q,o,m,w,g,A,t);var D=Math.abs(q.position().top);n.mCustomScrollbar("scrollTo",D,{scrollInertia:0,trigger:"internal"})}else{if(z>f&&n.data("horizontalScroll")){y.css("display","block");var h=o.width();if(n.data("autoDraggerLength")){var j=Math.round(f/z*h),C=m.data("minDraggerWidth");if(j<=C){m.css({width:C})}else{if(j>=h-10){var e=h-10;m.css({width:e})}else{m.css({width:j})}}}var v=m.width(),x=(z-f)/(h-v);n.data("scrollAmount",x).mCustomScrollbar("scrolling",k,q,o,m,w,g,A,t);var D=Math.abs(q.position().left);n.mCustomScrollbar("scrollTo",D,{scrollInertia:0,trigger:"internal"})}else{k.unbind("mousewheel focusin");if(n.data("horizontalScroll")){m.add(q).css("left",0)}else{m.add(q).css("top",0)}if(n.data("alwaysShowScrollbar")){if(!n.data("horizontalScroll")){m.css({height:o.height()})}else{if(n.data("horizontalScroll")){m.css({width:o.width()})}}}else{y.css("display","none");q.addClass("mCS_no_scrollbar")}n.data({bindEvent_mousewheel:false,bindEvent_focusin:false})}}},scrolling:function(i,q,n,k,A,f,D,w){var l=c(this);if(!l.data("bindEvent_scrollbar_drag")){var o,p,C,z,e;if(c.support.pointer){C="pointerdown";z="pointermove";e="pointerup"}else{if(c.support.msPointer){C="MSPointerDown";z="MSPointerMove";e="MSPointerUp"}}if(c.support.pointer||c.support.msPointer){k.bind(C,function(K){K.preventDefault();l.data({on_drag:true});k.addClass("mCSB_dragger_onDrag");var J=c(this),M=J.offset(),I=K.originalEvent.pageX-M.left,L=K.originalEvent.pageY-M.top;if(I<J.width()&&I>0&&L<J.height()&&L>0){o=L;p=I}});c(document).bind(z+"."+l.data("mCustomScrollbarIndex"),function(K){K.preventDefault();if(l.data("on_drag")){var J=k,M=J.offset(),I=K.originalEvent.pageX-M.left,L=K.originalEvent.pageY-M.top;G(o,p,L,I)}}).bind(e+"."+l.data("mCustomScrollbarIndex"),function(x){l.data({on_drag:false});k.removeClass("mCSB_dragger_onDrag")})}else{k.bind("mousedown touchstart",function(K){K.preventDefault();K.stopImmediatePropagation();var J=c(this),N=J.offset(),I,M;if(K.type==="touchstart"){var L=K.originalEvent.touches[0]||K.originalEvent.changedTouches[0];I=L.pageX-N.left;M=L.pageY-N.top}else{l.data({on_drag:true});k.addClass("mCSB_dragger_onDrag");I=K.pageX-N.left;M=K.pageY-N.top}if(I<J.width()&&I>0&&M<J.height()&&M>0){o=M;p=I}}).bind("touchmove",function(K){K.preventDefault();K.stopImmediatePropagation();var N=K.originalEvent.touches[0]||K.originalEvent.changedTouches[0],J=c(this),M=J.offset(),I=N.pageX-M.left,L=N.pageY-M.top;G(o,p,L,I)});c(document).bind("mousemove."+l.data("mCustomScrollbarIndex"),function(K){if(l.data("on_drag")){var J=k,M=J.offset(),I=K.pageX-M.left,L=K.pageY-M.top;G(o,p,L,I)}}).bind("mouseup."+l.data("mCustomScrollbarIndex"),function(x){l.data({on_drag:false});k.removeClass("mCSB_dragger_onDrag")})}l.data({bindEvent_scrollbar_drag:true})}function G(J,K,L,I){if(l.data("horizontalScroll")){l.mCustomScrollbar("scrollTo",(k.position().left-(K))+I,{moveDragger:true,trigger:"internal"})}else{l.mCustomScrollbar("scrollTo",(k.position().top-(J))+L,{moveDragger:true,trigger:"internal"})}}if(c.support.touch&&l.data("contentTouchScroll")){if(!l.data("bindEvent_content_touch")){var m,E,s,t,v,F,H;q.bind("touchstart",function(x){x.stopImmediatePropagation();m=x.originalEvent.touches[0]||x.originalEvent.changedTouches[0];E=c(this);s=E.offset();v=m.pageX-s.left;t=m.pageY-s.top;F=t;H=v});q.bind("touchmove",function(x){x.preventDefault();x.stopImmediatePropagation();m=x.originalEvent.touches[0]||x.originalEvent.changedTouches[0];E=c(this).parent();s=E.offset();v=m.pageX-s.left;t=m.pageY-s.top;if(l.data("horizontalScroll")){l.mCustomScrollbar("scrollTo",H-v,{trigger:"internal"})}else{l.mCustomScrollbar("scrollTo",F-t,{trigger:"internal"})}})}}if(!l.data("bindEvent_scrollbar_click")){n.bind("click",function(I){var x=(I.pageY-n.offset().top)*l.data("scrollAmount"),y=c(I.target);if(l.data("horizontalScroll")){x=(I.pageX-n.offset().left)*l.data("scrollAmount")}if(y.hasClass("mCSB_draggerContainer")||y.hasClass("mCSB_draggerRail")){l.mCustomScrollbar("scrollTo",x,{trigger:"internal",scrollEasing:"draggerRailEase"})}});l.data({bindEvent_scrollbar_click:true})}if(l.data("mouseWheel")){if(!l.data("bindEvent_mousewheel")){i.bind("mousewheel",function(K,M){var J,I=l.data("mouseWheelPixels"),x=Math.abs(q.position().top),L=k.position().top,y=n.height()-k.height();if(l.data("normalizeMouseWheelDelta")){if(M<0){M=-1}else{M=1}}if(I==="auto"){I=100+Math.round(l.data("scrollAmount")/2)}if(l.data("horizontalScroll")){L=k.position().left;y=n.width()-k.width();x=Math.abs(q.position().left)}if((M>0&&L!==0)||(M<0&&L!==y)){K.preventDefault();K.stopImmediatePropagation()}J=x-(M*I);l.mCustomScrollbar("scrollTo",J,{trigger:"internal"})});l.data({bindEvent_mousewheel:true})}}if(l.data("scrollButtons_enable")){if(l.data("scrollButtons_scrollType")==="pixels"){if(l.data("horizontalScroll")){w.add(D).unbind("mousedown touchstart MSPointerDown pointerdown mouseup MSPointerUp pointerup mouseout MSPointerOut pointerout touchend",j,h);l.data({bindEvent_buttonsContinuous_x:false});if(!l.data("bindEvent_buttonsPixels_x")){w.bind("click",function(x){x.preventDefault();r(Math.abs(q.position().left)+l.data("scrollButtons_scrollAmount"))});D.bind("click",function(x){x.preventDefault();r(Math.abs(q.position().left)-l.data("scrollButtons_scrollAmount"))});l.data({bindEvent_buttonsPixels_x:true})}}else{f.add(A).unbind("mousedown touchstart MSPointerDown pointerdown mouseup MSPointerUp pointerup mouseout MSPointerOut pointerout touchend",j,h);l.data({bindEvent_buttonsContinuous_y:false});if(!l.data("bindEvent_buttonsPixels_y")){f.bind("click",function(x){x.preventDefault();r(Math.abs(q.position().top)+l.data("scrollButtons_scrollAmount"))});A.bind("click",function(x){x.preventDefault();r(Math.abs(q.position().top)-l.data("scrollButtons_scrollAmount"))});l.data({bindEvent_buttonsPixels_y:true})}}function r(x){if(!k.data("preventAction")){k.data("preventAction",true);l.mCustomScrollbar("scrollTo",x,{trigger:"internal"})}}}else{if(l.data("horizontalScroll")){w.add(D).unbind("click");l.data({bindEvent_buttonsPixels_x:false});if(!l.data("bindEvent_buttonsContinuous_x")){w.bind("mousedown touchstart MSPointerDown pointerdown",function(y){y.preventDefault();var x=B();l.data({mCSB_buttonScrollRight:setInterval(function(){l.mCustomScrollbar("scrollTo",Math.abs(q.position().left)+x,{trigger:"internal",scrollEasing:"easeOutCirc"})},17)})});var j=function(x){x.preventDefault();clearInterval(l.data("mCSB_buttonScrollRight"))};w.bind("mouseup touchend MSPointerUp pointerup mouseout MSPointerOut pointerout",j);D.bind("mousedown touchstart MSPointerDown pointerdown",function(y){y.preventDefault();var x=B();l.data({mCSB_buttonScrollLeft:setInterval(function(){l.mCustomScrollbar("scrollTo",Math.abs(q.position().left)-x,{trigger:"internal",scrollEasing:"easeOutCirc"})},17)})});var h=function(x){x.preventDefault();clearInterval(l.data("mCSB_buttonScrollLeft"))};D.bind("mouseup touchend MSPointerUp pointerup mouseout MSPointerOut pointerout",h);l.data({bindEvent_buttonsContinuous_x:true})}}else{f.add(A).unbind("click");l.data({bindEvent_buttonsPixels_y:false});if(!l.data("bindEvent_buttonsContinuous_y")){f.bind("mousedown touchstart MSPointerDown pointerdown",function(y){y.preventDefault();var x=B();l.data({mCSB_buttonScrollDown:setInterval(function(){l.mCustomScrollbar("scrollTo",Math.abs(q.position().top)+x,{trigger:"internal",scrollEasing:"easeOutCirc"})},17)})});var u=function(x){x.preventDefault();clearInterval(l.data("mCSB_buttonScrollDown"))};f.bind("mouseup touchend MSPointerUp pointerup mouseout MSPointerOut pointerout",u);A.bind("mousedown touchstart MSPointerDown pointerdown",function(y){y.preventDefault();var x=B();l.data({mCSB_buttonScrollUp:setInterval(function(){l.mCustomScrollbar("scrollTo",Math.abs(q.position().top)-x,{trigger:"internal",scrollEasing:"easeOutCirc"})},17)})});var g=function(x){x.preventDefault();clearInterval(l.data("mCSB_buttonScrollUp"))};A.bind("mouseup touchend MSPointerUp pointerup mouseout MSPointerOut pointerout",g);l.data({bindEvent_buttonsContinuous_y:true})}}function B(){var x=l.data("scrollButtons_scrollSpeed");if(l.data("scrollButtons_scrollSpeed")==="auto"){x=Math.round((l.data("scrollInertia")+100)/40)}return x}}}if(l.data("autoScrollOnFocus")){if(!l.data("bindEvent_focusin")){i.bind("focusin",function(){i.scrollTop(0).scrollLeft(0);var x=c(document.activeElement);if(x.is("input,textarea,select,button,a[tabindex],area,object")){var J=q.position().top,y=x.position().top,I=i.height()-x.outerHeight();if(l.data("horizontalScroll")){J=q.position().left;y=x.position().left;I=i.width()-x.outerWidth()}if(J+y<0||J+y>I){l.mCustomScrollbar("scrollTo",y,{trigger:"internal"})}}});l.data({bindEvent_focusin:true})}}if(l.data("autoHideScrollbar")&&!l.data("alwaysShowScrollbar")){if(!l.data("bindEvent_autoHideScrollbar")){i.bind("mouseenter",function(x){i.addClass("mCS-mouse-over");d.showScrollbar.call(i.children(".mCSB_scrollTools"))}).bind("mouseleave touchend",function(x){i.removeClass("mCS-mouse-over");if(x.type==="mouseleave"){d.hideScrollbar.call(i.children(".mCSB_scrollTools"))}});l.data({bindEvent_autoHideScrollbar:true})}}},scrollTo:function(e,f){var i=c(this),o={moveDragger:false,trigger:"external",callbacks:true,scrollInertia:i.data("scrollInertia"),scrollEasing:i.data("scrollEasing")},f=c.extend(o,f),p,g=i.children(".mCustomScrollBox"),k=g.children(".mCSB_container"),r=g.children(".mCSB_scrollTools"),j=r.children(".mCSB_draggerContainer"),h=j.children(".mCSB_dragger"),t=draggerSpeed=f.scrollInertia,q,s,m,l;if(!k.hasClass("mCS_no_scrollbar")){i.data({mCS_trigger:f.trigger});if(i.data("mCS_Init")){f.callbacks=false}if(e||e===0){if(typeof(e)==="number"){if(f.moveDragger){p=e;if(i.data("horizontalScroll")){e=h.position().left*i.data("scrollAmount")}else{e=h.position().top*i.data("scrollAmount")}draggerSpeed=0}else{p=e/i.data("scrollAmount")}}else{if(typeof(e)==="string"){var v;if(e==="top"){v=0}else{if(e==="bottom"&&!i.data("horizontalScroll")){v=k.outerHeight()-g.height()}else{if(e==="left"){v=0}else{if(e==="right"&&i.data("horizontalScroll")){v=k.outerWidth()-g.width()}else{if(e==="first"){v=i.find(".mCSB_container").find(":first")}else{if(e==="last"){v=i.find(".mCSB_container").find(":last")}else{v=i.find(e)}}}}}}if(v.length===1){if(i.data("horizontalScroll")){e=v.position().left}else{e=v.position().top}p=e/i.data("scrollAmount")}else{p=e=v}}}if(i.data("horizontalScroll")){if(i.data("onTotalScrollBack_Offset")){s=-i.data("onTotalScrollBack_Offset")}if(i.data("onTotalScroll_Offset")){l=g.width()-k.outerWidth()+i.data("onTotalScroll_Offset")}if(p<0){p=e=0;clearInterval(i.data("mCSB_buttonScrollLeft"));if(!s){q=true}}else{if(p>=j.width()-h.width()){p=j.width()-h.width();e=g.width()-k.outerWidth();clearInterval(i.data("mCSB_buttonScrollRight"));if(!l){m=true}}else{e=-e}}var n=i.data("snapAmount");if(n){e=Math.round(e/n)*n-i.data("snapOffset")}d.mTweenAxis.call(this,h[0],"left",Math.round(p),draggerSpeed,f.scrollEasing);d.mTweenAxis.call(this,k[0],"left",Math.round(e),t,f.scrollEasing,{onStart:function(){if(f.callbacks&&!i.data("mCS_tweenRunning")){u("onScrollStart")}if(i.data("autoHideScrollbar")&&!i.data("alwaysShowScrollbar")){d.showScrollbar.call(r)}},onUpdate:function(){if(f.callbacks){u("whileScrolling")}},onComplete:function(){if(f.callbacks){u("onScroll");if(q||(s&&k.position().left>=s)){u("onTotalScrollBack")}if(m||(l&&k.position().left<=l)){u("onTotalScroll")}}h.data("preventAction",false);i.data("mCS_tweenRunning",false);if(i.data("autoHideScrollbar")&&!i.data("alwaysShowScrollbar")){if(!g.hasClass("mCS-mouse-over")){d.hideScrollbar.call(r)}}}})}else{if(i.data("onTotalScrollBack_Offset")){s=-i.data("onTotalScrollBack_Offset")}if(i.data("onTotalScroll_Offset")){l=g.height()-k.outerHeight()+i.data("onTotalScroll_Offset")}if(p<0){p=e=0;clearInterval(i.data("mCSB_buttonScrollUp"));if(!s){q=true}}else{if(p>=j.height()-h.height()){p=j.height()-h.height();e=g.height()-k.outerHeight();clearInterval(i.data("mCSB_buttonScrollDown"));if(!l){m=true}}else{e=-e}}var n=i.data("snapAmount");if(n){e=Math.round(e/n)*n-i.data("snapOffset")}d.mTweenAxis.call(this,h[0],"top",Math.round(p),draggerSpeed,f.scrollEasing);d.mTweenAxis.call(this,k[0],"top",Math.round(e),t,f.scrollEasing,{onStart:function(){if(f.callbacks&&!i.data("mCS_tweenRunning")){u("onScrollStart")}if(i.data("autoHideScrollbar")&&!i.data("alwaysShowScrollbar")){d.showScrollbar.call(r)}},onUpdate:function(){if(f.callbacks){u("whileScrolling")}},onComplete:function(){if(f.callbacks){u("onScroll");if(q||(s&&k.position().top>=s)){u("onTotalScrollBack")}if(m||(l&&k.position().top<=l)){u("onTotalScroll")}}h.data("preventAction",false);i.data("mCS_tweenRunning",false);if(i.data("autoHideScrollbar")&&!i.data("alwaysShowScrollbar")){if(!g.hasClass("mCS-mouse-over")){d.hideScrollbar.call(r)}}}})}if(i.data("mCS_Init")){i.data({mCS_Init:false})}}}function u(w){if(i.data("mCustomScrollbarIndex")){this.mcs={top:k.position().top,left:k.position().left,draggerTop:h.position().top,draggerLeft:h.position().left,topPct:Math.round((100*Math.abs(k.position().top))/Math.abs(k.outerHeight()-g.height())),leftPct:Math.round((100*Math.abs(k.position().left))/Math.abs(k.outerWidth()-g.width()))};switch(w){case"onScrollStart":i.data("mCS_tweenRunning",true).data("onScrollStart_Callback").call(i,this.mcs);break;case"whileScrolling":i.data("whileScrolling_Callback").call(i,this.mcs);break;case"onScroll":i.data("onScroll_Callback").call(i,this.mcs);break;case"onTotalScrollBack":i.data("onTotalScrollBack_Callback").call(i,this.mcs);break;case"onTotalScroll":i.data("onTotalScroll_Callback").call(i,this.mcs);break}}}},stop:function(){var g=c(this),e=g.children().children(".mCSB_container"),f=g.children().children().children().children(".mCSB_dragger");d.mTweenAxisStop.call(this,e[0]);d.mTweenAxisStop.call(this,f[0])},disable:function(e){var j=c(this),f=j.children(".mCustomScrollBox"),h=f.children(".mCSB_container"),g=f.children(".mCSB_scrollTools"),i=g.children().children(".mCSB_dragger");f.unbind("mousewheel focusin mouseenter mouseleave touchend");h.unbind("touchstart touchmove");if(e){if(j.data("horizontalScroll")){i.add(h).css("left",0)}else{i.add(h).css("top",0)}}g.css("display","none");h.addClass("mCS_no_scrollbar");j.data({bindEvent_mousewheel:false,bindEvent_focusin:false,bindEvent_content_touch:false,bindEvent_autoHideScrollbar:false}).addClass("mCS_disabled")},destroy:function(){var e=c(this);e.removeClass("mCustomScrollbar _mCS_"+e.data("mCustomScrollbarIndex")).addClass("mCS_destroyed").children().children(".mCSB_container").unwrap().children().unwrap().siblings(".mCSB_scrollTools").remove();c(document).unbind("mousemove."+e.data("mCustomScrollbarIndex")+" mouseup."+e.data("mCustomScrollbarIndex")+" MSPointerMove."+e.data("mCustomScrollbarIndex")+" MSPointerUp."+e.data("mCustomScrollbarIndex"));c(window).unbind("resize."+e.data("mCustomScrollbarIndex"))}},d={showScrollbar:function(){this.stop().animate({opacity:1},"fast")},hideScrollbar:function(){this.stop().animate({opacity:0},"fast")},mTweenAxis:function(g,i,h,f,o,y){var y=y||{},v=y.onStart||function(){},p=y.onUpdate||function(){},w=y.onComplete||function(){};var n=t(),l,j=0,r=g.offsetTop,s=g.style;if(i==="left"){r=g.offsetLeft}var m=h-r;q();e();function t(){if(window.performance&&window.performance.now){return window.performance.now()}else{if(window.performance&&window.performance.webkitNow){return window.performance.webkitNow()}else{if(Date.now){return Date.now()}else{return new Date().getTime()}}}}function x(){if(!j){v.call()}j=t()-n;u();if(j>=g._time){g._time=(j>g._time)?j+l-(j-g._time):j+l-1;if(g._time<j+1){g._time=j+1}}if(g._time<f){g._id=_request(x)}else{w.call()}}function u(){if(f>0){g.currVal=k(g._time,r,m,f,o);s[i]=Math.round(g.currVal)+"px"}else{s[i]=h+"px"}p.call()}function e(){l=1000/60;g._time=j+l;_request=(!window.requestAnimationFrame)?function(z){u();return setTimeout(z,0.01)}:window.requestAnimationFrame;g._id=_request(x)}function q(){if(g._id==null){return}if(!window.requestAnimationFrame){clearTimeout(g._id)}else{window.cancelAnimationFrame(g._id)}g._id=null}function k(B,A,F,E,C){switch(C){case"linear":return F*B/E+A;break;case"easeOutQuad":B/=E;return -F*B*(B-2)+A;break;case"easeInOutQuad":B/=E/2;if(B<1){return F/2*B*B+A}B--;return -F/2*(B*(B-2)-1)+A;break;case"easeOutCubic":B/=E;B--;return F*(B*B*B+1)+A;break;case"easeOutQuart":B/=E;B--;return -F*(B*B*B*B-1)+A;break;case"easeOutQuint":B/=E;B--;return F*(B*B*B*B*B+1)+A;break;case"easeOutCirc":B/=E;B--;return F*Math.sqrt(1-B*B)+A;break;case"easeOutSine":return F*Math.sin(B/E*(Math.PI/2))+A;break;case"easeOutExpo":return F*(-Math.pow(2,-10*B/E)+1)+A;break;case"mcsEaseOut":var D=(B/=E)*B,z=D*B;return A+F*(0.499999999999997*z*D+-2.5*D*D+5.5*z+-6.5*D+4*B);break;case"draggerRailEase":B/=E/2;if(B<1){return F/2*B*B*B+A}B-=2;return F/2*(B*B*B+2)+A;break}}},mTweenAxisStop:function(e){if(e._id==null){return}if(!window.requestAnimationFrame){clearTimeout(e._id)}else{window.cancelAnimationFrame(e._id)}e._id=null},rafPolyfill:function(){var f=["ms","moz","webkit","o"],e=f.length;while(--e>-1&&!window.requestAnimationFrame){window.requestAnimationFrame=window[f[e]+"RequestAnimationFrame"];window.cancelAnimationFrame=window[f[e]+"CancelAnimationFrame"]||window[f[e]+"CancelRequestAnimationFrame"]}}};d.rafPolyfill.call();c.support.touch=!!("ontouchstart" in window);c.support.pointer=window.navigator.pointerEnabled;c.support.msPointer=window.navigator.msPointerEnabled;var a=("https:"==document.location.protocol)?"https:":"http:";c.event.special.mousewheel||document.write('<script src="'+a+'//cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.0.6/jquery.mousewheel.min.js"><\/script>');c.fn.mCustomScrollbar=function(e){if(b[e]){return b[e].apply(this,Array.prototype.slice.call(arguments,1))}else{if(typeof e==="object"||!e){return b.init.apply(this,arguments)}else{c.error("Method "+e+" does not exist")}}}})(jQuery);

//Jplayer
(function(b,f){"function"===typeof define&&define.amd?define(["jquery"],f):b.jQuery?f(b.jQuery):f(b.Zepto)})(this,function(b,f){b.fn.jPlayer=function(a){var c="string"===typeof a,d=Array.prototype.slice.call(arguments,1),e=this;a=!c&&d.length?b.extend.apply(null,[!0,a].concat(d)):a;if(c&&"_"===a.charAt(0))return e;c?this.each(function(){var c=b(this).data("jPlayer"),h=c&&b.isFunction(c[a])?c[a].apply(c,d):c;if(h!==c&&h!==f)return e=h,!1}):this.each(function(){var c=b(this).data("jPlayer");c?c.option(a||
{}):b(this).data("jPlayer",new b.jPlayer(a,this))});return e};b.jPlayer=function(a,c){if(arguments.length){this.element=b(c);this.options=b.extend(!0,{},this.options,a);var d=this;this.element.bind("remove.jPlayer",function(){d.destroy()});this._init()}};"function"!==typeof b.fn.stop&&(b.fn.stop=function(){});b.jPlayer.emulateMethods="load play pause";b.jPlayer.emulateStatus="src readyState networkState currentTime duration paused ended playbackRate";b.jPlayer.emulateOptions="muted volume";b.jPlayer.reservedEvent=
"ready flashreset resize repeat error warning";b.jPlayer.event={};b.each("ready setmedia flashreset resize repeat click error warning loadstart progress suspend abort emptied stalled play pause loadedmetadata loadeddata waiting playing canplay canplaythrough seeking seeked timeupdate ended ratechange durationchange volumechange".split(" "),function(){b.jPlayer.event[this]="jPlayer_"+this});b.jPlayer.htmlEvent="loadstart abort emptied stalled loadedmetadata loadeddata canplay canplaythrough".split(" ");
b.jPlayer.pause=function(){b.each(b.jPlayer.prototype.instances,function(a,c){c.data("jPlayer").status.srcSet&&c.jPlayer("pause")})};b.jPlayer.timeFormat={showHour:!1,showMin:!0,showSec:!0,padHour:!1,padMin:!0,padSec:!0,sepHour:":",sepMin:":",sepSec:""};var l=function(){this.init()};l.prototype={init:function(){this.options={timeFormat:b.jPlayer.timeFormat}},time:function(a){var c=new Date(1E3*(a&&"number"===typeof a?a:0)),b=c.getUTCHours();a=this.options.timeFormat.showHour?c.getUTCMinutes():c.getUTCMinutes()+
60*b;c=this.options.timeFormat.showMin?c.getUTCSeconds():c.getUTCSeconds()+60*a;b=this.options.timeFormat.padHour&&10>b?"0"+b:b;a=this.options.timeFormat.padMin&&10>a?"0"+a:a;c=this.options.timeFormat.padSec&&10>c?"0"+c:c;b=""+(this.options.timeFormat.showHour?b+this.options.timeFormat.sepHour:"");b+=this.options.timeFormat.showMin?a+this.options.timeFormat.sepMin:"";return b+=this.options.timeFormat.showSec?c+this.options.timeFormat.sepSec:""}};var n=new l;b.jPlayer.convertTime=function(a){return n.time(a)};
b.jPlayer.uaBrowser=function(a){a=a.toLowerCase();var c=/(opera)(?:.*version)?[ \/]([\w.]+)/,b=/(msie) ([\w.]+)/,e=/(mozilla)(?:.*? rv:([\w.]+))?/;a=/(webkit)[ \/]([\w.]+)/.exec(a)||c.exec(a)||b.exec(a)||0>a.indexOf("compatible")&&e.exec(a)||[];return{browser:a[1]||"",version:a[2]||"0"}};b.jPlayer.uaPlatform=function(a){var c=a.toLowerCase(),b=/(android)/,e=/(mobile)/;a=/(ipad|iphone|ipod|android|blackberry|playbook|windows ce|webos)/.exec(c)||[];c=/(ipad|playbook)/.exec(c)||!e.exec(c)&&b.exec(c)||
[];a[1]&&(a[1]=a[1].replace(/\s/g,"_"));return{platform:a[1]||"",tablet:c[1]||""}};b.jPlayer.browser={};b.jPlayer.platform={};var k=b.jPlayer.uaBrowser(navigator.userAgent);k.browser&&(b.jPlayer.browser[k.browser]=!0,b.jPlayer.browser.version=k.version);k=b.jPlayer.uaPlatform(navigator.userAgent);k.platform&&(b.jPlayer.platform[k.platform]=!0,b.jPlayer.platform.mobile=!k.tablet,b.jPlayer.platform.tablet=!!k.tablet);b.jPlayer.getDocMode=function(){var a;b.jPlayer.browser.msie&&(document.documentMode?
a=document.documentMode:(a=5,document.compatMode&&"CSS1Compat"===document.compatMode&&(a=7)));return a};b.jPlayer.browser.documentMode=b.jPlayer.getDocMode();b.jPlayer.nativeFeatures={init:function(){var a=document,c=a.createElement("video"),b={w3c:"fullscreenEnabled fullscreenElement requestFullscreen exitFullscreen fullscreenchange fullscreenerror".split(" "),moz:"mozFullScreenEnabled mozFullScreenElement mozRequestFullScreen mozCancelFullScreen mozfullscreenchange mozfullscreenerror".split(" "),
webkit:" webkitCurrentFullScreenElement webkitRequestFullScreen webkitCancelFullScreen webkitfullscreenchange ".split(" "),webkitVideo:"webkitSupportsFullscreen webkitDisplayingFullscreen webkitEnterFullscreen webkitExitFullscreen  ".split(" ")},e=["w3c","moz","webkit","webkitVideo"],g,h;this.fullscreen=c={support:{w3c:!!a[b.w3c[0]],moz:!!a[b.moz[0]],webkit:"function"===typeof a[b.webkit[3]],webkitVideo:"function"===typeof c[b.webkitVideo[2]]},used:{}};g=0;for(h=e.length;g<h;g++){var f=e[g];if(c.support[f]){c.spec=
f;c.used[f]=!0;break}}if(c.spec){var m=b[c.spec];c.api={fullscreenEnabled:!0,fullscreenElement:function(c){c=c?c:a;return c[m[1]]},requestFullscreen:function(a){return a[m[2]]()},exitFullscreen:function(c){c=c?c:a;return c[m[3]]()}};c.event={fullscreenchange:m[4],fullscreenerror:m[5]}}else c.api={fullscreenEnabled:!1,fullscreenElement:function(){return null},requestFullscreen:function(){},exitFullscreen:function(){}},c.event={}}};b.jPlayer.nativeFeatures.init();b.jPlayer.focus=null;b.jPlayer.keyIgnoreElementNames=
"INPUT TEXTAREA";var p=function(a){var c=b.jPlayer.focus,d;c&&(b.each(b.jPlayer.keyIgnoreElementNames.split(/\s+/g),function(c,b){if(a.target.nodeName.toUpperCase()===b.toUpperCase())return d=!0,!1}),d||b.each(c.options.keyBindings,function(d,g){if(g&&a.which===g.key&&b.isFunction(g.fn))return a.preventDefault(),g.fn(c),!1}))};b.jPlayer.keys=function(a){b(document.documentElement).unbind("keydown.jPlayer");a&&b(document.documentElement).bind("keydown.jPlayer",p)};b.jPlayer.keys(!0);b.jPlayer.prototype=
{count:0,version:{script:"2.6.0",needFlash:"2.6.0",flash:"unknown"},options:{swfPath:"js",solution:"html, flash",supplied:"mp3",preload:"metadata",volume:0.8,muted:!1,remainingDuration:!1,toggleDuration:!1,playbackRate:1,defaultPlaybackRate:1,minPlaybackRate:0.5,maxPlaybackRate:4,wmode:"opaque",backgroundColor:"#000000",cssSelectorAncestor:"#jp_container_1",cssSelector:{videoPlay:".jp-video-play",play:".jp-play",pause:".jp-pause",stop:".jp-stop",seekBar:".jp-seek-bar",playBar:".jp-play-bar",mute:".jp-mute",
unmute:".jp-unmute",volumeBar:".jp-volume-bar",volumeBarValue:".jp-volume-bar-value",volumeMax:".jp-volume-max",playbackRateBar:".jp-playback-rate-bar",playbackRateBarValue:".jp-playback-rate-bar-value",currentTime:".jp-current-time",duration:".jp-duration",title:".jp-title",fullScreen:".jp-full-screen",restoreScreen:".jp-restore-screen",repeat:".jp-repeat",repeatOff:".jp-repeat-off",gui:".jp-gui",noSolution:".jp-no-solution"},smoothPlayBar:!1,fullScreen:!1,fullWindow:!1,autohide:{restored:!1,full:!0,
fadeIn:200,fadeOut:600,hold:1E3},loop:!1,repeat:function(a){a.jPlayer.options.loop?b(this).unbind(".jPlayerRepeat").bind(b.jPlayer.event.ended+".jPlayer.jPlayerRepeat",function(){b(this).jPlayer("play")}):b(this).unbind(".jPlayerRepeat")},nativeVideoControls:{},noFullWindow:{msie:/msie [0-6]\./,ipad:/ipad.*?os [0-4]\./,iphone:/iphone/,ipod:/ipod/,android_pad:/android [0-3]\.(?!.*?mobile)/,android_phone:/android.*?mobile/,blackberry:/blackberry/,windows_ce:/windows ce/,iemobile:/iemobile/,webos:/webos/},
noVolume:{ipad:/ipad/,iphone:/iphone/,ipod:/ipod/,android_pad:/android(?!.*?mobile)/,android_phone:/android.*?mobile/,blackberry:/blackberry/,windows_ce:/windows ce/,iemobile:/iemobile/,webos:/webos/,playbook:/playbook/},timeFormat:{},keyEnabled:!1,audioFullScreen:!1,keyBindings:{play:{key:32,fn:function(a){a.status.paused?a.play():a.pause()}},fullScreen:{key:13,fn:function(a){(a.status.video||a.options.audioFullScreen)&&a._setOption("fullScreen",!a.options.fullScreen)}},muted:{key:8,fn:function(a){a._muted(!a.options.muted)}},
volumeUp:{key:38,fn:function(a){a.volume(a.options.volume+0.1)}},volumeDown:{key:40,fn:function(a){a.volume(a.options.volume-0.1)}}},verticalVolume:!1,verticalPlaybackRate:!1,globalVolume:!1,idPrefix:"jp",noConflict:"jQuery",emulateHtml:!1,consoleAlerts:!0,errorAlerts:!1,warningAlerts:!1},optionsAudio:{size:{width:"0px",height:"0px",cssClass:""},sizeFull:{width:"0px",height:"0px",cssClass:""}},optionsVideo:{size:{width:"480px",height:"270px",cssClass:"jp-video-270p"},sizeFull:{width:"100%",height:"100%",
cssClass:"jp-video-full"}},instances:{},status:{src:"",media:{},paused:!0,format:{},formatType:"",waitForPlay:!0,waitForLoad:!0,srcSet:!1,video:!1,seekPercent:0,currentPercentRelative:0,currentPercentAbsolute:0,currentTime:0,duration:0,remaining:0,videoWidth:0,videoHeight:0,readyState:0,networkState:0,playbackRate:1,ended:0},internal:{ready:!1},solution:{html:!0,flash:!0},format:{mp3:{codec:'audio/mpeg; codecs="mp3"',flashCanPlay:!0,media:"audio"},m4a:{codec:'audio/mp4; codecs="mp4a.40.2"',flashCanPlay:!0,
media:"audio"},m3u8a:{codec:'application/vnd.apple.mpegurl; codecs="mp4a.40.2"',flashCanPlay:!1,media:"audio"},m3ua:{codec:"audio/mpegurl",flashCanPlay:!1,media:"audio"},oga:{codec:'audio/ogg; codecs="vorbis, opus"',flashCanPlay:!1,media:"audio"},flac:{codec:"audio/x-flac",flashCanPlay:!1,media:"audio"},wav:{codec:'audio/wav; codecs="1"',flashCanPlay:!1,media:"audio"},webma:{codec:'audio/webm; codecs="vorbis"',flashCanPlay:!1,media:"audio"},fla:{codec:"audio/x-flv",flashCanPlay:!0,media:"audio"},
rtmpa:{codec:'audio/rtmp; codecs="rtmp"',flashCanPlay:!0,media:"audio"},m4v:{codec:'video/mp4; codecs="avc1.42E01E, mp4a.40.2"',flashCanPlay:!0,media:"video"},m3u8v:{codec:'application/vnd.apple.mpegurl; codecs="avc1.42E01E, mp4a.40.2"',flashCanPlay:!1,media:"video"},m3uv:{codec:"audio/mpegurl",flashCanPlay:!1,media:"video"},ogv:{codec:'video/ogg; codecs="theora, vorbis"',flashCanPlay:!1,media:"video"},webmv:{codec:'video/webm; codecs="vorbis, vp8"',flashCanPlay:!1,media:"video"},flv:{codec:"video/x-flv",
flashCanPlay:!0,media:"video"},rtmpv:{codec:'video/rtmp; codecs="rtmp"',flashCanPlay:!0,media:"video"}},_init:function(){var a=this;this.element.empty();this.status=b.extend({},this.status);this.internal=b.extend({},this.internal);this.options.timeFormat=b.extend({},b.jPlayer.timeFormat,this.options.timeFormat);this.internal.cmdsIgnored=b.jPlayer.platform.ipad||b.jPlayer.platform.iphone||b.jPlayer.platform.ipod;this.internal.domNode=this.element.get(0);this.options.keyEnabled&&!b.jPlayer.focus&&(b.jPlayer.focus=
this);this.androidFix={setMedia:!1,play:!1,pause:!1,time:NaN};b.jPlayer.platform.android&&(this.options.preload="auto"!==this.options.preload?"metadata":"auto");this.formats=[];this.solutions=[];this.require={};this.htmlElement={};this.html={};this.html.audio={};this.html.video={};this.flash={};this.css={};this.css.cs={};this.css.jq={};this.ancestorJq=[];this.options.volume=this._limitValue(this.options.volume,0,1);b.each(this.options.supplied.toLowerCase().split(","),function(c,d){var e=d.replace(/^\s+|\s+$/g,
"");if(a.format[e]){var f=!1;b.each(a.formats,function(a,c){if(e===c)return f=!0,!1});f||a.formats.push(e)}});b.each(this.options.solution.toLowerCase().split(","),function(c,d){var e=d.replace(/^\s+|\s+$/g,"");if(a.solution[e]){var f=!1;b.each(a.solutions,function(a,c){if(e===c)return f=!0,!1});f||a.solutions.push(e)}});this.internal.instance="jp_"+this.count;this.instances[this.internal.instance]=this.element;this.element.attr("id")||this.element.attr("id",this.options.idPrefix+"_jplayer_"+this.count);
this.internal.self=b.extend({},{id:this.element.attr("id"),jq:this.element});this.internal.audio=b.extend({},{id:this.options.idPrefix+"_audio_"+this.count,jq:f});this.internal.video=b.extend({},{id:this.options.idPrefix+"_video_"+this.count,jq:f});this.internal.flash=b.extend({},{id:this.options.idPrefix+"_flash_"+this.count,jq:f,swf:this.options.swfPath+(".swf"!==this.options.swfPath.toLowerCase().slice(-4)?(this.options.swfPath&&"/"!==this.options.swfPath.slice(-1)?"/":"")+"Jplayer.swf":"")});
this.internal.poster=b.extend({},{id:this.options.idPrefix+"_poster_"+this.count,jq:f});b.each(b.jPlayer.event,function(c,b){a.options[c]!==f&&(a.element.bind(b+".jPlayer",a.options[c]),a.options[c]=f)});this.require.audio=!1;this.require.video=!1;b.each(this.formats,function(c,b){a.require[a.format[b].media]=!0});this.options=this.require.video?b.extend(!0,{},this.optionsVideo,this.options):b.extend(!0,{},this.optionsAudio,this.options);this._setSize();this.status.nativeVideoControls=this._uaBlocklist(this.options.nativeVideoControls);
this.status.noFullWindow=this._uaBlocklist(this.options.noFullWindow);this.status.noVolume=this._uaBlocklist(this.options.noVolume);b.jPlayer.nativeFeatures.fullscreen.api.fullscreenEnabled&&this._fullscreenAddEventListeners();this._restrictNativeVideoControls();this.htmlElement.poster=document.createElement("img");this.htmlElement.poster.id=this.internal.poster.id;this.htmlElement.poster.onload=function(){a.status.video&&!a.status.waitForPlay||a.internal.poster.jq.show()};this.element.append(this.htmlElement.poster);
this.internal.poster.jq=b("#"+this.internal.poster.id);this.internal.poster.jq.css({width:this.status.width,height:this.status.height});this.internal.poster.jq.hide();this.internal.poster.jq.bind("click.jPlayer",function(){a._trigger(b.jPlayer.event.click)});this.html.audio.available=!1;this.require.audio&&(this.htmlElement.audio=document.createElement("audio"),this.htmlElement.audio.id=this.internal.audio.id,this.html.audio.available=!!this.htmlElement.audio.canPlayType&&this._testCanPlayType(this.htmlElement.audio));
this.html.video.available=!1;this.require.video&&(this.htmlElement.video=document.createElement("video"),this.htmlElement.video.id=this.internal.video.id,this.html.video.available=!!this.htmlElement.video.canPlayType&&this._testCanPlayType(this.htmlElement.video));this.flash.available=this._checkForFlash(10.1);this.html.canPlay={};this.flash.canPlay={};b.each(this.formats,function(c,b){a.html.canPlay[b]=a.html[a.format[b].media].available&&""!==a.htmlElement[a.format[b].media].canPlayType(a.format[b].codec);
a.flash.canPlay[b]=a.format[b].flashCanPlay&&a.flash.available});this.html.desired=!1;this.flash.desired=!1;b.each(this.solutions,function(c,d){if(0===c)a[d].desired=!0;else{var e=!1,f=!1;b.each(a.formats,function(c,b){a[a.solutions[0]].canPlay[b]&&("video"===a.format[b].media?f=!0:e=!0)});a[d].desired=a.require.audio&&!e||a.require.video&&!f}});this.html.support={};this.flash.support={};b.each(this.formats,function(c,b){a.html.support[b]=a.html.canPlay[b]&&a.html.desired;a.flash.support[b]=a.flash.canPlay[b]&&
a.flash.desired});this.html.used=!1;this.flash.used=!1;b.each(this.solutions,function(c,d){b.each(a.formats,function(c,b){if(a[d].support[b])return a[d].used=!0,!1})});this._resetActive();this._resetGate();this._cssSelectorAncestor(this.options.cssSelectorAncestor);this.html.used||this.flash.used?this.css.jq.noSolution.length&&this.css.jq.noSolution.hide():(this._error({type:b.jPlayer.error.NO_SOLUTION,context:"{solution:'"+this.options.solution+"', supplied:'"+this.options.supplied+"'}",message:b.jPlayer.errorMsg.NO_SOLUTION,
hint:b.jPlayer.errorHint.NO_SOLUTION}),this.css.jq.noSolution.length&&this.css.jq.noSolution.show());if(this.flash.used){var c,d="jQuery="+encodeURI(this.options.noConflict)+"&id="+encodeURI(this.internal.self.id)+"&vol="+this.options.volume+"&muted="+this.options.muted;if(b.jPlayer.browser.msie&&(9>Number(b.jPlayer.browser.version)||9>b.jPlayer.browser.documentMode)){d=['<param name="movie" value="'+this.internal.flash.swf+'" />','<param name="FlashVars" value="'+d+'" />','<param name="allowScriptAccess" value="always" />',
'<param name="bgcolor" value="'+this.options.backgroundColor+'" />','<param name="wmode" value="'+this.options.wmode+'" />'];c=document.createElement('<object id="'+this.internal.flash.id+'" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="0" height="0" tabindex="-1"></object>');for(var e=0;e<d.length;e++)c.appendChild(document.createElement(d[e]))}else e=function(a,c,b){var d=document.createElement("param");d.setAttribute("name",c);d.setAttribute("value",b);a.appendChild(d)},c=document.createElement("object"),
c.setAttribute("id",this.internal.flash.id),c.setAttribute("name",this.internal.flash.id),c.setAttribute("data",this.internal.flash.swf),c.setAttribute("type","application/x-shockwave-flash"),c.setAttribute("width","1"),c.setAttribute("height","1"),c.setAttribute("tabindex","-1"),e(c,"flashvars",d),e(c,"allowscriptaccess","always"),e(c,"bgcolor",this.options.backgroundColor),e(c,"wmode",this.options.wmode);this.element.append(c);this.internal.flash.jq=b(c)}this.status.playbackRateEnabled=this.html.used&&
!this.flash.used?this._testPlaybackRate("audio"):!1;this._updatePlaybackRate();this.html.used&&(this.html.audio.available&&(this._addHtmlEventListeners(this.htmlElement.audio,this.html.audio),this.element.append(this.htmlElement.audio),this.internal.audio.jq=b("#"+this.internal.audio.id)),this.html.video.available&&(this._addHtmlEventListeners(this.htmlElement.video,this.html.video),this.element.append(this.htmlElement.video),this.internal.video.jq=b("#"+this.internal.video.id),this.status.nativeVideoControls?
this.internal.video.jq.css({width:this.status.width,height:this.status.height}):this.internal.video.jq.css({width:"0px",height:"0px"}),this.internal.video.jq.bind("click.jPlayer",function(){a._trigger(b.jPlayer.event.click)})));this.options.emulateHtml&&this._emulateHtmlBridge();this.html.used&&!this.flash.used&&setTimeout(function(){a.internal.ready=!0;a.version.flash="n/a";a._trigger(b.jPlayer.event.repeat);a._trigger(b.jPlayer.event.ready)},100);this._updateNativeVideoControls();this.css.jq.videoPlay.length&&
this.css.jq.videoPlay.hide();b.jPlayer.prototype.count++},destroy:function(){this.clearMedia();this._removeUiClass();this.css.jq.currentTime.length&&this.css.jq.currentTime.text("");this.css.jq.duration.length&&this.css.jq.duration.text("");b.each(this.css.jq,function(a,c){c.length&&c.unbind(".jPlayer")});this.internal.poster.jq.unbind(".jPlayer");this.internal.video.jq&&this.internal.video.jq.unbind(".jPlayer");this._fullscreenRemoveEventListeners();this===b.jPlayer.focus&&(b.jPlayer.focus=null);
this.options.emulateHtml&&this._destroyHtmlBridge();this.element.removeData("jPlayer");this.element.unbind(".jPlayer");this.element.empty();delete this.instances[this.internal.instance]},enable:function(){},disable:function(){},_testCanPlayType:function(a){try{return a.canPlayType(this.format.mp3.codec),!0}catch(c){return!1}},_testPlaybackRate:function(a){a=document.createElement("string"===typeof a?a:"audio");try{return"playbackRate"in a?(a.playbackRate=0.5,0.5===a.playbackRate):!1}catch(c){return!1}},
_uaBlocklist:function(a){var c=navigator.userAgent.toLowerCase(),d=!1;b.each(a,function(a,b){if(b&&b.test(c))return d=!0,!1});return d},_restrictNativeVideoControls:function(){this.require.audio&&this.status.nativeVideoControls&&(this.status.nativeVideoControls=!1,this.status.noFullWindow=!0)},_updateNativeVideoControls:function(){this.html.video.available&&this.html.used&&(this.htmlElement.video.controls=this.status.nativeVideoControls,this._updateAutohide(),this.status.nativeVideoControls&&this.require.video?
(this.internal.poster.jq.hide(),this.internal.video.jq.css({width:this.status.width,height:this.status.height})):this.status.waitForPlay&&this.status.video&&(this.internal.poster.jq.show(),this.internal.video.jq.css({width:"0px",height:"0px"})))},_addHtmlEventListeners:function(a,c){var d=this;a.preload=this.options.preload;a.muted=this.options.muted;a.volume=this.options.volume;this.status.playbackRateEnabled&&(a.defaultPlaybackRate=this.options.defaultPlaybackRate,a.playbackRate=this.options.playbackRate);
a.addEventListener("progress",function(){c.gate&&(d.internal.cmdsIgnored&&0<this.readyState&&(d.internal.cmdsIgnored=!1),d.androidFix.setMedia=!1,d.androidFix.play&&(d.androidFix.play=!1,d.play(d.androidFix.time)),d.androidFix.pause&&(d.androidFix.pause=!1,d.pause(d.androidFix.time)),d._getHtmlStatus(a),d._updateInterface(),d._trigger(b.jPlayer.event.progress))},!1);a.addEventListener("timeupdate",function(){c.gate&&(d._getHtmlStatus(a),d._updateInterface(),d._trigger(b.jPlayer.event.timeupdate))},
!1);a.addEventListener("durationchange",function(){c.gate&&(d._getHtmlStatus(a),d._updateInterface(),d._trigger(b.jPlayer.event.durationchange))},!1);a.addEventListener("play",function(){c.gate&&(d._updateButtons(!0),d._html_checkWaitForPlay(),d._trigger(b.jPlayer.event.play))},!1);a.addEventListener("playing",function(){c.gate&&(d._updateButtons(!0),d._seeked(),d._trigger(b.jPlayer.event.playing))},!1);a.addEventListener("pause",function(){c.gate&&(d._updateButtons(!1),d._trigger(b.jPlayer.event.pause))},
!1);a.addEventListener("waiting",function(){c.gate&&(d._seeking(),d._trigger(b.jPlayer.event.waiting))},!1);a.addEventListener("seeking",function(){c.gate&&(d._seeking(),d._trigger(b.jPlayer.event.seeking))},!1);a.addEventListener("seeked",function(){c.gate&&(d._seeked(),d._trigger(b.jPlayer.event.seeked))},!1);a.addEventListener("volumechange",function(){c.gate&&(d.options.volume=a.volume,d.options.muted=a.muted,d._updateMute(),d._updateVolume(),d._trigger(b.jPlayer.event.volumechange))},!1);a.addEventListener("ratechange",
function(){c.gate&&(d.options.defaultPlaybackRate=a.defaultPlaybackRate,d.options.playbackRate=a.playbackRate,d._updatePlaybackRate(),d._trigger(b.jPlayer.event.ratechange))},!1);a.addEventListener("suspend",function(){c.gate&&(d._seeked(),d._trigger(b.jPlayer.event.suspend))},!1);a.addEventListener("ended",function(){c.gate&&(b.jPlayer.browser.webkit||(d.htmlElement.media.currentTime=0),d.htmlElement.media.pause(),d._updateButtons(!1),d._getHtmlStatus(a,!0),d._updateInterface(),d._trigger(b.jPlayer.event.ended))},
!1);a.addEventListener("error",function(){c.gate&&(d._updateButtons(!1),d._seeked(),d.status.srcSet&&(clearTimeout(d.internal.htmlDlyCmdId),d.status.waitForLoad=!0,d.status.waitForPlay=!0,d.status.video&&!d.status.nativeVideoControls&&d.internal.video.jq.css({width:"0px",height:"0px"}),d._validString(d.status.media.poster)&&!d.status.nativeVideoControls&&d.internal.poster.jq.show(),d.css.jq.videoPlay.length&&d.css.jq.videoPlay.show(),d._error({type:b.jPlayer.error.URL,context:d.status.src,message:b.jPlayer.errorMsg.URL,
hint:b.jPlayer.errorHint.URL})))},!1);b.each(b.jPlayer.htmlEvent,function(e,g){a.addEventListener(this,function(){c.gate&&d._trigger(b.jPlayer.event[g])},!1)})},_getHtmlStatus:function(a,c){var b=0,e=0,g=0,f=0;isFinite(a.duration)&&(this.status.duration=a.duration);b=a.currentTime;e=0<this.status.duration?100*b/this.status.duration:0;"object"===typeof a.seekable&&0<a.seekable.length?(g=0<this.status.duration?100*a.seekable.end(a.seekable.length-1)/this.status.duration:100,f=0<this.status.duration?
100*a.currentTime/a.seekable.end(a.seekable.length-1):0):(g=100,f=e);c&&(e=f=b=0);this.status.seekPercent=g;this.status.currentPercentRelative=f;this.status.currentPercentAbsolute=e;this.status.currentTime=b;this.status.remaining=this.status.duration-this.status.currentTime;this.status.videoWidth=a.videoWidth;this.status.videoHeight=a.videoHeight;this.status.readyState=a.readyState;this.status.networkState=a.networkState;this.status.playbackRate=a.playbackRate;this.status.ended=a.ended},_resetStatus:function(){this.status=
b.extend({},this.status,b.jPlayer.prototype.status)},_trigger:function(a,c,d){a=b.Event(a);a.jPlayer={};a.jPlayer.version=b.extend({},this.version);a.jPlayer.options=b.extend(!0,{},this.options);a.jPlayer.status=b.extend(!0,{},this.status);a.jPlayer.html=b.extend(!0,{},this.html);a.jPlayer.flash=b.extend(!0,{},this.flash);c&&(a.jPlayer.error=b.extend({},c));d&&(a.jPlayer.warning=b.extend({},d));this.element.trigger(a)},jPlayerFlashEvent:function(a,c){if(a===b.jPlayer.event.ready)if(!this.internal.ready)this.internal.ready=
!0,this.internal.flash.jq.css({width:"0px",height:"0px"}),this.version.flash=c.version,this.version.needFlash!==this.version.flash&&this._error({type:b.jPlayer.error.VERSION,context:this.version.flash,message:b.jPlayer.errorMsg.VERSION+this.version.flash,hint:b.jPlayer.errorHint.VERSION}),this._trigger(b.jPlayer.event.repeat),this._trigger(a);else if(this.flash.gate){if(this.status.srcSet){var d=this.status.currentTime,e=this.status.paused;this.setMedia(this.status.media);this.volumeWorker(this.options.volume);
0<d&&(e?this.pause(d):this.play(d))}this._trigger(b.jPlayer.event.flashreset)}if(this.flash.gate)switch(a){case b.jPlayer.event.progress:this._getFlashStatus(c);this._updateInterface();this._trigger(a);break;case b.jPlayer.event.timeupdate:this._getFlashStatus(c);this._updateInterface();this._trigger(a);break;case b.jPlayer.event.play:this._seeked();this._updateButtons(!0);this._trigger(a);break;case b.jPlayer.event.pause:this._updateButtons(!1);this._trigger(a);break;case b.jPlayer.event.ended:this._updateButtons(!1);
this._trigger(a);break;case b.jPlayer.event.click:this._trigger(a);break;case b.jPlayer.event.error:this.status.waitForLoad=!0;this.status.waitForPlay=!0;this.status.video&&this.internal.flash.jq.css({width:"0px",height:"0px"});this._validString(this.status.media.poster)&&this.internal.poster.jq.show();this.css.jq.videoPlay.length&&this.status.video&&this.css.jq.videoPlay.show();this.status.video?this._flash_setVideo(this.status.media):this._flash_setAudio(this.status.media);this._updateButtons(!1);
this._error({type:b.jPlayer.error.URL,context:c.src,message:b.jPlayer.errorMsg.URL,hint:b.jPlayer.errorHint.URL});break;case b.jPlayer.event.seeking:this._seeking();this._trigger(a);break;case b.jPlayer.event.seeked:this._seeked();this._trigger(a);break;case b.jPlayer.event.ready:break;default:this._trigger(a)}return!1},_getFlashStatus:function(a){this.status.seekPercent=a.seekPercent;this.status.currentPercentRelative=a.currentPercentRelative;this.status.currentPercentAbsolute=a.currentPercentAbsolute;
this.status.currentTime=a.currentTime;this.status.duration=a.duration;this.status.remaining=a.duration-a.currentTime;this.status.videoWidth=a.videoWidth;this.status.videoHeight=a.videoHeight;this.status.readyState=4;this.status.networkState=0;this.status.playbackRate=1;this.status.ended=!1},_updateButtons:function(a){a===f?a=!this.status.paused:this.status.paused=!a;this.css.jq.play.length&&this.css.jq.pause.length&&(a?(this.css.jq.play.hide(),this.css.jq.pause.show()):(this.css.jq.play.show(),this.css.jq.pause.hide()));
this.css.jq.restoreScreen.length&&this.css.jq.fullScreen.length&&(this.status.noFullWindow?(this.css.jq.fullScreen.hide(),this.css.jq.restoreScreen.hide()):this.options.fullWindow?(this.css.jq.fullScreen.hide(),this.css.jq.restoreScreen.show()):(this.css.jq.fullScreen.show(),this.css.jq.restoreScreen.hide()));this.css.jq.repeat.length&&this.css.jq.repeatOff.length&&(this.options.loop?(this.css.jq.repeat.hide(),this.css.jq.repeatOff.show()):(this.css.jq.repeat.show(),this.css.jq.repeatOff.hide()))},
_updateInterface:function(){this.css.jq.seekBar.length&&this.css.jq.seekBar.width(this.status.seekPercent+"%");this.css.jq.playBar.length&&(this.options.smoothPlayBar?this.css.jq.playBar.stop().animate({width:this.status.currentPercentAbsolute+"%"},250,"linear"):this.css.jq.playBar.width(this.status.currentPercentRelative+"%"));var a="";this.css.jq.currentTime.length&&(a=this._convertTime(this.status.currentTime),a!==this.css.jq.currentTime.text()&&this.css.jq.currentTime.text(this._convertTime(this.status.currentTime)));
var a="",a=this.status.duration,c=this.status.remaining;this.css.jq.duration.length&&("string"===typeof this.status.media.duration?a=this.status.media.duration:("number"===typeof this.status.media.duration&&(a=this.status.media.duration,c=a-this.status.currentTime),a=this.options.remainingDuration?(0<c?"-":"")+this._convertTime(c):this._convertTime(a)),a!==this.css.jq.duration.text()&&this.css.jq.duration.text(a))},_convertTime:l.prototype.time,_seeking:function(){this.css.jq.seekBar.length&&this.css.jq.seekBar.addClass("jp-seeking-bg")},
_seeked:function(){this.css.jq.seekBar.length&&this.css.jq.seekBar.removeClass("jp-seeking-bg")},_resetGate:function(){this.html.audio.gate=!1;this.html.video.gate=!1;this.flash.gate=!1},_resetActive:function(){this.html.active=!1;this.flash.active=!1},_escapeHtml:function(a){return a.split("&").join("&amp;").split("<").join("&lt;").split(">").join("&gt;").split('"').join("&quot;")},_qualifyURL:function(a){var c=document.createElement("div");c.innerHTML='<a href="'+this._escapeHtml(a)+'">x</a>';return c.firstChild.href},
_absoluteMediaUrls:function(a){var c=this;b.each(a,function(b,e){e&&c.format[b]&&(a[b]=c._qualifyURL(e))});return a},setMedia:function(a){var c=this,d=!1,e=this.status.media.poster!==a.poster;this._resetMedia();this._resetGate();this._resetActive();this.androidFix.setMedia=!1;this.androidFix.play=!1;this.androidFix.pause=!1;a=this._absoluteMediaUrls(a);b.each(this.formats,function(e,f){var k="video"===c.format[f].media;b.each(c.solutions,function(e,g){if(c[g].support[f]&&c._validString(a[f])){var l=
"html"===g;k?(l?(c.html.video.gate=!0,c._html_setVideo(a),c.html.active=!0):(c.flash.gate=!0,c._flash_setVideo(a),c.flash.active=!0),c.css.jq.videoPlay.length&&c.css.jq.videoPlay.show(),c.status.video=!0):(l?(c.html.audio.gate=!0,c._html_setAudio(a),c.html.active=!0,b.jPlayer.platform.android&&(c.androidFix.setMedia=!0)):(c.flash.gate=!0,c._flash_setAudio(a),c.flash.active=!0),c.css.jq.videoPlay.length&&c.css.jq.videoPlay.hide(),c.status.video=!1);d=!0;return!1}});if(d)return!1});d?(this.status.nativeVideoControls&&
this.html.video.gate||!this._validString(a.poster)||(e?this.htmlElement.poster.src=a.poster:this.internal.poster.jq.show()),this.css.jq.title.length&&"string"===typeof a.title&&(this.css.jq.title.html(a.title),this.htmlElement.audio&&this.htmlElement.audio.setAttribute("title",a.title),this.htmlElement.video&&this.htmlElement.video.setAttribute("title",a.title)),this.status.srcSet=!0,this.status.media=b.extend({},a),this._updateButtons(!1),this._updateInterface(),this._trigger(b.jPlayer.event.setmedia)):
this._error({type:b.jPlayer.error.NO_SUPPORT,context:"{supplied:'"+this.options.supplied+"'}",message:b.jPlayer.errorMsg.NO_SUPPORT,hint:b.jPlayer.errorHint.NO_SUPPORT})},_resetMedia:function(){this._resetStatus();this._updateButtons(!1);this._updateInterface();this._seeked();this.internal.poster.jq.hide();clearTimeout(this.internal.htmlDlyCmdId);this.html.active?this._html_resetMedia():this.flash.active&&this._flash_resetMedia()},clearMedia:function(){this._resetMedia();this.html.active?this._html_clearMedia():
this.flash.active&&this._flash_clearMedia();this._resetGate();this._resetActive()},load:function(){this.status.srcSet?this.html.active?this._html_load():this.flash.active&&this._flash_load():this._urlNotSetError("load")},focus:function(){this.options.keyEnabled&&(b.jPlayer.focus=this)},play:function(a){a="number"===typeof a?a:NaN;this.status.srcSet?(this.focus(),this.html.active?this._html_play(a):this.flash.active&&this._flash_play(a)):this._urlNotSetError("play")},videoPlay:function(){this.play()},
pause:function(a){a="number"===typeof a?a:NaN;this.status.srcSet?this.html.active?this._html_pause(a):this.flash.active&&this._flash_pause(a):this._urlNotSetError("pause")},tellOthers:function(a,c){var d=this,e="function"===typeof c,g=Array.prototype.slice.call(arguments);"string"===typeof a&&(e&&g.splice(1,1),b.each(this.instances,function(){d.element!==this&&(e&&!c.call(this.data("jPlayer"),d)||this.jPlayer.apply(this,g))}))},pauseOthers:function(a){this.tellOthers("pause",function(){return this.status.srcSet},
a)},stop:function(){this.status.srcSet?this.html.active?this._html_pause(0):this.flash.active&&this._flash_pause(0):this._urlNotSetError("stop")},playHead:function(a){a=this._limitValue(a,0,100);this.status.srcSet?this.html.active?this._html_playHead(a):this.flash.active&&this._flash_playHead(a):this._urlNotSetError("playHead")},_muted:function(a){this.mutedWorker(a);this.options.globalVolume&&this.tellOthers("mutedWorker",function(){return this.options.globalVolume},a)},mutedWorker:function(a){this.options.muted=
a;this.html.used&&this._html_setProperty("muted",a);this.flash.used&&this._flash_mute(a);this.html.video.gate||this.html.audio.gate||(this._updateMute(a),this._updateVolume(this.options.volume),this._trigger(b.jPlayer.event.volumechange))},mute:function(a){a=a===f?!0:!!a;this._muted(a)},unmute:function(a){a=a===f?!0:!!a;this._muted(!a)},_updateMute:function(a){a===f&&(a=this.options.muted);this.css.jq.mute.length&&this.css.jq.unmute.length&&(this.status.noVolume?(this.css.jq.mute.hide(),this.css.jq.unmute.hide()):
a?(this.css.jq.mute.hide(),this.css.jq.unmute.show()):(this.css.jq.mute.show(),this.css.jq.unmute.hide()))},volume:function(a){this.volumeWorker(a);this.options.globalVolume&&this.tellOthers("volumeWorker",function(){return this.options.globalVolume},a)},volumeWorker:function(a){a=this._limitValue(a,0,1);this.options.volume=a;this.html.used&&this._html_setProperty("volume",a);this.flash.used&&this._flash_volume(a);this.html.video.gate||this.html.audio.gate||(this._updateVolume(a),this._trigger(b.jPlayer.event.volumechange))},
volumeBar:function(a){if(this.css.jq.volumeBar.length){var c=b(a.currentTarget),d=c.offset(),e=a.pageX-d.left,g=c.width();a=c.height()-a.pageY+d.top;c=c.height();this.options.verticalVolume?this.volume(a/c):this.volume(e/g)}this.options.muted&&this._muted(!1)},_updateVolume:function(a){a===f&&(a=this.options.volume);a=this.options.muted?0:a;this.status.noVolume?(this.css.jq.volumeBar.length&&this.css.jq.volumeBar.hide(),this.css.jq.volumeBarValue.length&&this.css.jq.volumeBarValue.hide(),this.css.jq.volumeMax.length&&
this.css.jq.volumeMax.hide()):(this.css.jq.volumeBar.length&&this.css.jq.volumeBar.show(),this.css.jq.volumeBarValue.length&&(this.css.jq.volumeBarValue.show(),this.css.jq.volumeBarValue[this.options.verticalVolume?"height":"width"](100*a+"%")),this.css.jq.volumeMax.length&&this.css.jq.volumeMax.show())},volumeMax:function(){this.volume(1);this.options.muted&&this._muted(!1)},_cssSelectorAncestor:function(a){var c=this;this.options.cssSelectorAncestor=a;this._removeUiClass();this.ancestorJq=a?b(a):
[];a&&1!==this.ancestorJq.length&&this._warning({type:b.jPlayer.warning.CSS_SELECTOR_COUNT,context:a,message:b.jPlayer.warningMsg.CSS_SELECTOR_COUNT+this.ancestorJq.length+" found for cssSelectorAncestor.",hint:b.jPlayer.warningHint.CSS_SELECTOR_COUNT});this._addUiClass();b.each(this.options.cssSelector,function(a,b){c._cssSelector(a,b)});this._updateInterface();this._updateButtons();this._updateAutohide();this._updateVolume();this._updateMute()},_cssSelector:function(a,c){var d=this;"string"===typeof c?
b.jPlayer.prototype.options.cssSelector[a]?(this.css.jq[a]&&this.css.jq[a].length&&this.css.jq[a].unbind(".jPlayer"),this.options.cssSelector[a]=c,this.css.cs[a]=this.options.cssSelectorAncestor+" "+c,this.css.jq[a]=c?b(this.css.cs[a]):[],this.css.jq[a].length&&this[a]&&this.css.jq[a].bind("click.jPlayer",function(c){c.preventDefault();d[a](c);b(this).blur()}),c&&1!==this.css.jq[a].length&&this._warning({type:b.jPlayer.warning.CSS_SELECTOR_COUNT,context:this.css.cs[a],message:b.jPlayer.warningMsg.CSS_SELECTOR_COUNT+
this.css.jq[a].length+" found for "+a+" method.",hint:b.jPlayer.warningHint.CSS_SELECTOR_COUNT})):this._warning({type:b.jPlayer.warning.CSS_SELECTOR_METHOD,context:a,message:b.jPlayer.warningMsg.CSS_SELECTOR_METHOD,hint:b.jPlayer.warningHint.CSS_SELECTOR_METHOD}):this._warning({type:b.jPlayer.warning.CSS_SELECTOR_STRING,context:c,message:b.jPlayer.warningMsg.CSS_SELECTOR_STRING,hint:b.jPlayer.warningHint.CSS_SELECTOR_STRING})},duration:function(a){this.options.toggleDuration&&this._setOption("remainingDuration",
!this.options.remainingDuration)},seekBar:function(a){if(this.css.jq.seekBar.length){var c=b(a.currentTarget),d=c.offset();a=a.pageX-d.left;c=c.width();this.playHead(100*a/c)}},playbackRate:function(a){this._setOption("playbackRate",a)},playbackRateBar:function(a){if(this.css.jq.playbackRateBar.length){var c=b(a.currentTarget),d=c.offset(),e=a.pageX-d.left,g=c.width();a=c.height()-a.pageY+d.top;c=c.height();this.playbackRate((this.options.verticalPlaybackRate?a/c:e/g)*(this.options.maxPlaybackRate-
this.options.minPlaybackRate)+this.options.minPlaybackRate)}},_updatePlaybackRate:function(){var a=(this.options.playbackRate-this.options.minPlaybackRate)/(this.options.maxPlaybackRate-this.options.minPlaybackRate);this.status.playbackRateEnabled?(this.css.jq.playbackRateBar.length&&this.css.jq.playbackRateBar.show(),this.css.jq.playbackRateBarValue.length&&(this.css.jq.playbackRateBarValue.show(),this.css.jq.playbackRateBarValue[this.options.verticalPlaybackRate?"height":"width"](100*a+"%"))):(this.css.jq.playbackRateBar.length&&
this.css.jq.playbackRateBar.hide(),this.css.jq.playbackRateBarValue.length&&this.css.jq.playbackRateBarValue.hide())},repeat:function(){this._loop(!0)},repeatOff:function(){this._loop(!1)},_loop:function(a){this.options.loop!==a&&(this.options.loop=a,this._updateButtons(),this._trigger(b.jPlayer.event.repeat))},option:function(a,c){var d=a;if(0===arguments.length)return b.extend(!0,{},this.options);if("string"===typeof a){var e=a.split(".");if(c===f){for(var d=b.extend(!0,{},this.options),g=0;g<e.length;g++)if(d[e[g]]!==
f)d=d[e[g]];else return this._warning({type:b.jPlayer.warning.OPTION_KEY,context:a,message:b.jPlayer.warningMsg.OPTION_KEY,hint:b.jPlayer.warningHint.OPTION_KEY}),f;return d}for(var g=d={},h=0;h<e.length;h++)h<e.length-1?(g[e[h]]={},g=g[e[h]]):g[e[h]]=c}this._setOptions(d);return this},_setOptions:function(a){var c=this;b.each(a,function(a,b){c._setOption(a,b)});return this},_setOption:function(a,c){var d=this;switch(a){case "volume":this.volume(c);break;case "muted":this._muted(c);break;case "globalVolume":this.options[a]=
c;break;case "cssSelectorAncestor":this._cssSelectorAncestor(c);break;case "cssSelector":b.each(c,function(a,c){d._cssSelector(a,c)});break;case "playbackRate":this.options[a]=c=this._limitValue(c,this.options.minPlaybackRate,this.options.maxPlaybackRate);this.html.used&&this._html_setProperty("playbackRate",c);this._updatePlaybackRate();break;case "defaultPlaybackRate":this.options[a]=c=this._limitValue(c,this.options.minPlaybackRate,this.options.maxPlaybackRate);this.html.used&&this._html_setProperty("defaultPlaybackRate",
c);this._updatePlaybackRate();break;case "minPlaybackRate":this.options[a]=c=this._limitValue(c,0.1,this.options.maxPlaybackRate-0.1);this._updatePlaybackRate();break;case "maxPlaybackRate":this.options[a]=c=this._limitValue(c,this.options.minPlaybackRate+0.1,16);this._updatePlaybackRate();break;case "fullScreen":if(this.options[a]!==c){var e=b.jPlayer.nativeFeatures.fullscreen.used.webkitVideo;if(!e||e&&!this.status.waitForPlay)e||(this.options[a]=c),c?this._requestFullscreen():this._exitFullscreen(),
e||this._setOption("fullWindow",c)}break;case "fullWindow":this.options[a]!==c&&(this._removeUiClass(),this.options[a]=c,this._refreshSize());break;case "size":this.options.fullWindow||this.options[a].cssClass===c.cssClass||this._removeUiClass();this.options[a]=b.extend({},this.options[a],c);this._refreshSize();break;case "sizeFull":this.options.fullWindow&&this.options[a].cssClass!==c.cssClass&&this._removeUiClass();this.options[a]=b.extend({},this.options[a],c);this._refreshSize();break;case "autohide":this.options[a]=
b.extend({},this.options[a],c);this._updateAutohide();break;case "loop":this._loop(c);break;case "remainingDuration":this.options[a]=c;this._updateInterface();break;case "toggleDuration":this.options[a]=c;break;case "nativeVideoControls":this.options[a]=b.extend({},this.options[a],c);this.status.nativeVideoControls=this._uaBlocklist(this.options.nativeVideoControls);this._restrictNativeVideoControls();this._updateNativeVideoControls();break;case "noFullWindow":this.options[a]=b.extend({},this.options[a],
c);this.status.nativeVideoControls=this._uaBlocklist(this.options.nativeVideoControls);this.status.noFullWindow=this._uaBlocklist(this.options.noFullWindow);this._restrictNativeVideoControls();this._updateButtons();break;case "noVolume":this.options[a]=b.extend({},this.options[a],c);this.status.noVolume=this._uaBlocklist(this.options.noVolume);this._updateVolume();this._updateMute();break;case "emulateHtml":this.options[a]!==c&&((this.options[a]=c)?this._emulateHtmlBridge():this._destroyHtmlBridge());
break;case "timeFormat":this.options[a]=b.extend({},this.options[a],c);break;case "keyEnabled":this.options[a]=c;c||this!==b.jPlayer.focus||(b.jPlayer.focus=null);break;case "keyBindings":this.options[a]=b.extend(!0,{},this.options[a],c);break;case "audioFullScreen":this.options[a]=c}return this},_refreshSize:function(){this._setSize();this._addUiClass();this._updateSize();this._updateButtons();this._updateAutohide();this._trigger(b.jPlayer.event.resize)},_setSize:function(){this.options.fullWindow?
(this.status.width=this.options.sizeFull.width,this.status.height=this.options.sizeFull.height,this.status.cssClass=this.options.sizeFull.cssClass):(this.status.width=this.options.size.width,this.status.height=this.options.size.height,this.status.cssClass=this.options.size.cssClass);this.element.css({width:this.status.width,height:this.status.height})},_addUiClass:function(){this.ancestorJq.length&&this.ancestorJq.addClass(this.status.cssClass)},_removeUiClass:function(){this.ancestorJq.length&&this.ancestorJq.removeClass(this.status.cssClass)},
_updateSize:function(){this.internal.poster.jq.css({width:this.status.width,height:this.status.height});!this.status.waitForPlay&&this.html.active&&this.status.video||this.html.video.available&&this.html.used&&this.status.nativeVideoControls?this.internal.video.jq.css({width:this.status.width,height:this.status.height}):!this.status.waitForPlay&&this.flash.active&&this.status.video&&this.internal.flash.jq.css({width:this.status.width,height:this.status.height})},_updateAutohide:function(){var a=this,
c=function(){a.css.jq.gui.fadeIn(a.options.autohide.fadeIn,function(){clearTimeout(a.internal.autohideId);a.internal.autohideId=setTimeout(function(){a.css.jq.gui.fadeOut(a.options.autohide.fadeOut)},a.options.autohide.hold)})};this.css.jq.gui.length&&(this.css.jq.gui.stop(!0,!0),clearTimeout(this.internal.autohideId),this.element.unbind(".jPlayerAutohide"),this.css.jq.gui.unbind(".jPlayerAutohide"),this.status.nativeVideoControls?this.css.jq.gui.hide():this.options.fullWindow&&this.options.autohide.full||
!this.options.fullWindow&&this.options.autohide.restored?(this.element.bind("mousemove.jPlayer.jPlayerAutohide",c),this.css.jq.gui.bind("mousemove.jPlayer.jPlayerAutohide",c),this.css.jq.gui.hide()):this.css.jq.gui.show())},fullScreen:function(){this._setOption("fullScreen",!0)},restoreScreen:function(){this._setOption("fullScreen",!1)},_fullscreenAddEventListeners:function(){var a=this,c=b.jPlayer.nativeFeatures.fullscreen;c.api.fullscreenEnabled&&c.event.fullscreenchange&&("function"!==typeof this.internal.fullscreenchangeHandler&&
(this.internal.fullscreenchangeHandler=function(){a._fullscreenchange()}),document.addEventListener(c.event.fullscreenchange,this.internal.fullscreenchangeHandler,!1))},_fullscreenRemoveEventListeners:function(){var a=b.jPlayer.nativeFeatures.fullscreen;this.internal.fullscreenchangeHandler&&document.removeEventListener(a.event.fullscreenchange,this.internal.fullscreenchangeHandler,!1)},_fullscreenchange:function(){this.options.fullScreen&&!b.jPlayer.nativeFeatures.fullscreen.api.fullscreenElement()&&
this._setOption("fullScreen",!1)},_requestFullscreen:function(){var a=this.ancestorJq.length?this.ancestorJq[0]:this.element[0],c=b.jPlayer.nativeFeatures.fullscreen;c.used.webkitVideo&&(a=this.htmlElement.video);c.api.fullscreenEnabled&&c.api.requestFullscreen(a)},_exitFullscreen:function(){var a=b.jPlayer.nativeFeatures.fullscreen,c;a.used.webkitVideo&&(c=this.htmlElement.video);a.api.fullscreenEnabled&&a.api.exitFullscreen(c)},_html_initMedia:function(a){var c=b(this.htmlElement.media).empty();
b.each(a.track||[],function(a,b){var g=document.createElement("track");g.setAttribute("kind",b.kind?b.kind:"");g.setAttribute("src",b.src?b.src:"");g.setAttribute("srclang",b.srclang?b.srclang:"");g.setAttribute("label",b.label?b.label:"");b.def&&g.setAttribute("default",b.def);c.append(g)});this.htmlElement.media.src=this.status.src;"none"!==this.options.preload&&this._html_load();this._trigger(b.jPlayer.event.timeupdate)},_html_setFormat:function(a){var c=this;b.each(this.formats,function(b,e){if(c.html.support[e]&&
a[e])return c.status.src=a[e],c.status.format[e]=!0,c.status.formatType=e,!1})},_html_setAudio:function(a){this._html_setFormat(a);this.htmlElement.media=this.htmlElement.audio;this._html_initMedia(a)},_html_setVideo:function(a){this._html_setFormat(a);this.status.nativeVideoControls&&(this.htmlElement.video.poster=this._validString(a.poster)?a.poster:"");this.htmlElement.media=this.htmlElement.video;this._html_initMedia(a)},_html_resetMedia:function(){this.htmlElement.media&&(this.htmlElement.media.id!==
this.internal.video.id||this.status.nativeVideoControls||this.internal.video.jq.css({width:"0px",height:"0px"}),this.htmlElement.media.pause())},_html_clearMedia:function(){this.htmlElement.media&&(this.htmlElement.media.src="about:blank",this.htmlElement.media.load())},_html_load:function(){this.status.waitForLoad&&(this.status.waitForLoad=!1,this.htmlElement.media.load());clearTimeout(this.internal.htmlDlyCmdId)},_html_play:function(a){var b=this,d=this.htmlElement.media;this.androidFix.pause=!1;
this._html_load();if(this.androidFix.setMedia)this.androidFix.play=!0,this.androidFix.time=a;else if(isNaN(a))d.play();else{this.internal.cmdsIgnored&&d.play();try{if(!d.seekable||"object"===typeof d.seekable&&0<d.seekable.length)d.currentTime=a,d.play();else throw 1;}catch(e){this.internal.htmlDlyCmdId=setTimeout(function(){b.play(a)},250);return}}this._html_checkWaitForPlay()},_html_pause:function(a){var b=this,d=this.htmlElement.media;this.androidFix.play=!1;0<a?this._html_load():clearTimeout(this.internal.htmlDlyCmdId);
d.pause();if(this.androidFix.setMedia)this.androidFix.pause=!0,this.androidFix.time=a;else if(!isNaN(a))try{if(!d.seekable||"object"===typeof d.seekable&&0<d.seekable.length)d.currentTime=a;else throw 1;}catch(e){this.internal.htmlDlyCmdId=setTimeout(function(){b.pause(a)},250);return}0<a&&this._html_checkWaitForPlay()},_html_playHead:function(a){var b=this,d=this.htmlElement.media;this._html_load();try{if("object"===typeof d.seekable&&0<d.seekable.length)d.currentTime=a*d.seekable.end(d.seekable.length-
1)/100;else if(0<d.duration&&!isNaN(d.duration))d.currentTime=a*d.duration/100;else throw"e";}catch(e){this.internal.htmlDlyCmdId=setTimeout(function(){b.playHead(a)},250);return}this.status.waitForLoad||this._html_checkWaitForPlay()},_html_checkWaitForPlay:function(){this.status.waitForPlay&&(this.status.waitForPlay=!1,this.css.jq.videoPlay.length&&this.css.jq.videoPlay.hide(),this.status.video&&(this.internal.poster.jq.hide(),this.internal.video.jq.css({width:this.status.width,height:this.status.height})))},
_html_setProperty:function(a,b){this.html.audio.available&&(this.htmlElement.audio[a]=b);this.html.video.available&&(this.htmlElement.video[a]=b)},_flash_setAudio:function(a){var c=this;try{b.each(this.formats,function(b,d){if(c.flash.support[d]&&a[d]){switch(d){case "m4a":case "fla":c._getMovie().fl_setAudio_m4a(a[d]);break;case "mp3":c._getMovie().fl_setAudio_mp3(a[d]);break;case "rtmpa":c._getMovie().fl_setAudio_rtmp(a[d])}c.status.src=a[d];c.status.format[d]=!0;c.status.formatType=d;return!1}}),
"auto"===this.options.preload&&(this._flash_load(),this.status.waitForLoad=!1)}catch(d){this._flashError(d)}},_flash_setVideo:function(a){var c=this;try{b.each(this.formats,function(b,d){if(c.flash.support[d]&&a[d]){switch(d){case "m4v":case "flv":c._getMovie().fl_setVideo_m4v(a[d]);break;case "rtmpv":c._getMovie().fl_setVideo_rtmp(a[d])}c.status.src=a[d];c.status.format[d]=!0;c.status.formatType=d;return!1}}),"auto"===this.options.preload&&(this._flash_load(),this.status.waitForLoad=!1)}catch(d){this._flashError(d)}},
_flash_resetMedia:function(){this.internal.flash.jq.css({width:"0px",height:"0px"});this._flash_pause(NaN)},_flash_clearMedia:function(){try{this._getMovie().fl_clearMedia()}catch(a){this._flashError(a)}},_flash_load:function(){try{this._getMovie().fl_load()}catch(a){this._flashError(a)}this.status.waitForLoad=!1},_flash_play:function(a){try{this._getMovie().fl_play(a)}catch(b){this._flashError(b)}this.status.waitForLoad=!1;this._flash_checkWaitForPlay()},_flash_pause:function(a){try{this._getMovie().fl_pause(a)}catch(b){this._flashError(b)}0<
a&&(this.status.waitForLoad=!1,this._flash_checkWaitForPlay())},_flash_playHead:function(a){try{this._getMovie().fl_play_head(a)}catch(b){this._flashError(b)}this.status.waitForLoad||this._flash_checkWaitForPlay()},_flash_checkWaitForPlay:function(){this.status.waitForPlay&&(this.status.waitForPlay=!1,this.css.jq.videoPlay.length&&this.css.jq.videoPlay.hide(),this.status.video&&(this.internal.poster.jq.hide(),this.internal.flash.jq.css({width:this.status.width,height:this.status.height})))},_flash_volume:function(a){try{this._getMovie().fl_volume(a)}catch(b){this._flashError(b)}},
_flash_mute:function(a){try{this._getMovie().fl_mute(a)}catch(b){this._flashError(b)}},_getMovie:function(){return document[this.internal.flash.id]},_getFlashPluginVersion:function(){var a=0,b;if(window.ActiveXObject)try{if(b=new ActiveXObject("ShockwaveFlash.ShockwaveFlash")){var d=b.GetVariable("$version");d&&(d=d.split(" ")[1].split(","),a=parseInt(d[0],10)+"."+parseInt(d[1],10))}}catch(e){}else navigator.plugins&&0<navigator.mimeTypes.length&&(b=navigator.plugins["Shockwave Flash"])&&(a=navigator.plugins["Shockwave Flash"].description.replace(/.*\s(\d+\.\d+).*/,
"$1"));return 1*a},_checkForFlash:function(a){var b=!1;this._getFlashPluginVersion()>=a&&(b=!0);return b},_validString:function(a){return a&&"string"===typeof a},_limitValue:function(a,b,d){return a<b?b:a>d?d:a},_urlNotSetError:function(a){this._error({type:b.jPlayer.error.URL_NOT_SET,context:a,message:b.jPlayer.errorMsg.URL_NOT_SET,hint:b.jPlayer.errorHint.URL_NOT_SET})},_flashError:function(a){var c;c=this.internal.ready?"FLASH_DISABLED":"FLASH";this._error({type:b.jPlayer.error[c],context:this.internal.flash.swf,
message:b.jPlayer.errorMsg[c]+a.message,hint:b.jPlayer.errorHint[c]});this.internal.flash.jq.css({width:"1px",height:"1px"})},_error:function(a){this._trigger(b.jPlayer.event.error,a);this.options.errorAlerts&&this._alert("Error!"+(a.message?"\n"+a.message:"")+(a.hint?"\n"+a.hint:"")+"\nContext: "+a.context)},_warning:function(a){this._trigger(b.jPlayer.event.warning,f,a);this.options.warningAlerts&&this._alert("Warning!"+(a.message?"\n"+a.message:"")+(a.hint?"\n"+a.hint:"")+"\nContext: "+a.context)},
_alert:function(a){a="jPlayer "+this.version.script+" : id='"+this.internal.self.id+"' : "+a;this.options.consoleAlerts?window.console&&window.console.log&&window.console.log(a):alert(a)},_emulateHtmlBridge:function(){var a=this;b.each(b.jPlayer.emulateMethods.split(/\s+/g),function(b,d){a.internal.domNode[d]=function(b){a[d](b)}});b.each(b.jPlayer.event,function(c,d){var e=!0;b.each(b.jPlayer.reservedEvent.split(/\s+/g),function(a,b){if(b===c)return e=!1});e&&a.element.bind(d+".jPlayer.jPlayerHtml",
function(){a._emulateHtmlUpdate();var b=document.createEvent("Event");b.initEvent(c,!1,!0);a.internal.domNode.dispatchEvent(b)})})},_emulateHtmlUpdate:function(){var a=this;b.each(b.jPlayer.emulateStatus.split(/\s+/g),function(b,d){a.internal.domNode[d]=a.status[d]});b.each(b.jPlayer.emulateOptions.split(/\s+/g),function(b,d){a.internal.domNode[d]=a.options[d]})},_destroyHtmlBridge:function(){var a=this;this.element.unbind(".jPlayerHtml");b.each((b.jPlayer.emulateMethods+" "+b.jPlayer.emulateStatus+
" "+b.jPlayer.emulateOptions).split(/\s+/g),function(b,d){delete a.internal.domNode[d]})}};b.jPlayer.error={FLASH:"e_flash",FLASH_DISABLED:"e_flash_disabled",NO_SOLUTION:"e_no_solution",NO_SUPPORT:"e_no_support",URL:"e_url",URL_NOT_SET:"e_url_not_set",VERSION:"e_version"};b.jPlayer.errorMsg={FLASH:"jPlayer's Flash fallback is not configured correctly, or a command was issued before the jPlayer Ready event. Details: ",FLASH_DISABLED:"jPlayer's Flash fallback has been disabled by the browser due to the CSS rules you have used. Details: ",
NO_SOLUTION:"No solution can be found by jPlayer in this browser. Neither HTML nor Flash can be used.",NO_SUPPORT:"It is not possible to play any media format provided in setMedia() on this browser using your current options.",URL:"Media URL could not be loaded.",URL_NOT_SET:"Attempt to issue media playback commands, while no media url is set.",VERSION:"jPlayer "+b.jPlayer.prototype.version.script+" needs Jplayer.swf version "+b.jPlayer.prototype.version.needFlash+" but found "};b.jPlayer.errorHint=
{FLASH:"Check your swfPath option and that Jplayer.swf is there.",FLASH_DISABLED:"Check that you have not display:none; the jPlayer entity or any ancestor.",NO_SOLUTION:"Review the jPlayer options: support and supplied.",NO_SUPPORT:"Video or audio formats defined in the supplied option are missing.",URL:"Check media URL is valid.",URL_NOT_SET:"Use setMedia() to set the media URL.",VERSION:"Update jPlayer files."};b.jPlayer.warning={CSS_SELECTOR_COUNT:"e_css_selector_count",CSS_SELECTOR_METHOD:"e_css_selector_method",
CSS_SELECTOR_STRING:"e_css_selector_string",OPTION_KEY:"e_option_key"};b.jPlayer.warningMsg={CSS_SELECTOR_COUNT:"The number of css selectors found did not equal one: ",CSS_SELECTOR_METHOD:"The methodName given in jPlayer('cssSelector') is not a valid jPlayer method.",CSS_SELECTOR_STRING:"The methodCssSelector given in jPlayer('cssSelector') is not a String or is empty.",OPTION_KEY:"The option requested in jPlayer('option') is undefined."};b.jPlayer.warningHint={CSS_SELECTOR_COUNT:"Check your css selector and the ancestor.",
CSS_SELECTOR_METHOD:"Check your method name.",CSS_SELECTOR_STRING:"Check your css selector is a string.",OPTION_KEY:"Check your option name."}});

//OWL

//Select fix

//Paralax
(function( $ ){
	var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

	$.fn.parallax = function(xpos, speedFactor, outerHeight) {
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;

		//get the starting position of each element to have parallax applied to it
		$this.each(function(){
			firstTop = $this.offset().top;
		});

		if (outerHeight) {
			getHeight = function(jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function(jqo) {
				return jqo.height();
			};
		}

		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;

		// function to be called whenever the window is scrolled or resized
		function update(){
			var pos = $window.scrollTop();

			$this.each(function(){
				var $element = $(this);
				var top = $element.offset().top;
				var height = getHeight($element);

				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + windowHeight) {
					return;
				}

				$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos) * speedFactor) + "px");
			});
		}

		$window.bind('scroll', update).resize(update);
		update();
	};
})(jQuery);

//Modernizr
;window.Modernizr=function(a,b,c){function w(a){j.cssText=a}function x(a,b){return w(m.join(a+";")+(b||""))}function y(a,b){return typeof a===b}function z(a,b){return!!~(""+a).indexOf(b)}function A(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:y(f,"function")?f.bind(d||b):f}return!1}var d="2.6.2",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k,l={}.toString,m=" -webkit- -moz- -o- -ms- ".split(" "),n={},o={},p={},q=[],r=q.slice,s,t=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},u={}.hasOwnProperty,v;!y(u,"undefined")&&!y(u.call,"undefined")?v=function(a,b){return u.call(a,b)}:v=function(a,b){return b in a&&y(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=r.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(r.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(r.call(arguments)))};return e}),n.touch=function(){var c;return"ontouchstart"in a||a.DocumentTouch&&b instanceof DocumentTouch?c=!0:t(["@media (",m.join("touch-enabled),("),h,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(a){c=a.offsetTop===9}),c};for(var B in n)v(n,B)&&(s=B.toLowerCase(),e[s]=n[B](),q.push((e[s]?"":"no-")+s));return e.addTest=function(a,b){if(typeof a=="object")for(var d in a)v(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},w(""),i=k=null,function(a,b){function k(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function l(){var a=r.elements;return typeof a=="string"?a.split(" "):a}function m(a){var b=i[a[g]];return b||(b={},h++,a[g]=h,i[h]=b),b}function n(a,c,f){c||(c=b);if(j)return c.createElement(a);f||(f=m(c));var g;return f.cache[a]?g=f.cache[a].cloneNode():e.test(a)?g=(f.cache[a]=f.createElem(a)).cloneNode():g=f.createElem(a),g.canHaveChildren&&!d.test(a)?f.frag.appendChild(g):g}function o(a,c){a||(a=b);if(j)return a.createDocumentFragment();c=c||m(a);var d=c.frag.cloneNode(),e=0,f=l(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function p(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return r.shivMethods?n(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+l().join().replace(/\w+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(r,b.frag)}function q(a){a||(a=b);var c=m(a);return r.shivCSS&&!f&&!c.hasCSS&&(c.hasCSS=!!k(a,"article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}mark{background:#FF0;color:#000}")),j||p(a,c),a}var c=a.html5||{},d=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,e=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,f,g="_html5shiv",h=0,i={},j;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",f="hidden"in a,j=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){f=!0,j=!0}})();var r={elements:c.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:c.shivCSS!==!1,supportsUnknownElements:j,shivMethods:c.shivMethods!==!1,type:"default",shivDocument:q,createElement:n,createDocumentFragment:o};a.html5=r,q(b)}(this,b),e._version=d,e._prefixes=m,e.testStyles=t,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+q.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};

//Shortcodes

function paginate(idx, slide){
    return '<li><a href="#" title=""></a></li>';
}

	/* Tabs */
	jQuery(window).load(function() {
		jQuery('.tabs_container ul.tabs li:first-child a').addClass('current');
		jQuery('.tabs_container .panes div.pane:first-child').show();
		
		jQuery('.tabs_container ul.tabs li a').click(function (a) { 
			var tab = jQuery(this).parent().parent().parent(), 
				index =jQuery(this).parent().index();
			
			tab.find('ul.tabs').find('a').removeClass('current');
			jQuery(this).addClass('current');
			
			tab.find('.panes').find('div.pane').not('div.pane:eq(' + index + ')').slideUp(100);
			tab.find('.panes').find('div.pane:eq(' + index + ')').slideDown(100);
			
			a.preventDefault();
		} );
 });
	/* Toggle */
	jQuery(document).ready(function() {
		jQuery('.toggle .toggle_title').click(function (b) { 
			var toggled = jQuery(this).parent().find('.toggle_content');
			
			jQuery(this).parent().find('.toggle_content').not(toggled).slideUp();
			
			if (jQuery(this).hasClass('current')) {
				jQuery(this).removeClass('current');
			} else {
				jQuery(this).addClass('current');
			}
			
			toggled.stop(false, true).slideToggle().css( { 
				display : 'block' 
			} );
			
			b.preventDefault();
		} );
		
	});
	/* Accordion */
	jQuery(document).ready(function() {
		//jQuery(".accordions .acc_title").first().addClass('current');
		//jQuery(".accordions .tab_content").first().slideToggle().css( { 
		//		display : 'block' 
		//	} );
		
		jQuery('.accordions .acc_title').click(function (c) { 
			var toggled = jQuery(this).parent().find('.tab_content');
			
			jQuery(this).parent().parent().find('.tab_content').not(toggled).slideUp();
			
			if (jQuery(this).hasClass('current')) {
				jQuery(this).removeClass('current');
			} else {
				jQuery(this).parent().parent().find('.acc_title').removeClass('current');
				jQuery(this).addClass('current');
			}
			
			toggled.stop(false, true).slideToggle().css( { 
				display : 'block' 
			} );
			
			c.preventDefault();
		} );
	});
//Vertical tabs
	jQuery(document).ready( function () {
	var navh = jQuery('.vtabs').css('height');
		jQuery('.vtab_pane_inner').css({"min-height":navh});
		jQuery('.vertical_tabs ul.vtabs li:first-child').addClass('current');
		jQuery('.vertical_tabs div.vtab_pane:first').show();
		
		jQuery('.vtab_title').click(function (d) { 
			var tour = jQuery(this).parent().parent().parent().parent(), 
				index = jQuery('ul.vtabs li').index(jQuery(this).parent());
			
			tour.find('ul.vtabs').find('li').removeClass('current');
			jQuery(this).parent().addClass('current');
			
			tour.find('div.vtab_pane').not('div.vtab_pane:eq(' + index + ')').slideUp();
			tour.find('div.vtab_pane:eq(' + index + ')').slideDown();
			
			d.preventDefault();
		} );	
	});
	/* Lightbox */
	jQuery(document).ready(function() {
	jQuery('a[rel^="dp_lightbox"]').prettyPhoto({
		deeplinking: true,
		overlay_gallery: false,
		social_tools: false,
		opacity: 0.7,
		show_title: false
	});
	});
	
	


/*==================================================
	     SLIDING GRAPH
==================================================*/
jQuery(window).load(function(){
								
	function isScrolledIntoView(id)
	{
		var elem = "#" + id;
		var docViewTop = jQuery(window).scrollTop();
		var docViewBottom = docViewTop + jQuery(window).height();
	
		if (jQuery(elem).length > 0){
			var elemTop = jQuery(elem).offset().top;
			var elemBottom = elemTop + jQuery(elem).height();
		}

		return ((elemBottom >= docViewTop) && (elemTop <= docViewBottom)
		  && (elemBottom <= docViewBottom) &&  (elemTop >= docViewTop) );
	}

	function sliding_horizontal_graph(id, speed){
		//alert(id);
		jQuery("#" + id + " li span").each(function(i){
			var j = i + 1; 										  
			var cur_li = jQuery("#" + id + " li:nth-child(" + j + ") span");
			var w = cur_li.attr("class");
			cur_li.animate({width: w + "%"}, speed);
		})
	}
	
	function graph_init(id, speed){
		jQuery(window).scroll(function(){
			if (isScrolledIntoView(id)){
				sliding_horizontal_graph(id, speed);
			}
			else{
				//jQuery("#" + id + " li span").css("width", "0");
			}
		})
		
		if (isScrolledIntoView(id)){
			sliding_horizontal_graph(id, speed);
		}
	}
	
	graph_init("graph-1", 1000);
	

});

//DP scripts

jQuery.cookie = function (key, value, options) {

    // key and at least value given, set cookie...
    if (arguments.length > 1 && String(value) !== "[object Object]") {
        options = jQuery.extend({}, options);

        if (value === null || value === undefined) {
            options.expires = -1;
        }

        if (typeof options.expires === 'number') {
            var days = options.expires, t = options.expires = new Date();
            t.setDate(t.getDate() + days);
        }

        value = String(value);

        return (document.cookie = [
            encodeURIComponent(key), '=',
            options.raw ? value : encodeURIComponent(value),
            options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
            options.path ? '; path=' + options.path : '',
            options.domain ? '; domain=' + options.domain : '',
            options.secure ? '; secure' : ''
        ].join(''));
    }

    // key and possibly options given, get cookie...
    options = value || {};
    var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
    return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};

/**
 *
 * Template scripts
 *
 **/

jQuery(window).load(function() {
	jQuery('#dp_status').fadeOut(); // will first fade out the loading animation
			jQuery('#dp_preloader').delay(350).fadeOut('slow'); // will fade out the white DIV that covers the website.
});

/** Shifted images engine **/


function shiftImages(){
	if(typeof $DP_TABLET_WIDTH != 'undefined') {
        if (jQuery(window).width()< $DP_TABLET_WIDTH) { jQuery(".shifted").removeClass("moved");
		jQuery('.shifted').each(function(){
			jQuery(this).css('margin-top', '0');
			jQuery(this).css('margin-left', '0');
			jQuery(this).css('margin-right', '0');
			jQuery(this).css('margin-bottom', '0');
		});
	} else {
		jQuery('.shifted').each(function(){
			jQuery(this).css('margin-top', jQuery(this).attr('data-margintop'));
			jQuery(this).css('margin-left', jQuery(this).attr('data-marginleft'));
			jQuery(this).css('margin-right', jQuery(this).attr('data-marginright'));
			jQuery(this).css('margin-bottom', jQuery(this).attr('data-marginbottom'));
		
		});
		jQuery('.shifted').addClass("moved");
		}
	}
}
jQuery(document).ready(function () {
    shiftImages();//run when page first loads
});

jQuery(window).resize(function () {
    shiftImages();//run on every window resize
});

jQuery(function() {
    jQuery("input:radio[name=iconview]").change(function() {
		chosen = jQuery('input:radio[name=iconview]:checked').val();
        if (chosen == 'code') {
		jQuery('.i-name').hide(); 
		jQuery('.i-code').show();
		} else {
		jQuery('.i-code').hide(); 
		jQuery('.i-name').show();
		}
    });
});

//Fitvids//
 jQuery(document).ready(function(){
	jQuery(".post,.page,.single-portfolio,#main-menu,.single-essential_grid").fitVids();
  });
//Widget titles indicator
    jQuery(document).ready(function(){
		elements = jQuery('.arrowed .indicator');
		elements.each(function() {
		var color = jQuery(this).parent().css('backgroundColor');
		var width = parseInt(jQuery(this).parent().width()) + parseInt(jQuery(this).parent().css("padding-left")) + parseInt(jQuery(this).parent().css("padding-right"));
		width = parseInt(width/2);
		width = width.toString()+"px"; 
		jQuery(this).css({'border-top-color':color, 'border-left-width':width, 'border-right-width':width});		
		});

		
    });




// onDOMLoadedContent event
jQuery(document).ready(function() {	
	// Back to Top Scroll scroll
	jQuery(window).scroll(function() {
		if(jQuery(this).scrollTop() != 0) {
			jQuery('#back-to-top').fadeIn();	
		} else {
			jQuery('#back-to-top').fadeOut();
		}
		
	});
	// Sticky header scroll
	jQuery(window).scroll(function() {
		if(typeof $DP_STICKY_HEADER != 'undefined') {
		if ($DP_STICKY_HEADER == 'Y') { 
		var switchvalue = jQuery('#dp-navigation-wrapper').height();
		if(jQuery(this).scrollTop() >switchvalue && jQuery(window).width()> $DP_TABLET_WIDTH ) {
		jQuery('#dp-navigation-wrapper').addClass('dp-sticky-navigation-wrapper');
		} else {
		jQuery('#dp-navigation-wrapper').removeClass('dp-sticky-navigation-wrapper');
		}
		}
		}
	});
	// Overlaping header scroll
	jQuery(window).scroll(function() {
		if ($DP_STICKY_HEADER == 'N') { 
		var switchvalue = jQuery('#dp-head-wrap').height();
		if(jQuery(this).scrollTop() >switchvalue) {
		jQuery('#dp-navigation-wrapper').hide();
		} else {
		jQuery('#dp-navigation-wrapper').show();
		}
		}
	});
	jQuery('#back-to-top').click(function() {
		jQuery('body,html').animate({scrollTop:0},800);
	});	
	// Thickbox use
	jQuery(document).ready(function(){
		if(typeof tb_init != "undefined") {
			tb_init('div.wp-caption a');//pass where to apply thickbox
		}
	});
	// style area
	if(jQuery('#dp-style-area')){
		jQuery('#dp-style-area div').each(function(i){
			jQuery(this).find('a').each(function(index) {
				jQuery(this).click(function(e){
	            	e.stopPropagation();
	            	e.preventDefault();
					changeStyle(jQuery(this).attr('href').replace('#', ''));
					window.location.reload();
				});
			});
		});
	}
	// demo color variations
	if(jQuery('#dp-demo-area')){
		jQuery('#dp-demo-area div').each(function(i){
			jQuery(this).find('a').each(function(index) {
				jQuery(this).click(function(e){
	            	e.stopPropagation();
	            	e.preventDefault();
					changeStyle(jQuery(this).attr('href').replace('#', ''));
					window.location.reload();
				});
			});
		});
	}
	// font-size switcher
	if(jQuery('#dp-font-size') && jQuery('#dp-mainbody')) {
		var current_fs = 100;
		jQuery('#dp-mainbody').css('font-size', current_fs+"%");
		
		jQuery('#dp-increment').click(function(e){ 
			e.stopPropagation();
			e.preventDefault(); 
			
			if(current_fs < 150) { 
				jQuery('#dp-mainbody').animate({ 'font-size': (current_fs + 10) + "%"}, 200); 
				current_fs += 10; 
			} 
		});
		
		jQuery('#dp-reset').click(function(e){ 
			e.stopPropagation(); 
			e.preventDefault(); 
			
			jQuery('#dp-mainbody').animate({ 'font-size': "100%"}, 200); 
			current_fs = 100; 
		});
		
		jQuery('#dp-decrement').click(function(e){ 
			e.stopPropagation(); 
			e.preventDefault(); 
			
			if(current_fs > 70) { 
				jQuery('#dp-mainbody').animate({ 'font-size': (current_fs - 10) + "%"}, 200); 
				current_fs -= 10; 
			} 
		});
	}
	
	// Function to change styles
	function changeStyle(style){
		var file = $DP_TMPL_URL+'/css/'+style;
		jQuery('head').append('<link rel="stylesheet" href="'+file+'" type="text/css" />');
		jQuery.cookie($DP_TMPL_NAME+'_style', style, { expires: 365, path: '/' });
	}
});

//Serch popup //
jQuery(document).ready(function(){
"use strict";
	jQuery('.dp-header-search').click(function () {
		jQuery('.dp-header-search-form').fadeIn(500);
	});
	jQuery('#cancel-search').click(function () {
jQuery('#dp-header-search-form').fadeOut(200);			
	});
});	
			
//Tipsy and pulsating point
jQuery(window).load( function () {
	"use strict";
    jQuery(".dp-tipsy").tipsy({gravity: 'ne', fade: true, html: true, title: "data-tipcontent", opacity:1 });
	});
jQuery(window).load( function () {
	"use strict";
    jQuery(".dp-tipsy-t").tipsy({gravity: 's', fade: true, html: true, title: "data-tipcontent", opacity:1 });
    jQuery(".dp-tipsy-r").tipsy({gravity: 'w', fade: true, html: true, title: "data-tipcontent", opacity:1 });
	});
jQuery(window).load( function () {
	"use strict";
    jQuery(".dp-tipsy-l").tipsy({gravity: 'e', fade: true, html: true, title: "data-tipcontent", opacity:1 });
    jQuery(".dp-tipsy-b").tipsy({gravity: 'n', fade: true, html: true, title: "data-tipcontent", opacity:1 });
	});
jQuery(window).load( function () {
	"use strict";
    jQuery(".dp-tipsy1").tipsy({gravity: 'se', fade: true, html: true, title: "data-tipcontent", opacity:1 });
	});
	
jQuery(window).load( function () {
	"use strict";
    jQuery("#dp-social-icons.left a").tipsy({gravity: 'w', fade: true, html: true, title: "data-tipcontent", opacity:1 });
	});
jQuery(window).load( function () {
	"use strict";
    jQuery("#dp-social-icons.right a").tipsy({gravity: 'e', fade: true, html: true, title: "data-tipcontent", opacity:1 });
	});
	
//Waypoints animation engine

jQuery(document).ready(function() {
"use strict";
	jQuery('.fade-in').waypoint(function() {
	delayvalue = jQuery(this).data("delay");
	if (typeof delayvalue === "undefined") {delayvalue = 0};
 	jQuery(this).delay(delayvalue).animate({opacity: 1}, 800 );
 	}, {
		triggerOnce: true,
		offset: '100%'
	});
	jQuery('.from-left').waypoint(function() {
	delayvalue = jQuery(this).data("delay");
	if (typeof delayvalue === "undefined") {delayvalue = 0};
 	jQuery(this).delay(delayvalue).animate({opacity: 1, left:0}, {duration:1100, easing:"easeInOutExpo"});
 	}, {
		triggerOnce: true,
		offset: '80%'
	});
	jQuery('.from-right').waypoint(function() {
	delayvalue = jQuery(this).data("delay");
	if (typeof delayvalue === "undefined") {delayvalue = 0};
 	jQuery(this).delay(delayvalue).animate({opacity: 1, right:0}, {duration:1100, easing:"easeInOutExpo"});
 	}, {
		triggerOnce: true,
		offset: '90%'
	});
	jQuery('.from-top').waypoint(function() {
			delayvalue = jQuery(this).data("delay");
	if (typeof delayvalue === "undefined") {delayvalue = 0};
 	jQuery(this).delay(delayvalue).addClass('isloaded');
 	}, {
		triggerOnce: true,
		offset: '65%'
	});
	jQuery('.from-bottom').waypoint(function() {
	delayvalue = jQuery(this).data("delay");
	if (typeof delayvalue === "undefined") {delayvalue = 0};
 	jQuery(this).delay(delayvalue).addClass('isloaded');
 	}, {
		triggerOnce: true,
		offset: '80%'
	});
	jQuery('.explode').waypoint(function() {
	delayvalue = jQuery(this).data("delay");
	if (typeof delayvalue === "undefined") {delayvalue = 0};
 	jQuery(this).delay(delayvalue).addClass('isloaded');
	}, {
		triggerOnce: true,
		offset: '85%'
	});
		jQuery('.colapse').waypoint(function() {
			delayvalue = jQuery(this).data("delay");
	if (typeof delayvalue === "undefined") {delayvalue = 0};
 	jQuery(this).delay(delayvalue).addClass('isloaded');
 	}, {
		triggerOnce: true,
		offset: '85%'
	});



})
			/* Animation engine
			================================================== */
			
			
			jQuery(document).ready(function() {
				
			var isMobile = false;
			
			/* Mobile Detect
			================================================== */
			
						if (navigator.userAgent.match(/Android/i) || 
							navigator.userAgent.match(/webOS/i) ||
							navigator.userAgent.match(/iPhone/i) || 
							navigator.userAgent.match(/iPad/i)|| 
							navigator.userAgent.match(/iPod/i) || 
							navigator.userAgent.match(/BlackBerry/i)) {                 
							isMobile = true;            
						}
			
			
			/* Content Animation
			================================================== */
			
			
						if (isMobile == false) {
							jQuery('*[data-animated]').addClass('dpanimated');
						}
						
			
						function animated_contents() {
							jQuery(".dpanimated:appeared").each(function (i) {
								var $this    = jQuery(this),
									animated = jQuery(this).data('animated');
			
								setTimeout(function () {
									$this.addClass(animated);
								}, 100 * i);
			
							});
						}
						
						animated_contents();
						jQuery(window).scroll(function () {
							animated_contents();
						});
			})

//Isotope
jQuery(window).load(function() {

	jQuery('.portfolio-wrapper ').isotope({
		itemSelector: '.portfolio-item',
		layoutMode: 'masonry'
	});
	jQuery('.masonry ').isotope({
		itemSelector: '.portfolio-item-wrapper',
		layoutMode: 'masonry'
	});
	jQuery(window).resize(function(){ 
	 jQuery('.masonry ').isotope('reLayout');
	
		});
	jQuery('.dp-wall ').isotope({
		itemSelector: '.item',
		layoutMode: 'masonry'
	});
	jQuery(window).resize(function(){ 
	 jQuery('.dp-wall ').isotope('reLayout');
	
		});

	jQuery('.portfolio-tabs a').click(function(e){
		e.preventDefault();

		var selector = jQuery(this).attr('data-filter');
		jQuery('.portfolio-wrapper').isotope({ filter: selector });
		jQuery(this).parents('ul').find('li').removeClass('active');
		jQuery(this).parent().addClass('active');
	});
	jQuery('.blog-tabs a').click(function(e){
		e.preventDefault();
		var selector = jQuery(this).attr('data-filter');
		jQuery('.masonry').isotope({ filter: selector });
		jQuery(this).parents('ul').find('li').removeClass('active');
		jQuery(this).parent().addClass('active');
	});
});
// Toolbar //
 jQuery(document).ready(function() {	
    		var handler = jQuery('#dpToolbarButton');
    		jQuery(handler).click(function() {
    			jQuery('#dpToolbar').toggleClass('active');	
    			
    			handler.find('i').addClass('icon-spin');
    			
    			setTimeout(function() {
    				handler.find('i').removeClass('icon-spin');
    			}, 800);
    		});
			//Layout Switcher
		   jQuery("#layout-style").change(function(e){
				if( jQuery(this).val() == 1){
					jQuery("body").removeClass("boxed"),
					jQuery("body").css("backgroundImage","none");
					jQuery(window).resize();
				} else{
					jQuery("body").addClass("boxed"),
					bg= $DP_TMPL_URL+'/images/patterns/noise_pattern_with_crosslines.png';
					jQuery("body").css("backgroundImage","url("+bg+")");
					jQuery(window).resize();
				}
			});
			//Background switcher
			jQuery('.dp-style-switcher-bg a').click(function() {
			var current = jQuery('.layout-style select[id=layout-style]').find('option:selected').val();
			if(current == '2') {
				var bg = jQuery(this).css("backgroundImage");
				jQuery("body").css("backgroundImage",bg);

			} else {
				alert('Please select boxed layout');
			}
		});	
});

//Paralax setting //	
jQuery(window).load(function(){
		jQuery('.parallax-bg').each(function(){
			jQuery(this).css( {
			'backgroundImage': jQuery(this).parent().css( 'backgroundImage' )
		} );
		var otherStyles = '';
            if ( typeof jQuery(this).parent().attr('style') !== 'undefined' ) {
                otherStyles = jQuery(this).parent().attr('style') + ';';
            }
            jQuery(this).parent().attr('style', otherStyles + 'background-image: none !important; background-color: transparent !important;');
			jQuery(this).parallax('50%', jQuery(this).data('speed'));
		});
	});
//Menu scripts

jQuery(document).ready(function() {
	
	function initSF(){

		jQuery(".sf-menu").superfish({
			 delay: 900,
			 speed: 200,
			 speedOut:      'fast', 
			 autoArrows    : false,            
			 animation:   {opacity:'show',height:'show'},
		}); 

	}
	initSF();
 });



(function($) {
    $.fn.hoverIntent = function(handlerIn,handlerOut,selector) {

        // default configuration values
        var cfg = {
            interval: 100,
            sensitivity: 7,
            timeout: 0
        };

        if ( typeof handlerIn === "object" ) {
            cfg = $.extend(cfg, handlerIn );
        } else if ($.isFunction(handlerOut)) {
            cfg = $.extend(cfg, { over: handlerIn, out: handlerOut, selector: selector } );
        } else {
            cfg = $.extend(cfg, { over: handlerIn, out: handlerIn, selector: handlerOut } );
        }

        // instantiate variables
        // cX, cY = current X and Y position of mouse, updated by mousemove event
        // pX, pY = previous X and Y position of mouse, set by mouseover and polling interval
        var cX, cY, pX, pY;

        // A private function for getting mouse position
        var track = function(ev) {
            cX = ev.pageX;
            cY = ev.pageY;
        };

        // A private function for comparing current and previous mouse position
        var compare = function(ev,ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            // compare mouse positions to see if they've crossed the threshold
            if ( ( Math.abs(pX-cX) + Math.abs(pY-cY) ) < cfg.sensitivity ) {
                $(ob).off("mousemove.hoverIntent",track);
                // set hoverIntent state to true (so mouseOut can be called)
                ob.hoverIntent_s = 1;
                return cfg.over.apply(ob,[ev]);
            } else {
                // set previous coordinates for next time
                pX = cX; pY = cY;
                // use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
                ob.hoverIntent_t = setTimeout( function(){compare(ev, ob);} , cfg.interval );
            }
        };

        // A private function for delaying the mouseOut function
        var delay = function(ev,ob) {
            ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
            ob.hoverIntent_s = 0;
            return cfg.out.apply(ob,[ev]);
        };

        // A private function for handling mouse 'hovering'
        var handleHover = function(e) {
            // copy objects to be passed into t (required for event object to be passed in IE)
            var ev = jQuery.extend({},e);
            var ob = this;

            // cancel hoverIntent timer if it exists
            if (ob.hoverIntent_t) { ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t); }

            // if e.type == "mouseenter"
            if (e.type == "mouseenter") {
                // set "previous" X and Y position based on initial entry point
                pX = ev.pageX; pY = ev.pageY;
                // update "current" X and Y position based on mousemove
                $(ob).on("mousemove.hoverIntent",track);
                // start polling interval (self-calling timeout) to compare mouse coordinates over time
                if (ob.hoverIntent_s != 1) { ob.hoverIntent_t = setTimeout( function(){compare(ev,ob);} , cfg.interval );}

                // else e.type == "mouseleave"
            } else {
                // unbind expensive mousemove event
                $(ob).off("mousemove.hoverIntent",track);
                // if hoverIntent state is true, then call the mouseOut function after the specified delay
                if (ob.hoverIntent_s == 1) { ob.hoverIntent_t = setTimeout( function(){delay(ev,ob);} , cfg.timeout );}
            }
        };

        // listen for mouseenter and mouseleave
        return this.on({'mouseenter.hoverIntent':handleHover,'mouseleave.hoverIntent':handleHover}, cfg.selector);
    };
})(jQuery);

/* Nice Scroll
================================================== */
 jQuery(window).load(function() {
				jQuery("#dp-mobile-menu").mCustomScrollbar({
					autoHideScrollbar:true,
					theme:"light-thin"
				});
	});

//Video background stuff //
jQuery(document).ready(function(){
jQuery(".mb_ytplayer").mb_YTPlayer();
var viewportheight = jQuery(window).height()- jQuery("#dp-head").height();
if (jQuery("body").hasClass("menu-position-2")) viewportheight = jQuery(window).height();
if (jQuery("body").hasClass("menu-position-3")) viewportheight = jQuery(window).height();
if  (jQuery("body").hasClass("admin-bar")) viewportheight = viewportheight - jQuery("#wpadminbar").height();
jQuery(".fullscreen").css("height", viewportheight)
jQuery(".dp-video-mute-button").click(function(event){
	event.preventDefault();
	if( jQuery(".dp-video-mute-button").hasClass("unmute") ) {
								jQuery(this).removeClass("unmute").addClass("mute");														
								jQuery(".mb_YTVPlayer").unmuteYTPVolume();
							} else {
								jQuery(this).removeClass("mute").addClass("unmute");
								jQuery(".mb_YTVPlayer").muteYTPVolume();							
							}
	});

});

//piechart settings//
jQuery(document).ready(function() {
        jQuery('.easyPieChart').easyPieChart;
        jQuery('.easyPieChart2').easyPieChart;
		});
	jQuery(document).ready(function() {

	jQuery('.easyPieChart').waypoint(function() {
	delayvalue = jQuery(this).data("delay");
	size = jQuery(this).data("size");
	barcolor = jQuery(this).data("barcolor");
	line = jQuery(this).data("line");
	trackcolor = jQuery(this).data("trackcolor");
	if (typeof delayvalue === "undefined") {delayvalue = 0};
 	jQuery(this).delay(delayvalue).easyPieChart({
			scaleColor: 'transparent',
			size: size,
			animate: 3000,
			lineWidth: line,
			lineCap: 'butt',
			barColor: barcolor,
			trackColor: trackcolor,
			onStep: function(from, to, percent) {
				jQuery(this.el).find('.percent').text(Math.round(percent));
			}
		});
 	}, {
		triggerOnce: true,
		offset: '100%'
	});
	});

	jQuery(document).ready(function() {

	jQuery('.easyPieChart2').waypoint(function() {
	delayvalue = jQuery(this).data("delay");
	size = jQuery(this).data("size");
	barcolor = jQuery(this).data("barcolor");
	trackcolor = jQuery(this).data("trackcolor");
	line = jQuery(this).data("line");
	if (typeof delayvalue === "undefined") {delayvalue = 0};
 	jQuery(this).delay(delayvalue).easyPieChart({
			scaleColor: 'transparent',
			size: size,
			animate: 5000,
			lineWidth: line,
			lineCap: 'butt',
			barColor: barcolor,
			scaleLength: 10,
			trackColor:  trackcolor,
			onStep: function(from, to, percent) {
				jQuery(this.el).find('.percent').text(Math.round(percent));
			}
		});
 	}, {
		triggerOnce: true,
		offset: '100%'
	});
	});

/*
**	Counter shortcode
*/
            function number(num, content, target, duration) {
                if (duration) {
                    var count    = 0;
                    var speed    = parseInt(duration / num);
                    var interval = setInterval(function(){
                        if(count - 1 < num) {
                            target.html(count);
                        }
                        else {
                            target.html(content);
                            clearInterval(interval);
                        }
                        count++;
                    }, speed);
                } else {
                    target.html(content);


                }
            }

            function stats(duration) {
                jQuery('.stats .num, .stats-alt .num').each(function() {
                    var container = jQuery(this);
                    var num       = container.attr('data-num');
                    var content   = container.attr('data-content');
                    number(num, content, container, duration);
                });
            }

            
                var $i = 1;
                jQuery('.stats, .stats-alt').appear().on('appear', function() {
                    if ($i === 1) { stats(300); }
                    $i++;
                });
/* Skills Bar Animation
================================================== */

	jQuery('.skill-bar').each(function(i){
		
		jQuery(this).appear1(function(){
			
			var percent = jQuery(this).find('span').attr('data-width');
			
			jQuery(this).find('span').animate({
				'width' : percent + '%'
			},2700, 'easeOutCirc',function(){
			});
			
			jQuery(this).find('span strong').animate({
				'opacity' : 1
			},2400);	
			
			////100% progress bar 
			if(percent == '100'){
				jQuery(this).find('span strong').addClass('full');
			}
			
		});

	});	
/* Team Image Overlay
================================================== */
    jQuery('.team').on('mouseover', function()
    {
        var overlay = jQuery(this).find('.overlay-wrp');
		var content1 = jQuery(this).find('.overlay .team-about');
        var content = jQuery(this).find('.overlay-content');
        var top = parseInt(overlay.height() * 0.8 - 20);

        overlay.stop(true,true).fadeIn(300);
        content.stop().animate({'top': top}, 400);
        content1.stop().animate({'padding-top': 50}, 400);

    }).on('mouseleave', function()
    {
        var overlay = jQuery(this).find('.overlay-wrp');
        var content = jQuery(this).find('.overlay-content');
		var content1 = jQuery(this).find('.overlay .team-about');
        var top = parseInt(overlay.height() * 0.2);
        
        content.stop().animate({'top': top}, 100);
        content1.stop().animate({'padding-top': 100}, 400);
        overlay.fadeOut(200);
    });

/*  Alert Boxes
================================================== */

	jQuery(document).ready(function(){
		jQuery("a.close").removeAttr("href").click(function(){
			jQuery(this).parent().fadeOut(200);
		});
	});
/*  Woocommerce stuff
================================================== */
        jQuery(document).ready(function () {
            jQuery(".orderby").selectFix({ arrowWidth: '30px', arrowContent: '\ue9fd', responsive: true });
        });


/*  Search overlay JS
================================================== */

	jQuery(document).ready(function(){
		jQuery(".dp-header-search").removeAttr("href").click(function(){
			jQuery('.search-overlay').addClass('open');
		});
		jQuery(".overlay-close").removeAttr("href").click(function(){
			jQuery('.search-overlay').toggleClass('open');
		});
	});

/*  Dynamic Sidebar JS
================================================== */
jQuery(document).ready(function(){
	
	jQuery('.dp-sidebar-button').click(function(e){
    e.preventDefault();
	jQuery('#dp-page-box').toggleClass('is-dynamic-sidebar');
	jQuery('#dp-dynamic-sidebar').toggleClass('is-dynamic-sidebar');

	if(!jQuery('#close-dynamic-sidebar').hasClass('is-dynamic-sidebar')) {
		setTimeout(function() {
			jQuery('#close-dynamic-sidebar').toggleClass('is-dynamic-sidebar');
		}, 300);
	} else {
		jQuery('#close-dynamic-sidebar').removeClass('is-dynamic-sidebar');
	}
	});
	jQuery('#close-dynamic-sidebar').click(function() {
    		jQuery('#close-dynamic-sidebar').toggleClass('is-dynamic-sidebar');
    		jQuery('#dp-page-box').toggleClass('is-dynamic-sidebar');
    		jQuery('#dp-dynamic-sidebar').toggleClass('is-dynamic-sidebar');
    	});
});

/*  Footer JS
================================================== */

jQuery(document).ready(function(){

		var width1 = (jQuery('.dp-page').outerWidth(true) - jQuery('.dp-page').outerWidth())/2;
		var width2 = jQuery('.widthmarker').width();
		var bgwidth = width1 + width2;
		jQuery('.contrastbg').width(bgwidth);


});
jQuery(window).resize(function () {
		var width1 = (jQuery('.dp-page').outerWidth(true) - jQuery('.dp-page').outerWidth())/2;
		var width2 = jQuery('.widthmarker').width();
		var bgwidth = width1 + width2;
		jQuery('.contrastbg').width(bgwidth);

});

/*  Categories widget JS
================================================== */

jQuery(document).ready(function () {
    jQuery('.widget_categories li').each(function () {
 			jQuery(this).html(jQuery(this).html().replace('(', '<span>'));
 			jQuery(this).html(jQuery(this).html().replace(')', '</span>')); 
    })
});

/*  VC Tabs fullwidth JS
================================================== */

jQuery(document).ready(function () {
    jQuery('.fulltabs').each(function () {
		var tabscount = jQuery(this).children().length;
		if  (tabscount < 9 ) {
		tabsclass = 'fulltabs-' + tabscount;
		jQuery(this).addClass(tabsclass);
		}
    })
});

/*  Check if button area exist JS
================================================== */

jQuery(document).ready(function () {
if (!! jQuery('.dp_shopping_cart').length || !! jQuery('.dp-button-area').length )  {
   jQuery('body').addClass('arebuttons');
}
});
/*  Scroll to anchor JS
================================================== */

jQuery(document).ready(function () {
	jQuery('.smooth-scroll, li.smooth-scroll .item-container a').click(function() {
				if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
								var target = $(this.hash);
								var offset = 0;
								if (jQuery('#wpadminbar').length) offset += 32;
								if (jQuery('#dp-navigation-wrapper').length) offset += jQuery('#dp-navigation-wrapper').height();
								if (jQuery('.paspartu-top').length) offset += jQuery('.paspartu-top').height();
								
								target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
								if (target.length) {
								$('html,body').animate({
								scrollTop: target.offset().top - offset 
								},900 ,'easeInQuint');
								return false;			}
			}
			});
					
});
/*  DotNav JS
================================================== */

jQuery(document).ready(function($){
	var contentSections = $('.dp-anchor'),
		navigationItems = $('#dotnav-menu li a');
		dotnavContainer = $('.dp_dotnav_container');
		if (dotnavContainer.length) {
			dotnavContainer.css( "margin-top", -dotnavContainer.outerHeight( true )/2 );
		}

	/*updateNavigation();*/
jQuery( window ).scroll( function(){
 
 if ( $( '#dotnav-menu' ).length ) {
 				$add_offset = 0;
				if ( $( '.dp-sticky-navigation-wrapper' ).length ) $add_offset += 65;
				if ( $ ( '#wpadminbar' ).length && $( window ).width() > 600 ) {
					$add_offset += $( '#wpadminbar' ).outerHeight();
				}
				if ( $ ( '.paspartu-top' ).length && $( window ).width() > 600 ) {
					$add_offset += 30;
				}
				for ( var $i = 1; $i<=$( "#dotnav-menu li" ).length; $i++ ) {
					$sectionId = jQuery( 'a#side_nav_item_id_' + $i ).attr('href').replace(/#/g, "");;
					 if( $( window ).scrollTop() + $( window ).height() == $( document ).height() ) {
						$last = $( "#dotnav-menu li" );
						$( '.side_nav_item a' ).removeClass( 'active' );
						$( 'a#side_nav_item_id_' + $last ).addClass( 'active' );
					 } else {
						if ( $( this ).scrollTop() >= jQuery( '#'+ $sectionId).offset().top - $add_offset ) {
							jQuery( '#dotnav-menu li a' ).removeClass( 'active' );
							jQuery( 'a#side_nav_item_id_' + $i ).addClass( 'active' );
						}
					 }
				}
 			}
			});

});

/*  Fix RevSlider and Fitvids */
	jQuery(document).ready(function() {
			jQuery('body').find('.tp-caption iframe').each(function() {
				var $this = jQuery(this);
				if($this.parent().hasClass('fluid-width-video-wrapper')) {
					$this.unwrap();
				}
			});
	});
	
/*  Aside menu JS */
	jQuery(document).ready(function() {
	jQuery('.dp-aside-menu-toggle').click(function(){
	jQuery('.dp-aside-navigation-wrapper').addClass('active');
	jQuery('.dp-aside-navigation-wrapper').animate({width: '260px'},500);
	jQuery(this).fadeOut();	
				});
	jQuery('.dp-aside-navigation-wrapper.slidingaside').mouseleave(function() {
			jQuery(this).removeClass('active');
				jQuery('.dp-aside-navigation-wrapper').delay(500).animate({width: '40px'},500);
					jQuery('.dp-aside-menu-toggle').delay(1000).fadeIn("slow");	


  });


	});

/* Overlay menu JS */
	jQuery(document).ready(function() {
	jQuery('.dp-overlay-menu-toggle').click(function(){
	jQuery('.dp-overlay-menu').toggleClass('open');
	});
	jQuery('.dp-overlay-menu-close').click(function(){
	jQuery('.dp-overlay-menu').toggleClass('open');
	});
	jQuery('.dp-overlay-menu li a').click(function(){
	jQuery('.dp-overlay-menu').toggleClass('open');
	});
	});
	
jQuery(document).ready(function(){
	var $elements = jQuery('.dp-overlay-menu li, .submenu');
jQuery('.dp-overlay-menu li.menu-item-has-children').hover(function() {
   $elements.eq($elements.index(this) + 1).slideDown("slow");
},function() {$elements.eq($elements.index(this) + 1).slideUp("slow");}

);
})
/*Flip boxes */
jQuery(document).ready(function(){
	jQuery('.dp-flipbox').each(function(){
	var boxid = '#'+jQuery(this).attr('id'); 
	var frontid = '#'+jQuery(this).attr('id') + '-front';
	var backid = '#'+jQuery(this).attr('id') + '-back';
	var fronth = jQuery(frontid).height();
	var backh = jQuery(backid).height();
	var finalh = Math.max(fronth, backh);
	jQuery(boxid).height(finalh);
	jQuery(frontid).height(finalh);
	jQuery(backid).height(finalh);
	});

})

jQuery(window).resize(function () {
	jQuery('.dp-flipbox').each(function(){
	var boxid = '#'+jQuery(this).attr('id'); 
	var frontid = '#'+jQuery(this).attr('id') + '-front';
	var backid = '#'+jQuery(this).attr('id') + '-back';
	var fronth = jQuery(frontid).height();
	var backh = jQuery(backid).height();
	var finalh = Math.max(fronth, backh);
	jQuery(boxid).height(finalh);
	jQuery(frontid).height(finalh);
	jQuery(backid).height(finalh);
	});

})



/* Pricing tables */

//Widget titles indicator
    jQuery(document).ready(function(){
		elements = jQuery('.down_indicator');
		elements.each(function() {
		var color = jQuery(this).parent().css('backgroundColor');
		var width = parseInt(jQuery(this).parent().width()) + parseInt(jQuery(this).parent().css("padding-left")) + parseInt(jQuery(this).parent().css("padding-right"));
		width = parseInt(width/2);
		width = width.toString()+"px"; 
		jQuery(this).css({'border-top-color':color, 'border-left-width':width, 'border-right-width':width});		
		});

		
    });
/* VC gallery Nivo thum slider */
    jQuery(document).ready(function(){
    jQuery('.wpb_gallery_slides').each(function (index) {
      var this_element = jQuery(this);
      var ss_count = 0;
      if (this_element.hasClass('wpb_slider_nivo')) {
        var sliderSpeed = 800,
          sliderTimeout = this_element.attr('data-interval') * 1000;

        if (sliderTimeout == 0) sliderTimeout = 9999999999;

        this_element.find('.nivoSlider_thumb').nivoSlider({
          effect:'boxRainGrow,boxRain,boxRainReverse,boxRainGrowReverse', // Specify sets like: 'fold,fade,sliceDown'
          slices:15, // For slice animations
          boxCols:8, // For box animations
          boxRows:4, // For box animations
          animSpeed:sliderSpeed, // Slide transition speed
          pauseTime:sliderTimeout, // How long each slide will show
          startSlide:0, // Set starting Slide (0 index)
          directionNav:true, // Next & Prev navigation
          directionNavHide:true, // Only show on hover
          controlNav:true, // 1,2,3... navigation
		  controlNavThumbs: true,
          keyboardNav:false, // Use left & right arrows
          pauseOnHover:true, // Stop animation while hovering
          manualAdvance:false, // Force manual transitions
          prevText:'Prev', // Prev directionNav text
          nextText:'Next' // Next directionNav text
        });
      }
	
	})
		
    });

/* Popup notications JS */
    jQuery(document).ready(function(){
    jQuery('.dp-popup-notification').each(function (index) {
	 	var notification = jQuery(this);
	 	var _animation = notification.data('animation');
		var _delay = notification.data('delay');
		var _displaymode = notification.data('displaymode');
		var _close = '#' + notification.attr('id') + '_close';
		var _timer = '#' + notification.attr('id') + '_timer';
		var _ofset = notification.data('ofset');
		jQuery.fn.showNotif = function() {
			notification.addClass(_animation)
		}
		jQuery.fn.closeNotif = function() {
			notification.hide('fast');
		}
		jQuery(_close).click(function(){
				notification.closeNotif();	
				});
		if (_displaymode == "onload") {
			notification.showNotif();
			if (_delay >0) {
				setTimeout(function(){ notification.closeNotif(); }, _delay);
				jQuery(_timer).animate({'width':'100%'},_delay)
			}
		}
		if (_displaymode == "onscroll") {
			jQuery(window).on('scroll', function(event) {
				if(jQuery(this).scrollTop()>_ofset){
					notification.showNotif();
			if (_delay >0) {
				setTimeout(function(){ notification.closeNotif(); }, _delay);
				jQuery(_timer).animate({'width':'100%'},_delay)
			}
				  }
				});
			};
	});
	});

/* Modal Boxes JS */
	jQuery(document).ready(function(){
		jQuery('.dp-md-trigger').click(function(){
							var _id = jQuery(this).data('id');
							jQuery('#modal-'+_id).addClass("md-show");
							jQuery('#overlay-'+_id).addClass("active");
							return false;
						});
		jQuery('.dp-md-overlay').click(function(){
							var _id = jQuery(this).data('id');
							jQuery('#modal-'+_id).removeClass("md-show");
							jQuery(this).removeClass("active");
							return false;
						});
		jQuery('.dp-modal-close').click(function(){
							var _id = jQuery(this).data('id');
							jQuery('#modal-'+_id).removeClass("md-show");
							jQuery('#overlay-'+_id).removeClass("active");
							return false;
						});
	});
/* Dual Button JS */
	jQuery(document).ready(function(){
		jQuery('.button-group').each(function(){
			var _radius = jQuery(this).data('radius')+'px'; 
			var _id = '#'+jQuery(this).attr('id')+' .gbutton';
			jQuery(_id).last().css( "border-top-right-radius", _radius );
			jQuery(_id).last().css( "border-bottom-right-radius", _radius );
			jQuery(_id).first().css( "border-top-left-radius", _radius );
			jQuery(_id).first().css( "border-bottom-left-radius", _radius );
		});
		jQuery('.equalized-group').each(function(){
			var _widths = new Array();
			jQuery(this).find(".gbutton .bt-text").each(function(){
				_widths.push(jQuery(this).outerWidth());
			})
			_eqwidth = Math.max.apply(Math,_widths)+20;
			jQuery(this).find(".gbutton .bt-text").each(function(){
				jQuery(this).outerWidth(_eqwidth);
			})
			});
		jQuery('.gbutton').hover(function(){
			  jQuery(this).css("background-color",jQuery(this).data("hbgcolor"));
			  jQuery(this).css("border-color",jQuery(this).data("hbordercolor"));
			  },function(){
			  jQuery(this).css("background-color",jQuery(this).data("bgcolor"));
			  jQuery(this).css("border-color",jQuery(this).data("bordercolor"));
			});
		jQuery('.gbutton a').hover(function(){
			  jQuery(this).css("color",jQuery(this).data("htextcolor"));
			  },function(){
			  jQuery(this).css("color",jQuery(this).data("textcolor"));
						});
		jQuery('.btn-separator-wrap').each(function(){
			var _parent =jQuery(this).parent().prev("div");
			
			jQuery(this).height(_parent.height());
						});
		jQuery('.button-drops').each(function(){
			var _parent = jQuery(this).data("parent");
			var _ofset = jQuery(_parent).height()+2;
			jQuery(this).css("top", _ofset);
			
		});
		jQuery('.dropdown-bt').each(function(){
		var _mode= jQuery(this).data("mode");
		var _id = jQuery(this).data("id");
		var _drops = '#drops-'+_id;
		if (_mode == "onclick") {
			jQuery(this).click(function(){
				jQuery(_drops).toggle('200');
				});
		}
		if (_mode == "onhover") {
		jQuery(this).parent().hover(function() {
				jQuery(_drops).show('slow');
			}, function() {
				jQuery(_drops).hide('slow');
			});
		}
		});
	});
	


/* Sticky width menu adjust */
jQuery(document).ready(function() {
	var mwidth = jQuery('#dp-page-box').width();
	jQuery('#dp-navigation-wrapper').css( "width", mwidth );
	
});
jQuery(window).on('resize', function(){
	var mwidth = jQuery('#dp-page-box').width();
	jQuery('#dp-navigation-wrapper').css( "width", mwidth );
});

/* Side grided column margin adjust */

/* Sticky width menu adjust */
jQuery(document).ready(function() {
	var offset = (jQuery(window).width() - $DP_TEMPLATE_WIDTH)/2;
	if (offset >= 0 ) 
	{offset = (offset +20)+'px';} else {offset = '20px';}
	jQuery('.grided-left').css( "padding-left" , offset);
	jQuery('.grided-right').css( "padding-right" , offset );
	
	
});
jQuery(window).on('resize', function(){
	var offset = (jQuery(window).width() - $DP_TEMPLATE_WIDTH)/2;
	if (offset >= 0 ) 
	{offset = (offset +20)+'px';} else {offset = '20px';}
	jQuery('.grided-left').css( "padding-left" , offset);
	jQuery('.grided-right').css( "padding-right" , offset );
});

/**
* jquery.matchHeight-min.js master
* http://brm.io/jquery-match-height/
* License: MIT
*/
(function(c){var n=-1,f=-1,g=function(a){return parseFloat(a)||0},r=function(a){var b=null,d=[];c(a).each(function(){var a=c(this),k=a.offset().top-g(a.css("margin-top")),l=0<d.length?d[d.length-1]:null;null===l?d.push(a):1>=Math.floor(Math.abs(b-k))?d[d.length-1]=l.add(a):d.push(a);b=k});return d},p=function(a){var b={byRow:!0,property:"height",target:null,remove:!1};if("object"===typeof a)return c.extend(b,a);"boolean"===typeof a?b.byRow=a:"remove"===a&&(b.remove=!0);return b},b=c.fn.matchHeight=
function(a){a=p(a);if(a.remove){var e=this;this.css(a.property,"");c.each(b._groups,function(a,b){b.elements=b.elements.not(e)});return this}if(1>=this.length&&!a.target)return this;b._groups.push({elements:this,options:a});b._apply(this,a);return this};b._groups=[];b._throttle=80;b._maintainScroll=!1;b._beforeUpdate=null;b._afterUpdate=null;b._apply=function(a,e){var d=p(e),h=c(a),k=[h],l=c(window).scrollTop(),f=c("html").outerHeight(!0),m=h.parents().filter(":hidden");m.each(function(){var a=c(this);
a.data("style-cache",a.attr("style"))});m.css("display","block");d.byRow&&!d.target&&(h.each(function(){var a=c(this),b=a.css("display");"inline-block"!==b&&"inline-flex"!==b&&(b="block");a.data("style-cache",a.attr("style"));a.css({display:b,"padding-top":"0","padding-bottom":"0","margin-top":"0","margin-bottom":"0","border-top-width":"0","border-bottom-width":"0",height:"100px"})}),k=r(h),h.each(function(){var a=c(this);a.attr("style",a.data("style-cache")||"")}));c.each(k,function(a,b){var e=c(b),
f=0;if(d.target)f=d.target.outerHeight(!1);else{if(d.byRow&&1>=e.length){e.css(d.property,"");return}e.each(function(){var a=c(this),b=a.css("display");"inline-block"!==b&&"inline-flex"!==b&&(b="block");b={display:b};b[d.property]="";a.css(b);a.outerHeight(!1)>f&&(f=a.outerHeight(!1));a.css("display","")})}e.each(function(){var a=c(this),b=0;d.target&&a.is(d.target)||("border-box"!==a.css("box-sizing")&&(b+=g(a.css("border-top-width"))+g(a.css("border-bottom-width")),b+=g(a.css("padding-top"))+g(a.css("padding-bottom"))),
a.css(d.property,f-b+"px"))})});m.each(function(){var a=c(this);a.attr("style",a.data("style-cache")||null)});b._maintainScroll&&c(window).scrollTop(l/f*c("html").outerHeight(!0));return this};b._applyDataApi=function(){var a={};c("[data-match-height], [data-mh]").each(function(){var b=c(this),d=b.attr("data-mh")||b.attr("data-match-height");a[d]=d in a?a[d].add(b):b});c.each(a,function(){this.matchHeight(!0)})};var q=function(a){b._beforeUpdate&&b._beforeUpdate(a,b._groups);c.each(b._groups,function(){b._apply(this.elements,
this.options)});b._afterUpdate&&b._afterUpdate(a,b._groups)};b._update=function(a,e){if(e&&"resize"===e.type){var d=c(window).width();if(d===n)return;n=d}a?-1===f&&(f=setTimeout(function(){q(e);f=-1},b._throttle)):q(e)};c(b._applyDataApi);c(window).bind("load",function(a){b._update(!1,a)});c(window).bind("resize orientationchange",function(a){b._update(!0,a)})})(jQuery);

jQuery(document).ready(function() {
                    jQuery('.equalized-columns').each(function() {
                        jQuery(this).children('.wpb_column').matchHeight();
                    });
	
});


function centerfooter(){
	if(typeof $DP_SMALL_TABLET_WIDTH != 'undefined') {
        if (jQuery(window).width()<= $DP_SMALL_TABLET_WIDTH) { 
jQuery('#dp-copyright-inner .social-bar').wrap('<div class="centered-block-outer"><div class="centered-block-middle"><div class="centered-block-inner"></div></div></div>');
				   jQuery('.dp-copyrights').wrap('<div class="centered-block-outer"><div class="centered-block-middle"><div class="centered-block-inner"></div></div></div>');
				  }
	}
}
jQuery(document).ready(function() {
				   centerfooter()
});
jQuery(window).on('resize', function() {
				   centerfooter()
});
