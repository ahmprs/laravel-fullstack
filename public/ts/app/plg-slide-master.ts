class PlgSlideMaster extends Plg {
    private arr_div = null;
    private arr_spn = [];

    private div_0 = null;
    private div_1 = null;
    private div_2 = null;
    private div_3 = null;
    private div_4 = null;
    private div_5 = null;

    private div_foot = null;
    private div_progress = null;

    /* private btn_previous = null; */
    /* private btn_pause_play = null; */
    /* private btn_next = null; */

    private paused = false;

    private slide_index = 0;

    private img_previous = null;
    private img_next = null;
    private img_pause_play = null;

    constructor(ownerId, csrf_token = "") {
        super(ownerId, csrf_token);

        this.div_0 = this.make("div");
        this.div_1 = this.make("div");
        this.div_2 = this.make("div");
        this.div_3 = this.make("div");
        this.div_4 = this.make("div");
        this.div_5 = this.make("div");

        this.div_foot = this.make("div");
        /* this.btn_previous = this.make("button", this.div_foot);*/
        /* this.btn_pause_play = this.make("button", this.div_foot);*/
        this.div_progress = this.make("div", this.div_foot);
        /* this.btn_next = this.make("button", this.div_foot);*/

        this.arr_div = [
            this.div_0,
            this.div_1,
            this.div_2,
            this.div_3,
            this.div_4,
            this.div_5,
        ];

        let n = this.arr_div.length;
        for (let i = 0; i < n; i++) {
            let sp = this.make("span", this.div_progress);
            sp.text("•");
            sp.css("font-size", "2em");
            sp.css("font-family", "monospace");
            this.arr_spn.push(sp);
        }

        this.fetch();
        this.prepare();
        this.assignEventHandlers();
        this.present();

        setInterval(() => {
            if (this.paused) return;
            this.slide_index = (this.slide_index + 1) % this.arr_div.length;
            this.present();
        }, 15000);
    }

    private fetch() {
        $.post("./slider-welcome", { _token: this.csrf_token }, (d, s) => {
            this.div_0.html(d);
        });

        $.post("./slider-intro", { _token: this.csrf_token }, (d, s) => {
            this.div_1.html(d);
        });

        $.post("./slider-tech", { _token: this.csrf_token }, (d, s) => {
            this.div_2.html(d);
        });

        $.post("./slider-web-app", { _token: this.csrf_token }, (d, s) => {
            this.div_3.html(d);
        });

        $.post(
            "./slider-smartphone-app",
            { _token: this.csrf_token },
            (d, s) => {
                this.div_4.html(d);
            }
        );

        $.post("./slider-desktop-app", { _token: this.csrf_token }, (d, s) => {
            this.div_5.html(d);
        });
    }

    private prepare() {
        for (let i = 0; i < this.arr_div.length; i++) {
            let d = this.arr_div[i];
            d.hide();
        }

        this.me.css("background-color", "#123");
        this.me.css("border-radius", "5px");
        this.div_progress.addClass("d-inline");
        this.div_progress.addClass("float-right");
        this.div_progress.addClass("p-1");

        this.arr_div.forEach((element) => {
            element.addClass("dark");
            element.addClass("round");
            element.addClass("p-2");
            element.addClass("center");
        });

        this.div_foot.addClass("round");
        this.div_foot.addClass("dark");

        /* this.btn_previous.addClass("btn");*/
        /* this.btn_previous.addClass("circle");*/

        this.img_previous = this.make("img", this.div_foot);
        this.img_previous.attr("src", "./img/previous.png");
        this.img_previous.attr("alt", "PREVIOUS");
        this.img_previous.css("width", "40px");

        /* this.btn_pause_play.addClass("btn");*/
        /* this.btn_pause_play.addClass("circle");*/

        this.img_pause_play = this.make("img", this.div_foot);
        this.img_pause_play.attr("src", "./img/pause.png");
        this.img_pause_play.attr("alt", "PAUSE");
        this.img_pause_play.css("width", "40px");

        /* this.btn_next.addClass("btn");*/
        /* this.btn_next.addClass("circle");*/
        this.img_next = this.make("img", this.div_foot);
        this.img_next.attr("src", "./img/next.png");
        this.img_next.attr("alt", "NEXT");
        this.img_next.css("width", "40px");
    }

    private present() {
        if (this.slide_index < 0) return;
        if (this.slide_index >= this.arr_div.length) return;

        for (let i = 0; i < this.arr_div.length; i++) {
            let d = this.arr_div[i];
            if (i == this.slide_index) {
                d.fadeIn();
                /* d.addClass("anm_taxi_left"); */
                this.arr_spn[i].css("color", "red");
            } else {
                d.hide();
                this.arr_spn[i].css("color", "gray");
            }
        }
    }

    private assignEventHandlers() {
        this.img_next.click(() => {
            this.slide_index = (this.slide_index + 1) % this.arr_div.length;
            this.present();
        });

        this.img_previous.click(() => {
            this.slide_index--;
            if (this.slide_index == -1)
                this.slide_index = this.arr_div.length - 1;

            this.present();
        });

        this.img_pause_play.click(() => {
            this.paused = !this.paused;

            if (this.paused) {
                this.img_pause_play.attr("src", "./img/play.png");
            } else {
                this.img_pause_play.attr("src", "./img/pause.png");
            }
            this.img_pause_play.css("width", "40px");
        });

        this.img_next.mouseover(() => {
            this.img_next.animate({ width: "45px" });
        });
        this.img_next.mouseleave(() => {
            this.img_next.animate({ width: "40px" });
        });

        this.img_previous.mouseover(() => {
            this.img_previous.animate({ width: "45px" });
        });
        this.img_previous.mouseleave(() => {
            this.img_previous.animate({ width: "40px" });
        });

        this.img_pause_play.mouseover(() => {
            this.img_pause_play.animate({ width: "45px" });
        });
        this.img_pause_play.mouseleave(() => {
            this.img_pause_play.animate({ width: "40px" });
        });
    }

    public static init(ownerId, csrf_token = "") {
        new PlgSlideMaster(ownerId, csrf_token);
    }
}
