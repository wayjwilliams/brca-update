jQuery(window).load(function(){"use strict";jQuery(document).find(".dp-tabs").each(function(e,t){t=jQuery(t);var n=t.attr("data-speed");var r=t.attr("data-interval");var i=t.attr("data-autoanim");var s=t.attr("data-event");var o=0;var u=t.find(".dp-tabs-item");var a=t.find(".dp-tabs-nav li");var f=jQuery(t.find(".dp-tabs-container")[0]);var l=o;var c=null;var h=u.length;var p=false;var d=false;var v=false;var m=[];jQuery(u).css("opacity",0);jQuery(u[o]).css({opacity:"1",position:"relative","z-index":2});jQuery(u).each(function(e,t){m[e]=jQuery(t).outerHeight()});a.each(function(e,r){r=jQuery(r);r.bind(s,function(){if(e!=l){c=l;l=e;if(typeof dp_tab_event_trigger!="undefined"){dp_tab_event_trigger(l,c,t.parent().parent().attr("id"))}f.css("height",f.outerHeight()+"px");var r={opacity:0};var i={opacity:1};jQuery(u[c]).animate(r,n/2,function(){jQuery(u[c]).css({position:"absolute",top:"0","z-index":"1"});jQuery(u[l]).css({position:"relative","z-index":"2"});jQuery(u[c]).removeClass("active");jQuery(u[l]).addClass("active");f.animate({height:m[e]},n/2,function(){f.css("height","auto")});setTimeout(function(){jQuery(u[l]).animate(i,n)},n/2)});if(!v)d=true;else v=false;jQuery(a[c]).removeClass("active");jQuery(a[l]).addClass("active")}})});if(i=="enabled"){setInterval(function(){if(!d){v=true;if(l<h-1)jQuery(a[l+1]).trigger(s);else jQuery(a[0]).trigger(s)}else{d=false}},r)}})})