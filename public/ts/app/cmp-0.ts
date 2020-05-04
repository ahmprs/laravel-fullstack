class Cmp {
    protected elm(elementId: string) {
        let element = <HTMLInputElement>document.getElementById(elementId);
        return element;
    }

    protected getVal(elementId: string) {
        let element = this.elm(elementId);
        return element.value;
    }

    protected setVal(elementId: string, value: any) {
        let element = this.elm(elementId);
        if (element == null) return;
        element.innerText = "" + value;
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
}
