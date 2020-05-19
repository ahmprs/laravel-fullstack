var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var CmpPluginCode = /** @class */ (function (_super) {
    __extends(CmpPluginCode, _super);
    function CmpPluginCode(ownerId, plgId) {
        var _this = _super.call(this, ownerId) || this;
        _this.me = null;
        _this.plg_id = null;
        _this.div_app = null;
        _this.btn_menu = null;
        _this.div_menu = null;
        _this.btn_hide_menu = null;
        _this.btn_save = null;
        _this.btn_delete = null;
        _this.txt_plugin_cls = null;
        _this.div_ts_code = null;
        _this.div_js_code = null;
        _this.div_app_script = null;
        _this.me = $("#" + ownerId);
        _this.plg_id = plgId;
        _this.div_app = _this.dlr("div_app");
        _this.btn_menu = _this.dlr("btn_menu");
        _this.div_menu = _this.dlr("div_menu");
        _this.btn_hide_menu = _this.dlr("btn_hide_menu");
        _this.btn_save = _this.dlr("btn_save");
        _this.btn_delete = _this.dlr("btn_delete");
        _this.txt_plugin_cls = _this.dlr("txt_plugin_cls");
        _this.div_ts_code = _this.dlr("div_ts_code");
        _this.div_js_code = _this.dlr("div_js_code");
        _this.div_app_script = _this.dlr("div_app_script");
        _this.prepare();
        _this.assignEventHandlers();
        return _this;
    }
    CmpPluginCode.prototype.prepare = function () {
        this.div_menu.hide();
        this.div_menu.removeClass("d-none");
    };
    CmpPluginCode.prototype.assignEventHandlers = function () {
        var _this = this;
        this.btn_menu.on("click", function () {
            _this.div_menu.fadeToggle();
        });
        this.btn_hide_menu.on("click", function () {
            _this.div_menu.fadeOut();
        });
        this.btn_save.on("click", function (event) {
            var plg_cls = _this.txt_plugin_cls.val();
            var plg_js_code = _this.div_js_code.html();
            var plg_ts_code = _this.div_js_code.html();
            var plg_js_plain = _this.div_js_code.text();
            $.post("./api/save-plugin-code", {
                plg_id: _this.plg_id,
                plg_js_code: plg_js_code,
                plg_ts_code: plg_ts_code,
                plg_js_plain: plg_js_plain,
                plg_cls: plg_cls,
            }, function (d, s) {
                console.log(d);
                if (d["ok"] == 1) {
                    _this.div_menu.fadeOut();
                    _this.btn_menu.fadeIn();
                }
            });
        });
        this.btn_delete.on("click", function (event) {
            if (_this.plg_id == null)
                return;
            var plg_id = _this.plg_id;
            var delete_confirm = window.prompt("DELETE PLUGIN?", "NO");
            if (delete_confirm.trim().toLocaleLowerCase() != "yes")
                return;
            $.post("./api/delete-plugin-code", { plg_id: plg_id }, function (d, s) {
                if (d["ok"] == 1) {
                    _this.me.fadeOut();
                }
            });
        });
    };
    CmpPluginCode.init = function (ownerId, plgId) {
        new CmpPluginCode(ownerId, plgId);
    };
    return CmpPluginCode;
}(Cmp));
