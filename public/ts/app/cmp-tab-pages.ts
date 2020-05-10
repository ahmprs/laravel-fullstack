class CmpTabPages extends Cmp {
    private arr_pages = [];
    private arr_buttons = [];
    private div_buttons = null;
    private div_page_holder = null;
    private active_page_index = -1;

    constructor(ownerId) {
        super(ownerId);

        this.div_buttons = this.dlr("div_buttons");
        let arr = this.div_buttons.children();
        for (let i = 0; i < arr.length; i++) {
            this.arr_buttons.push($(arr[i]));
        }

        this.div_page_holder = this.dlr("div_page_holder");
        let brr = this.div_page_holder.children();
        for (let i = 0; i < brr.length; i++) {
            this.arr_pages.push($(brr[i]));
        }

        this.prepare();
        this.assignEventHandlers();
    }

    private assignEventHandlers() {
        for (let i = 0; i < this.arr_buttons.length; i++) {
            let btn = this.arr_buttons[i];

            btn.on("click", (event) => {
                let btn = $(event.target);
                let pin = btn.attr("pin");
                this.active_page_index = parseInt(pin);
                this.present();
            });
        }
    }

    private prepare() {
        for (let i = 0; i < this.arr_pages.length; i++) {
            let p = this.arr_pages[i];
            p.hide();
            p.removeClass("d-none");
        }
        this.active_page_index = 0;
        this.present();
    }

    private present() {
        let pin = this.active_page_index;
        if (pin == -1) return;

        for (let i = 0; i < this.arr_pages.length; i++) {
            let p = this.arr_pages[i];
            if (p.attr("pin") != pin) p.hide();
            else p.fadeIn();
        }

        for (let i = 0; i < this.arr_buttons.length; i++) {
            let b = this.arr_buttons[i];
            if (b.attr("pin") != pin) b.removeClass("bg-white");
            else b.addClass("bg-white");
        }
    }

    public static init(ownerId) {
        new CmpTabPages(ownerId);
    }
}
