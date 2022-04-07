// DrawingSize
const position = { x: 0, y: 0 };
const res = { x: 0, y: 0 };
const ukuran = { x: 0, y: 0 };

// CanvasRender
const cnv = document.getElementById('render');
const ct = cnv.getContext("2d");

// cnv.addEventListener("mousemove", function (ev) {
//     var rect = cnv.getBoundingClientRect();

//     ukuran.x = (ev.clientX - rect.left) / (rect.right - rect.left) * cnv.width;
//     ukuran.y = (ev.clientY - rect.top) / (rect.bottom - rect.top) * cnv.height;

//     $('#size').html(ukuran.x + ',' + ukuran.y);
//     ct.fillStyle = '#000000';
//     ct.fillRect(ukuran.x, ukuran.y, 8, 8);
// })

interact(".draggable")
    .draggable({
        manualStart: true,
        autoScroll: true,
        listeners: {
            move: function (event) {
                position.x += event.dx;
                position.y += event.dy;
                event.target.style.transform = `translate(${position.x}px, ${position.y}px)`;
            },
            end: function (ev) {
                var rect = cnv.getBoundingClientRect();

                ukuran.x = (ev.clientX - rect.left) / (rect.right - rect.left) * cnv.width;
                ukuran.y = (ev.clientY - rect.top) / (rect.bottom - rect.top) * cnv.height;

                $('#size').html(ukuran.x + ',' + ukuran.y);
                ct.fillStyle = '#000000';
                ct.fillRect(ukuran.x, ukuran.y, 100,100);
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

interact('#render').dropzone({
    accept: '#signature-result',
    overlap: 0.25,
    // listeners: {
    //     drop: function (event) {
    //         ukuran.x = event.touches[0].clientX;

    //         console.log(ukuran.x);
    //     }
    // }
})


