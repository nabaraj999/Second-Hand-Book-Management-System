function handleBookAction(action, bookId, successMessage, buttonText, buttonColor) {
    if (confirm(`Are you sure you want to ${action} this book?`)) {
        const xhr = new XMLHttpRequest();
        const encodedBookId = encodeURIComponent(bookId);
        xhr.open("GET", `${action}_book.php?id=${encodedBookId}`, true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                const response = xhr.responseText;
                if (response.includes(successMessage)) {
                    const actionButton = document.getElementById(`${action}-${bookId}`);
                    const oppositeAction = action === 'approve' ? 'reject' : 'approve';
                    const oppositeButton = document.getElementById(`${oppositeAction}-${bookId}`);

                    if (actionButton) {
                        actionButton.innerHTML = buttonText;
                        actionButton.style.color = buttonColor;
                        actionButton.disabled = true;

                        // Disable the opposite action button, if it exists
                        if (oppositeButton) {
                            oppositeButton.disabled = true;
                        }
                    } else {
                        console.error(`${capitalize(action)} button not found for book ID:`, bookId);
                    }
                } else {
                    alert(`Failed to ${action} the book: ${response}`);
                }
            } else {
                alert(`Request failed. Status: ${xhr.status}. Error: ${xhr.statusText}`);
            }
        };

        xhr.onerror = function() {
            alert('Request failed due to a network error. Please try again later.');
        };

        xhr.send();
    }
}

function approveBook(bookId) {
    handleBookAction('approve', bookId, 'Book approved successfully!', '✔ Approved', 'green');
}

function rejectBook(bookId) {
    handleBookAction('reject', bookId, 'Book rejected successfully!', '✖ Rejected', 'red');
}

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}
