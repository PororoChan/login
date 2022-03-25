const position = { x: 0, y: 0 };

interact(".draggable")
    .draggable({
    manualStart: true,
    listeners: {
    move(event) {
        position.x += event.dx;
        position.y += event.dy;
        event.target.style.transform = `translate(${position.x}px, ${position.y}px)`;
    }
    }
})
.on("move", function(event) {
    const { currentTarget, interaction } = event;
    let element = currentTarget;

    if (
    interaction.pointerIsDown &&
    !interaction.interacting() &&
    currentTarget.style.transform === ""
    ) {
    element = currentTarget.cloneNode(true);

    element.style.position = "absolute";
    element.style.left = 0;
    element.style.top = 0;

    const container = document.querySelector("#signature-frame");
    container && container.appendChild(element);

    const { offsetTop, offsetLeft } = currentTarget;
    position.x = offsetLeft;
    position.y = offsetTop;

    } else if (interaction.pointerIsDown && !interaction.interacting()) {
    const regex = /translate\(([\d]+)px, ([\d]+)px\)/i;
    const transform = regex.exec(currentTarget.style.transform);

    if (transform && transform.length > 1) {
        position.x = Number(transform[1]);
        position.y = Number(transform[2]);
    }
    }

    interaction.start({ name: "drag" }, event.interactable, element);
})
.resizable({
    preserveAspectRatio: false,
    edges: { left: true, right: true, bottom: true, top: true }
})
.on('resizemove', function (event) {
    var target = event.target,
        x = (parseFloat(target.getAttribute('data-x')) || 0),
        y = (parseFloat(target.getAttribute('data-y')) || 0);

    target.style.width  = event.rect.width + 'px';
    target.style.height = event.rect.height + 'px';

    x += event.deltaRect.left;
    y += event.deltaRect.top;

    target.style.webkitTransform = target.style.transform =
        'translate(' + x + 'px,' + y + 'px)';

    target.setAttribute('data-x', x);
    target.setAttribute('data-y', y);
    target.textContent = event.rect.width + '×' + event.rect.height;
})

