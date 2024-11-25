
function addToCart(event, productId) {
    console.log('Add to Cart clicked'); // Debug log
    event.preventDefault(); // Prevent default link behavior
    event.stopPropagation(); // Prevent event bubbling

    // AJAX request to add or increment the product in the cart
    fetch(`/cart/add-or-increment/${productId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert(data.message);

            // Update the displayed quantity
            const inCartElement = document.querySelector(`#in-cart-quantity[data-id="${productId}"]`);
            if (inCartElement) {
                inCartElement.textContent = data.quantity;
            }
        } else {
            alert(data.message || 'Error adding product to cart.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong!');
    });
}


function toggleFavorite(event, productId) {
    console.log('Favorite clicked'); // Debug log
    event.preventDefault(); // Prevent default link behavior
    event.stopPropagation(); // Prevent event bubbling

    // AJAX request to toggle favorite status
    fetch(`/favorites/toggle/${productId}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const heartIcon = event.target.tagName === 'IMG' ? event.target : event.target.querySelector('img');
            heartIcon.src = data.isFavorite ? '/pics/heart_filled.png' : '/pics/heart.png';
        } else {
            alert('Error updating favorite status.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong!');
    });
}


document.addEventListener('DOMContentLoaded', function () {
    console.log('DOM fully loaded'); // Debug log

    // Attach event listeners for "Add to Cart"
    document.querySelectorAll('.addCart').forEach(button => {
        button.addEventListener('click', function (event) {
            const productId = this.dataset.id; // Get the product ID
            addToCart(event, productId);
        });
    });

    // Attach event listeners for "Favorite"
    document.querySelectorAll('.heart').forEach(heart => {
        heart.addEventListener('click', function (event) {
            const productId = this.dataset.id; // Get the product ID
            toggleFavorite(event, productId);
        });
    });
});

