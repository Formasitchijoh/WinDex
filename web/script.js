const apiUrl = 'http://localhost:8000/api/brands';

function fetchBrands(country = '') {
    const headers = country ? { 'CF-IPCountry': country } : {};
    fetch(apiUrl, { headers })
        .then(res => res.json())
        .then(brands => {
            const tbody = document.getElementById('brands-tbody');
            tbody.innerHTML = '';
            brands.forEach(brand => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${brand.rank}</td>
                    <td class="casino-cell">
                        <img src="${brand.brand_image}" alt="${brand.brand_name}">
                        <span>${brand.brand_name}</span>
                    </td>
                    <td>${brand.bonus || 'N/A'}</td>
                    <td class="stars">${renderStars(brand.rating)}</td>
                    <td>${brand.terms || 'N/A'}</td>
                    <td>
                        <a href="${brand.link}" target="_blank" class="visit-btn">Visit Casino</a>
                        <button class="edit-btn" onclick="showUpdateForm(${brand.brand_id}, '${brand.brand_name}', '${brand.brand_image}', ${brand.rating}, '${brand.country_code || ''}', '${brand.bonus || ''}', '${brand.terms || ''}', '${brand.link || ''}')">Edit</button>
                        <button class="delete-btn" onclick="deleteBrand(${brand.brand_id})">Delete</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error fetching brands:', error);
            document.getElementById('country-info').textContent = 'Error loading toplist';
        });
}

function renderStars(rating) {
    let stars = '';
    for (let i = 1; i <= 5; i++) {
        stars += i <= rating ? '★' : '☆';
    }
    return stars;
}

// Initial fetch (relies on Cloudflare's CF-IPCountry in production)
fetchBrands();
document.getElementById('country-info').textContent = 'Toplist based on your location (Cloudflare CF-IPCountry)';

// Simulate CF-IPCountry for testing
document.getElementById('country-selector').addEventListener('change', e => {
    const country = e.target.value;
    document.getElementById('country-info').textContent = country
        ? `Toplist for ${country}`
        : 'Toplist based on your location (Cloudflare CF-IPCountry)';
    fetchBrands(country);
});

document.getElementById('add-brand').addEventListener('submit', e => {
    e.preventDefault();
    const data = {
        brand_name: document.getElementById('name').value,
        brand_image: document.getElementById('image').value,
        rating: parseInt(document.getElementById('rating').value),
        country_code: document.getElementById('country_code').value || null,
        bonus: document.getElementById('bonus').value || null,
        terms: document.getElementById('terms').value || null,
        link: document.getElementById('link').value
    };
    fetch(apiUrl, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    }).then(() => fetchBrands());
});

function deleteBrand(id) {
    fetch(`${apiUrl}/${id}`, { method: 'DELETE' })
        .then(() => fetchBrands());
}

function showUpdateForm(id, name, image, rating, country_code, bonus, terms, link) {
    const existingForm = document.getElementById('update-brand');
    if (existingForm) existingForm.remove();
    const form = document.createElement('form');
    form.id = 'update-brand';
    form.innerHTML = `
        <h2>Edit Casino</h2>
        <input type="text" id="update-name" value="${name}" required>
        <input type="text" id="update-image" value="${image}" required>
        <input type="number" id="update-rating" value="${rating}" min="1" max="5" required>
        <input type="text" id="update-country_code" value="${country_code}" placeholder="Country Code (e.g., CA)">
        <input type="text" id="update-bonus" value="${bonus}" placeholder="Bonus">
        <input type="text" id="update-terms" value="${terms}" placeholder="Terms">
        <input type="url" id="update-link" value="${link}" placeholder="Casino Link" required>
        <button type="submit">Update Casino</button>
        <button type="button" onclick="this.parentElement.remove()">Cancel</button>
    `;
    document.body.insertBefore(form, document.getElementById('brands-table'));
    form.addEventListener('submit', e => {
        e.preventDefault();
        const data = {
            brand_name: document.getElementById('update-name').value,
            brand_image: document.getElementById('update-image').value,
            rating: parseInt(document.getElementById('update-rating').value),
            country_code: document.getElementById('update-country_code').value || null,
            bonus: document.getElementById('update-bonus').value || null,
            terms: document.getElementById('update-terms').value || null,
            link: document.getElementById('update-link').value
        };
        fetch(`${apiUrl}/${id}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        }).then(() => {
            form.remove();
            fetchBrands();
        });
    });
}