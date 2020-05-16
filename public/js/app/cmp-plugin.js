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
var CmpPlugin = /** @class */ (function (_super) {
    __extends(CmpPlugin, _super);
    function CmpPlugin(ownerId, plgId) {
        var _this = _super.call(this, ownerId) || this;
        _this.me = null;
        _this.plg_id = null;
        _this.div_app = null;
        _this.div_js_code = null;
        _this.div_ts_code = null;
        _this.div_app_script = null;
        _this.btn_menu = null;
        _this.div_menu = null;
        _this.btn_hide_menu = null;
        _this.btn_reload = null;
        _this.btn_save = null;
        _this.btn_clear = null;
        _this.btn_delete = null;
        _this.cmb_publish = null;
        _this.cmb_section = null;
        _this.plg_gdp_publish = null;
        _this.plg_gdp_expires = null;
        _this.plg_js_code = null;
        _this.plg_ts_code = null;
        _this.me = $("#" + ownerId);
        _this.plg_id = plgId;
        _this.div_js_code = _this.dlr("div_js_code");
        _this.div_ts_code = _this.dlr("div_ts_code");
        _this.div_app = _this.dlr("div_app");
        _this.div_app_script = _this.dlr("div_app_script");
        _this.btn_menu = _this.dlr("btn_menu");
        _this.div_menu = _this.dlr("div_menu");
        _this.btn_hide_menu = _this.dlr("btn_hide_menu");
        _this.btn_reload = _this.dlr("btn_reload");
        _this.btn_save = _this.dlr("btn_save");
        _this.btn_clear = _this.dlr("btn_clear");
        _this.btn_delete = _this.dlr("btn_delete");
        _this.plg_gdp_publish = _this.dlr("plg_gdp_publish");
        _this.plg_gdp_expires = _this.dlr("plg_gdp_expires");
        _this.cmb_publish = _this.dlr("cmb_publish");
        _this.cmb_section = _this.dlr("cmb_section");
        _this.prepare();
        _this.assignEventHandlers();
        return _this;
    }
    CmpPlugin.prototype.assignEventHandlers = function () {
        var _this = this;
        this.btn_menu.on("click", function () {
            _this.div_menu.fadeIn();
        });
        this.btn_hide_menu.on("click", function () {
            _this.div_menu.fadeOut();
        });
        this.btn_save.on("click", function (event) {
            var plg_js_code = _this.div_js_code.html();
            var plg_ts_code = _this.div_ts_code.html();
            var plg_js_plain = _this.div_js_code.text();
            // plg_js_code = /*Globals.strToCode*/ plg_js_code;
            // plg_ts_code = /*Globals.strToCode*/ plg_ts_code;
            var plg_show = _this.cmb_publish.prop("selectedIndex");
            var plg_gdp_publish = $("#" + _this.plg_gdp_publish.attr("id") + "_txt_date").attr("gdp");
            var plg_gdp_expires = $("#" + _this.plg_gdp_expires.attr("id") + "_txt_date").attr("gdp");
            var plg_tag = _this.cmb_section.val(); /* section */
            $.post("./api/save-plugin", {
                plg_id: _this.plg_id,
                plg_js_code: plg_js_code,
                plg_ts_code: plg_ts_code,
                plg_js_plain: plg_js_plain,
                plg_show: plg_show,
                plg_tag: plg_tag,
                plg_gdp_publish: plg_gdp_publish,
                plg_gdp_expires: plg_gdp_expires,
            }, function (d, s) {
                console.log(d);
                _this.div_menu.fadeOut();
                _this.btn_menu.fadeIn();
            });
        });
        this.btn_clear.on("click", function (event) {
            _this.div_js_code.html("");
            _this.div_ts_code.html("");
        });
        this.btn_delete.on("click", function (event) {
            if (_this.plg_id == null)
                return;
            var plg_id = _this.plg_id;
            var delete_confirm = window.prompt("DELETE PLUGIN?", "NO");
            if (delete_confirm.trim().toLocaleLowerCase() != "yes")
                return;
            $.post("./api/delete-plugin", { plg_id: plg_id }, function (d, s) {
                if (d["ok"] == 1) {
                    _this.me.fadeOut();
                }
            });
        });
        this.btn_reload.on("click", function () {
            _this.reloadPluginCode();
        });
    };
    CmpPlugin.prototype.prepare = function () {
        this.div_menu.hide();
        this.div_menu.removeClass("d-none");
        var plg_show = parseInt(this.cmb_publish.attr("tag"));
        this.cmb_publish.prop("selectedIndex", plg_show);
        var doc_tag = this.cmb_section.attr("tag");
        this.cmb_section.val(doc_tag);
    };
    CmpPlugin.prototype.reloadPluginCode = function () {
        var _this = this;
        $.post("./api/get-plugin", { plg_id: this.plg_id }, function (d, s) {
            try {
                if (d["ok"] == 1) {
                    _this.plg_js_code =
                        /*Globals.codeToStr*/ d["result"]["plg_js_code"];
                    _this.plg_ts_code =
                        /*Globals.codeToStr*/ d["result"]["plg_ts_code"];
                    _this.present();
                }
                else {
                    console.log("Unable to get plugin");
                }
            }
            catch (err) {
                console.log(err);
            }
        });
    };
    CmpPlugin.prototype.present = function () {
        this.div_js_code.html(this.plg_js_code);
        this.div_ts_code.html(this.plg_ts_code);
    };
    CmpPlugin.init = function (ownerId, plgId) {
        new CmpPlugin(ownerId, plgId);
    };
    return CmpPlugin;
}(Cmp));
