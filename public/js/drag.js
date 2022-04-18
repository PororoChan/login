// DrawingSize
const position = { x: 0, y: 0 };
const ukuran = { x: 0, y: 0 };

// CanvasRender
const cnv = document.getElementById('render');
var dragged = false;
var icon = document.getElementById('icons');
var btn = document.getElementById('dropped');

function hello();

function getPos(ev) {
    ev.preventDefault();
    var rect = cnv.getBoundingClientRect();
    ukuran.x = (ev.pageX - rect.left) / (rect.right - rect.left) * cnv.width;
    ukuran.y = (ev.pageY - rect.top) / (rect.bottom - rect.top) * cnv.height;
    var img = signaturePad.toDataURL('image/svg+xml').removeBlanks();
    ctx.drawImage(img, ukuran.x - img.width / 2, ukuran.y - img.height / 2);
}

interact(".draggable")
    .draggable({
        inertia: true,
        manualStart: true,
        autoScroll: true,
        listeners: {
            move: function (event) {
                position.x += event.dx;
                position.y += event.dy;
                event.target.style.transform = `translate(${position.x}px, ${position.y}px)`; 
                dragged = false;
            },
            end: function (ev) {
                getPos(ev);
                console.log(ev);
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
            container && container.appendChild(element);

            const { offsetTop, offsetLeft } = currentTarget;
            position.x = offsetLeft;
            position.y = offsetTop;
        } 

        interaction.start({ name: "drag" }, event.interactable, element);
    })  

interact('#render').dropzone({
    accept: '#signature-result',
    overlap: 0.25,
    listeners: {
        drop: function (event) {
            dragged = true;
        }
    }
})

interact('#dropped').dropzone({
    accept: '#signature-result',
    listeners: {
        drop: function (event) {
            icon.setAttribute('class', 'fas fa-check');
            btn.setAttribute('class', 'btn btn-outline-secondary float-right');
            
            setTimeout(() => {
                icon.setAttribute('class', 'fas fa-trash');
                btn.setAttribute('class', 'btn btn-outline-danger float-right');
            }, 1000);

            event.relatedTarget.remove();
            $.notify('Tanda Tangan dihapus', 'info');
        }
    }
})





