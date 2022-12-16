function delegate_event(eventType, ancestorElem, childSelector, eventHandler) {
    if (!ancestorElem || (typeof ancestorElem === 'string' && !(ancestorElem = document.querySelector(ancestorElem)))) {
        return
    }

    ancestorElem.addEventListener(eventType, e => {
        if (e.target && e.target.closest && e.target.closest(childSelector)) {
            (eventHandler)(e)
        }
    })

}