function setup() {
	this.addEventListener("DOMContentLoaded", sizeLightbox, true);
	this.addEventListener("DOMContentLoaded", sizeFooterWidgetArea, true);
	this.addEventListener("DOMContentLoaded", footerMapExpandableList, true);
	this.addEventListener("DOMContentLoaded", addLightboxEvent, true);
	this.addEventListener("resize", sizeLightbox, true);
	this.addEventListener("resize", sizeFooterWidgetArea, true);
	this.addEventListener("resize", doLightboxUnload, true);
}
setup();


function sizeLightbox() {
	var lightboxObj = document.getElementById('lightbox');
	if (document.body && document.body.offsetWidth) {
		winW = document.body.offsetWidth;
		winH = document.body.offsetHeight;
	}
	if (document.compatMode=='CSS1Compat' && document.documentElement && document.documentElement.offsetWidth ) {
		winW = document.documentElement.offsetWidth;
		winH = document.documentElement.offsetHeight;
	}
	if (window.innerWidth && window.innerHeight) {
		winW = window.innerWidth;
		winH = window.innerHeight;
	}
	calcLbWidth = winW / 2;
	calcLbHeight = winH / 2;
	lightboxObj.style.width = calcLbWidth + 'px';
	lightboxObj.style.height = calcLbHeight + 'px';
}


function sizeFooterWidgetArea() {

  var footerWidgetArea1Object = document.getElementById('footer-widget-area-1');
  var footerWidgetArea2Object = document.getElementById('footer-widget-area-2');
  var footerWidgetArea3Object = document.getElementById('footer-widget-area-3');

  var footerWidgetArea1 = footerWidgetArea1Object != null ? 1 : 0; //$('#footer-widget-area-1').length;
  var footerWidgetArea2 = footerWidgetArea2Object != null ? 1 : 0; 
  var footerWidgetArea3 = footerWidgetArea3Object != null ? 1 : 0; 
  var footerWidgetArea = Math.max(footerWidgetArea1 + footerWidgetArea2 + footerWidgetArea3, 100/95);
  
  var footerWidgetWidth = (Math.round(1000000 * 100 / footerWidgetArea)/1000000).toString() + '%';
  
  if( footerWidgetArea1Object != null ) {
    footerWidgetArea1Object.style.width = footerWidgetWidth;
  }
  if( footerWidgetArea2Object != null ) {
    footerWidgetArea2Object.style.width = footerWidgetWidth;
  }
  if( footerWidgetArea3Object != null ) {
    footerWidgetArea3Object.style.width = footerWidgetWidth;
  }
    
}


function footerMapExpandableList() {

    $('div.expandable ul li ul.sub-menu').siblings('span.expandable').text('[+]');
    $('div.expandable ul li ul.sub-menu').siblings('span.expandable').addClass('collapsed');

    $('div.expandable ul li a').click(function() {
        window.location.href = $(this).attr("href");
		return false;
    });

    $('div.expandable ul li ul.sub-menu').hide();
    $('div.expandable ul li').click(function() {
        t = $(this);
        tpc = t.children('div.expandable ul li ul.sub-menu');
        tpc.slideToggle("1000", "easeInOutCubic");

		tSpan = t.children('span.expandable');
		if( tSpan.hasClass('collapsed') ) {
            tSpan.text('[-]');
			tSpan.removeClass('collapsed');
			tSpan.addClass('expanded');
            return false;
        }
		if( tSpan.hasClass('expanded') ) {
		    tSpan.text('[+]');
			tSpan.removeClass('expanded');
			tSpan.addClass('collapsed');
            return false;
        }
        return false;

    });

}


function doLightboxLoad(imgElement) {
	if (document.body && document.body.offsetWidth) {
		winW = document.body.offsetWidth;
		winH = document.body.offsetHeight;
	}
	if (document.compatMode=='CSS1Compat' && document.documentElement && document.documentElement.offsetWidth ) {
		winW = document.documentElement.offsetWidth;
		winH = document.documentElement.offsetHeight;
	}
	if (window.innerWidth && window.innerHeight) {
		winW = window.innerWidth;
		winH = window.innerHeight;
	}
	calcLbWidth = winW / 2;
	calcLbHeight = winH / 2;
	var lightboxObj = $('#lightbox');
	var darkboxObj = $('#darkbox');
	var imgWidth = imgElement.clientWidth;
	var imgHeight = imgElement.clientHeight;
	var lightboxHeight = calcLbHeight;
	var imgMarginTop = (lightboxHeight - imgHeight) / 2;
	var htmlStr = "<img src='" + imgElement.src + "' style='margin-top:'" + imgMarginTop + "px' />";
	lightboxObj.html(htmlStr);
	lightboxObj.css('display', 'block');
	darkboxObj.css('display', 'block');
}


function doLightboxUnload() {
	var lightboxObj = $('#lightbox');
	var darkboxObj = $('#darkbox');
	lightboxObj.css('display', 'none');
	darkboxObj.css('display', 'none');
}


function addLightboxEvent() {
	//document.getElementsByClassName("raindrop")[0];
	$('.slideshow_widget').find('img').click(doLightboxLoad(this));
	//var events = $._data($('img'), "events");
	//alert( events );
	/*
    if( events == null) {
		$('img').click( function() { alert($('img')) } );
		//$('img').mouseover( function() { alert($('img')) } );
    }
	*/
	//( function() {$('img').click(doLightboxLoad($('img')))} );
}


function addLightbox() {

	//$(div.theslide img.theimg').addClass('lightbox-trigger');

	
//	$('a.lightbox-trigger').click(doLightbox());
	$('lightbox-trigger').onclick = doLightboxLoad();
	
	$('#lightbox').onclick = doLightboxUnload();
	
	/*
		function(element) {
			this.invoke('observe', 'click',doLightbox());
		}
	);
	*/
	/*
	$('.lightbox-trigger').onclick = function () {
		document.getElementById('lightbox').style.display='block';
		document.getElementById('darkbox').style.display='block';
	}
	*/	
	function doLightboxLoad() {
		document.getElementById('lightbox').style.display='block';
		document.getElementById('darkbox').style.display='block';
	}
	
	function doLightboxUnload() {
		document.getElementById('lightbox').style.display='none';
		document.getElementById('darkbox').style.display='none';
	}
	
	function doLightbox() {
		$('#lightbox').fadeIn();
		$('#darkbox').fadeIn();
		//$('#lightbox').slideToggle("1000", "easeInOutCubic");
		//$('#darkbox').slideToggle("1000", "easeInOutCubic");
		//document.getElementById('lightbox').slideToggle("1000", "easeInOutCubic");
		//document.getElementById('darkbox').slideToggle("1000", "easeInOutCubic");
	/*
		if( document.getElementById('darkbox').style.display='none' ) {
			document.getElementById('lightbox').style.display='block';
			document.getElementById('darkbox').style.display='block';
		}
	
		if( document.getElementById('darkbox').style.display='block' ) {
			document.getElementById('lightbox').style.display='none';
			document.getElementById('darkbox').style.display='none';
		}
	*/
	}

	
}