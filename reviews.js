function addToComparison(propertyId, propertyName) {
    if (comparisonList.length >= 3) {
        alert("لا يمكنك مقارنة أكثر من 3 عقارات.");
        return;
    }

    if (!comparisonList.some(item => item.id === propertyId)) {
        comparisonList.push({ id: propertyId, name: propertyName });
        updateComparisonList();
    } else {
        alert("العقار موجود بالفعل في قائمة المقارنة.");
    }
}

function updateComparisonList() {
    const comparisonBox = document.getElementById('comparison-box');
    comparisonBox.innerHTML = ''; // إعادة تعيين المحتوى

    comparisonList.forEach(property => {
        const propertyElement = document.createElement('div');
        propertyElement.className = 'comparison-item';
        propertyElement.innerText = `عقار: ${property.name} (ID: ${property.id})`;
        comparisonBox.appendChild(propertyElement);
    });

    document.getElementById('compare-button').style.display = comparisonList.length > 0 ? 'block' : 'none';
}
