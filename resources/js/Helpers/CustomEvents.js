export default class customEvents {
    showError(error) {
        const event = new CustomEvent('show-error', { detail: { message: error, show: true } })
        const el = document.getElementById('main')
        el.dispatchEvent(event)
    };

    wasClickOutsideElement(startingElem, targetElemId) {
        let currentElem = startingElem
        let isChildOfTarget = false;
        while (!isChildOfTarget) {
            if (currentElem.tagName == 'BODY') {
                break;
            }
            isChildOfTarget = currentElem.getAttribute('id') == targetElemId;    
            currentElem = currentElem.parentElement
        }
        return isChildOfTarget;
    }
}