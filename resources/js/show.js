document.addEventListener('DOMContentLoaded', function () {
    const addToCartButton = document.querySelector('.addCart');
    const counterInput = document.querySelector('#product-counter');
    const inCartElement = document.querySelector('#in-cart-quantity');

    if (addToCartButton && counterInput) {
        // Fetch and update the counter with the current cart quantity
        const productId = addToCartButton.getAttribute('data-id');

        fetch(`/cart/quantity/${productId}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => {
            response => response.text()
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
            if (data.success) {
                const quantity = data.quantity || 0;
                counterInput.value = quantity;
                if (inCartElement) {
                    inCartElement.textContent = quantity;
                }
            }
        })
        .catch(error => {
            console.error(error)
            console.error('Error fetching cart quantity:', error);
        });

        // Handle Add/Update Cart functionality
        addToCartButton.addEventListener('click', function () {
            const quantity = parseInt(counterInput.value);

            if (quantity <= 0 || isNaN(quantity)) {
                alert('Please enter a valid quantity.');
                return;
            }

            fetch(`/cart/handle/${productId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ quantity: quantity })
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
                    if (inCartElement) {
                        inCartElement.textContent = data.quantity;
                    }
                    counterInput.value = data.quantity; // Update the counter
                } else {
                    alert(data.message || 'An error occurred.');
                }
            })
            .catch(error => {
                console.error('Error updating cart:', error);
                alert('Something went wrong!');
            });
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const favoriteIcon = document.querySelector('#favorite-icon');
    const productId = favoriteIcon.parentElement.getAttribute('data-id');

    favoriteIcon.addEventListener('click', function () {
        fetch(`/favorites/toggle/${productId}`, {
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
                favoriteIcon.src = data.isFavorite ? '/pics/heart_filled.png' : '/pics/heart.png';
            } else {
                alert('Unable to update favorite status.');
            }
        })
        .catch(error => {
            console.error('Error toggling favorite:', error);
        });
    });
});

