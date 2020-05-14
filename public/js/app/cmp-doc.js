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
var CmpDoc = /** @class */ (function (_super) {
    __extends(CmpDoc, _super);
    function CmpDoc(ownerId, docId) {
        var _this = _super.call(this, ownerId) || this;
        _this.me = null;
        _this.div_doc = null;
        _this.div_menu = null;
        _this.btn_reload = null;
        _this.btn_save = null;
        _this.btn_clear = null;
        _this.btn_delete = null;
        _this.doc = null;
        _this.doc_id = null;
        _this.btn_menu = null;
        _this.btn_hide_menu = null;
        _this.cmb_publish = null;
        _this.cmb_section = null;
        _this.doc_gdp_publish = null;
        _this.doc_gdp_expires = null;
        _this.doc_id = docId;
        _this.me = $("#" + ownerId);
        _this.div_doc = _this.dlr("div_doc");
        _this.div_menu = _this.dlr("div_menu");
        _this.btn_reload = _this.dlr("btn_reload");
        _this.btn_save = _this.dlr("btn_save");
        _this.btn_clear = _this.dlr("btn_clear");
        _this.btn_delete = _this.dlr("btn_delete");
        _this.btn_menu = _this.dlr("btn_menu");
        _this.btn_hide_menu = _this.dlr("btn_hide_menu");
        _this.cmb_publish = _this.dlr("cmb_publish");
        _this.cmb_section = _this.dlr("cmb_section");
        _this.doc_gdp_publish = _this.dlr("doc_gdp_publish");
        _this.doc_gdp_expires = _this.dlr("doc_gdp_expires");
        _this.prepare();
        _this.assignEventHandlers();
        _this.reloadDocContent();
        return _this;
    }
    CmpDoc.prototype.prepare = function () {
        this.div_menu.hide();
        this.div_menu.removeClass("d-none");
        var doc_show = parseInt(this.cmb_publish.attr("tag"));
        this.cmb_publish.prop("selectedIndex", doc_show);
        debugger;
        var doc_tag = this.cmb_section.attr("tag");
        this.cmb_section.val(doc_tag);
    };
    CmpDoc.prototype.reloadDocContent = function () {
        var _this = this;
        $.post("./api/get-div-doc", { doc_id: this.doc_id }, function (d, s) {
            try {
                if (d["ok"] == 1) {
                    _this.doc = d["result"]["doc_content"];
                    _this.present();
                }
                else {
                    console.log("Unable to get div doc");
                }
            }
            catch (err) {
                console.log(err);
            }
        });
    };
    CmpDoc.prototype.assignEventHandlers = function () {
        var _this = this;
        this.btn_menu.click(function (event) {
            _this.div_menu.fadeIn();
            _this.btn_menu.fadeOut();
        });
        this.btn_hide_menu.click(function (event) {
            _this.div_menu.fadeOut();
            _this.btn_menu.fadeIn();
        });
        this.btn_reload.on("click", function (event) {
            _this.reloadDocContent();
        });
        this.btn_save.on("click", function (event) {
            _this.doc = _this.div_doc.html();
            var doc_content = _this.div_doc.html();
            var doc_show = _this.cmb_publish.prop("selectedIndex");
            var doc_gdp_publish = $("#" + _this.doc_gdp_publish.attr("id") + "_txt_date").attr("gdp");
            var doc_gdp_expires = $("#" + _this.doc_gdp_expires.attr("id") + "_txt_date").attr("gdp");
            var doc_tag = _this.cmb_section.val(); /* section */
            $.post("./api/save-div-doc", {
                doc_id: _this.doc_id,
                doc_content: doc_content,
                doc_show: doc_show,
                doc_tag: doc_tag,
                doc_gdp_publish: doc_gdp_publish,
                doc_gdp_expires: doc_gdp_expires,
            }, function (d, s) {
                console.log(d);
            });
        });
        this.btn_clear.on("click", function (event) {
            _this.div_doc.html("");
        });
        this.btn_delete.on("click", function (event) {
            var doc_id = 4;
            $.post("./api/get-div-doc", { doc_id: doc_id }, function (d, s) {
                // console.log(d);
            });
        });
    };
    // private fnn() {
    //     navigator.clipboard
    //         .readText()
    //         .then((text) => {
    //             console.log("Pasted content: ", text);
    //         })
    //         .catch((err) => {
    //             console.error("Failed to read clipboard contents: ", err);
    //         });
    // }
    // private fn() {
    //     navigator.permissions.query({name: "clipboard-read"}).then(result => {
    //         // If permission to read the clipboard is granted or if the user will
    //         // be prompted to allow it, we proceed.
    //         if (result.state == "granted" || result.state == "prompt") {
    //           navigator.clipboard.read().then(data => {
    //             for (let i=0; i<data.items.length; i++) {
    //               if (data.items[i].type != "text/plain") {
    //                 alert("Clipboard contains non-text data. Unable to access it.");
    //               } else {
    //                 textElem.innerText = data.items[i].getAs("text/plain");
    //               }
    //             }
    //           });
    //         }
    //       });
    // }
    // async function getClipboardContents() {
    //     try {
    //       const clipboardItems = await navigator.clipboard.read();
    //       for (const clipboardItem of clipboardItems) {
    //         for (const type of clipboardItem.types) {
    //           const blob = await clipboardItem.getType(type);
    //           console.log(URL.createObjectURL(blob));
    //         }
    //       }
    //     } catch (err) {
    //       console.error(err.name, err.message);
    //     }
    //   }
    CmpDoc.prototype.present = function () {
        this.div_doc.html(this.doc);
    };
    CmpDoc.init = function (ownerId, docId) {
        new CmpDoc(ownerId, docId);
    };
    return CmpDoc;
}(Cmp));
