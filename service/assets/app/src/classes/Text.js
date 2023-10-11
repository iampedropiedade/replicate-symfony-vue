export class Text {

    static trim(text, maxLength, ellipsis=true) {
        if(text.length <= maxLength) {
            return text
        }
        let trimmed = text.substring(0, maxLength)
        trimmed = trimmed.substring(0, Math.min(trimmed.length, trimmed.lastIndexOf(' ')))
        if(text.length > trimmed.length && ellipsis === true) {
            trimmed += '...';
        }
        return trimmed;
    }

    static upperFirst(text) {
        return text.charAt(0).toUpperCase() + text.slice(1);
    }

}
