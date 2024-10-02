const body = document.querySelector('body')
sidebar = body.querySelector('.sidebar')
toggle = body.querySelector('.toggle')
modeSwitch = body.querySelector('.toggle-switch')
modeText = body.querySelector('.mode-text')

toggle.addEventListener('click',() =>{
    sidebar.classList.toggle('close')
});


modeSwitch.addEventListener('click',() =>{
    body.classList.toggle('dark')
    if (body.classList.contains('dark')){
        modeText.innerText = 'Light Mode'
        localStorage.setItem('theme', 'light');
    }else{
        localStorage.setItem('theme', 'dark');
        modeText.innerText = 'Dark Mode'
    }

});

// Получаем элементы
// const body = document.querySelector('body');
// const modeSwitch = body.querySelector('.toggle-switch');
// const modeText = body.querySelector('.mode-text');

// Проверяем состояние LocalStorage при загрузке страницы
window.addEventListener('load', () => {
    if (localStorage.getItem('theme') === 'dark') {
        body.classList.add('dark');
        modeText.innerText = 'Light Mode';
    } else {
        body.classList.remove('dark');
        modeText.innerText = 'Dark Mode';
    }
});

// Добавляем обработчик переключения темы
// modeSwitch.addEventListener('click', () => {
//     body.classList.toggle('dark');
//
//     // Сохраняем состояние темы в LocalStorage
//     if (body.classList.contains('dark')) {
//         localStorage.setItem('theme', 'dark');
//         modeText.innerText = 'Light Mode';
//     } else {
//         localStorage.setItem('theme', 'light');
//         modeText.innerText = 'Dark Mode';
//     }
// });
//
