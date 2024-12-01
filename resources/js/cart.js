document.addEventListener('DOMContentLoaded', function () {
    const cartContainer = document.querySelector('.order-list');
   
    function checkEmptyCart() {
        if (!cartContainer.querySelector('.order-item')) {
            cartContainer.innerHTML = `<p class="empty-cart-message">Your cart is empty!</p>`;
        }
    }

    checkEmptyCart();
    updateCartTotal();

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
    
            // Update the total price
            updateCartTotal();
    
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
                    updateCartTotal(); // Revert total on error
                }
            })
            .catch(error => {
                console.error('Error updating cart:', error);
                alert('Something went wrong!');
                quantityDisplay.textContent = currentQuantity; // Revert display on failure
                updateCartTotal(); // Revert total on error
            });
        });
    });

    function updateCartTotal() {
        let total = 0;
    
        // Loop through each order item to calculate the total
        document.querySelectorAll('.order-item').forEach(item => {
            const price = parseFloat(item.querySelector('.price_quant p').textContent.replace('Price: $', ''));
            const quantity = parseInt(item.querySelector('.quantity-display').textContent);
            total += price * quantity;
        });
    
        // Update the total in the DOM
        const totalElement = document.querySelector('.cart-total h3');
        if (totalElement) {
            totalElement.textContent = `Total: $${total.toFixed(2)}`;
        }
    }

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


    
      
});
