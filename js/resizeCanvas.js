var canvas = document.getElementById('glcanvas');

    function resizeCanvas() {
            canvas.style.width = window.innerWidth;
            canvas.style.height = window.innerHeight;
    }
    resizeCanvas();
    setInterval(resizeCanvas, 30);
