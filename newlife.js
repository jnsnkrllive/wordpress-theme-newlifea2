var newlifeHelper = {
  setup: function() {
    $(document).ready(sliderInit);
    $(window).ready(hideExpandablePosts);
    $(window).ready(this.initReady);
    $(window).on('load',this.initLoad);
    $(window).resize(sliderImgsSize);
  },
  initReady: function() {
    $('.newlife-slideshow a img').css({opacity: 0.0});
  },
  initLoad: function() {
    sliderImgsSize();
    $('.newlife-slideshow a img:first').css({opacity: 1.0}).addClass('active');
  }
};


function hideExpandablePosts() {
  $('.expandable-posts').hide();
  $('.expandable-posts').siblings('span').children('.expandable-icon').addClass('collapsed');
}


function toggleExpandablePosts(element) {
  var tExpand = $(element).siblings('.expandable');
  tExpand.slideToggle("1000", "easeInOutCubic");
  var tSpan = tExpand.siblings('span').children('.expandable-icon');
  if( tSpan.hasClass('collapsed') ) {
    tSpan.removeClass('collapsed');
    tSpan.addClass('expanded');
  } else if( tSpan.hasClass('expanded') ) {
    tSpan.removeClass('expanded');
    tSpan.addClass('collapsed');
  }
}

function sliderImgsSize() {
  $('.newlife-slideshow a img').each(function() {
    var $thisImg = $(this);
    var $imgParent = $thisImg.parent('a').parent('.newlife-slideshow');
    var $maxWidth = 0.9*$imgParent.width();
    var $maxHeight = 0.9*$imgParent.height();
    // Set Initial Image Dimensions
    $thisImg.removeAttr("width");
    $thisImg.removeAttr("height");
    $thisImg.width($maxWidth);
    // Adjust Image Dimensions Based on Width
    if( $thisImg.width() > $maxWidth ) {
      $thisImg.width($maxWidth);
    }
    // Adjust Image Dimensions Based on Height
    if( $thisImg.height() > $maxHeight ) {
      $thisImg.width($thisImg.width() * $maxHeight/$thisImg.height());
    }
    // Center Image Horizontally/Vertically
    $thisImg.css('margin-left', '-'+$thisImg.width()/2+'px');
    $thisImg.css('margin-top', '-'+$thisImg.height()/2+'px');
    // Set Image Height to Maintain Aspect Ratio
    $thisImg.css('height','auto');
  });
}


function sliderSwitchPrev() {
  var $active = $('.newlife-slideshow a img.active');

  if ( $active.length == 0 ) $active = $('.newlife-slideshow a:first').children('img');

  var $prev = $active.parent('a').prev('a').length ? $active.parent('a').prev('a').children('.theSlide') : $('.newlife-slideshow a:last').children('img');

  $active.addClass('last-active');
      
  $prev.css({opacity: 0.0})
      .addClass('active')
      .animate({opacity: 1.0}, 500, function() {
          $active.removeClass('active last-active');
      });
  $active.animate({opacity: 0.0}, 500);
}


function sliderSwitchNext() {
  var $active = $('.newlife-slideshow a img.active');

  if ( $active.length == 0 ) $active = $('.newlife-slideshow a:last').children('img');

  var $next = $active.parent('a').next('a').length ? $active.parent('a').next('a').children('.theSlide') : $('.newlife-slideshow a:first').children('img');

  $active.addClass('last-active');
      
  $next.css({opacity: 0.0})
      .addClass('active')
      .animate({opacity: 1.0}, 500, function() {
          $active.removeClass('active last-active');
      });
  $active.animate({opacity: 0.0}, 500);
}


function sliderInit() {
  var interval = setInterval( "sliderSwitchNext()", 6000 );
  $('.sliderPrev').click( function() {clearInterval(interval);  setTimeout( function() { interval = setInterval( "sliderSwitchNext()", 6000 ); });  sliderSwitchPrev();} );
  $('.sliderNext').click( function() {clearInterval(interval);  setTimeout( function() { interval = setInterval( "sliderSwitchNext()", 6000 ); });  sliderSwitchNext();} );
};