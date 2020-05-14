class CmpPdf extends Cmp {
    private emb_pdf = null;

    constructor(ownerId) {
        super(ownerId);

        this.emb_pdf = this.dlr("emb_pdf");
        // this.emb_pdf.css("width", "100%");
        // let h = this.emb_pdf[0].scrollWidth + 280;
        // this.emb_pdf.css("height", h + "px");
        this.emb_pdf.css("height", window.innerHeight + "px");

        // console.log(this.emb_pdf);

        // console.log(this.emb_pdf);
        // console.log($("div#viewerContainer"));
        // debugger;
    }

    public static init(ownerId) {
        new CmpPdf(ownerId);
    }
}
