import {
    Toaster,
    ToasterPosition,
    ToasterType,
} from "bs-toaster";

export class Toasts {

    static successToast() {
        return new Toaster({
            position: ToasterPosition.TOP_END,
            type: ToasterType.SUCCESS,
            delay: 5000,
            animation: true,
        });
    }

    static infoToast() {
        return new Toaster({
            position: ToasterPosition.TOP_END,
            type: ToasterType.INFO,
            delay: 5000,
            animation: true,
        });
    }

    static dangerToast() {
        return new Toaster({
            position: ToasterPosition.TOP_END,
            type: ToasterType.DANGER,
            delay: 10000,
            animation: true,
        });
    }

}
