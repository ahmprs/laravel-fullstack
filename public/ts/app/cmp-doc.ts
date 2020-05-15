class CmpDoc extends Cmp {
    private me = null;
    private div_doc = null;
    private div_menu = null;
    private btn_reload = null;
    private btn_save = null;
    private btn_clear = null;
    private btn_delete = null;
    private doc: string = null;
    private doc_id = null;
    private btn_menu = null;
    private btn_hide_menu = null;

    private cmb_publish = null;
    private cmb_section = null;
    private doc_gdp_publish = null;
    private doc_gdp_expires = null;

    constructor(ownerId, docId) {
        super(ownerId);

        this.doc_id = docId;
        this.me = $("#" + ownerId);
        this.div_doc = this.dlr("div_doc");
        this.div_menu = this.dlr("div_menu");
        this.btn_reload = this.dlr("btn_reload");
        this.btn_save = this.dlr("btn_save");
        this.btn_clear = this.dlr("btn_clear");
        this.btn_delete = this.dlr("btn_delete");
        this.btn_menu = this.dlr("btn_menu");
        this.btn_hide_menu = this.dlr("btn_hide_menu");
        this.cmb_publish = this.dlr("cmb_publish");
        this.cmb_section = this.dlr("cmb_section");

        this.doc_gdp_publish = this.dlr("doc_gdp_publish");
        this.doc_gdp_expires = this.dlr("doc_gdp_expires");

        this.prepare();

        this.assignEventHandlers();
        this.reloadDocContent();
    }

    private prepare() {
        this.div_menu.hide();
        this.div_menu.removeClass("d-none");

        let doc_show = parseInt(this.cmb_publish.attr("tag"));
        this.cmb_publish.prop("selectedIndex", doc_show);

        let doc_tag = this.cmb_section.attr("tag");
        this.cmb_section.val(doc_tag);
    }

    private reloadDocContent() {
        $.post("./api/get-div-doc", { doc_id: this.doc_id }, (d, s) => {
            try {
                if (d["ok"] == 1) {
                    this.doc = d["result"]["doc_content"];
                    this.present();
                } else {
                    console.log("Unable to get div doc");
                }
            } catch (err) {
                console.log(err);
            }
        });
    }

    private assignEventHandlers() {
        this.btn_menu.click((event) => {
            this.div_menu.fadeIn();
            this.btn_menu.fadeOut();
        });

        this.btn_hide_menu.click((event) => {
            this.div_menu.fadeOut();
            this.btn_menu.fadeIn();
        });

        this.btn_reload.on("click", (event) => {
            this.reloadDocContent();
        });

        this.btn_save.on("click", (event) => {
            this.doc = this.div_doc.html();
            let doc_content = this.div_doc.html();

            let doc_show = this.cmb_publish.prop("selectedIndex");

            let doc_gdp_publish = $(
                "#" + this.doc_gdp_publish.attr("id") + "_txt_date"
            ).attr("gdp");

            let doc_gdp_expires = $(
                "#" + this.doc_gdp_expires.attr("id") + "_txt_date"
            ).attr("gdp");

            let doc_tag = this.cmb_section.val(); /* section */

            $.post(
                "./api/save-div-doc",
                {
                    doc_id: this.doc_id,
                    doc_content,
                    doc_show,
                    doc_tag,
                    doc_gdp_publish,
                    doc_gdp_expires,
                },
                (d, s) => {
                    console.log(d);
                    this.div_menu.fadeOut();
                    this.btn_menu.fadeIn();
                }
            );
        });

        this.btn_clear.on("click", (event) => {
            this.div_doc.html("");
        });

        this.btn_delete.on("click", (event) => {
            if (this.doc_id == null) return;
            let doc_id = this.doc_id;

            let delete_confirm = window.prompt("DELETE CONTENTS?", "NO");
            if (delete_confirm.trim().toLocaleLowerCase() != "yes") return;

            $.post("./api/delete-div-doc", { doc_id }, (d, s) => {
                if (d["ok"] == 1) {
                    this.me.fadeOut();
                }
            });
        });
    }

    private present() {
        this.div_doc.html(this.doc);
    }

    public static init(ownerId, docId) {
        new CmpDoc(ownerId, docId);
    }
}
