document.addEventListener('DOMContentLoaded', function () {
    const cartContainer = document.querySelector('.order-list');

    // Function to check if the cart is empty
    function checkEmptyCart() {
        if (!cartContainer.querySelector('.order-item')) {
            cartContainer.innerHTML = `<p class="empty-cart-message">Your cart is empty!</p>`;
        }
    }

    // Initial check when the page loads
    checkEmptyCart();

    // Handle quantity increment and decrement
    document.querySelectorAll('.increase-qty, .decrease-qty').forEach(button => {
        button.addEventListener('click', function () {
            const parent = this.closest('.order-item');
            const quantityDisplay = parent.querySelector('.quantity-display');
            const productId = quantityDisplay.getAttribute('data-id');
            const stock = parseInt(quantityDisplay.getAttribute('data-stock'));
            const currentQuantity = parseInt(quantityDisplay.textContent);

            let newQuantity = currentQuantity;

            if (this.classList.contains('increase-qty')) {
                newQuantity = Math.min(currentQuantity + 1, stock, 10); // Increase quantity, limit by stock and 10
            } else if (this.classList.contains('decrease-qty')) {
                newQuantity = Math.max(currentQuantity - 1, 1); // Decrease quantity, limit by minimum 1
            }

            if (newQuantity === currentQuantity) {
                return; // No change, skip update
            }

            // Update display immediately
            quantityDisplay.textContent = newQuantity;

            // Send update to the server
            fetch('/orders/update-cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: newQuantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert(data.message); // Show error message
                    quantityDisplay.textContent = currentQuantity; // Revert display on error
                }
            })
            .catch(error => {
                console.error('Error updating cart:', error);
                alert('Something went wrong!');
                quantityDisplay.textContent = currentQuantity; // Revert display on failure
            });
        });
    });

    // Handle item removal
    document.querySelectorAll('.removeBtn').forEach(button => {
        button.addEventListener('click', function () {
            const parent = this.closest('.order-item');
            const productId = parent.getAttribute('data-id');

            // Create and show the confirmation popup
            const confirmPopup = document.createElement('div');
            confirmPopup.innerHTML = `
                <div class="popup-overlay">
                    <div class="popup_order">
                        <p>Are you sure you want to remove this item?</p>
                        <button id="confirm-remove">Yes</button>
                        <button id="cancel-remove">No</button>
                    </div>
                </div>
            `;
            document.body.appendChild(confirmPopup);

            // Handle confirmation
            document.getElementById('confirm-remove').addEventListener('click', function () {
                fetch(`/orders/remove/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        parent.remove(); // Remove the item from the DOM
                        checkEmptyCart(); // Check if cart is empty
                    } else {
                        alert('Error removing item from cart.');
                    }
                })
                .catch(error => {
                    console.error('Error removing item:', error);
                    alert('Something went wrong!');
                })
                .finally(() => {
                    confirmPopup.remove(); // Remove the popup
                });
            });

            // Handle cancellation
            document.getElementById('cancel-remove').addEventListener('click', function () {
                confirmPopup.remove(); // Remove the popup
            });
        });
    });

    // Handle form submission for placing orders
    document.querySelector('form').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        const formData = new FormData(this);

        fetch('/orders/place', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success popup
                const successPopup = document.createElement('div');
                successPopup.innerHTML = `
                    <div class="popup-overlay">
                        <div class="popup_order">
                            <p>Order placed successfully!</p>
                            <button id="continue-shopping">Continue Shopping</button>
                        </div>
                    </div>
                `;
                document.body.appendChild(successPopup);

                // Handle "Continue Shopping" button
                document.getElementById('continue-shopping').addEventListener('click', function () {
                    window.location.href = '/';
                });
            } else {
                alert('Failed to place order. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error placing order:', error);
            alert('Something went wrong. Please try again.');
        });
    });
});
