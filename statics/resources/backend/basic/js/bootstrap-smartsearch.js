!function($) {
    "use strict";
    // jshint laxcomma: true

    /* TYPEAHEAD PUBLIC CLASS DEFINITION
     * ================================= */
    var Smartsearch = function(element, options) {
        this.$element = $(element);
        this.$hiddenInput = this.$element.next(':hidden');
        this.options = $.extend({}, $.fn.smartsearch.defaults, options);
        this.matcher = this.options.matcher || this.matcher;
        this.sorter = this.options.sorter || this.sorter;
        this.select = this.options.select || this.select;
        this.autoSelect = typeof this.options.autoSelect == 'boolean' ? this.options.autoSelect : true;
        this.highlighter = this.options.highlighter || this.highlighter;
        this.updater = this.options.updater || this.updater;
        this.source = this.options.source;
        this.url = this.options.url;
        this.$menu = $(this.options.menu);
        this.shown = false;
        this.callback = this.options.callback;
        this.ajaxcallback = this.options.ajaxcallback;
        this.listen();
        this.showHintOnFocus = typeof this.options.showHintOnFocus == 'boolean' ? this.options.showHintOnFocus : false;
    }

    Smartsearch.prototype = {
        constructor: Smartsearch,
        select: function() {
            var val = this.$menu.find('.active').data('value');
            var name = this.$menu.find('.active').data('name');
            if (this.autoSelect || val) {
                this.$element
                        .val(this.updater(name))
                        .change();
                this.$hiddenInput.val(val);
            }
            eval(this.callback);
            return this.hide();
        },
        updater: function(item) {
            return item;
        },
        setSource: function(source) {
            this.source = source;
        },
        show: function() {
            var pos = $.extend({}, this.$element.position(), {
                height: this.$element[0].offsetHeight
            }), scrollHeight;
            scrollHeight = typeof this.options.scrollHeight == 'function' ?
                    this.options.scrollHeight.call() :
                    this.options.scrollHeight;
            var width = this.options.width == 'follow' ?
                    parseInt(this.$element.width())
                    + parseInt(this.$element.css('padding-left'))
                    + parseInt(this.$element.css('padding-right')) :
                    this.options.width;
            this.$menu
                    .insertAfter(this.$hiddenInput)
                    .css({
                        top: pos.top + pos.height + scrollHeight,
                        left: pos.left,
                        'min-width': width
                    })
                    .show();
            this.shown = true;
            return this;
        },
        hide: function() {
            this.$menu.hide();
            this.shown = false;
            return this;
        },
        lookup: function(query) {
            var items;
            if (typeof (query) != 'undefined' && query !== null) {
                this.query = query;
            } else {
                this.query = this.$element.val() || '';
            }
            if (this.query.length < this.options.minLength) {
                return this.shown ? this.hide() : this;
            }
            if(this.url){
                this.remoteprocess(this.url,this.query);
            }else{
                items = $.isFunction(this.source) ? this.source(this.query, $.proxy(this.process, this)) : this.source;
                return items ? this.process(items) : this;
            }
        },
        remoteprocess: function(url,query){
            var _this = this;
            if(query != ''){
                $.ajax({
                    url: this.url,
                    type: 'get',
                    dataType: 'json',
                    data: {word:this.query},
                    success: function(data){
                    	_this.$element.attr('itemlength',data.length);
                        _this.process(data);
                        if(_this.ajaxcallback){
                            eval(_this.ajaxcallback);
                        }
                    },
                    error: function(XHR, textStatus, errorThrown){
                        var ret, err;
                        if (XHR.readyState === 0 || XHR.status === 0) {
                                return;
                        }
                        switch (textStatus) {
                        case 'timeout':
                                err = 'The request timed out!';
                                break;
                        case 'parsererror':
                                err = 'Parser error!';
                                break;
                        case 'error':
                                if (XHR.status && !/^\s*$/.test(XHR.status)) {
                                        err = 'Error ' + XHR.status;
                                } else {
                                        err = 'Error';
                                }
                                if (XHR.responseText && !/^\s*$/.test(XHR.responseText)) {
                                        err = err + ': ' + XHR.responseText;
                                }
                                break;
                        }

                        //alert(err);
                    }
                });
            }
        },
        process: function(items) {
            var that = this;
            if(!this.url){
                items = $.grep(items, function(item) {
                    return that.matcher(item.condition);
                });
            }
            items = this.sorter(items);

            if (!items.length) {
                return this.shown ? this.hide() : this;
            }
            
            if (this.options.items == 'all' || this.options.minLength === 0 && !this.$element.val()) {
                return this.render(items).show();
            } else {
                return this.render(items.slice(0, this.options.items)).show();
            }
        },
        matcher: function(item) {
            return ~item.toLowerCase().indexOf(this.query.toLowerCase());
        },
        sorter: function(items) {
            var beginswith = []
                    , caseSensitive = []
                    , caseInsensitive = []
                    , item;

            while ((item = items.shift())) {
                if (!item.condition.toLowerCase().indexOf(this.query.toLowerCase()))
                    beginswith.push(item);
                else if (~item.condition.indexOf(this.query))
                    caseSensitive.push(item);
                else
                    caseInsensitive.push(item);
            }

            return beginswith.concat(caseSensitive, caseInsensitive);
        },
        highlighter: function(item) {
            var query = this.query.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, '\\$&');
            return item.replace(new RegExp('(' + query + ')', 'ig'), function($1, match) {
                return '<strong>' + match + '</strong>';
            });
        },
        render: function(items) {
            var that = this
            items = $(items).map(function(i, item) {
                i = $(that.options.item).data('value', item.value).data('name', item.name);
                i.find('a').html(that.highlighter(item.text));
                return i[0];
            });
            if (this.autoSelect) {
                items.first().addClass('active');
            }
            this.$menu.html(items);
            return this;
        },
        next: function(event) {
            var active = this.$menu.find('.active').removeClass('active')
                    , next = active.next();
            if (!next.length) {
                next = $(this.$menu.find('li')[0]);
            }
            next.addClass('active');
            var boxH = parseInt(this.$menu.height());
            var liTop = parseInt(next.position().top);
            var offset = parseInt(this.$menu.scrollTop());
            if (liTop + 20 > boxH) {
                offset += liTop + 20 - boxH;
                this.$menu.scrollTop(offset);
            } else {
                if (next.index() == 0)
                    this.$menu.scrollTop(0);
            }
        },
        prev: function(event) {
            var active = this.$menu.find('.active').removeClass('active')
                    , prev = active.prev();

            if (!prev.length) {
                prev = this.$menu.find('li').last();
            }
            prev.addClass('active');
            var liTop = parseInt(prev.position().top);
            var offset = parseInt(this.$menu.scrollTop());
            if (liTop - 5 < 0) {
                offset += (liTop - 5);
                this.$menu.scrollTop(offset);
            } else {
                var children = this.$menu.children('li');
                if (prev.index() == children.length - 1) {
                    offset = liTop - parseInt(this.$menu.height());
                    offset += parseInt(prev.height());
                    this.$menu.scrollTop(offset);
                }
            }
        },
        listen: function() {
            this.$element
                    .on('focus', $.proxy(this.focus, this))
                    .on('blur', $.proxy(this.blur, this))
                    .on('keypress', $.proxy(this.keypress, this))
                    .on('keyup', $.proxy(this.keyup, this));
            if (this.eventSupported('keydown')) {
                this.$element.on('keydown', $.proxy(this.keydown, this));
            }
            this.$menu
                    .on('click', $.proxy(this.click, this))
                    .on('mouseenter', 'li', $.proxy(this.mouseenter, this))
                    .on('mouseleave', 'li', $.proxy(this.mouseleave, this));
        },
        destroy: function() {
            this.$element.data('typeahead', null);
            this.$element
                    .off('focus')
                    .off('blur')
                    .off('keypress')
                    .off('keyup');
            if (this.eventSupported('keydown')) {
                this.$element.off('keydown');
            }
            this.$menu.remove();
        },
        eventSupported: function(eventName) {
            var isSupported = eventName in this.$element;
            if (!isSupported) {
                this.$element.setAttribute(eventName, 'return;');
                isSupported = typeof this.$element[eventName] === 'function';
            }
            return isSupported;
        },
        move: function(e) {
            if (!this.shown)
                return;
            switch (e.keyCode) {
                case 9: // tab
                case 13: // enter
                case 27: // escape
                    e.preventDefault();
                    break;
                case 38: // up arrow
                    e.preventDefault();
                    this.prev();
                    break;
                case 40: // down arrow
                    e.preventDefault();
                    this.next();
                    break;
            }
            e.stopPropagation();
        },
        keydown: function(e) {
            this.suppressKeyPressRepeat = ~$.inArray(e.keyCode, [40, 38, 9, 13, 27]);
            if (!this.shown && e.keyCode == 40) {
                this.lookup("");
            } else {
                this.move(e);
            }
        },
        keypress: function(e) {
            if (this.suppressKeyPressRepeat)
                return;
            this.move(e);
        },
        keyup: function(e) {
            switch (e.keyCode) {
                case 40: // down arrow
                case 38: // up arrow
                case 16: // shift
                case 17: // ctrl
                case 18: // alt
                    break;

                case 9:
                    break;// tab
                case 13: // enter
                    if (!this.shown)
                        return;
                    this.select();
                    break;

                case 27: // escape
                    if (!this.shown)
                        return;
                    this.hide();
                    break;
                default:
                    this.lookup();
            }

            e.stopPropagation();
            e.preventDefault();
        },
        focus: function(e) {
            if (!this.focused) {
                this.focused = true;
                if (this.options.minLength === 0 && !this.$element.val() || this.options.showHintOnFocus) {
                    this.lookup();
                }
            }
        },
        blur: function(e) {
            this.focused = false;
            if (!this.mousedover && this.shown)
                this.hide();
        },
        click: function(e) {
            e.stopPropagation();
            e.preventDefault();
            this.select();
//            this.$element.focus();
        },
        mouseenter: function(e) {
            this.mousedover = true;
            this.$menu.find('.active').removeClass('active');
            $(e.currentTarget).addClass('active');
        },
        mouseleave: function(e) {
            this.mousedover = false;
            if (!this.focused && this.shown)
                this.hide();
        }
    }

    $.fn.smartsearch = function(option) {
        var arg = arguments;
        return this.each(function() {
            var $this = $(this)
                    , data = $this.data('smartsearch')
                    , options = typeof option == 'object' && option;
            if (!data)
                $this.data('smartsearch', (data = new Smartsearch(this, options)));
            if (typeof option == 'string') {
                if (arg.length > 1) {
                    data[option].apply(data, Array.prototype.slice.call(arg, 1));
                } else {
                    data[option]();
                }
            }
        });
    };

    $.fn.smartsearch.defaults = {
        source: [],
        items: 8,
        value: 0,
        menu: '<ul class="smartsearch dropdown-menu"></ul>',
        item: '<li><a href="#"></a></li>',
        minLength: 0,
        scrollHeight: 0,
        width: 'follow', //auto,follow
        showHintOnFocus: true,
        autoSelect: true
    };
    $(document).on('focus.smartsearch.data-api', '[data-provide="smartsearch"]', function(e) {
        var $this = $(this);
        if ($this.data('smartsearch'))
            return;
        $this.smartsearch($this.data());
    });
    $(function() {
        var input = $('[data-provide="smartsearch"]');
        if (input.length > 0) {
            $.each(input, function(i, n) {
                $('<input type="hidden" value=""/>').attr('name', n.name).val($(n).attr('data-value')).insertAfter($(n));
               $(n).val($(n).attr('data-text'));
               var data = eval($(n).attr('data-source'));
               $.each(data, function(j, m) {
                   if (m.value == $(n).attr('data-value')) {
                       $(n).val(m.name);
                   }
               });
            });
        }
    });
}(window.jQuery);
$(document).ready(function() {
    $("#Item_barcode").focus();
    $('[enter=totab]').keypress(function(e) {
        if (e.keyCode == 13) {
            var fields = $(this).parents('form:eq(0),body').find('input:enabled, textarea, select');
            var index = fields.index(this);
            if (index > -1 && (index + 1) < fields.length) {
                fields.eq(index + 1).focus();
            }
            return false;
        }
    });
});
