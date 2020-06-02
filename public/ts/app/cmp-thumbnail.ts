class CmpThumbNail extends Cmp {
    private div_thumbnail = null;
    private h3_title = null;
    private img_pic = null;
    private slide_index = 0;
    private arr_splash = [];
    private div_splash = null;
    private paused = true;

    constructor(ownerId) {
        super(ownerId);

        this.div_thumbnail = this.dlr("div_thumbnail");
        this.h3_title = this.dlr("h3_title");
        this.img_pic = this.dlr("img_pic");
        this.div_splash = this.dlr("div_splash");
        this.arr_splash = this.div_splash.children();

        this.prepare();
        this.assignEventHandlers();
        this.present();
    }

    private prepare() {
        for (let i = 0; i < this.arr_splash.length; i++) {
            this.div_thumbnail.append(this.arr_splash[i]);
            $(this.arr_splash[i]).hide();
            $(this.arr_splash[i]).removeClass("d-none");
        }
    }

    private present() {
        setInterval(() => {
            if (!this.paused) {
                let n = this.arr_splash.length;
                let spn = $(this.arr_splash[this.slide_index]);

                for (let i = 0; i < n; i++) {
                    let s = $(this.arr_splash[i]);

                    if (i == this.slide_index) {
                        s.fadeIn();
                    } else {
                        s.hide();
                    }
                }
                this.slide_index++;
                if (this.slide_index >= n) this.slide_index = 0;

                console.log(spn.text());
            }
        }, 2000);
    }

    private assignEventHandlers() {
        this.img_pic.mouseover(() => {
            this.img_pic.animate({ zoom: "1.2" });
            this.paused = false;
        });

        this.img_pic.mouseleave(() => {
            this.img_pic.animate({ zoom: "1.0" });
            this.paused = true;
        });
    }

    public static init(ownerId) {
        new CmpThumbNail(ownerId);
    }
}
