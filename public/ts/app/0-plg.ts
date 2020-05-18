class Plg {
    public prefix: string = "";

    public me = null;

    public constructor(ownerId: string) {
        this.prefix = ownerId + "_";
        this.me = $("#" + ownerId);
        // Keep track of each object generated
        Globals.arrPlg[ownerId] = this;
    }

    protected applyPath(el, path) {
        let arr: string[] = path.split("/");
        let res = el;
        for (let i = 0; i < arr.length; i++) {
            res = res[arr[i]];
            if (res == null) return null;
        }
        return res;
    }

    protected dlr(id: string) {
        return $("#" + this.prefix + id);
    }

    protected getPlg(id: string) {
        return Globals.arr[this.prefix + id];
    }

    protected make(elementTagName: string, parentElement = null) {
        let element = $(document.createElement(elementTagName));
        if (parentElement == null) {
            element.appendTo(this.me);
        } else {
            element.appendTo(parentElement);
        }
        return element;
    }
}
