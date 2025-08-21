document.querySelectorAll('.accordion-button').forEach(button => {
    button.addEventListener('click', () => {
        const content = button.nextElementSibling;
        const isActive = button.classList.contains('active');
        if (isActive) {
            button.classList.remove('active');
            content.classList.remove('show');
        } else {
            button.classList.add('active');
            content.classList.add('show');
        }
        });
    });
    document.querySelectorAll('.sub-accordion-button').forEach(btn => {
        btn.addEventListener('click', (e) => {
        e.stopPropagation(); 
        const isActive = btn.classList.contains('active');
        if (isActive) {
            btn.classList.remove('active');
            btn.nextElementSibling.classList.remove('show');
        } else {
            btn.classList.add('active');
            btn.nextElementSibling.classList.add('show');
        }
    });
});