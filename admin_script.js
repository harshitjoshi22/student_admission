document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', function(event) {
        if (this.textContent === 'Delete') {
            if (!confirm('Are you sure you want to delete this record?')) {
                event.preventDefault();
            }
        }
    });
});
