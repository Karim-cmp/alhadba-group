// مثال بسيط لتحسين وظيفة البحث
document.addEventListener("DOMContentLoaded", function() {
    const searchForm = document.querySelector('form');
    const searchInput = document.querySelector('input[name="search"]');

    searchForm.addEventListener('submit', function(event) {
        event.preventDefault(); // منع إعادة تحميل الصفحة

        const query = searchInput.value;

        fetch('search_properties.php?q=' + encodeURIComponent(query))
            .then(response => response.json())
            .then(data => {
                displayProperties(data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});

// وظيفة لعرض العقارات في صفحة النتائج
function displayProperties(properties) {
    const container = document.querySelector('.container');
    container.innerHTML = ''; // تفريغ المحتوى الحالي

    if (properties.length > 0) {
        properties.forEach(property => {
            const propertyCard = document.createElement('div');
            propertyCard.classList.add('property-card');
            propertyCard.innerHTML = `
                <img src="${property.image_url}" alt="Property Image">
                <h2>${property.title}</h2>
                <p>${property.description}</p>
                <p>السعر: ${property.price} جنيهاً</p>
                <p>عدد الغرف: ${property.number_of_rooms}</p>
                <p>عدد الحمامات: ${property.number_of_bathrooms}</p>
                <p>الموقع: ${property.location}</p>
                <a href="property_details.php?id=${property.id}">عرض التفاصيل</a>
            `;
            container.appendChild(propertyCard);
        });
    } else {
        container.innerHTML = '<p>لا توجد عقارات لعرضها.</p>';
    }
}
