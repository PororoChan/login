// DrawingSize
const position = { x: 0, y: 0 };
const ukuran = { x: 0, y: 0 };

// CanvasRender
const cnv = document.getElementById('render');

var dragged = false,
    icon = document.getElementById('icons'),
    btn = document.getElementById('dropped');

function getPos(ev) {
    ev.preventDefault();
    var rect = cnv.getBoundingClientRect();
    ukuran.x = (ev.pageX - rect.left) / (rect.right - rect.left) * cnv.width;
    ukuran.y = (ev.pageY - rect.top) / (rect.bottom - rect.top) * cnv.height;
    // ctx.drawImage(ev.target, ukuran.x - ev.target.width / 2, ukuran.y - ev.target.height / 2);
}

interact(".draggable")
    .draggable({
        inertia: true,
        manualStart: true,
        autoScroll: true,
        listeners: {
            move: function (event) {
                position.x += parseInt(event.dx);
                position.y += parseInt(event.dy);
                event.target.style.transform = `translate(${position.x}px, ${position.y}px)`;
                dragged = false;
            },
            end: function (ev) {
                getPos(ev);
            }
        },
    })
    .on("move", function (event) {
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
            container.appendChild(element);

            const { offsetTop, offsetLeft } = currentTarget;
            position.x = offsetLeft;
            position.y = offsetTop;

        } else if (interaction.pointerIsDown && !interaction.interacting()) {
            const regex = /translate\(([-\d]+)px, ([\d]+)px\)/i;
            const transform = regex.exec(currentTarget.style.transform);

            if (transform && transform.length > 1) {
                position.x = Number(transform[1]);
                position.y = Number(transform[2]);
            }
        }

        interaction.start({ name: "drag" }, event.interactable, element);
    });

interact('#render').dropzone({
    accept: '.draggable',
    listeners: {
        drop: function (ev) {
            dragged = true; 
        }
    }
});

interact('#dropped').dropzone({
    accept: '.draggable',
    listeners: {
        drop: function(ev) {
            icon.setAttribute('class', 'fas fa-check');
            btn.setAttribute('class', 'btn btn-outline-success float-right');

            setTimeout(() => {
                icon.setAttribute('class', 'fas fa-trash');
                btn.setAttribute('class', 'btn btn-outline-danger float-right');
            }, 1500);

            ev.relatedTarget.remove();
            $.notify('class', 'btn btn-outline-danger float-right');
        }
    }
})







