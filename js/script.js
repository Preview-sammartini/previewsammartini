document.addEventListener("DOMContentLoaded", () => {
    const h2Element = document.querySelector('main h2');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                h2Element.classList.add('border-expand');
            } else {
                h2Element.classList.remove('border-expand');
            }
        });
    });

    observer.observe(h2Element);
});

document.getElementById("year").innerHTML = new Date().getFullYear();
