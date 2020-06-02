class PlgSearch extends Plg {
    private txt_search = null;
    private btn_search = null;
    private div_search_results = null;
    private btn_close = null;

    constructor(ownerId, csrf_token = "") {
        super(ownerId, csrf_token);

        this.btn_close = this.make("button");

        this.txt_search = this.make("input");
        this.btn_search = this.make("button");
        this.make("br");
        this.div_search_results = this.make("div");

        this.prepare();
        this.assignEventHandlers();
    }

    private prepare() {
        this.btn_close.text("x");
        this.btn_close.addClass("btn");
        this.btn_close.addClass("btn-danger");
        this.btn_close.addClass("float-right");

        this.txt_search.attr("placeholder", "SEARCH ...");
        this.txt_search.addClass("form-control");
        this.txt_search.addClass("col-md-6");
        this.txt_search.addClass("mb-1");

        this.btn_search.text("SEARCH");
        this.btn_search.addClass("btn");
        this.btn_search.addClass("btn-secondary");
    }

    private assignEventHandlers() {
        this.btn_search.click(() => {
            this.div_search_results.html("");
            this.make("hr", this.div_search_results);
            this.addSearchResultEntry(this.txt_search.val());
        });

        this.btn_close.click(() => {
            $(this.me.parent()).fadeOut();
        });
    }

    private addSearchResultEntry(entry: string) {
        let ent = $("<p></p>");
        ent.text(entry);
        ent.css("color", "#345");
        ent.addClass("check");
        this.div_search_results.append(ent);
    }

    public static init(ownerId, csrf_token = "") {
        new PlgSearch(ownerId, csrf_token);
    }
}
