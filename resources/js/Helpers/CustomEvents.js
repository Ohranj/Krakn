export default class customEvents {
    showError(error) {
        const event = new CustomEvent('show-error', { detail: { message: error, show: true } })
        const el = document.getElementById('main')
        el.dispatchEvent(event)
    }
}