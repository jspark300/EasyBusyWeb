
$(document).ready(function(){
    //searchToggle();
    tab();
    searchFavorite();
    regularBtn();
    shopNav();
	 shopNav2();
    shopSlide();
    evalRating();
    writeToggle();
    entrySelect();
    snsToggle();
    locateSelect();
    //loading();
    reply_input();	
});
function searchToggle() {
    $(".header1 .btn_wrap .search").on("click", function() {
        $(".header1 .search_wrap").toggle();
        $(this).toggleClass("on");
    });
    $(".header1 .search_wrap > a").on("click", function() {
        $(".header1 .search_wrap").hide();
    });
}

function tab() {
    $(".tab_wrap a").on("click", function() {
        var tabidx = ($(this).parent("li").index()+1);
        $(".tab_wrap a").removeClass("on");
        $(this).addClass("on");
        $(".tab_con").hide();
        $(".tab_con.tab"+tabidx).show();
    });
}

function searchFavorite() {
    $(".search .btn_wrap_list li a").on("click", function() {
        $(".search .btn_wrap_list li a").removeClass("on");
        $(this).addClass("on");
    })
}

function regularBtn() {
    $(".regular").on("click", function() {
        $(this).toggleClass("on");
    })
}

function shopNav() {
    //var list_width = $(".shop_nav ul li").width() * $(".shop_nav ul li").size();   
    //$(".shop_nav ul").css({"width" : list_width +"px"});
    $(".shop_nav ul li a").on("click", function() {
        $(".shop_nav ul li a").removeClass("on");
        $(this).addClass("on");
    })
}
function shopNav2() {
    //var list_width = $(".shop_nav ul li").width() * $(".shop_nav ul li").size();   
    //$(".shop_nav ul").css({"width" : list_width +"px"});
    $(".shop_nav2 ul li a").on("click", function() {
        $(".shop_nav2 ul li a").removeClass("on");
        $(this).addClass("on");
    })
}

function shopSlide() {
    $(window).on("load resize", function() {
        var win_width = $(window).width();
        $(".slide_gallery ul li").css({"width" : win_width +"px"});
        var list_width = $(".slide_gallery ul li").width() * $(".slide_gallery ul li").size();
        $(".slide_gallery ul").css({"width" : list_width +"px"});
    })
}

function evalRating() {
    $( ".eval_rating a" ).click(function() {
        $(this).parent().children("a").removeClass("on");
        $(this).addClass("on");
        return false;
    });
}

function writeToggle() {
    $(".shop_eval .d2 .btn_more").on("click", function() {
        $(".shop_eval .d3").toggle();
        $(this).toggleClass("on");
    })
}

function entrySelect() {
    $(".shop_entry_2 .d2 ul li a").on("click", function() {
        if ($(this).hasClass("selected")) {
            return false;
        } else {
           $(".shop_entry_2 .d2 ul li a").removeClass("on");
            $(this).addClass("on"); 
        }
    });
}

function snsToggle() {
    $(".shop_sns ul li a").on("click", function() {
        $(".shop_sns ul li").removeClass("on");
        $(this).parent("li").addClass("on");
    })
}

function locateSelect() {
    $(".locate_wrap dt .u1 li a").on("click", function() {
        var tabidx = ($(this).parent("li").index()+1);
        $(".locate_wrap dt .u1 li").removeClass("on");
        $(this).parent("li").addClass("on");
        $(".locate_wrap dd .u1").hide();
        $(".locate_wrap dd .u1.f"+tabidx).show();
    });
    $(".locate_wrap dd .u1 li a").on("click", function() {
        $(".locate_wrap dd .u1 li").removeClass("on");
        $(this).parent("li").addClass("on");
    });
}

function main_slide() {
    $('div.imgSlide > ul').bxSlider({
        captions: true,
        auto: true,
        autoControls: true,
        pause: 1800
    });
    $('div.imgSlide2 > ul').bxSlider({
        mode: 'vertical',
        minSlides: 1,
        infiniteLoop: true,
        auto: true,
        pause: 2000
    });
}

function loading() {
    var documentHeight = document.documentElement.clientHeight;
    $(window).bind("orientationchange resize" , function(){
        documentHeight = document.documentElement.clientHeight;
    });
    var willTop = documentHeight / 2 - 20;

    var popType = "<div class='loading'><img src='images/loading.gif' alt='loading' style='margin-top:"+willTop+"px'></div>";
    
    $("body").append(popType).css({"height":documentHeight, "overflow":"hidden"});
}
function reply_input() {
    $(".reply_cont2 .reply_btn2 a").on("click", function() {
        $(this).parent().hide();
        $(this).parent().siblings(".reply_input2").show();;
    })

    $(".reply_cont2 a.reply_btn3").on("click", function() {
        $(this).parent().parent().hide();
        $(this).parent().parent().siblings(".reply_btn2").show();;
    })
}

