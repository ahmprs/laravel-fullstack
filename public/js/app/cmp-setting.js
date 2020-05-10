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
var CmpSetting = /** @class */ (function (_super) {
    __extends(CmpSetting, _super);
    function CmpSetting(ownerId, stgType, stgId) {
        var _this = _super.call(this, ownerId) || this;
        _this.stgType = null;
        _this.btn_save = null;
        _this.cmb_option = null;
        _this.txt_text = null;
        _this.txt_number = null;
        _this.cmp_cal = null;
        _this.stg_id = 0;
        _this.stg_id = stgId;
        _this.stgType = stgType;
        _this.btn_save = _this.dlr("btn_save");
        if (_this.stgType == "option")
            _this.cmb_option = _this.dlr("cmb_option");
        if (_this.stgType == "text")
            _this.txt_text = _this.dlr("txt_text");
        if (_this.stgType == "number")
            _this.txt_number = _this.dlr("txt_number");
        if (_this.stgType == "gdp")
            _this.cmp_cal = _this.getCmp("cmp_cal"); // Globals.arr[ownerId + "_cmp_cal"];
        _this.prepare();
        _this.assignEventHandlers();
        return _this;
    }
    CmpSetting.prototype.hasChanges = function () {
        this.btn_save.fadeIn();
    };
    CmpSetting.prototype.getStgVal = function () {
        switch (this.stgType) {
            case "option":
                return this.cmb_option.val();
            case "text":
                return this.txt_text.val();
            case "number":
                return this.txt_number.val();
            case "gdp":
                return this.cmp_cal.getGdp();
            default:
                return "";
        }
    };
    CmpSetting.prototype.assignEventHandlers = function () {
        var _this = this;
        if (this.cmb_option != null) {
            this.cmb_option.on("change", function () {
                _this.hasChanges();
            });
        }
        if (this.txt_text != null) {
            this.txt_text.keypress(function () {
                _this.hasChanges();
            });
        }
        if (this.txt_number != null) {
            this.txt_number.keypress(function () {
                _this.hasChanges();
            });
            this.txt_number.on("input", function () {
                _this.hasChanges();
            });
        }
        this.btn_save.on("click", function () {
            // send a post request to update the value
            var stg_id = _this.stg_id;
            var stg_val = _this.getStgVal();
            $.post("./api/update-settings", { stg_id: stg_id, stg_val: stg_val }, function (d, s) {
                try {
                    if (d["ok"] == 1) {
                        _this.btn_save.fadeOut();
                    }
                }
                catch (err) {
                    console.log(err);
                }
            });
            // this.btn_save.fadeOut();
        });
        if (this.cmp_cal != null) {
            this.cmp_cal["onDateChange"] = function () {
                _this.hasChanges();
            };
        }
    };
    CmpSetting.prototype.prepare = function () {
        this.btn_save.hide();
        this.btn_save.removeClass("d-none");
        if (this.stgType == "option") {
            var stg_val = this.cmb_option.attr("stg_val");
            this.cmb_option.val(stg_val).prop("selected", true);
        }
    };
    CmpSetting.init = function (ownerId, stgType, stgId) {
        new CmpSetting(ownerId, stgType, stgId);
    };
    return CmpSetting;
}(Cmp));
