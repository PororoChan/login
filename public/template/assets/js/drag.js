window.dragMoveListener = dragMoveListener;

interact('.draggable')
    .draggable({
        onmove: dragMoveListener,
        inertia: true,
        autoScroll: true,
        restrict: {
            elementRect: { top: 0, left: 0, bottom: 1, right: 1 }
        }
    })
    .resizable({
        edges: { top: true, left: true, bottom: true, right: true },
        listeners: {
            move: function (event) {
                let { x, y } = event.target.dataset
        
                x = (parseFloat(x) || 0) + event.deltaRect.left
                y = (parseFloat(y) || 0) + event.deltaRect.top
        
                Object.assign(event.target.style, {
                    width: `${event.rect.width}px`,
                    height: `${event.rect.height}px`,
                    transform: `translate(${x}px, ${y}px)`
                })
        
                Object.assign(event.target.dataset, { x, y })
            }
        }
    })
    .styleCursor(false);

function dragMoveListener(event) {
    var target = event.target;
    var x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
    var y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;
    target.style.webkitTransform = target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';
    target.setAttribute('data-x', x);
    target.setAttribute('data-y', y);
}

function resizeMoveListener(event) {
    var target = event.target;
    var x = (parseFloat(target.getAttribute('data-x')) || 0);
    var y = (parseFloat(target.getAttribute('data-y')) || 0);
    x += event.deltaRect.left;
    y += event.deltaRect.top;

    target.style.width = event.rect.width + 'px';
    target.style.height = event.rect.height + 'px';
    target.style.webkitTransform = target.style.transform = 'translate(' + x + 'px,' + y + 'px)';
    target.setAttribute('data-x', x);
    target.setAttribute('data-y', y);    
}
