const apiUrl = 'https://windex.onrender.com/api/brands';

function formatBonus(bonus) {
    if (!bonus || bonus === 'N/A') return 'N/A';

    const bonusRegex = /^(\d+)%\s*up\s*to\s*([€$£]?)(\d+)\s*(.*?)$/i;
    const match = bonus.match(bonusRegex);

    if (!match) return bonus;
    const [, percentage, currency, amount, extra] = match;
    let formattedBonus = `<strong>${percentage}% jusqu'à ${currency}${amount}</strong>`;

    if (extra.trim()) {
        const extraFormatted = extra.replace(/FS/i, 'Tours Gratuit').trim();
        formattedBonus += `<br>${extraFormatted}`;
    }

    return formattedBonus;
}

function fetchBrands(country = '') {
    const tbody = document.getElementById('brands-tbody');
    tbody.innerHTML = `<tr>
    <td colspan="6" >
        <div class="loading">
            Loading brands...<div class="spinner"></div>
        </div>
    </td></tr>`;

    const headers = country ? { 'CF-IPCountry': country } : {};
    fetch(apiUrl, { headers })
        .then(res => {
            if (!res.ok) throw new Error('Failed to fetch brands');
            return res.json();
        })
        .then(brands => {
            tbody.innerHTML = '';
            let hasCountryMatch = brands.some(b => b.country_code === country.toUpperCase());
            let firstNonCountryFound = false;

            if (brands.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="error">No brands available.</td></tr>';
                return;
            }

            brands.forEach((brand, index) => {
                const isCountryMatch = country && brand.country_code === country.toUpperCase();
                const isFirstInCountry = isCountryMatch && brand.rank === 1;
                const isFirstNonCountry = !isCountryMatch && !firstNonCountryFound && hasCountryMatch;

                if (!isCountryMatch) firstNonCountryFound = true;

                // First row: Main brand content
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>
                        <div class="brand-ranking">
                            ${brand.rank}
                            ${isFirstInCountry ? '<span class="badge best-rating">MEILLEURE NOTE</span>' : ''}
                            ${isFirstNonCountry ? '<span class="badge popular">POPULAIRE</span>' : ''}
                        </div>
                    </td>
                    <td>
                        <div class="casino-cell">
                            <img src="${brand.brand_image}" alt="${brand.brand_name}">
                            <a href="${brand.link}" target="_blank" class="casino-name">${brand.brand_name}</a>
                        </div>
                    </td>
                     <td>
                        <img class="plus" src="https://simplyfinance.com.au/wp-content/uploads/2021/05/Icon-Tick-Dark-1.svg">
                    </td>
                    <td>
                        <div class="bonus">${formatBonus(brand.bonus)}</div>
                    </td>
                    <td class="stars">${renderStars(brand.rating)}</td>
                    <td>
                        <img class="plus" src="asset/plus.png" alt="${brand.brand_name}">
                    </td>
                    <td>
                        <div class="action-column">
                            <button class="visit-btn">Obtenir le bonus</button>
                            <a href="${brand.link}" target="_blank" >Visiter le site</a>
                        </div>
                    </td>
                `;
                tbody.appendChild(row);

                // Second row: Merged cell for description
                const descRow = document.createElement('tr');
                descRow.innerHTML = `
                    <td class="brand-ranking"></td>
                    <td colspan="5" class="description">Découvrir ${brand.brand_name} : C'est un casino de premier ordre offrant des jeux excitants et des bonus.</td>
                `;
                tbody.appendChild(descRow);
            });
        })
        .catch(error => {
            console.error('Error fetching brands:', error);
            tbody.innerHTML = '<tr><td colspan="6" class="error">Failed to load brands. Please try again.</td></tr>';
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

fetchBrands();
document.getElementById('country-info').textContent = 'Toplist basé sur votre localisation (Cloudflare CF-IPCountry)';

document.getElementById('country-selector').addEventListener('change', e => {
    const country = e.target.value;
    document.getElementById('country-info').textContent = country
        ? `Toplist pour ${country}`
        : 'Toplist basé sur votre localisation (Cloudflare CF-IPCountry)';
    fetchBrands(country);
});

document.getElementById('add-brand')?.addEventListener('submit', e => {
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