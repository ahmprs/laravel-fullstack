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
var CmpPdf = /** @class */ (function (_super) {
    __extends(CmpPdf, _super);
    function CmpPdf(ownerId) {
        var _this = _super.call(this, ownerId) || this;
        _this.emb_pdf = null;
        _this.emb_pdf = _this.dlr("emb_pdf");
        // this.emb_pdf.css("width", "100%");
        // let h = this.emb_pdf[0].scrollWidth + 280;
        // this.emb_pdf.css("height", h + "px");
        _this.emb_pdf.css("height", window.innerHeight + "px");
        return _this;
        // console.log(this.emb_pdf);
        // console.log(this.emb_pdf);
        // console.log($("div#viewerContainer"));
        // debugger;
    }
    CmpPdf.init = function (ownerId) {
        new CmpPdf(ownerId);
    };
    return CmpPdf;
}(Cmp));
