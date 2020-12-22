;(function ($) {
    $.fn.category = function (options) {
        var defaults = {
            data: [],
            initValue: [],
            search: '',
            onClick: function (values, is_last) {
            }
        };
        var opts = $.extend(defaults, options);
        var _this = this, level = 1;


        _this.render = function render(data, level, path) {
            path = path || '';
            var areaCont = "<ul class=\"select-category-level-" + level + "\" data-level=\"" + level + "\">";
            var level_next = level + 1;
            for (var i = 0; i < data.length; i++) {
                areaCont += '<li class="select-category-item" data-value="' + data[i]['value'] + '" data-index="' + i + '" data-path="' + path + i + '."><a href="javascript:void(0)">' + data[i]['label'] + '</a></li>';
            }
            areaCont += '</ul>';
            // 比当前level大的全部删除
            for (level - 1; level < 10; ++level) {
                if (_this.find(".select-category-level-" + level).length) {
                    _this.find(".select-category-level-" + level).remove();
                }
            }
            _this.append(areaCont);
        };
        // 选择分类
        _this.delegate('li.select-category-item', 'click', function () {
            var index = $(this).data('index'), path = $(this).data('path'), level = $(this).parent().data('level');
            var real_path = path.split('.');
            var data;
            var selected_values = [];
            data = opts.data[real_path[0]].children;
            selected_values.push({
                label: opts.data[real_path[0]].label,
                value: opts.data[real_path[0]].value,
            });
            for (var i = 1; i < real_path.length; i++) {
                if (i + 1 === real_path.length) {
                    continue;
                }
                selected_values.push({
                    label: data[real_path[i]].label,
                    value: data[real_path[i]].value,
                });
                data = data[real_path[i]].children;

            }
            console.log(data);
            console.log('selected_value', selected_values);
            // var data = opts.data[index];
            $(this).addClass("active").siblings("li").removeClass("active");
            if (data) {
                _this.render(data, ++level, path);
            }
            var is_last = data ? false : true;
            opts.onClick.apply(this, [selected_values, is_last]);

        });
        // 初始化
        _this.render(opts.data, level);
        // 具备初始值
        console.log(opts.initValue);
        if (opts.initValue.length) {
            for (var i=0;i<opts.initValue.length;i++){
                _this.find('li.select-category-item[data-value='+opts.initValue[i]+']').trigger('click');
            }
        }

    };
})(jQuery);

