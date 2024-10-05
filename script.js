let comparisonList = [];

document.getElementById('add-property-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('add_property.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        loadProperties();
        this.reset();
    });
});

document.getElementById('search-form').addEventListener('submit', function(e) {
    e.preventDefault();
    // تنفيذ البحث هنا
});

function loadProperties() {
    fetch('fetch_properties.php')
    .then(response => response.json())
    .then(properties => {
        const propertyList = document.getElementById('property-list');
        propertyList.innerHTML = '';
        properties.forEach(property => {
            const card = document.createElement('div');
            card.className = 'property-card';
            card.innerHTML = `
                <h3>${property.name}</h3>
                <p>${property.description}</p>
                <p>السعر: ${property.price} جنيه</p>
                <p>المساحة: ${property.area} متر مربع</p>
                <img src="images/${property.image}" alt="${property.name}" style="width: 100%; height: auto;">
                <button onclick="addToFavorites(${property.id}, '${property.name}')">أضف للمفضلة</button>
            `;
            propertyList.appendChild(card);
        });
    });
}

function addToFavorites(id, name) {
    const favoritesList = document.getElementById('favorites-list');
    const item = document.createElement('div');
    item.innerText = name;
    favoritesList.appendChild(item);
}

// مقارنة العقارات
function compareProperties() {
    let comparisonDetails = comparisonList.map(id => {
        return 'عقار ' + id; // يمكنك تعديل النص حسب الحاجة
    }).join(', ');

    alert('المقارنة بين العقارات: ' + comparisonDetails);
}

// دردشة مباشرة
document.getElementById('chat-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const messageInput = document.getElementById('message-input');
    const message = messageInput.value;
    const messageDiv = document.createElement('div');
    messageDiv.innerText = message;
    document.getElementById('messages').appendChild(messageDiv);
    messageInput.value = '';
});

// تحميل العقارات عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', loadProperties);
document.getElementById('login-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const email = e.target[0].value;
    const password = e.target[1].value;

    // هنا ستحتاج إلى إرسال الطلب إلى الخادم للتحقق من بيانات المستخدم
    console.log(`تسجيل الدخول باستخدام البريد الإلكتروني: ${email} وكلمة المرور: ${password}`);
    // يمكنك استبدال هذا القسم بطلب AJAX إلى خادمك
});
document.getElementById('comment-form').addEventListener('submit', function (e) {
    e.preventDefault();
    const name = e.target[0].value;
    const comment = e.target[1].value;

    const commentDiv = document.createElement('div');
    commentDiv.innerHTML = `<strong>${name}:</strong> ${comment}`;
    document.getElementById('comments-list').appendChild(commentDiv);
    
    e.target.reset();
});
const chatForm = document.getElementById('chat-form');
const messagesDiv = document.getElementById('messages');

chatForm.addEventListener('submit', function (e) {
    e.preventDefault();
    const messageInput = document.getElementById('message-input');
    const message = messageInput.value;

    const messageDiv = document.createElement('div');
    messageDiv.innerText = message;
    messagesDiv.appendChild(messageDiv);
    messagesDiv.scrollTop = messagesDiv.scrollHeight; // لتحريك الرسالة الجديدة
    messageInput.value = '';
});
