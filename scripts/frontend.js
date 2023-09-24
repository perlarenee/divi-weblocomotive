// This script is loaded both on the frontend page and in the Visual Builder.
jQuery(function($) {

    $.fn.isInViewport = function(option = false,padding=0) {//top, bottom, topAndBottom, topOrBottom
        var topPad = padding;
        var elementTop = $(this).offset().top;
        var elementBottom = elementTop + $(this).outerHeight();
        var viewportTop = $(window).scrollTop() + topPad;
        var viewportBottom = viewportTop + $(window).height();
        var result = elementBottom > viewportTop && elementTop < viewportBottom;
        if(option){
            if(option == "top"){
                result = elementTop < viewportBottom && elementTop > viewportTop;
            }else if(option == "bottom"){
                result = elementBottom > viewportTop && elementBottom < viewportBottom;
            }else if(option == "topAndBottom"){
                result = elementBottom > viewportTop  && elementBottom < viewportBottom && elementTop < viewportBottom  && elementTop > viewportTop;
            }else if(option == "topOrBottom"){
                //do nothing. default to original result
            }
        }
        return result;
    };

    var prevTop = $(window).scrollTop();
    var method = false;
    var clickDelay = false;

    var showHideDotNav = function(option="show",instance=false){
        var dotNav = instance;
        //console.log('option:',option,'instance:',instance)
        if(option == "show"){
            //console.log('show dotnav');
            dotNav.addClass('show').removeClass('hide');
        }else{
            //console.log('hide dotnav');
            dotNav.addClass('hide').removeClass('show');
        }
    }

    var getTopPad = function(){
        var staticHeader = $('.et-fixed-header');
        var adminBar = $("#wpadminbar");
        var topPad = 0;
        if(staticHeader.length){
            topPad = staticHeader.outerHeight();
        }
        if(adminBar.length){
            topPad += adminBar.outerHeight();
        }
        topPad = topPad;
        return topPad;
    }

    //set current dotnav as active and add to local storage for history state
    var dotnavActive = function(thisID=false){
        //console.log('dotnav active:',thisID);
        $(".dotnav a").removeClass("active");
        var thisElem = $(".dotnav a[href$='"+thisID+"']");
        $(thisElem).addClass("active");
        var store = {
          dotnav: thisID,
          page: window.location
        }
        localStorage.setItem('dotnav', JSON.stringify(store));
    }

    
    $(window).on('resize scroll', function(e) {
        //determine scroll direction
        var direction = "up";
        var currentTop = $(window).scrollTop();
        if(prevTop<currentTop){
            direction = "down";
        }
        prevTop = currentTop;
        var active = [];

        $('.dotnav').each(function(){
            var instance = $(this);
            var links = instance.find('.et_pb_diwe_dotnav_item a');
            links.each(function(){
                var href = $(this).attr('href');
                var y = $(window).scrollTop();
                //console.log('href:',href);
                if (y > 0) {
                    showHideDotNav('show', instance);
                    //console.log('show',y,'instance:',instance);
                } else {
                    if(instance.hasClass("hideTop")){
                        showHideDotNav('hide',instance); 
                        //console.log('hideTop','instance:',instance);
                    }
                }
    
                //is object in 
                var topPadding = getTopPad();
                if(method){
                    active = [];
                    if($(method).isInViewport("topOrBottom",topPadding)){
                        active.push(method)
                    }
                }else{
                    if ($(href).isInViewport("topOrBottom",topPadding)) {
                        // console.log(href+" is in viewport");
                        active.push(href)
                    }else{
                        // console.log(href+" not in viewport");
                        active.splice( $.inArray(href,active), $.inArray(href,active) );
                    }
                }
            });
        });

        //if direction is down and more than one item is in array, pick the last item as active, otherwise pick the first
        if(active.length > 1 && direction == "down"){
            activeItem = active[active.length-1];
        }else{
            activeItem = active[0]
        }
        dotnavActive(activeItem);

        if(method == activeItem){
            //delay setting method to false long enough that any continued scroll doesn't give a false positive
            if(method && !clickDelay){
                clickDelay = true; //only fire once per click
                setTimeout(() => {
                    method = false;
                  }, "800");
            }
        }
      });



      //on page load, if dotnav local storage is set, and current page was the same as the source page, set active class. Else clear local storage
    if(localStorage.getItem('dotnav')){
        var dotnav = localStorage.getItem('dotnav');
        var store = JSON.parse(dotnav);
        if(store.page.href == window.location){
            $(".dotnav a[href$='"+store.dotnav+"']").addClass('active');
            method = store.dotnav;
        }else{
            localStorage.removeItem('dotnav');
        }
    }
    
    //smooth scroll
    $(".dotnav a").on('click', function(event) {
        //console.log('this.hash:',this.hash);
        if (this.hash && this.hash !== "") {
            clickDelay = 0;
            dotnavActive(this.hash);
            method = this.hash;
            return false;
        }
    });

    let pageIndex = {};

    //increment blog instance
    if($(".loadmorePosts")){
        let loadMores = document.querySelectorAll('.loadmorePosts');
        let blogs = document.querySelectorAll('.diwe-blog');
        for(let i=0;i<loadMores.length;i++){
            let thisInstance = loadMores[i];
            let thisBlog = blogs[i];
            thisInstance.dataset.instance = i;
            thisBlog.dataset.instance=i;
            pageIndex[i] = 1;
        }
    }
    //ajax load more
    $('.loadmorePosts').on('click',function(){
        let thisItem = parseInt($(this).data('instance'));
        pageIndex[thisItem] = pageIndex[thisItem]+1;
        let currentPage = pageIndex[thisItem];
        let postData = $('.diwe-blog[data-instance="'+thisItem+'"').data("post");


        //console.log('postData',postData.dark);
        $.ajax({
            type: 'POST',
            url: '/wp-admin/admin-ajax.php',
            dataType: 'json',
            data: {
              action: 'weichie_load_more',
              paged: currentPage,
              code: postData.code,
              dark: postData.dark,
              order: postData.order,
              orderby: postData.orderby,
              post_type: postData.post_type,
              posts_per_page: postData.posts_per_page
            },
            success: function (res) {
                if(currentPage >= res.max){
                    $('.loadmorePosts[data-instance="'+thisItem+'"').hide();
                }
                $('.diwe-blog[data-instance="'+thisItem+'"').append(res.html);
                
            }
          });

    });

});