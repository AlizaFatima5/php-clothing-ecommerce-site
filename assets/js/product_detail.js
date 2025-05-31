function swapImage(img) {
        // Remove active class from all thumbnails
        document.querySelectorAll('.gallery img').forEach(i => i.classList.remove('active'));
        // Add active class to clicked thumbnail
        img.classList.add('active');
        // Change main image src to clicked thumbnail src
        document.getElementById('mainImage').src = img.src;
        document.getElementById('mainImage').alt = img.alt;
    }

    function addToCart(productId) {
        const qtyInput = document.getElementById('quantity');
        let qty = parseInt(qtyInput.value);
        if (qty < 1 || isNaN(qty)) {
            alert("Please enter a valid quantity.");
            qtyInput.focus();
            return;
        }
        // Implement your add to cart logic here (AJAX or form submission)
        alert(`Product ID ${productId} added to cart with quantity ${qty}.`);
    }

    function goToCheckout(productId) {
        const qtyInput = document.getElementById('quantity');
        let qty = parseInt(qtyInput.value);
        if (qty < 1 || isNaN(qty)) {
            alert("Please enter a valid quantity.");
            qtyInput.focus();
            return;
        }
        // Redirect to checkout page with product id and quantity as query params
        window.location.href = `checkout.php?product_id=${productId}&quantity=${qty}`;
    }

    function toggleAccordion(button) {
        const expanded = button.getAttribute('aria-expanded') === 'true';
        const contentId = button.getAttribute('aria-controls');
        const content = document.getElementById(contentId);

        if (expanded) {
            button.setAttribute('aria-expanded', 'false');
            content.setAttribute('aria-hidden', 'true');
            button.querySelector('i').classList.replace('fa-chevron-up', 'fa-chevron-down');
        } else {
            button.setAttribute('aria-expanded', 'true');
            content.setAttribute('aria-hidden', 'false');
            button.querySelector('i').classList.replace('fa-chevron-down', 'fa-chevron-up');
        }
    }