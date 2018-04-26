/* - - - - - - - - - - - - - - - - - - - - - - - - - 
 * Module list
 * 
 * Tools
 * - breakpoint([breakpoint]): returns/determins against current breakpoint
 * - pageType: retuns current Page-Type
 *
 * Controls
 * - drawerNav[.init(target)|.move(target)|.open(target)|.close(target)|.toggle(target)]:
 *   Drawer Navigation controller
 * - scrollToAnchor(target[, scrollTimer]]): Scroll controller
 */

/* - - - - - - - - - - - - - - - - - - - - - - - - - *
 * jQuery Execution Scheduler
 */
var jQueryExecScheduler = {
    ready: function() {
    },
    load: function() {

    },
    resize: function() {
        drawerNav.init(); // also closes drawer-nav
    },
    breakpoints: { // executed in accordance to viewport-width at load
        xs: function() {
            drawerNav.init();
        },
        sm: function() {
            drawerNav.init();  
        },
        md: function() {
            drawerNav.init();
        },
        lg: function() {

        }
    },
    pageType: { // executed in accordance to body[data-page-type] at load
        default: function() {

        },
        top: function() {

        }
    }
}
$(function() {
    jQueryExecScheduler.ready();
    jQueryExecScheduler.breakpoints[breakpoint()]();
    jQueryExecScheduler.pageType[pageType]();
});
$(window).on('load', function() {
    jQueryExecScheduler.load();
});
$(window).on('resize', function() {
    jQueryExecScheduler.resize();
});

/* - - - - - - - - - - - - - - - - - - - - - - - - - *
   On-the-fly stuffs
 */
function breakpoint(breakpointIndex) {
    var breakpoints = {
        xs: null,
        sm: 768,
        md: 992,
        lg: 1200
    };

    if (breakpointIndex === undefined) {
        var result,
            baseBreakpointIndex;
        for (var v in breakpoints) {
            if (breakpoints[v] === null)
                baseBreakpointIndex = v;
            else if (window.innerWidth >= breakpoints[v])
                result = v;
        }
        return result ? result : baseBreakpointIndex;
    } else
        return window.innerWidth >= breakpoints[breakpointIndex] ? true : false;
}
var pageType = document.getElementsByTagName('body')[0].getAttribute('data-page-type');

/* - - - - - - - - - - - - - - - - - - - - - - - - - * 
 * Drawer Navigation (for smartdevices) controller
 */
var drawerNav = {
    // configs
    navElem: '#drawer-nav',
    classTarget: 'body, #drawer-nav',
    toggleSwitch: '#button-drawer-nav, #drawer-nav-background, .drawer-nav-toggle',
    // status
    curLevel: null, // null (before init) or number >= 1
    curNavElem: null, // null (level-1) or LI element
    defaultNavElem: 1, // 1 (level-1) or LI element
    navWidth: null,
    navMaxDepth: 1,
    initialized: false,
    // modules
    init: function(target) {
        var self = this;
        // set default nav
        if (target !== undefined)
            this.defaultNavElem = target;
        if (this.initialized) {
            this.close();
            return;
        }
        this.navWidth = $('#drawer-nav').width();
        // labels: link, dig
        $('li:has(> a)', this.navElem).addClass('link');
        $('li:has(> p)', this.navElem).addClass('dig');
        // labels: levels, return/label
        labelLevel(1, $('#drawer-nav .wrap > ul'));
        function labelLevel(levelIndex, levelParent) {
            if (levelIndex > self.navMaxDepth)
                self.navMaxDepth = levelIndex;
            levelParent.addClass('level-' + levelIndex);
            if (levelIndex != 1) {
                var levelLabel = '<li class="return to-level-1 caret-left icon-left">メインメニュー <small>へ</small></li>';
                    curlevelLabel = $(levelParent).siblings('p').html();
                for (var i = 2; i < levelIndex; i++) {
                    var html = levelParent.parents('li ul.level-' + i).siblings('p').html();
                    levelLabel += '<li class="return to-level-' + i + ' caret-left icon-left">' + html + ' <small>へ</small></li>';
                }
                levelLabel += '<li class="label">' + curlevelLabel + '</li>';
                $(levelParent).prepend(levelLabel);
            }
            $('> li > ul', levelParent).each(function() {
                labelLevel(levelIndex + 1, $(this));
            });
        }
        // set width to nav element
        $('ul.level-1', this.navElem).css('width', this.navWidth * this.navMaxDepth);
        // set to default nav
        this.move(this.defaultNavElem);
        // click events
        $(this.toggleSwitch).click(function(e) {
            e.stopImmediatePropagation();
            self.toggle();
        });
        $('li.dig', this.navElem).click(function(e) { // 進むボタン
            e.stopImmediatePropagation();
            self.move($(this));
        });
        $('li.return', this.navElem).click(function(e) { // 戻るボタン
            e.stopImmediatePropagation();
            self.move(parseInt($(this).attr('class').match(/to-level-(\d+)/)[1]));
        });
        // Mark initialized
        $(this.classTarget).addClass('drawer-nav-init drawer-nav-off');
        this.initialized = true;
    },
    move: function(target) {
        var self = this,
            curLevel = this.curLevel,
            curNavElem = this.curNavElem,
            targetLevel,
            targetNavElem,
            desc;
        if (target === undefined || target == 1) {
            // Init/back to top
            targetLevel = 1;
            targetNavElem = null;
            desc = true;
        } else if (typeof target == 'number') {
            // back to..
            targetLevel = target;
            targetNavElem = $(curNavElem).parents('.level-' + target);
            desc = true;
        } else {
            // proceed to..
            targetLevel = $('> ul', target).attr('class').replace('level-', '');
            targetNavElem = target;
        }
        
        // x-axis: set class
        $(this.classTarget)
        .removeClass('drawer-nav-level-' + curLevel)
        .addClass('drawer-nav-level-' + targetLevel);
        // y-axis: set class
        if (desc) {
            var levelDiff = curLevel - targetLevel;
            while (levelDiff > 0) {
                $(this.curNavElem).closest('.active').removeClass('active');
                levelDiff--;
            }
        }
        $(targetNavElem).addClass('active');
        // set current menu class + Scroll back to top
        var rootNavUl = $('ul.level-1', this.navElem),
            curNavUl = $('> ul', curNavElem),
            targetNavUl = $('> ul', targetNavElem),
            targetNavHeight = targetNavUl.height();
        if (desc)
            curNavUl.removeClass('current');
        curNavUl.addClass('current');
        setTimeout(function() {
            if (targetNavElem == null)
                rootNavUl.css('height', '');
            else
                rootNavUl.css('height', targetNavHeight);
            $(self.navElem).stop().animate({
                scrollTop: 0
            }, 0);
        }, 250);

        // save current state
        this.curLevel = targetLevel;
        this.curNavElem = targetLevel == 1 ? null : $(targetNavElem);
    },
    open: function(target) {
        if (target !== undefined)
            this.move(target);
        $(this.classTarget)
        .removeClass('drawer-nav-off')
        .addClass('drawer-nav-on');
    },
    close: function(target) {
        $(this.classTarget)
        .removeClass('drawer-nav-on')
        .addClass('drawer-nav-off');
        if (target !== undefined)
            this.move(target);
        else
            this.move(this.defaultNavElem);
    },
    toggle: function(target) {
        if ($(this.classTarget).hasClass('drawer-nav-on'))
            this.close(target);
        else
            this.open(target);
    }
};

/* - - - - - - - - - - - - - - - - - - - - - - - - - * 
 * SCROLL SENSOR v2.5
 * (c) 2017 Iori Tatsuguchi
 * ------------------------
 * 1.) スクロール方向
 *     スクロール中およびスクロール後一定時間、
 *     所定の要素に対し .scrolling 、また方向に応じ .scrolling-up を追加
 *     その後位置の変化に応じ所定の要素に対し .scrolled-up を追加
 * 
 * 2.) スクロール深度
 *     現在のスクロールオフセットが所定の深度に到達している場合、
 *     所定の要素に対し .deep-scroll を追加
 * 
 * v2.5: jQuery, トリガー不要. スクリプトロード後即実行
 * v2.6: オプション項目（target, activeFlagTimeout, deepScrollDepth, 付与クラス名）の整理
 */
(function() {
    var target = document.getElementsByTagName('body')[0], // 結果をクラス名として付与する要素
        activeFlagTimeout = 1200, // スクロールフラグ有効時間（ミリ秒）
        deepScrollDepth = 80, // .deep-scroll 付与深度
        activeFlag = false,
        activeFlagExecution,
        currentY = 0,
        previousY = 0;

    function activeFlagTimer() {
        activeFlag = true;
        target.classList.add('scrolling');
        target.classList.remove('scrolled-up', 'scrolled-down');

        if (activeFlagExecution !== undefined)
            clearTimeout(activeFlagExecution);
        activeFlagExecution = setTimeout(function() {
            activeFlag = false;
            if (target.classList.contains('scrolling-up'))
                target.classList.add('scrolled-up');
            if (target.classList.contains('scrolling-down'))
                target.classList.add('scrolled-down');
            target.classList.remove('scrolling', 'scrolling-up', 'scrolling-down');
        }, activeFlagTimeout);
    };

    window.addEventListener('scroll', function() {
        activeFlagTimer();
        currentY = window.scrollY;

        if (currentY < previousY) {
            target.classList.add('scrolling-up');
            target.classList.remove('scrolling-down');
        } else {
            target.classList.add('scrolling-down');
            target.classList.remove('scrolling-up');
        }
        previousY = currentY;

        if (currentY > deepScrollDepth)
            target.classList.add('deep-scroll');
        else
            target.classList.remove('deep-scroll');
    });
}());

/* - - - - - - - - - - - - - - - - - - - - - - - - - * 
 * Scroll to Anchor
 */
function scrollToAnchor(target, scrollTimer) {
    if (scrollTimer === undefined)
        scrollTimer = 1000;
    $("html, body").stop().animate({
        scrollTop: $(target).offset().top - $('#site-header').height() + 1
    }, scrollTimer);
}
