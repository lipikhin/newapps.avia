document.addEventListener('DOMContentLoaded', () => {
    const body = document.querySelector('body');
    const sidebar = body.querySelector('.sidebar');
    const toggle = body.querySelector('.toggle');
    const modeSwitch = body.querySelector('.toggle-switch');
    const modeText = body.querySelector('.mode-text');

    if (toggle) {
        toggle.addEventListener('click', () => {
            if (sidebar) {
                sidebar.classList.toggle('close');
            }
        });
    }

    if (modeSwitch) {
        modeSwitch.addEventListener('click', () => {
            body.classList.toggle('dark');
            if (body.classList.contains('dark')) {
                if (modeText) {
                    modeText.innerText = 'Light Mode';
                }
            } else {
                if (modeText) {
                    modeText.innerText = 'Dark Mode';
                }
            }
        });
    }
});

