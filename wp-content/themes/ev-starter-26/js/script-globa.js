document.addEventListener("DOMContentLoaded", function() {
    function removeBrOnMobile() {
        const small = document.querySelector('.text-header');
        if (small && window.innerWidth < 768) {
            small.innerHTML = small.innerHTML.replace(/<br\s*\/?>/, ' ');
        }
    }

    removeBrOnMobile();

    // Opcional: para manejar redimensionamiento de ventana
    window.addEventListener('resize', function() {
        removeBrOnMobile();
    });
});